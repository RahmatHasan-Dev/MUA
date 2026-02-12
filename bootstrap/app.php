<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Daftarkan alias middleware di sini
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        // Kecualikan route callback dari proteksi CSRF
        $middleware->validateCsrfTokens(except: [
            'api/midtrans-callback',
            '/payment/notification', // ✅ hasil gabungan
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
