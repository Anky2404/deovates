<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'permissions.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = Permission::latest('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $permission = null;

        if ($uuid) {
            try {
                $permission = Permission::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Permission createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.permissions.index')->with('error', 'Unable to load the requested permission.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('permission'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $permission = $uuid ? Permission::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('permissions', 'slug')->ignore($permission?->id)],
            'module' => ['nullable', 'string', 'max:255', Rule::in(array_keys(config('constants.MODULES')))],
            'group' => 'nullable|array',
            'group.*' => 'string|max:255',
            'action' => 'nullable|array',
            'action.*' => [Rule::in(array_values(config('constants.ACTIONS')))],
            'description' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer|min:0',
            'meta' => 'nullable|string',
            'is_system' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        // Columns store multi-select as CSV
        $data['group'] = ! empty($data['group']) ? implode(',', $data['group']) : null;
        $data['action'] = ! empty($data['action']) ? implode(',', $data['action']) : null;

        // Decode safely, bad JSON must not crash save
        $decodedMeta = json_decode($data['meta'] ?? '', true);
        $data['meta'] = is_array($decodedMeta) ? $decodedMeta : [];

        $data['display_order'] = $data['display_order'] ?? 0;
        $data['is_system'] = $request->boolean('is_system');
        $data['is_active'] = $request->boolean('is_active');

        try {
            $oldValues = $permission ? array_intersect_key($permission->getAttributes(), $data) : [];

            if ($permission) {
                $permission->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated permission ' . $permission->name;
            } else {
                // Admin guard, not default guard
                $data['created_by'] = auth('admin')->id();
                $permission = Permission::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created permission ' . $permission->name;
            }

            $newValues = collect($permission->getChanges())->except('updated_at')->toArray();
            $oldValues = collect($oldValues)->only(array_keys($newValues))->toArray();

            ActivityLog::log($action, config('constants.MODULES.permission'), [
                'subject_type' => Permission::class,
                'subject_id' => $permission->id,
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'description' => $description,
            ]);

            return redirect()->route('admin.permissions.index')->with('success', 'Permission saved successfully.');
        } catch (\Throwable $e) {
            Log::error('Permission saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $permission = Permission::where('uuid', $uuid)->firstOrFail();
            $permission->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.permission'), [
                'subject_type' => Permission::class,
                'subject_id' => $permission->id,
                'description' => 'Deleted permission ' . $permission->name,
            ]);

            return back()->with('success', 'Permission deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Permission destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $permission = Permission::where('uuid', $uuid)->firstOrFail();
            $permission->is_active = ! $permission->is_active;
            $permission->save();

            ActivityLog::log(
                $permission->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.permission'),
                [
                    'subject_type' => Permission::class,
                    'subject_id' => $permission->id,
                    'description' => ($permission->is_active ? 'Activated' : 'Deactivated') . ' permission ' . $permission->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $permission->is_active]);
            }

            return back()->with('success', 'Permission status updated.');
        } catch (\Throwable $e) {
            Log::error('Permission togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
