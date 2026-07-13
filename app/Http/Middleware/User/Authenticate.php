<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        return parent::handle($request, $next, 'web');
    }

    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            return Route::has('front.login.index')
                ? route('front.login.index')
                : route('front.home.index');
        }

        return null;
    }
}
