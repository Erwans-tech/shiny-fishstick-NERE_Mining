<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Force la redirection de HTTP vers HTTPS en production
 */
class ForceHttps
{
    public function handle(Request $request, Closure $next): Response
    {
        // En production ou si FORCE_HTTPS est activé
        if ((app()->environment('production') || env('FORCE_HTTPS')) && !$request->isSecure()) {
            // Rediriger vers HTTPS
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
