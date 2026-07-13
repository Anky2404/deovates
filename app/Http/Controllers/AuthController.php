<?php

namespace App\Http\Controllers;

use App\Models\AuthLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //Index function
    public function index()
    {
        return view('backend.auth.index');
    }



public function loginsubmit(Request $req, $guard)
{
    try {
        $req->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::with('role')->withTrashed()->where('email', $req->email)->first();

        if (!$user) {
            AuthLog::logEvent('login_attempt', null, false, 'Email not found');
            return back()->with('error', 'No account found with this email.');
        }

        if ($user->trashed()) {
            AuthLog::logEvent('login_attempt', $user->id, false, 'Account deleted');
            return back()->with('error', 'Your account has been deleted.');
        }

        if (!$user->is_active) {
            AuthLog::logEvent('login_attempt', $user->id, false, 'Account deactivated');
            return back()->with('error', 'Your account is deactivated.');
        }

        $remember = $req->filled('remember');

        $authenticated = Auth::guard($guard)->attempt([
            'email'    => $req->email,
            'password' => $req->password,
        ], $remember);

        if (!$authenticated) {
            AuthLog::logEvent('login_attempt', $user->id, false, 'Incorrect password');
            return back()->with('error', 'Incorrect password. Please try again.');
        }

        $req->session()->regenerate();

        session([
            'auth_user_id'    => $user->id,
            'auth_user_name'  => $user->name,
            'auth_user_email' => $user->email,
            'login_time'      => now(),
            'login_ip'        => $req->ip(),
            'login_agent'     => $req->userAgent(),
            'login_browser'   => AuthLog::detectBrowser(),
            'login_device'    => AuthLog::detectDevice(),
            'login_platform'  => AuthLog::detectPlatform(),
        ]);

        if (config('session.driver') === 'database') {
            SessionModel::where('id', session()->getId())->update([
                'user_id'       => $user->id,
                'ip_address'    => $req->ip(),
                'user_agent'    => $req->userAgent(),
                'last_activity' => time(),
            ]);
        }

        AuthLog::logEvent('login_success', $user->id, true);

        $dashboardRoute = $guard === 'admin'
            ? 'admin.dashboard.index'
            : 'user.dashboard.index';

        return redirect()
            ->route($dashboardRoute)
            ->with('success', 'Welcome back, ' . $user->name . '!');

    } catch (\Throwable $e) {
        AuthLog::logEvent('login_error', null, false, $e->getMessage());
        Log::error('Login Error: ' . $e->getMessage());
        return back()->with('error', 'Unexpected error occurred.');
    }
}


    // Forgot Password
    public function forgot()
    {
        return view('backend.auth.forgot');
    }

    // Send reset link
    public function forgotsubmit(Request $request)
    {
        try {
            // Validate email
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            //  Send reset link
            $status = Password::broker('admins')->sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                return back()->with('success', 'Password reset link sent to your email.');
            }

            return back()->with('error', 'Unable to send reset link.');
        } catch (\Throwable $e) {
            dd($request->all());
            Log::error('Forgot Password Error', [
                'email' => $request->email,
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Show Reset form
    public function showResetForm(Request $request, $token)
    {
        return view('backend.auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    // Reset Password
    public function reset(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'token' => 'required',
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8|confirmed',
            ]);

            // Reset password
            $status = Password::broker('admins')->reset(
                $request->only(
                    'email',
                    'password',
                    'password_confirmation',
                    'token'
                ),
                function ($user, $password) {
                    $user->password = Hash::make($password);
                    $user->save();
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return redirect()
                    ->route('admin.login.index')
                    ->with('success', 'Your password has been reset successfully.');
            }

            return back()->with('error', 'Invalid or expired password reset token.');
        } catch (\Throwable $e) {
            Log::error('Reset Password Error', [
                'email' => $request->email,
                'message' => $e->getMessage(),
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // Logout Function
    public function logout(Request $request, $guard)
    {
        try {
            $guard = $guard ?? (Auth::guard('admin')->check() ? 'admin' : 'web');

            Auth::guard($guard)->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route($guard === 'admin' ? 'admin.login.index' : 'login')
                ->with('success', 'Logged out successfully.');
        } catch (\Throwable $e) {
            \Log::error('Logout Error: ' . $e->getMessage());
            return back()->with('error', 'Logout failed. Try again.');
        }
    }
}
