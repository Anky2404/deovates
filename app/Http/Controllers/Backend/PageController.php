<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'pages.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Page::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Page::orderBy('display_order')->orderBy('id')->get();

        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // Persist drag-drop reorder
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    Page::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.page'), [
                'description' => 'Reordered pages',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Page reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function details(string $uuid)
    {
        $page = Page::with(['template', 'content', 'forms'])->where('uuid', $uuid)->firstOrFail();

        return view($this->prefix . $this->folder . 'details', compact('page'));
    }

    public function createoredit(?string $uuid = null)
    {
        $page = null;

        if ($uuid) {
            $page = Page::with('sections')->where('uuid', $uuid)->firstOrFail();
        }

        $sections = Section::orderBy('name')->get();

        return view($this->prefix . $this->folder . 'createoredit', compact('page', 'sections'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $page = $uuid ? Page::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('pages', 'slug')->ignore($page?->id)],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'meta_keywords' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'is_active' => ['nullable'],
            'is_published' => ['nullable'],
            'sections' => ['nullable', 'array'],
            'sections.order' => ['nullable', 'array'],
            'sections.order.*' => ['integer', 'exists:sections,id'],
        ]);

        try {
            DB::beginTransaction();

            $data = $validated;
            unset($data['meta_keywords'], $data['sections']);

            // "name" has no dedicated field in this simplified form — keep
            // it in sync with title since the column is still NOT NULL.
            $data['name'] = $validated['title'];
            $data['meta_keywords'] = $this->parseCommaList($request->input('meta_keywords'));
            $data['is_active'] = $request->boolean('is_active');
            $data['is_published'] = $request->boolean('is_published');

            $isNew = ! $page;

            if ($isNew) {
                $data['created_by'] = auth('admin')->id();
            }
            $data['updated_by'] = auth('admin')->id();

            if ($page) {
                $page->fill($data);
                $page->save();
            } else {
                $page = Page::create($data);
            }

            $sectionOrder = $request->input('sections.order', []);
            $activeSections = $request->input('sections_active', []);
            $sectionSync = [];

            foreach ($sectionOrder as $position => $sectionId) {
                $sectionSync[$sectionId] = [
                    'display_order' => $position + 1,
                    'is_active' => isset($activeSections[$sectionId]),
                ];
            }

            $page->sections()->sync($sectionSync);

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($isNew ? 'create' : 'update')),
                config('constants.MODULES.page'),
                [
                    'subject_type' => Page::class,
                    'subject_id' => $page->id,
                    'new_values' => $page->getChanges(),
                    'description' => ($isNew ? 'Created' : 'Updated') . ' page: ' . $page->name,
                ]
            );

            DB::commit();

            return redirect()->route('admin.pages.index')->with('success', 'Page saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Page saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, string $uuid)
    {
        $page = Page::where('uuid', $uuid)->firstOrFail();

        try {
            $page->is_active = ! $page->is_active;
            $page->save();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.' . ($page->is_active ? 'activate' : 'deactivate')),
                config('constants.MODULES.page'),
                [
                    'subject_type' => Page::class,
                    'subject_id' => $page->id,
                    'new_values' => ['is_active' => $page->is_active],
                    'description' => 'Toggled status of page: ' . $page->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $page->is_active]);
            }

            return back()->with('success', 'Status updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Page togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(string $uuid)
    {
        $page = Page::where('uuid', $uuid)->firstOrFail();

        try {
            $page->delete();

            ActivityLog::log(
                config('constants.ACTIVITY_ACTIONS.delete'),
                config('constants.MODULES.page'),
                [
                    'subject_type' => Page::class,
                    'subject_id' => $page->id,
                    'description' => 'Deleted page: ' . $page->name,
                ]
            );

            return back()->with('success', 'Page deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Page destroy failed: ' . $e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    private function parseCommaList(?string $value): array
    {
        if (empty($value)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $value)), fn ($item) => $item !== ''));
    }
}
