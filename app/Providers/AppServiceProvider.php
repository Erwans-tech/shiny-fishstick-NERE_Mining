<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Forcer HTTPS sur Render (et tout env de production)
        // Render termine le TLS en amont et passe la requête en HTTP en interne.
        // Sans ce code, asset() génère des URL http:// → mixed content warnings.
        if (config('app.env') === 'production' || env('FORCE_HTTPS')) {
            URL::forceScheme('https');
        }
    }
}
