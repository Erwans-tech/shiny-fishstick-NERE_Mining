<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Retourne l'URL publique d'un fichier uploadé.
     *
     * - En local  : asset('uploads/' . $path)  → http://localhost:8000/uploads/news/xxx.jpg
     * - En prod   : Storage::url($path)         → https://pub-xxx.r2.dev/news/xxx.jpg
     *
     * Gère aussi les chemins statiques commençant par 'images/' (assets du repo).
     *
     * @param  string|null  $path   Chemin relatif au disk (ex: 'news/abc123.jpg')
     * @return string               URL publique complète
     */
    public static function uploadUrl(?string $path): string
    {
        if (empty($path)) {
            return '';
        }

        // Fichiers statiques versionés dans public/images/ → asset() direct
        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        // Les uploads du site doivent toujours être servis depuis le disque public
        // pour qu'ils pointent vers /uploads/... en local et vers le bucket public en prod.
        return Storage::disk('public')->url($path);
    }
}
