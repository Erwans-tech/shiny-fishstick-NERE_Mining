<?php

namespace App\Helpers;

class CanonicalHelper
{
    /**
     * Generate canonical URL for a page
     * For bilingual sites, canonical should point to the language-specific version
     */
    public static function render(string $section, string $locale = 'fr'): string
    {
        $url = self::getCanonicalUrl($section, $locale);
        return '<link rel="canonical" href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" />';
    }

    /**
     * Get canonical URL for a section and locale
     */
    public static function getCanonicalUrl(string $section, string $locale = 'fr'): string
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $path = self::getPath($section, $locale);
        return $baseUrl . $path;
    }

    /**
     * Get path for section and locale
     */
    public static function getPath(string $section, string $locale = 'fr'): string
    {
        // Map sections to routes
        $routeMapFr = [
            'home' => '/',
            'company' => '/qui-sommes-nous',
            'company-ceo' => '/qui-sommes-nous/mot-du-pdg',
            'company-identity' => '/qui-sommes-nous/identite',
            'company-history' => '/qui-sommes-nous/histoire',
            'company-values' => '/qui-sommes-nous/valeurs',
            'company-governance' => '/qui-sommes-nous/gouvernance',
            'karma' => '/karma',
            'resources' => '/ressources',
            'reserves' => '/reserves',
            'projects' => '/projets',
            'cil-project' => '/projets/projet-cil',
            'sustainability' => '/developpement-durable',
            'communities' => '/developpement-durable/communautes',
            'environment' => '/developpement-durable/environnement',
            'hse' => '/developpement-durable/sante-securite',
            'local-content' => '/developpement-durable/contenu-local',
            'news' => '/actualites',
            'press' => '/communiques',
            'gallery' => '/mediatheque',
            'reports' => '/rapports',
            'press-contact' => '/contact-presse',
            'careers' => '/carrieres',
            'contact' => '/contact',
            'partners' => '/partenaires',
        ];

        $routeMapEn = [
            'home' => '/en',
            'company' => '/en/about',
            'company-ceo' => '/en/about/ceo-message',
            'company-identity' => '/en/about/identity',
            'company-history' => '/en/about/history',
            'company-values' => '/en/about/values',
            'company-governance' => '/en/about/governance',
            'karma' => '/en/karma',
            'resources' => '/en/resources',
            'reserves' => '/en/reserves',
            'projects' => '/en/projects',
            'cil-project' => '/en/projects/cil-project',
            'sustainability' => '/en/sustainability',
            'communities' => '/en/sustainability/communities',
            'environment' => '/en/sustainability/environment',
            'hse' => '/en/sustainability/health-safety',
            'local-content' => '/en/sustainability/local-content',
            'news' => '/en/news',
            'press' => '/en/press-releases',
            'gallery' => '/en/media',
            'reports' => '/en/publications',
            'press-contact' => '/en/press-contact',
            'careers' => '/en/careers',
            'contact' => '/en/contact',
        ];

        $routeMap = $locale === 'en' ? $routeMapEn : $routeMapFr;
        return $routeMap[$section] ?? '/';
    }

    /**
     * Get alternate language URL (for rel="alternate" hreflang)
     */
    public static function getAlternateUrl(string $section, string $locale = 'fr'): string
    {
        $alternateLocale = $locale === 'en' ? 'fr' : 'en';
        return self::getCanonicalUrl($section, $alternateLocale);
    }

    /**
     * Generate hreflang alternate link tags for bilingual site
     * https://developers.google.com/search/docs/crawling-indexing/localized-versions
     */
    public static function renderHreflang(string $section, string $locale = 'fr'): string
    {
        $currentUrl = self::getCanonicalUrl($section, $locale);
        $alternateUrl = self::getAlternateUrl($section, $locale);
        $currentLang = $locale === 'en' ? 'en' : 'fr';
        $alternateLang = $locale === 'en' ? 'fr' : 'en';

        $html = "\n    <!-- Hreflang for multilingual site -->\n";
        $html .= "    <link rel=\"alternate\" hreflang=\"{$currentLang}\" href=\"" . htmlspecialchars($currentUrl, ENT_QUOTES, 'UTF-8') . "\" />\n";
        $html .= "    <link rel=\"alternate\" hreflang=\"{$alternateLang}\" href=\"" . htmlspecialchars($alternateUrl, ENT_QUOTES, 'UTF-8') . "\" />\n";
        $html .= "    <link rel=\"alternate\" hreflang=\"x-default\" href=\"" . htmlspecialchars(self::getCanonicalUrl($section, 'fr'), ENT_QUOTES, 'UTF-8') . "\" />\n";

        return $html;
    }
}
