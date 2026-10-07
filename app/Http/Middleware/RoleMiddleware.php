<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: middleware('role:admin,hr')
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Vérifier que l'utilisateur est authentifié en session admin
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Accès non autorisé');
        }

        // Récupérer l'utilisateur connecté
        $user = \App\Models\User::find(session('admin_id'));

        if (!$user) {
            return redirect()->route('admin.login')->with('error', 'Utilisateur non trouvé');
        }

        // Vérifier si l'utilisateur a l'un des rôles requis
        if (!in_array($user->role, $roles)) {
            \Log::warning('Accès non autorisé', [
                'user_id' => $user->id,
                'user_role' => $user->role,
                'required_roles' => $roles,
                'ip' => $request->ip(),
                'url' => $request->url(),
            ]);

            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}

