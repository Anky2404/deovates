<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Form;
use App\Models\Section;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'sections.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Section::with('form')->latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Section::orderBy('display_order')->orderBy('id')->get();
        return view($this->prefix . $this->folder . 'index', compact('rows', 'reorderRows'));
    }

    // Persist a new drag-and-drop order from the reorder modal.
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->input('order') as $position => $uuid) {
                    Section::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.section'), [
                'description' => 'Reordered sections',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Section reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    // Create / Edit Function
    public function createoredit(Request $request, ?string $uuid = null)
    {
        $section = null;

        if ($uuid) {
            try {
                $section = Section::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Section createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.sections.index')->with('error', 'Unable to load the requested section.');
            }
        }

        $forms = Form::active()->orderBy('name')->pluck('name', 'id');

        return view($this->prefix . $this->folder . 'createoredit', compact('section', 'forms'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, ?string $uuid = null)
    {
        $section = $uuid ? Section::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('sections', 'slug')->ignore($section?->id)],
            'form_id' => ['nullable', 'exists:forms,id'],
            'content' => ['nullable', 'string'],
            'settings' => ['nullable', 'string'],
            'type' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'is_visible' => ['nullable', 'boolean'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'views' => ['nullable', 'integer', 'min:0'],
        ]);

        // JSON-auto textareas: decode safely, never let bad JSON crash the save.
        $decodedContent = json_decode($data['content'] ?? '', true);
        $data['content'] = is_array($decodedContent) ? $decodedContent : [];

        $decodedSettings = json_decode($data['settings'] ?? '', true);
        $data['settings'] = is_array($decodedSettings) ? $decodedSettings : [];

        $data['is_active'] = $request->boolean('is_active');
        $data['is_visible'] = $request->boolean('is_visible');
        $data['display_order'] = $data['display_order'] ?? 0;
        $data['views'] = $data['views'] ?? 0;

        try {
            DB::beginTransaction();

            if ($section) {
                $section->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated section ' . $section->name;
            } else {
                $section = Section::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created section ' . $section->name;
            }

            ActivityLog::log($action, config('constants.MODULES.section'), [
                'subject_type' => Section::class,
                'subject_id' => $section->id,
                'new_values' => $section->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.sections.index')->with('success', 'Section saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Section saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, string $uuid)
    {
        try {
            $section = Section::where('uuid', $uuid)->firstOrFail();
            $section->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.section'), [
                'subject_type' => Section::class,
                'subject_id' => $section->id,
                'description' => 'Deleted section ' . $section->name,
            ]);

            return back()->with('success', 'Section deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Section destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, string $uuid)
    {
        try {
            $section = Section::where('uuid', $uuid)->firstOrFail();
            $section->is_active = ! $section->is_active;
            $section->save();

            ActivityLog::log(
                $section->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.section'),
                [
                    'subject_type' => Section::class,
                    'subject_id' => $section->id,
                    'description' => ($section->is_active ? 'Activated' : 'Deactivated') . ' section ' . $section->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $section->is_active]);
            }

            return back()->with('success', 'Section status updated.');
        } catch (\Throwable $e) {
            Log::error('Section togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
