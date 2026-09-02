<?php

/**
 * Uploads Configuration
 * Gestion des répertoires et fichiers uploadés
 */

return [
    /**
     * Disques de stockage
     */
    'disks' => [
        'public' => 'public/uploads',
        'applications' => 'public/uploads/applications',
        'news' => 'public/uploads/news',
        'partners' => 'public/uploads/partners',
        'certifications' => 'public/uploads/certifications',
        'hero' => 'public/uploads/hero',
        'media' => 'public/uploads/media',
        'press' => 'public/uploads/press',
        'reports' => 'public/uploads/reports',
    ],

    /**
     * Limites de fichiers (en MB)
     */
    'limits' => [
        'applications' => 5,        // CV et lettres
        'news_image' => 3,
        'hero_image' => 5,
        'media_image' => 5,
        'partners_logo' => 2,
        'certifications_logo' => 2,
        'press_image' => 3,
        'reports_document' => 10,
    ],

    /**
     * Types MIME autorisés
     */
    'mime_types' => [
        'images' => ['image/jpeg', 'image/png', 'image/webp', 'image/gif'],
        'documents' => ['application/pdf', 'application/msword', 
                       'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
        'logos' => ['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp'],
    ],

    /**
     * Extensions autorisées
     */
    'extensions' => [
        'images' => ['jpg', 'jpeg', 'png', 'webp', 'gif'],
        'documents' => ['pdf', 'doc', 'docx'],
        'logos' => ['jpg', 'jpeg', 'png', 'svg', 'webp'],
    ],

    /**
     * Chemins complets (URL publiques)
     */
    'paths' => [
        'applications' => '/uploads/applications/',
        'news' => '/uploads/news/',
        'partners' => '/uploads/partners/',
        'certifications' => '/uploads/certifications/',
        'hero' => '/uploads/hero/',
        'media' => '/uploads/media/',
        'press' => '/uploads/press/',
        'reports' => '/uploads/reports/',
    ],

    /**
     * Nettoyage automatique
     */
    'cleanup' => [
        'enabled' => true,
        'days' => 30,  // Supprimer fichiers temporaires après 30 jours
    ],
];
