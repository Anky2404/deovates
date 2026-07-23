<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Backend\Concerns\HandlesImageUploads;
use App\Models\ActivityLog;
use App\Models\AuthLog;
use App\Models\Session as SessionModel;
use App\Models\User;
use App\Services\MediaUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use HandlesImageUploads;

    public function __construct(private MediaUploader $mediaUploader) {}

    public function index()
    {
        return view('backend.auth.index');
    }

    public function loginsubmit(Request $req, $guard)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        try {
            $user = User::with('role')->withTrashed()->where('email', $req->email)->first();

            if (! $user) {
                AuthLog::logEvent('login_attempt', null, false, 'Email not found');

                return back()->withInput($req->only('email'))->with('error', 'No account found with this email.');
            }

            if ($user->trashed()) {
                AuthLog::logEvent('login_attempt', $user->id, false, 'Account deleted');

                return back()->withInput($req->only('email'))->with('error', 'Your account has been deleted.');
            }

            if (! $user->is_active) {
                AuthLog::logEvent('login_attempt', $user->id, false, 'Account deactivated');

                return back()->withInput($req->only('email'))->with('error', 'Your account is deactivated.');
            }

            $remember = $req->boolean('remember');

            $authenticated = Auth::guard($guard)->attempt([
                'email' => $req->email,
                'password' => $req->password,
            ], $remember);

            if (! $authenticated) {
                AuthLog::logEvent('login_attempt', $user->id, false, 'Incorrect password');

                return back()->withInput($req->only('email'))->with('error', 'Incorrect password. Please try again.');
            }

            $req->session()->regenerate();

            $user->forceFill([
                'last_login_at' => now(),
                'last_login_ip' => $req->ip(),
            ])->save();

            session([
                'auth_user_id' => $user->id,
                'auth_user_name' => $user->name,
                'auth_user_email' => $user->email,
                'login_time' => now(),
                'login_ip' => $req->ip(),
                'login_agent' => $req->userAgent(),
                'login_browser' => AuthLog::detectBrowser(),
                'login_device' => AuthLog::detectDevice(),
                'login_platform' => AuthLog::detectPlatform(),
            ]);

            if (config('session.driver') === 'database') {
                SessionModel::where('id', $req->session()->getId())->update([
                    'user_id' => $user->id,
                    'ip_address' => $req->ip(),
                    'user_agent' => $req->userAgent(),
                    'last_activity' => time(),
                ]);
            }

            AuthLog::logEvent('login_success', $user->id, true);

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.login'), config('constants.MODULES.user'), [
                'user_id' => $user->id,
                'user_role' => $user->role?->name,
                'subject_type' => User::class,
                'subject_id' => $user->id,
                'description' => $user->name.' logged in',
            ]);

            $dashboardRoute = $guard === 'admin'
                ? 'admin.dashboard.index'
                : 'user.dashboard.index';

            return redirect()
                ->route($dashboardRoute)
                ->with('success', 'Welcome back, '.$user->name.'!');

        } catch (\Throwable $e) {
            AuthLog::logEvent('login_error', $user->id ?? null, false, $e->getMessage());
            Log::error('Login Error: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput($req->only('email'))->with('error', 'Unexpected error occurred. Please try again.');
        }
    }

    public function forgot()
    {
        return view('backend.auth.forgot');
    }

    public function forgotsubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        try {
            $status = Password::broker('admins')->sendResetLink(
                $request->only('email')
            );

            $sent = $status === Password::RESET_LINK_SENT;

            AuthLog::logEvent('password_reset_request', $user?->id, $sent, $sent ? null : $status);

            if ($sent) {
                return back()->with('success', 'Password reset link sent to your email.');
            }

            return back()->with('error', 'Unable to send reset link.');
        } catch (\Throwable $e) {
            AuthLog::logEvent('password_reset_request', $user?->id, false, $e->getMessage());
            Log::error('Forgot Password Error: '.$e->getMessage(), [
                'email' => $request->email,
                'exception' => $e,
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function showResetForm(Request $request, $token)
    {
        return view('backend.auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        try {
            $status = Password::broker('admins')->reset(
                $request->only(
                    'email',
                    'password',
                    'password_confirmation',
                    'token'
                ),
                function ($user, $password) {
                    $user->password = $password;
                    $user->save();
                }
            );

            $reset = $status === Password::PASSWORD_RESET;

            AuthLog::logEvent('password_reset', $user?->id, $reset, $reset ? null : $status);

            if ($reset) {
                if ($user) {
                    ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.user'), [
                        'user_id' => $user->id,
                        'user_role' => $user->role?->name,
                        'subject_type' => User::class,
                        'subject_id' => $user->id,
                        'description' => $user->name.' reset their password via forgot-password link',
                    ]);
                }

                return redirect()
                    ->route('admin.login.index')
                    ->with('success', 'Your password has been reset successfully.');
            }

            return back()->with('error', 'Invalid or expired password reset token.');
        } catch (\Throwable $e) {
            AuthLog::logEvent('password_reset', $user?->id, false, $e->getMessage());
            Log::error('Reset Password Error: '.$e->getMessage(), [
                'email' => $request->email,
                'exception' => $e,
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function profile()
    {
        $user = Auth::guard('admin')->user();

        return view('backend.auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('admin')->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'designation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|mimes:'.config('constants.IMAGE_MIMES').'|max:4096',
            'avatar_alt' => 'nullable|string|max:255',
        ]);

        try {
            $this->applyImage($request, $data, 'avatar', 'users', $user);

            DB::beginTransaction();

            $user->update($data);

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.user'), [
                'user_id' => $user->id,
                'user_role' => $user->role?->name,
                'subject_type' => User::class,
                'subject_id' => $user->id,
                'new_values' => $user->getChanges(),
                'description' => $user->name.' updated their own profile',
            ]);

            DB::commit();

            return back()->with('success', 'Profile updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Update Profile Error: '.$e->getMessage(), ['exception' => $e]);

            return back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed|different:current_password',
        ]);

        $user = Auth::guard('admin')->user();

        try {
            if (! Hash::check($request->current_password, $user->password)) {
                AuthLog::logEvent('password_change', $user->id, false, 'Current password incorrect');

                return back()->with('error', 'Current password is incorrect.');
            }

            $user->password = $request->password;
            $user->save();

            AuthLog::logEvent('password_change', $user->id, true);

            ActivityLog::log(config('constants.ACTIVITY_ACTIONS.update'), config('constants.MODULES.user'), [
                'user_id' => $user->id,
                'user_role' => $user->role?->name,
                'subject_type' => User::class,
                'subject_id' => $user->id,
                'description' => $user->name.' changed their own password',
            ]);

            return back()->with('success', 'Password changed successfully.');
        } catch (\Throwable $e) {
            AuthLog::logEvent('password_change', $user->id, false, $e->getMessage());
            Log::error('Change Password Error: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function logout(Request $request, $guard)
    {
        try {
            $guard = $guard ?: (Auth::guard('admin')->check() ? 'admin' : 'web');
            $user = Auth::guard($guard)->user();

            if ($user) {
                AuthLog::logEvent('logout', $user->id, true);

                ActivityLog::log(config('constants.ACTIVITY_ACTIONS.logout'), config('constants.MODULES.user'), [
                    'user_id' => $user->id,
                    'user_role' => $user->role?->name,
                    'subject_type' => User::class,
                    'subject_id' => $user->id,
                    'description' => $user->name.' logged out',
                ]);
            }

            Auth::guard($guard)->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route($guard === 'admin' ? 'admin.login.index' : 'login')
                ->with('success', 'Logged out successfully.');
        } catch (\Throwable $e) {
            Log::error('Logout Error: '.$e->getMessage(), ['exception' => $e]);

            return back()->with('error', 'Logout failed. Try again.');
        }
    }
}
