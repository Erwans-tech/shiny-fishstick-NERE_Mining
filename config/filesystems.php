<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | En développement local : "public" (dossier public/uploads/)
    | En production Render   : "r2"    (Cloudflare R2, compatible S3)
    |
    */
    'default' => 'public',

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root'   => storage_path('app/private'),
            'serve'  => true,
            'throw'  => false,
        ],

        // ── Disk local (dev) ──────────────────────────────────────
        'public' => [
            'driver'     => 'local',
            'root'       => public_path('uploads'),
            'url'        => rtrim(env('APP_URL', 'http://localhost'), '/') . '/uploads',
            'visibility' => 'public',
            'throw'      => env('FILESYSTEM_THROW', true),
        ],

        // ── Cloudflare R2 (production Render) ────────────────────
        // Compatible S3. Gratuit jusqu'à 10 GB + 1M req/mois.
        // Variables à renseigner dans Render Environment :
        //   R2_ACCESS_KEY_ID, R2_SECRET_ACCESS_KEY, R2_BUCKET,
        //   R2_ACCOUNT_ID, R2_PUBLIC_URL
        'r2' => [
            'driver'                  => 's3',
            'key'                     => env('R2_ACCESS_KEY_ID'),
            'secret'                  => env('R2_SECRET_ACCESS_KEY'),
            'region'                  => 'auto',
            'bucket'                  => env('R2_BUCKET', 'nere-mining'),
            // Endpoint Cloudflare R2 : https://<account_id>.r2.cloudflarestorage.com
            'endpoint'                => 'https://' . env('R2_ACCOUNT_ID') . '.r2.cloudflarestorage.com',
            // URL publique du bucket (domaine custom ou r2.dev fourni par Cloudflare)
            'url'                     => env('R2_PUBLIC_URL'),
            'use_path_style_endpoint' => true,
            'visibility'              => 'public',
            'throw'                   => true,
        ],

        // ── S3 générique (fallback AWS) ───────────────────────────
        's3' => [
            'driver'                  => 's3',
            'key'                     => env('AWS_ACCESS_KEY_ID'),
            'secret'                  => env('AWS_SECRET_ACCESS_KEY'),
            'region'                  => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'bucket'                  => env('AWS_BUCKET'),
            'url'                     => env('AWS_URL'),
            'endpoint'                => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw'                   => false,
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
