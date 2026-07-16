<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

// Backs two route groups: per-row CRUD and bulk matrix editor
class UserPermissionController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'users.permissions.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Dispatches by resolved route name
    public function index(Request $request)
    {
        if ($request->routeIs('admin.user-permissions.index')) {
            return $this->matrixIndex($request);
        }

        $rows = UserPermission::with(['user', 'permission'])->latest('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // Bulk permission-matrix view
    protected function matrixIndex(Request $request)
    {
        $users = User::active()->orderBy('name')->get();
        $permissions = Permission::active()->orderBy('module')->orderBy('name')->get();

        $selectedUser = null;
        $userPermissions = [];

        if ($request->filled('user_id')) {
            try {
                $selectedUser = User::findOrFail($request->input('user_id'));
                $userPermissions = UserPermission::where('user_id', $selectedUser->id)
                    ->where('is_allowed', true)
                    ->pluck('permission_id')
                    ->toArray();
            } catch (\Throwable $e) {
                Log::error('User permissions matrix lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                $selectedUser = null;
            }
        }

        return view('backend.user-permissions.index', compact('users', 'permissions', 'selectedUser', 'userPermissions'));
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $record = null;

        if ($uuid) {
            try {
                $record = UserPermission::with(['user', 'permission'])->where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('UserPermission createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.users.permissions.index')->with('error', 'Unable to load the requested user permission.');
            }
        }

        $users = User::active()->orderBy('name')->get();
        $permissions = Permission::active()->orderBy('name')->get();

        // Keep deactivated user/permission visible while editing
        if ($record?->user && ! $users->contains('id', $record->user_id)) {
            $users->push($record->user);
        }
        if ($record?->permission && ! $permissions->contains('id', $record->permission_id)) {
            $permissions->push($record->permission);
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('record', 'users', 'permissions'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $record = $uuid ? UserPermission::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('user_permissions', 'user_id')
                    ->ignore($record?->id)
                    ->where(fn ($query) => $query->where('permission_id', $request->input('permission_id'))),
            ],
            'permission_id' => 'required|exists:permissions,id',
            'expires_at' => 'nullable|date',
            'conditions' => 'nullable|string',
            'meta' => 'nullable|string',
            'is_allowed' => 'nullable|boolean',
        ], [
            'user_id.unique' => 'This user already has this permission assigned.',
        ]);

        // Never let bad JSON crash the save
        $decodedConditions = json_decode($data['conditions'] ?? '', true);
        $data['conditions'] = is_array($decodedConditions) ? $decodedConditions : [];

        $decodedMeta = json_decode($data['meta'] ?? '', true);
        $data['meta'] = is_array($decodedMeta) ? $decodedMeta : [];

        $data['is_allowed'] = $request->boolean('is_allowed');

        try {
            DB::beginTransaction();

            $oldValues = $record ? array_intersect_key($record->getAttributes(), $data) : [];

            if ($record) {
                $record->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated user permission assignment';
            } else {
                $data['granted_by'] = auth('admin')->id();
                $record = UserPermission::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Assigned permission to user';
            }

            $newValues = collect($record->getChanges())->except('updated_at')->toArray();
            $oldValues = collect($oldValues)->only(array_keys($newValues))->toArray();

            ActivityLog::log($action, config('constants.MODULES.userpermission'), [
                'subject_type' => UserPermission::class,
                'subject_id' => $record->id,
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.users.permissions.index')->with('success', 'User permission saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('UserPermission saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $record = UserPermission::where('uuid', $uuid)->firstOrFail();
            $record->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.userpermission'), [
                'subject_type' => UserPermission::class,
                'subject_id' => $record->id,
                'description' => 'Deleted user permission assignment',
            ]);

            return back()->with('success', 'User permission deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('UserPermission destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Flips is_allowed
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $record = UserPermission::where('uuid', $uuid)->firstOrFail();
            $record->is_allowed = ! $record->is_allowed;
            $record->save();

            ActivityLog::log(
                $record->is_allowed ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.userpermission'),
                [
                    'subject_type' => UserPermission::class,
                    'subject_id' => $record->id,
                    'description' => ($record->is_allowed ? 'Allowed' : 'Disallowed') . ' user permission assignment',
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $record->is_allowed]);
            }

            return back()->with('success', 'User permission status updated.');
        } catch (\Throwable $e) {
            Log::error('UserPermission togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Bulk grant/revoke, keeps audit trail rows
    public function update(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission_ids' => 'nullable|array',
            'permission_ids.*' => 'exists:permissions,id',
        ]);

        $userId = $data['user_id'];
        $selectedIds = $data['permission_ids'] ?? [];
        $grantedBy = auth('admin')->id();

        try {
            DB::beginTransaction();

            foreach ($selectedIds as $permissionId) {
                UserPermission::updateOrCreate(
                    ['user_id' => $userId, 'permission_id' => $permissionId],
                    ['is_allowed' => true, 'granted_by' => $grantedBy]
                );
            }

            UserPermission::where('user_id', $userId)
                ->when(! empty($selectedIds), fn ($query) => $query->whereNotIn('permission_id', $selectedIds))
                ->update(['is_allowed' => false]);

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.userpermission'), [
                'subject_type' => User::class,
                'subject_id' => $userId,
                'description' => 'Updated permission matrix for user ID ' . $userId,
            ]);

            DB::commit();

            return redirect()->route('admin.user-permissions.index', ['user_id' => $userId])
                ->with('success', 'User permissions updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('User permissions bulk update failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
