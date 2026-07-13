<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'roles.';

    public function __construct()
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = Role::latest('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // Create / Edit Function
    public function createoredit(Request $request, $uuid = null)
    {
        $role = null;

        if ($uuid) {
            try {
                $role = Role::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('Role createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.roles.index')->with('error', 'Unable to load the requested role.');
            }
        }

        return view($this->prefix . $this->folder . 'createoredit', compact('role'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, $uuid = null)
    {
        $role = $uuid ? Role::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('roles', 'slug')->ignore($role?->id)],
            'guard' => ['nullable', 'string', 'max:255', Rule::in(array_keys(config('constants.GUARDS')))],
            'is_active' => 'nullable|boolean',
        ]);

        $data['guard'] = $data['guard'] ?? 'web';
        $data['is_active'] = $request->boolean('is_active');

        try {
            if ($role) {
                $role->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated role ' . $role->name;
            } else {
                $role = Role::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created role ' . $role->name;
            }

            ActivityLog::log($action, config('constants.MODULES.role'), [
                'subject_type' => Role::class,
                'subject_id' => $role->id,
                'new_values' => $role->getChanges(),
                'description' => $description,
            ]);

            return redirect()->route('admin.roles.index')->with('success', 'Role saved successfully.');
        } catch (\Throwable $e) {
            Log::error('Role saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, $uuid)
    {
        try {
            $role = Role::where('uuid', $uuid)->firstOrFail();
            $role->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.role'), [
                'subject_type' => Role::class,
                'subject_id' => $role->id,
                'description' => 'Deleted role ' . $role->name,
            ]);

            return back()->with('success', 'Role deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Role destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
    public function togglestatus(Request $request, $uuid)
    {
        try {
            $role = Role::where('uuid', $uuid)->firstOrFail();
            $role->is_active = ! $role->is_active;
            $role->save();

            ActivityLog::log(
                $role->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.role'),
                [
                    'subject_type' => Role::class,
                    'subject_id' => $role->id,
                    'description' => ($role->is_active ? 'Activated' : 'Deactivated') . ' role ' . $role->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $role->is_active]);
            }

            return back()->with('success', 'Role status updated.');
        } catch (\Throwable $e) {
            Log::error('Role togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
