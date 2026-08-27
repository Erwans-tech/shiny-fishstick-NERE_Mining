<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Ajoute les en-têtes de sécurité HTTP à chaque réponse.
 *
 * Ces en-têtes protègent contre :
 *  - XSS (Content-Security-Policy, X-Content-Type-Options)
 *  - Clickjacking (X-Frame-Options)
 *  - Sniffing MIME (X-Content-Type-Options)
 *  - Downgrade HTTP→HTTPS (HSTS)
 *  - Fuite d'informations serveur (X-Powered-By retiré)
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        // ── HSTS : forcer HTTPS pendant 1 an, sous-domaines inclus ──
        if ($request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        // ── Empêcher le clickjacking (iframes non autorisées) ──────
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // ── Empêcher le MIME-sniffing du navigateur ─────────────────
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // ── Limiter les infos dans le Referer ───────────────────────
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // ── Désactiver les fonctionnalités navigateur non utilisées ─
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=()'
        );

        // ── Content Security Policy ─────────────────────────────────
        // Adapté pour le projet : Google Fonts + Google Maps + self
        $csp = implode('; ', [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline'",  // unsafe-inline nécessaire pour JS inline existant
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "font-src 'self' https://fonts.gstatic.com",
            "img-src 'self' data: https:",
            "frame-src https://www.google.com",   // Google Maps embeds
            "connect-src 'self'",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
        ]);
        $response->headers->set('Content-Security-Policy', $csp);

        // ── Retirer les en-têtes qui révèlent le serveur ────────────
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        // ── XSS Protection (legacy, IE 11) ──────────────────────────
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
