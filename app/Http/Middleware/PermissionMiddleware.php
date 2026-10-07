<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: middleware('permission:view_applications,manage_jobs')
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
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

        // Les admins ont toujours accès
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Vérifier que l'utilisateur a l'une des permissions requises
        $hasPermission = false;
        foreach ($permissions as $permission) {
            // Implémenter la logique de permissions ici
            // Pour maintenant, on peut utiliser une logique simple basée sur les rôles
            if ($this->hasPermission($user, $permission)) {
                $hasPermission = true;
                break;
            }
        }

        if (!$hasPermission) {
            \Log::warning('Permission refusée', [
                'user_id' => $user->id,
                'user_role' => $user->role,
                'required_permissions' => $permissions,
                'ip' => $request->ip(),
                'url' => $request->url(),
            ]);

            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }

    /**
     * Vérifier si l'utilisateur a une permission
     */
    private function hasPermission($user, $permission)
    {
        // Permissions par rôle
        $rolePermissions = [
            'admin' => ['*'], // Tous les accès
            'hr' => [
                'view_applications',
                'manage_applications',
                'view_messages',
                'manage_messages',
                'view_newsletter',
                'manage_newsletter',
            ],
            'site_manager' => [
                'view_jobs',
                'manage_jobs',
                'view_news',
                'manage_news',
                'view_content',
                'manage_content',
                'view_media',
                'manage_media',
                'manage_settings',
            ],
        ];

        $userPermissions = $rolePermissions[$user->role] ?? [];

        // Admin a accès à tout
        if (in_array('*', $userPermissions)) {
            return true;
        }

        return in_array($permission, $userPermissions);
    }
}
