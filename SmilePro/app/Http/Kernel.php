<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // HIER, NIET $routeMiddleware maar $middlewareAliases
    protected $middlewareAliases = [

        'auth'     => \App\Http\Middleware\Authenticate::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // Laat je bestaande 'role' middleware hier ook staan als je Spatie gebruikt
        // Voorbeeld:
        // 'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,

        // Nieuwe alias voor jouw eigen middleware:
        'management' => \App\Http\Middleware\EnsureUserIsManagement::class,
    ];
}
