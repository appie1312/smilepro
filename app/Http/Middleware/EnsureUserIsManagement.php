<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsManagement
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->rolename !== 'admin') {
            abort(403, 'Geen toegang — Alleen praktijkmanagement mag dit zien.');
        }

        return $next($request);
    }
}
