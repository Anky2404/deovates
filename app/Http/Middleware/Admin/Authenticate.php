<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        return parent::handle($request, $next, 'admin');
    }

    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            return route('admin.login.index');
        }

        return null;
    }
}
