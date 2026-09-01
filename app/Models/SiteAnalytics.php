<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteAnalytics extends Model
{
    protected $fillable = [
        'page_url',
        'page_title',
        'referrer',
        'user_agent',
        'device_type',
        'country',
        'ip_address',
        'visited_at'
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    public $timestamps = false;

    /**
     * Enregistrer une visite
     */
    public static function track($request)
    {
        $userAgent = $request->userAgent();
        
        return static::create([
            'page_url' => $request->fullUrl(),
            'page_title' => null, // Sera rempli par JavaScript côté client
            'referrer' => $request->header('referer'),
            'user_agent' => $userAgent,
            'device_type' => static::detectDevice($userAgent),
            'country' => null, // Peut être rempli avec une API de géolocalisation
            'ip_address' => hash('sha256', $request->ip()), // Hashé pour RGPD
            'visited_at' => now(),
        ]);
    }

    /**
     * Détecter le type d'appareil
     */
    private static function detectDevice($userAgent): string
    {
        if (preg_match('/mobile|android|iphone|ipad|phone/i', $userAgent)) {
            return 'mobile';
        }
        if (preg_match('/tablet|ipad/i', $userAgent)) {
            return 'tablet';
        }
        return 'desktop';
    }
}

