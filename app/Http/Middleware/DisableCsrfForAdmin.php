<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DisableCsrfForAdmin
{
    /**
     * Désactive temporairement la protection CSRF pour les routes admin.
     * ATTENTION : À utiliser seulement pour diagnostiquer/corriger le problème de session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si c'est une route admin, désactiver CSRF temporairement
        if ($request->is('gestion-nm*')) {
            $request->session()->regenerateToken();
            config(['session.csrf_protection' => false]);
        }

        return $next($request);
    }
}