<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Vérifie que l'utilisateur est connecté en tant qu'admin.
     * Redirige vers le login masqué sinon.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! session('admin_logged_in')) {
            return redirect()->route('admin.login')
                ->with('error', 'Accès restreint. Veuillez vous connecter.');
        }

        return $next($request);
    }
}
