<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Form;
use App\Models\Page;
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

        return view($this->prefix . $this->folder . 'index', compact('rows'));
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
            $page = Page::with('forms')->where('uuid', $uuid)->firstOrFail();
        }

        $forms = Form::orderBy('name')->get();

        return view($this->prefix . $this->folder . 'createoredit', compact('page', 'forms'));
    }

    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $page = $uuid ? Page::where('uuid', $uuid)->firstOrFail() : null;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('pages', 'slug')->ignore($page?->id)],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'template_id' => ['nullable', 'integer', 'exists:templates,id'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'meta_keywords' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'display_order' => ['nullable', 'integer'],
            'published_at' => ['nullable', 'date'],
            'is_active' => ['nullable'],
            'is_homepage' => ['nullable'],
            'form_ids' => ['nullable', 'array'],
            'form_ids.*' => ['nullable', 'exists:forms,id'],
        ]);

        try {
            DB::beginTransaction();

            $data = $validated;
            unset($data['form_ids'], $data['meta_keywords']);

            $data['meta_keywords'] = $this->parseCommaList($request->input('meta_keywords'));
            $data['is_active'] = $request->boolean('is_active');
            $data['is_homepage'] = $request->boolean('is_homepage');
            $data['published_at'] = $request->filled('published_at') ? $request->input('published_at') : null;

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

            $page->forms()->sync($request->input('form_ids', []));

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
