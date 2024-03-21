<?php

use App\Http\Middleware\OwnCors;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([OwnCors::class]);

        // Use it only in the web routes
        $middleware->web([OwnCors::class]);

        // API only
        $middleware->api([OwnCors::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
