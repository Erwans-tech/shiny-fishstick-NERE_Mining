<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | En développement et sur Render : "public" (dossier public/uploads/ versionné)
    | Le stockage externe n'est pas utilisé sur le plan Render gratuit.
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
            'throw'      => true,
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
