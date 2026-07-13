<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route(Route::has('front.dashboard.index') ? 'front.dashboard.index' : 'front.home.index');
        }

        return $next($request);
    }
}
