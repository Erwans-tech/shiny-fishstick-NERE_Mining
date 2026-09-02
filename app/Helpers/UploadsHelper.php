<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class UploadsHelper
{
    /**
     * Vérifier la santé des répertoires d'uploads
     */
    public static function healthCheck(): array
    {
        $status = [
            'uploads_writable' => true,
            'directories' => [],
            'errors' => [],
        ];

        $uploadDirs = [
            'public/uploads/applications',
            'public/uploads/certifications',
            'public/uploads/hero',
            'public/uploads/media',
            'public/uploads/news',
            'public/uploads/partners',
            'public/uploads/press',
            'public/uploads/reports',
            'storage/logs',
            'bootstrap/cache',
        ];

        foreach ($uploadDirs as $dir) {
            $path = base_path($dir);
            $exists = File::exists($path);
            $writable = $exists && is_writable($path);

            $status['directories'][$dir] = [
                'exists' => $exists,
                'writable' => $writable,
            ];

            if (!$exists) {
                $status['errors'][] = "Directory does not exist: {$dir}";
                $status['uploads_writable'] = false;
            }

            if ($exists && !$writable) {
                $status['errors'][] = "Directory not writable: {$dir}";
                $status['uploads_writable'] = false;
            }
        }

        return $status;
    }

    /**
     * Créer les répertoires d'uploads s'ils n'existent pas
     */
    public static function ensureDirectoriesExist(): bool
    {
        $uploadDirs = [
            'public/uploads/applications',
            'public/uploads/certifications',
            'public/uploads/hero',
            'public/uploads/media',
            'public/uploads/news',
            'public/uploads/partners',
            'public/uploads/press',
            'public/uploads/reports',
        ];

        try {
            foreach ($uploadDirs as $dir) {
                $path = base_path($dir);
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0755, true);
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Obtenir le chemin public d'un fichier uploadé
     */
    public static function getPublicPath(string $category, string $filename): string
    {
        $basePaths = config('uploads.paths', []);
        $basePath = $basePaths[$category] ?? '/uploads/';
        return $basePath . $filename;
    }

    /**
     * Obtenir le chemin complet de stockage
     */
    public static function getStoragePath(string $category): string
    {
        $disks = config('uploads.disks', []);
        return $disks[$category] ?? 'public/uploads';
    }

    /**
     * Valider un fichier uploadé
     */
    public static function validate($file, string $category = 'images'): array
    {
        $errors = [];
        $limits = config('uploads.limits', []);
        $mimeTypes = config('uploads.mime_types', []);
        $extensions = config('uploads.extensions', []);

        // Vérifier extension
        $ext = strtolower($file->getClientOriginalExtension());
        $allowedExts = $extensions['images'] ?? [];
        if ($category === 'documents') {
            $allowedExts = $extensions['documents'] ?? [];
        } elseif ($category === 'logos') {
            $allowedExts = $extensions['logos'] ?? [];
        }

        if (!in_array($ext, $allowedExts)) {
            $errors[] = "Invalid file extension: {$ext}";
        }

        // Vérifier MIME type
        $mimeType = $file->getMimeType();
        $allowedMimes = $mimeTypes['images'] ?? [];
        if ($category === 'documents') {
            $allowedMimes = $mimeTypes['documents'] ?? [];
        } elseif ($category === 'logos') {
            $allowedMimes = $mimeTypes['logos'] ?? [];
        }

        if (!in_array($mimeType, $allowedMimes)) {
            $errors[] = "Invalid MIME type: {$mimeType}";
        }

        // Vérifier taille
        $maxSizeMB = $limits[$category] ?? 5;
        $maxSizeBytes = $maxSizeMB * 1024 * 1024;
        if ($file->getSize() > $maxSizeBytes) {
            $errors[] = "File too large (max {$maxSizeMB}MB)";
        }

        return $errors;
    }

    /**
     * Générer un nom de fichier sûr
     */
    public static function generateFilename(string $category, string $originalName): string
    {
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $name = preg_replace('/[^a-z0-9]+/i', '-', $name);
        $name = trim($name, '-');
        
        return $name . '-' . uniqid() . '.' . $ext;
    }

    /**
     * Supprimer un fichier uploadé
     */
    public static function delete(string $category, string $filename): bool
    {
        try {
            $path = base_path(self::getStoragePath($category) . '/' . $filename);
            if (File::exists($path)) {
                File::delete($path);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
