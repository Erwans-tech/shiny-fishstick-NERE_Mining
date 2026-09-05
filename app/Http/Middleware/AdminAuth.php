<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Vérifie l'authentification admin.
     * Redirige vers le login masqué si non connecté.
     * Log toute tentative d'accès non autorisé.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! session('admin_logged_in')) {
            // Logger la tentative d'accès non autorisé
            Log::warning('Tentative acces admin non autorisee', [
                'ip'   => $request->ip(),
                'url'  => $request->fullUrl(),
                'ua'   => $request->userAgent(),
            ]);

            return redirect()->route('admin.login')
                ->with('error', 'Accès restreint. Veuillez vous connecter.');
        }

        // Régénérer l'ID de session périodiquement (anti-fixation)
        if (! session('admin_session_renewed')) {
            $request->session()->regenerate();
            session(['admin_session_renewed' => true]);
        }

        // Vérifier que le compte admin existe toujours en base
        // (protection contre suppression de compte après login)
        $adminId = session('admin_id');
        if ($adminId) {
            $still = \App\Models\User::where('id', $adminId)
                ->where('is_admin', true)
                ->exists();
            if (! $still) {
                $request->session()->flush();
                Log::warning('Session admin invalidee — compte introuvable', ['id' => $adminId]);
                return redirect()->route('admin.login')
                    ->with('error', 'Session expirée. Veuillez vous reconnecter.');
            }
        }

        return $next($request);
    }
}
