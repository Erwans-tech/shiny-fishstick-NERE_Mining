<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // ── Alias personnalisés ──────────────────────────────────────
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
        ]);

        // ── En-têtes de sécurité sur toutes les réponses web ────────
        $middleware->web(append: [
            \App\Http\Middleware\SecurityHeaders::class,
            \App\Http\Middleware\TrackVisitor::class, // Tracker les visites
        ]);

        // ── Faire confiance aux proxies (load balancer, Nginx, CDN) ─
        // Nécessaire pour que HTTPS et l'IP cliente soient détectés correctement
        $middleware->trustProxies(at: '*');

        // ── Niveau de confiance CSRF : SameSite strict + referer ────
        $middleware->validateCsrfTokens(except: [
            // Aucune exception — CSRF activé partout
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // Réponse JSON pour les routes API uniquement
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

        // En production : masquer les détails des erreurs 500
        $exceptions->renderable(function (\Throwable $e, Request $request) {
            if (app()->environment('production') && !$request->expectsJson()) {
                if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                    $status = $e->getStatusCode();
                    // 404 et 403 ont leur propre template Blade si présent
                    return null; // laisse Laravel gérer
                }
            }
            return null;
        });

    })->create();
