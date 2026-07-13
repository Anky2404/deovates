<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Form;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PageSectionController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'pages.sections.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = PageSection::with(['page', 'form'])
            ->latest('id')
            ->paginate($this->pagerecords)
            ->withQueryString();

        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // Create / Edit Function
    public function createoredit(Request $request, $uuid = null)
    {
        $row = null;

        if ($uuid) {
            try {
                $row = PageSection::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('PageSection createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.pages.sections.index')->with('error', 'Unable to load the requested page section.');
            }
        }

        $pages = Page::active()->orderBy('title')->pluck('title', 'id');
        $forms = Form::active()->orderBy('name')->pluck('name', 'id');

        return view($this->prefix . $this->folder . 'createoredit', compact('row', 'pages', 'forms'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, $uuid = null)
    {
        $row = $uuid ? PageSection::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'page_id' => [
                'required',
                'exists:pages,id',
                Rule::unique('page_sections', 'page_id')
                    ->where(fn ($query) => $query->where('form_id', $request->form_id))
                    ->ignore($row?->id),
            ],
            'form_id' => ['required', 'exists:forms,id'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        try {
            DB::beginTransaction();

            if ($row) {
                $row->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated page section link #' . $row->id;
            } else {
                $row = PageSection::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created page section link #' . $row->id;
            }

            ActivityLog::log($action, config('constants.MODULES.pagesection'), [
                'subject_type' => PageSection::class,
                'subject_id' => $row->id,
                'new_values' => $row->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.pages.sections.index')->with('success', 'Page section saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('PageSection saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    // NOTE: PageSection does NOT use SoftDeletes, so this is a permanent, hard delete.
    public function destroy(Request $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $row = PageSection::where('uuid', $uuid)->firstOrFail();
            $row->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.pagesection'), [
                'subject_type' => PageSection::class,
                'subject_id' => $row->id,
                'description' => 'Deleted page section link #' . $row->id,
            ]);

            DB::commit();

            return back()->with('success', 'Page section deleted successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('PageSection destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $row = PageSection::where('uuid', $uuid)->firstOrFail();
            $row->is_active = ! $row->is_active;
            $row->save();

            ActivityLog::log(
                $row->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.pagesection'),
                [
                    'subject_type' => PageSection::class,
                    'subject_id' => $row->id,
                    'description' => ($row->is_active ? 'Activated' : 'Deactivated') . ' page section link #' . $row->id,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $row->is_active]);
            }

            return back()->with('success', 'Page section status updated.');
        } catch (\Throwable $e) {
            Log::error('PageSection togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
