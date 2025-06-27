<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',  // Agregar esta línea
        apiPrefix: 'api',                  // Prefijo para rutas API
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Middleware global para API (opcional)
        $middleware->api([
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
        
        // Puedes agregar más middleware aquí si lo necesitas
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Configuración de excepciones
    })->create();