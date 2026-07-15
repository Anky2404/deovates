<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'departments.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Department::latest('id')->paginate($this->pagerecords)->withQueryString();
        $reorderRows = Department::orderBy('display_order')->orderBy('id')->get();
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
                    Department::where('uuid', $uuid)->update(['display_order' => $position + 1]);
                }
            });

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.department'), [
                'description' => 'Reordered departments',
            ]);

            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            Log::error('Department reorder failed: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
        }
    }

    // Create / Edit Function
    public function createoredit(Request $request, $uuid = null)
    {
        $department = null;

        if ($uuid) {
            try {
                $department = Department::where('uuid', $uuid)->firstOrFail();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Department createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.departments.index')->with('error', 'Unable to load the requested department.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('department'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, $uuid = null)
    {
        $department = $uuid ? Department::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('departments', 'slug')->ignore($department?->id)],
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        try {
            if ($department) {
                $department->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated department ' . $department->name;
            } else {
                $department = Department::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created department ' . $department->name;
            }

            ActivityLog::log($action, config('constants.MODULES.department'), [
                'subject_type' => Department::class,
                'subject_id' => $department->id,
                'new_values' => $department->getChanges(),
                'description' => $description,
            ]);

            return redirect()->route('admin.departments.index')->with('success', 'Department saved successfully.');
        } catch (\Throwable $e) {
            Log::error('Department saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, $uuid)
    {
        try {
            $department = Department::where('uuid', $uuid)->firstOrFail();
            $department->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.department'), [
                'subject_type' => Department::class,
                'subject_id' => $department->id,
                'description' => 'Deleted department ' . $department->name,
            ]);

            return back()->with('success', 'Department deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Department destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $department = Department::where('uuid', $uuid)->firstOrFail();
            $department->is_active = ! $department->is_active;
            $department->save();

            ActivityLog::log(
                $department->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.department'),
                [
                    'subject_type' => Department::class,
                    'subject_id' => $department->id,
                    'description' => ($department->is_active ? 'Activated' : 'Deactivated') . ' department ' . $department->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $department->is_active]);
            }

            return back()->with('success', 'Department status updated.');
        } catch (\Throwable $e) {
            Log::error('Department togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
