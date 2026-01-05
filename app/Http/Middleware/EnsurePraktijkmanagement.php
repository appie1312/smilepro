<?php

// app/Http/Middleware/EnsurePraktijkmanagement.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePraktijkmanagement
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== 'praktijkmanagement') {
            abort(403, 'Je hebt geen toestemming om de omzet te bekijken.');
        }

        return $next($request);
    }
}
