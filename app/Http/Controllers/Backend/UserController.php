<?php

namespace App\Http\Controllers\Backend;

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
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $pagerecords;
    private $prefix = 'backend.';
    private $folder = 'users.';

    public function __construct(private MediaUploader $mediaUploader)
    {
        $this->pagerecords = config('constants.ADMIN_PAGE_RECORDS');
    }

    // Index Function
    public function index(Request $request)
    {
        $rows = User::with(['role', 'department'])->latest('id')->paginate($this->pagerecords)->withQueryString();
        return view($this->prefix . $this->folder . 'index', compact('rows'));
    }

    // Details / Profile Function (both "details" and "profile" routes point here)
    public function details(Request $request, $uuid)
    {
        try {
            $user = User::with(['role', 'department'])->where('uuid', $uuid)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error('User details lookup failed: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('admin.users.index')->with('error', 'Unable to load the requested user.');
        }

        return view($this->prefix . $this->folder . 'details', compact('user'));
    }

    // Create / Edit Function
    public function createoredit(Request $request, $uuid = null)
    {
        $user = null;

        if ($uuid) {
            try {
                $user = User::where('uuid', $uuid)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw $e;
            } catch (\Throwable $e) {
                Log::error('User createoredit lookup failed: ' . $e->getMessage(), ['exception' => $e]);
                return redirect()->route('admin.users.index')->with('error', 'Unable to load the requested user.');
            }
        }

        $roles = Role::active()->orderBy('name')->get();
        $departments = Department::active()->orderBy('name')->get();
        $countries = Country::active()->orderBy('name')->get();

        return view($this->prefix . $this->folder . 'createoredit', compact('user', 'roles', 'departments', 'countries'));
    }

    // Save / Update Function
    public function saveorupdate(Request $request, $uuid = null)
    {
        $user = $uuid ? User::where('uuid', $uuid)->firstOrFail() : null;

        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user?->id)],
            'phone' => 'nullable|string|max:20',
            'designation' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|max:4096',
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:6'],
            'is_active' => 'nullable|boolean',
        ]);

        // country_code is collected by the form for the phone dropdown UI only —
        // the users table has no matching column, so it's intentionally not persisted.

        $data['is_active'] = $request->boolean('is_active');

        // Never overwrite an existing password with a blank value; the "hashed"
        // cast on the model takes care of hashing once we assign a plain string.
        if (empty($data['password'])) {
            unset($data['password']);
        }

        try {
            if ($request->hasFile('avatar')) {
                $data['avatar'] = $this->mediaUploader->uploadSingle(
                    $request->file('avatar'),
                    'users',
                    $user->avatar ?? null
                );
            }

            DB::beginTransaction();

            if ($user) {
                $user->update($data);
                $action = config('constants.ACTIVITY_ACTIONS.update');
                $description = 'Updated user ' . $user->name;
            } else {
                $user = User::create($data);
                $action = config('constants.ACTIVITY_ACTIONS.create');
                $description = 'Created user ' . $user->name;
            }

            ActivityLog::log($action, config('constants.MODULES.user'), [
                'subject_type' => User::class,
                'subject_id' => $user->id,
                'new_values' => $user->getChanges(),
                'description' => $description,
            ]);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User saved successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('User saveorupdate failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Destroy Function
    public function destroy(Request $request, $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();
            $user->delete();

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.delete'), config('constants.MODULES.user'), [
                'subject_type' => User::class,
                'subject_id' => $user->id,
                'description' => 'Deleted user ' . $user->name,
            ]);

            return back()->with('success', 'User deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('User destroy failed: ' . $e->getMessage(), ['exception' => $e]);
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Toggle Status Function
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
                    'description' => ($user->is_active ? 'Activated' : 'Deactivated') . ' user ' . $user->name,
                ]
            );

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'status' => $user->is_active]);
            }

            return back()->with('success', 'User status updated.');
        } catch (\Throwable $e) {
            Log::error('User togglestatus failed: ' . $e->getMessage(), ['exception' => $e]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Something went wrong.'], 500);
            }

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
