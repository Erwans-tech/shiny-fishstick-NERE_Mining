<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\JobOffer;
use App\Models\Report;
use App\Models\PressDocument;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class SitemapController extends Controller
{
    /**
     * Generate sitemap.xml for SEO
     */
    public function sitemap()
    {
        $urls = [];

        // Static pages - FR
        $staticPages = [
            ['url' => '/', 'changefreq' => 'monthly', 'priority' => 1.0],
            ['url' => '/qui-sommes-nous', 'changefreq' => 'monthly', 'priority' => 0.9],
            ['url' => '/qui-sommes-nous/mot-du-pdg', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/qui-sommes-nous/identite', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/qui-sommes-nous/histoire', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/qui-sommes-nous/valeurs', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/qui-sommes-nous/gouvernance', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/karma', 'changefreq' => 'monthly', 'priority' => 0.9],
            ['url' => '/ressources', 'changefreq' => 'quarterly', 'priority' => 0.8],
            ['url' => '/reserves', 'changefreq' => 'quarterly', 'priority' => 0.8],
            ['url' => '/projets', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/projets/projet-cil', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/developpement-durable', 'changefreq' => 'monthly', 'priority' => 0.9],
            ['url' => '/developpement-durable/communautes', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/developpement-durable/environnement', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/developpement-durable/sante-securite', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/developpement-durable/contenu-local', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/actualites', 'changefreq' => 'weekly', 'priority' => 0.8],
            ['url' => '/mediatheque', 'changefreq' => 'monthly', 'priority' => 0.7],
            ['url' => '/communiques', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/contact-presse', 'changefreq' => 'yearly', 'priority' => 0.7],
            ['url' => '/rapports', 'changefreq' => 'quarterly', 'priority' => 0.8],
            ['url' => '/partenaires', 'changefreq' => 'monthly', 'priority' => 0.7],
            ['url' => '/carrieres', 'changefreq' => 'weekly', 'priority' => 0.8],
            ['url' => '/offres-emploi', 'changefreq' => 'weekly', 'priority' => 0.8],
            ['url' => '/candidature-spontanee', 'changefreq' => 'yearly', 'priority' => 0.6],
            ['url' => '/contact', 'changefreq' => 'yearly', 'priority' => 0.7],
        ];

        // Static pages - EN
        $staticPagesEn = [
            ['url' => '/en', 'changefreq' => 'monthly', 'priority' => 1.0],
            ['url' => '/en/about', 'changefreq' => 'monthly', 'priority' => 0.9],
            ['url' => '/en/about/ceo-message', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/en/about/identity', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/en/about/history', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/en/about/values', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/en/about/governance', 'changefreq' => 'yearly', 'priority' => 0.8],
            ['url' => '/en/karma', 'changefreq' => 'monthly', 'priority' => 0.9],
            ['url' => '/en/resources', 'changefreq' => 'quarterly', 'priority' => 0.8],
            ['url' => '/en/reserves', 'changefreq' => 'quarterly', 'priority' => 0.8],
            ['url' => '/en/projects', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/en/projects/cil-project', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/en/sustainability', 'changefreq' => 'monthly', 'priority' => 0.9],
            ['url' => '/en/sustainability/communities', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/en/sustainability/environment', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/en/sustainability/health-safety', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/en/sustainability/local-content', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/en/news', 'changefreq' => 'weekly', 'priority' => 0.8],
            ['url' => '/en/media', 'changefreq' => 'monthly', 'priority' => 0.7],
            ['url' => '/en/press-releases', 'changefreq' => 'monthly', 'priority' => 0.8],
            ['url' => '/en/press-contact', 'changefreq' => 'yearly', 'priority' => 0.7],
            ['url' => '/en/publications', 'changefreq' => 'quarterly', 'priority' => 0.8],
            ['url' => '/en/careers', 'changefreq' => 'weekly', 'priority' => 0.8],
            ['url' => '/en/jobs', 'changefreq' => 'weekly', 'priority' => 0.8],
            ['url' => '/en/spontaneous-application', 'changefreq' => 'yearly', 'priority' => 0.6],
            ['url' => '/en/contact', 'changefreq' => 'yearly', 'priority' => 0.7],
        ];

        $urls = array_merge($urls, $staticPages, $staticPagesEn);

        // Dynamic news articles - FR & EN
        $news = News::published()->latest('published_at')->get();
        foreach ($news as $item) {
            $urls[] = [
                'url' => '/actualites/' . $item->slug,
                'lastmod' => $item->updated_at->toAtomString(),
                'changefreq' => 'never',
                'priority' => 0.7,
            ];
            $urls[] = [
                'url' => '/en/news/' . $item->slug,
                'lastmod' => $item->updated_at->toAtomString(),
                'changefreq' => 'never',
                'priority' => 0.7,
            ];
        }

        // Job offers - FR & EN
        $jobs = JobOffer::where('is_published', true)->latest()->get();
        foreach ($jobs as $job) {
            $urls[] = [
                'url' => '/offres-emploi/' . $job->slug,
                'lastmod' => $job->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => 0.8,
            ];
            $urls[] = [
                'url' => '/en/jobs/' . $job->slug,
                'lastmod' => $job->updated_at->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => 0.8,
            ];
        }

        // Reports - FR & EN
        $reports = Report::published()->latest('published_at')->get();
        foreach ($reports as $report) {
            $urls[] = [
                'url' => '/rapports/' . $report->slug,
                'lastmod' => $report->updated_at->toAtomString(),
                'changefreq' => 'never',
                'priority' => 0.6,
            ];
        }

        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars(config('app.url') . $url['url'], ENT_XML1) . "</loc>\n";
            if (isset($url['lastmod'])) {
                $xml .= "    <lastmod>" . $url['lastmod'] . "</lastmod>\n";
            }
            $xml .= "    <changefreq>" . $url['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . $url['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= "</urlset>";

        return Response::make($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Content-Disposition' => 'inline; filename="sitemap.xml"',
        ]);
    }
}
