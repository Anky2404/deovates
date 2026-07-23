<?php

use App\Http\Middleware\Admin\Authenticate;
use App\Http\Middleware\Admin\RedirectIfAuthenticated;
use App\Http\Middleware\TrackSiteVisit;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.auth' => Authenticate::class,
            'admin.guest' => RedirectIfAuthenticated::class,
            'user.auth' => App\Http\Middleware\User\Authenticate::class,
            'user.guest' => App\Http\Middleware\User\RedirectIfAuthenticated::class,
            'track.visit' => TrackSiteVisit::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
