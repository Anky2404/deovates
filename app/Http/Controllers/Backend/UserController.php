<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Country;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use App\Services\MediaUploader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use HandlesImageUploads;

    private $pagerecords;

    private $prefix = 'backend.';

    private $folder = 'users.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    public function index(Request $request)
    {
        $rows = User::with(['role', 'department'])->latest('id')->paginate($this->pagerecords)->withQueryString();

        return view($this->prefix.$this->folder.'index', compact('rows'));
    }

    // Also serves "profile" route
    public function details(Request $request, $uuid)
    {
        try {
            $user = User::with(['role', 'department'])->where('uuid', $uuid)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error('User details lookup failed: '.$e->getMessage(), ['exception' => $e]);

            return redirect()->route('admin.users.index')->with('error', 'Unable to load the requested user.');
        }

        return view($this->prefix.$this->folder.'details', compact('user'));
    }

    public function createoredit(Request $request, $uuid = null)
    {
        $user = null;

        if ($uuid) {
            try {
                $user = User::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('User createoredit lookup failed: '.$e->getMessage(), ['exception' => $e]);

                return redirect()->route('admin.users.index')->with('error', 'Unable to load the requested user.');
            }
        }

        $roles = Role::active()->orderBy('name')->get();
        $departments = Department::active()->orderBy('name')->get();
        $countries = Country::active()->orderBy('name')->get();

        return view($this->prefix.$this->folder.'createoredit', compact('user', 'roles', 'departments', 'countries'));
    }

    public function saveorupdate(Request $request, $uuid = null)
    {
        $user = $uuid ? User::where('uuid', $uuid)->firstOrFail() : null;

        $isAdminRole = Role::whereIn('slug', ['super-admin', 'admin'])
            ->where('id', $request->input('role_id'))
            ->exists();

        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'department_id' => [$isAdminRole ? 'nullable' : 'required', 'exists:departments,id'],
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user?->id)],
            'phone' => 'nullable|string|max:20',
            'designation' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|mimes:'.config('constants.IMAGE_MIMES').'|max:4096',
            'avatar_alt' => 'nullable|string|max:255',
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:6'],
            'is_active' => 'nullable|boolean',
        ]);

        // country_code not persisted, UI only
        // Normalize empty department_id to null
        $data['department_id'] = $data['department_id'] ?: null;

        $data['is_active'] = $request->boolean('is_active');

        // Blank password means keep existing
        if (empty($data['password'])) {
            unset($data['password']);
        }

        try {
            $newUuid = null;

            if (! $user) {
                $newUuid = (string) Str::uuid();
                $data['uuid'] = $newUuid;
            }

            $this->applyImage($request, $data, 'avatar', 'users', $user, $newUuid);

            DB::beginTransaction();

            // Snapshot for activity log diff
            $oldValues = $user ? array_intersect_key($user->getAttributes(), $data) : [];

            if ($user) {
                $user->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated user '.$user->name;
            } else {
                $user = User::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created user '.$user->name;
            }

            $newValues = collect($user->getChanges())->except(['updated_at', 'password'])->toArray();
            $oldValues = collect($oldValues)->only(array_keys($newValues))->except('password')->toArray();

            ActivityLog::log($action, config('constants.MODULES.user'), [
                'subject_type' => User::class,
                'subject_id' => $user->id,
                'old_values' => $oldValues,
                'new_values' => $newValues,
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('User saveorupdate failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function destroy(Request $request, $uuid)
    {
        try {
            $user = User::with('role')->where('uuid', $uuid)->firstOrFail();

            if ($user->role?->slug === 'super-admin') {
                return back()->with('error', 'The Super Admin user cannot be deleted.');
            }

            $user->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.user'), [
                'subject_type' => User::class,
                'subject_id' => $user->id,
                'description' => 'Deleted user '.$user->name,
            ]);

            return back()->with('success', 'User deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('User destroy failed: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function togglestatus(Request $request, $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();
            $user->is_active = ! $user->is_active;
            $user->save();

            ActivityLog::log(
                $user->is_active ? config('constants.ACTIVITY_ACTIONS.activate') : config('constants.ACTIVITY_ACTIONS.deactivate'),
                config('constants.MODULES.user'),
                [
                    'subject_type' => User::class,
                    'subject_id' => $user->id,
                    'description' => ($user->is_active ? 'Activated' : 'Deactivated').' user '.$user->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $user->is_active]);
            }

            return back()->with('success', 'User status updated.');
        } catch (\Throwable $e) {
            Log::error('User togglestatus failed: '.$e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
