<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ── 1. Forcer HTTPS en production ───────────────────────────
        if (app()->environment('production') || env('FORCE_HTTPS')) {
            URL::forceScheme('https');
        }

        // ── 2. URL publiques R2 ──────────────────────────────────────
        // Storage::url('path/file.jpg') doit retourner l'URL publique
        // du bucket R2, pas une URL S3 signée.
        // On configure l'URL de base du disk r2 avec R2_PUBLIC_URL.
        if (config('filesystems.default') === 'r2' && env('R2_PUBLIC_URL')) {
            config(['filesystems.disks.r2.url' => rtrim(env('R2_PUBLIC_URL'), '/')]);
        }

        // ── 2. Rate limiting : protection brute-force login ─────────
        RateLimiter::for('login-admin', function (Request $request) {
            return [
                // Max 5 tentatives par IP sur 1 minute
                Limit::perMinute(5)->by($request->ip()),
                // Max 10 par heure sur l'email (si fourni)
                Limit::perHour(10)->by($request->input('email', $request->ip())),
            ];
        });

        // Rate limiting contact form : max 5 soumissions / minute par IP
        RateLimiter::for('contact-form', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        // Rate limiting candidatures : max 3 / heure par IP
        RateLimiter::for('job-apply', function (Request $request) {
            return Limit::perHour(3)->by($request->ip());
        });

        // ── 3. Directive Blade @uploadUrl ───────────────────────────
        // Usage dans les vues : @uploadUrl($model->image_path)
        // ou en PHP inline   : \App\Helpers\StorageHelper::uploadUrl($path)
        \Illuminate\Support\Facades\Blade::directive('uploadUrl', function ($path) {
            return "<?php echo e(\\App\\Helpers\\StorageHelper::uploadUrl({$path})); ?>";
        });
        Validator::extend('safe_file', function ($attribute, $value, $parameters) {
            $allowedMimes = ['image/jpeg','image/png','image/gif','image/webp',
                             'application/pdf','application/msword',
                             'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                             'image/svg+xml'];
            return in_array($value->getMimeType(), $allowedMimes, true);
        });

        // ── 4. Pagination en français ────────────────────────────────
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        // ── 5. Modèle strict en développement uniquement ────────────
        // Détecte les relations N+1, les attributs manquants, etc.
        if (app()->environment('local')) {
            \Illuminate\Database\Eloquent\Model::shouldBeStrict();
        }

        // ── 6. Log des requêtes SQL lentes en production ─────────────
        // Alerte si une requête dépasse 3 secondes
        if (app()->environment('production')) {
            DB::whenQueryingForLongerThan(3000, function (DB $db) {
                \Illuminate\Support\Facades\Log::warning(
                    'Requête SQL lente détectée',
                    ['connection' => $db->getName()]
                );
            });
        }
    }
}
