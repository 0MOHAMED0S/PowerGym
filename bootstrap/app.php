<?php

use App\Http\Middleware\AdminSub;
use App\Http\Middleware\CodeVerify;
use App\Http\Middleware\SuberAdmin;
use App\Http\Middleware\Subscriber;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'CodeVerify' => CodeVerify::class,
            'SuberAdmin' => SuberAdmin::class,
            'Subscriber' => Subscriber::class,
            'AdmSub' => AdminSub::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
