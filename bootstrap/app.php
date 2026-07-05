<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckRole; // 1. Pastikan baris import ini ada di paling atas

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 2. Daftarkan alias middleware auth.role Anda di sini
        $middleware->alias([
            'auth.role' => CheckRole::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();