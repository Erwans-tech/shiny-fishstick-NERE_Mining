<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Get SEO meta description for a page
     */
    public static function getDescription(string $section, string $locale = 'fr'): string
    {
        $descriptions = config('seo.descriptions')[$locale] ?? [];
        return $descriptions[$section] ?? '';
    }

    /**
     * Get all meta data for a page
     */
    public static function getMeta(string $section, string $locale = 'fr'): array
    {
        return [
            'description' => self::getDescription($section, $locale),
        ];
    }
}
