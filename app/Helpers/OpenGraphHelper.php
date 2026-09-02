<?php

namespace App\Helpers;

class OpenGraphHelper
{
    /**
     * Generate Open Graph meta tags HTML
     */
    public static function render(
        string $section,
        string $locale = 'fr',
        ?string $description = null,
        ?string $image = null,
        ?string $title = null
    ): string {
        $ogTitle = $title ?? self::getTitle($section, $locale);
        $ogDescription = $description ?? self::getDescription($section, $locale);
        $ogImage = $image ?? self::getImage($section);
        $ogType = 'website';
        $ogUrl = self::getUrl($section, $locale);
        $ogLocale = $locale === 'en' ? 'en_US' : 'fr_FR';

        $html = "\n    <!-- Open Graph Tags -->\n";
        $html .= "    <meta property=\"og:title\" content=\"" . htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8') . "\" />\n";
        $html .= "    <meta property=\"og:description\" content=\"" . htmlspecialchars($ogDescription, ENT_QUOTES, 'UTF-8') . "\" />\n";
        $html .= "    <meta property=\"og:image\" content=\"" . htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') . "\" />\n";
        $html .= "    <meta property=\"og:image:alt\" content=\"" . htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8') . "\" />\n";
        $html .= "    <meta property=\"og:type\" content=\"{$ogType}\" />\n";
        $html .= "    <meta property=\"og:url\" content=\"{$ogUrl}\" />\n";
        $html .= "    <meta property=\"og:site_name\" content=\"Néré Mining\" />\n";
        $html .= "    <meta property=\"og:locale\" content=\"{$ogLocale}\" />\n";
        
        // Alternate language
        $altLocale = $locale === 'en' ? 'fr_FR' : 'en_US';
        $html .= "    <meta property=\"og:locale:alternate\" content=\"{$altLocale}\" />\n";

        // Twitter Card
        $html .= "    <meta name=\"twitter:card\" content=\"summary_large_image\" />\n";
        $html .= "    <meta name=\"twitter:title\" content=\"" . htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8') . "\" />\n";
        $html .= "    <meta name=\"twitter:description\" content=\"" . htmlspecialchars($ogDescription, ENT_QUOTES, 'UTF-8') . "\" />\n";
        $html .= "    <meta name=\"twitter:image\" content=\"" . htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') . "\" />\n";

        // LinkedIn
        $html .= "    <meta name=\"linkedin:card\" content=\"summary_large_image\" />\n";

        return $html;
    }

    /**
     * Get OG title
     */
    public static function getTitle(string $section, string $locale = 'fr'): string
    {
        $titles = config('opengraph.titles', [])[$locale] ?? [];
        return $titles[$section] ?? 'Néré Mining';
    }

    /**
     * Get OG description
     */
    public static function getDescription(string $section, string $locale = 'fr'): string
    {
        $descriptions = config('seo.descriptions', [])[$locale] ?? [];
        return $descriptions[$section] ?? '';
    }

    /**
     * Get OG image URL
     */
    public static function getImage(string $section): string
    {
        $images = config('opengraph.images', []);
        $imagePath = $images[$section] ?? $images['default'] ?? '/images/og-default.jpg';
        return config('app.url') . $imagePath;
    }

    /**
     * Get current page URL for OG
     */
    public static function getUrl(string $section, string $locale = 'fr'): string
    {
        $baseUrl = config('app.url');
        
        // Map sections to routes
        $routeMap = [
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

        if ($locale === 'en') {
            // Map to English routes
            $routeMap['company'] = '/en/about';
            $routeMap['company-ceo'] = '/en/about/ceo-message';
            $routeMap['company-identity'] = '/en/about/identity';
            $routeMap['company-history'] = '/en/about/history';
            $routeMap['company-values'] = '/en/about/values';
            $routeMap['company-governance'] = '/en/about/governance';
            $routeMap['karma'] = '/en/karma';
            $routeMap['resources'] = '/en/resources';
            $routeMap['reserves'] = '/en/reserves';
            $routeMap['projects'] = '/en/projects';
            $routeMap['cil-project'] = '/en/projects/cil-project';
            $routeMap['sustainability'] = '/en/sustainability';
            $routeMap['communities'] = '/en/sustainability/communities';
            $routeMap['environment'] = '/en/sustainability/environment';
            $routeMap['hse'] = '/en/sustainability/health-safety';
            $routeMap['local-content'] = '/en/sustainability/local-content';
            $routeMap['news'] = '/en/news';
            $routeMap['press'] = '/en/press-releases';
            $routeMap['gallery'] = '/en/media';
            $routeMap['reports'] = '/en/publications';
            $routeMap['press-contact'] = '/en/press-contact';
            $routeMap['careers'] = '/en/careers';
            $routeMap['contact'] = '/en/contact';
            $routeMap['home'] = '/en';
        }

        $path = $routeMap[$section] ?? '/';
        return rtrim($baseUrl, '/') . $path;
    }
}
