<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * En-têtes de sécurité HTTP ajoutés à chaque réponse.
 * Protège contre XSS, clickjacking, sniffing MIME, downgrade HTTPS.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        // ── HSTS : forcer HTTPS pendant 1 an ─────────────────────
        if ($request->isSecure()) {
            $response->headers->set(
                'Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        // ── Bloquer les iframes (anti-clickjacking) ───────────────
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // ── Empêcher MIME sniffing ────────────────────────────────
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // ── Contrôle du Referer ───────────────────────────────────
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // ── Désactiver fonctionnalités navigateur non utilisées ───
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=(), usb=()'
        );

        // ── Content Security Policy ───────────────────────────────
        // Adapté au projet : Google Fonts + Google Maps + éventuellement R2
        $r2Domain = '';
        if (env('R2_PUBLIC_URL')) {
            $host     = parse_url(env('R2_PUBLIC_URL'), PHP_URL_HOST);
            $r2Domain = $host ? ' https://' . $host : '';
        }

        $csp = implode('; ', array_filter([
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline'",           // unsafe-inline nécessaire pour JS inline existant
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
            "font-src 'self' https://fonts.gstatic.com",
            "img-src 'self' data: https:" . $r2Domain,     // https: pour R2 et Google Maps
            "frame-src https://www.google.com https://www.youtube.com https://player.vimeo.com",
            "connect-src 'self'",
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
            "upgrade-insecure-requests",
        ]));

        $response->headers->set('Content-Security-Policy', $csp);

        // ── Retirer les en-têtes révélant le serveur ─────────────
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        // ── XSS Protection legacy (IE 11) ─────────────────────────
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        return $response;
    }
}
