<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\SiteAnalytics;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ne pas tracker les requêtes admin, API, assets
        if (
            $request->is('gestion-nm/*') || 
            $request->is('api/*') || 
            $request->is('storage/*') ||
            $request->is('css/*') ||
            $request->is('js/*') ||
            $request->is('images/*')
        ) {
            return $next($request);
        }

        // Tracker uniquement les requêtes GET (pages affichées)
        if ($request->isMethod('GET')) {
            try {
                SiteAnalytics::track($request);
            } catch (\Exception $e) {
                // Silencieusement ignorer les erreurs de tracking
                \Log::error('Analytics tracking error: ' . $e->getMessage());
            }
        }

        return $next($request);
    }
}

