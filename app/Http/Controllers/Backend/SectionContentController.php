<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\SectionContent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SectionContentController extends Controller
{
    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'section-contents.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = SectionContent::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = SectionContent::orderBy('display_order')->orderBy('id')->get();

        return view($this->prefix.$this->folder.'index', compact('rows', 'reorderRows'));
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
                    SectionContent::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.sectioncontent'), [
                'description' => 'Reordered section contents',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('SectionContent reorder failed: '.$e->getMessage(), ['exception' => $e]);

            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $sectionContent = null;

        if ($uuid) {
            try {
                $sectionContent = SectionContent::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('SectionContent createoredit lookup failed: '.$e->getMessage(), ['exception' => $e]);

                return redirect()->route('admin.section-contents.index')->with('error', 'Unable to load the requested section content.');
            }
        }

        return view($this->prefix.$this->folder.'createoredit', compact('sectionContent'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $sectionContent = $uuid ? SectionContent::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('section_contents', 'slug')->ignore($sectionContent?->id)],
            'page_name' => ['required', 'string', Rule::in(array_keys(config('constants.PAGE_NAMES')))],
            'section_name' => ['required', 'string', Rule::in(array_keys(config('constants.SECTION_NAMES')))],
            'section_label' => 'nullable|string|max:255',
            'section_title' => 'nullable|string|max:255',
            'section_subtitle' => 'nullable|string|max:255',
            'left_description' => 'nullable|string',
            'right_list' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if (! $sectionContent) {
            $data['display_order'] = (SectionContent::max('display_order') ?? 0) + 1;
        }

        try {
            if ($sectionContent) {
                $sectionContent->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated section content '.$sectionContent->title;
            } else {
                $sectionContent = SectionContent::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created section content '.$sectionContent->title;
            }

            ActivityLog::log($action, config('constants.MODULES.sectioncontent'), [
                'subject_type' => SectionContent::class,
                'subject_id' => $sectionContent->id,
                'new_values' => $sectionContent->getChanges(),
                'description' => $description,
            ]);

            return redirect()->route('admin.section-contents.index')->with('success', 'Section content saved successfully.');
        } catch (\Throwable $e) {
            Log::error('SectionContent saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $sectionContent = SectionContent::where('uuid', $uuid)->firstOrFail();
            $sectionContent->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.sectioncontent'), [
                'subject_type' => SectionContent::class,
                'subject_id' => $sectionContent->id,
                'description' => 'Deleted section content '.$sectionContent->title,
            ]);

            return back()->with('success', 'Section content deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('SectionContent destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $sectionContent = SectionContent::where('uuid', $uuid)->firstOrFail();
            $sectionContent->is_active = ! $sectionContent->is_active;
            $sectionContent->save();

            ActivityLog::log(
                $sectionContent->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.sectioncontent'),
                [
                    'subject_type' => SectionContent::class,
                    'subject_id' => $sectionContent->id,
                    'description' => ($sectionContent->is_active ? 'Activated' : 'Deactivated').' section content '.$sectionContent->title,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $sectionContent->is_active]);
            }

            return back()->with('success', 'Section content status updated.');
        } catch (\Throwable $e) {
            Log::error('SectionContent togglestatus failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
