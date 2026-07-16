<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class RolePermissionController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'roles.permissions.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = RolePermission::with(['role', 'permission'])->latest('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $rolePermission = null;

        if ($uuid) {
            try {
                $rolePermission = RolePermission::with(['role', 'permission'])->where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('RolePermission createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.roles.permissions.index')->with('error', 'Unable to load the requested role permission.');
            }
        }

        $roles = Role::active()->orderBy('name')->get();
        $permissions = Permission::active()->orderBy('name')->get();

        // Keep deactivated role/permission in list
        if ($rolePermission?->role && ! $roles->contains('id', $rolePermission->role_id)) {
            $roles->push($rolePermission->role);
        }
        if ($rolePermission?->permission && ! $permissions->contains('id', $rolePermission->permission_id)) {
            $permissions->push($rolePermission->permission);
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('rolePermission', 'roles', 'permissions'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $rolePermission = $uuid ? RolePermission::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'role_id' => [
                'required',
                'exists:roles,id',
                Rule::unique('role_permissions', 'role_id')
                    ->ignore($rolePermission?->id)
                    ->where(fn ($query) => $query->where('permission_id', $request->input('permission_id'))),
            ],
            'permission_id' => 'required|exists:permissions,id',
            'conditions' => 'nullable|string',
            'meta' => 'nullable|string',
            'is_allowed' => 'nullable|boolean',
        ], [
            'role_id.unique' => 'This role already has this permission assigned.',
        ]);

        // Decode safely, bad JSON must not crash save
        $decodedConditions = json_decode($data['conditions'] ?? '', true);
        $data['conditions'] = is_array($decodedConditions) ? $decodedConditions : [];

        $decodedMeta = json_decode($data['meta'] ?? '', true);
        $data['meta'] = is_array($decodedMeta) ? $decodedMeta : [];

        $data['is_allowed'] = $request->boolean('is_allowed');

        try {
            DB::beginTransaction();

            $oldValues = $rolePermission ? array_intersect_key($rolePermission->getAttributes(), $data) : [];

            if ($rolePermission) {
                $rolePermission->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated role permission assignment';
            } else {
                $rolePermission = RolePermission::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Assigned permission to role';
            }

            $newValues = collect($rolePermission->getChanges())->except('updated_at')->toArray();
            $oldValues = collect($oldValues)->only(array_keys($newValues))->toArray();

            ActivityLog::log($action, config('constants.MODULES.rolepermission'), [
                'subject_type' => RolePermission::class,
                'subject_id' => $rolePermission->id,
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.roles.permissions.index')->with('success', 'Role permission saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('RolePermission saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $rolePermission = RolePermission::where('uuid', $uuid)->firstOrFail();
            $rolePermission->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.rolepermission'), [
                'subject_type' => RolePermission::class,
                'subject_id' => $rolePermission->id,
                'description' => 'Deleted role permission assignment',
            ]);

            return back()->with('success', 'Role permission deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('RolePermission destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Flips is_allowed, drives index badge
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $rolePermission = RolePermission::where('uuid', $uuid)->firstOrFail();
            $rolePermission->is_allowed = ! $rolePermission->is_allowed;
            $rolePermission->save();

            ActivityLog::log(
                $rolePermission->is_allowed ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.rolepermission'),
                [
                    'subject_type' => RolePermission::class,
                    'subject_id' => $rolePermission->id,
                    'description' => ($rolePermission->is_allowed ? 'Allowed' : 'Disallowed') . ' role permission assignment',
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $rolePermission->is_allowed]);
            }

            return back()->with('success', 'Role permission status updated.');
        } catch (\Throwable $e) {
            Log::error('RolePermission togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
