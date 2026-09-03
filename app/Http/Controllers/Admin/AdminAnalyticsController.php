<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteAnalytics;
use Illuminate\Support\Facades\DB;

class AdminAnalyticsController extends Controller
{
    /**
     * Helper pour les requêtes SQL compatibles multi-DB
     */
    private function getDbFunction(string $function, string $column): string
    {
        $dbDriver = config('database.default');

        switch ($function) {
            case 'DATE':
                return $dbDriver === 'sqlite'
                    ? "date({$column})"
                    : "DATE({$column})";

            case 'HOUR':
                if ($dbDriver === 'sqlite') {
                    return "CAST(strftime('%H', {$column}) AS INTEGER)";
                }

                if ($dbDriver === 'pgsql') {
                    return "CAST(EXTRACT(HOUR FROM {$column}) AS INTEGER)";
                }

                return "HOUR({$column})";

            default:
                return $function . "({$column})";
        }
    }

    public function index()
    {
        // Période sélectionnée (par défaut : 30 derniers jours)
        $days = request('days', 30);
        $startDate = now()->subDays($days);

        // ═══ STATISTIQUES GLOBALES ═══════════════════════════════════

        // Total visites
        $totalVisits = SiteAnalytics::where('visited_at', '>=', $startDate)->count();

        // Visiteurs uniques (basé sur IP hashée)
        $uniqueVisitors = SiteAnalytics::where('visited_at', '>=', $startDate)
            ->distinct('ip_address')
            ->count('ip_address');

        // Visites aujourd'hui
        $visitsToday = SiteAnalytics::whereDate('visited_at', today())->count();

        // Taux de rebond (visiteurs avec 1 seule page vue)
        $singlePageVisitors = SiteAnalytics::select('ip_address')
            ->where('visited_at', '>=', $startDate)
            ->groupBy('ip_address')
            ->havingRaw('COUNT(*) = 1')
            ->count();
        $bounceRate = $uniqueVisitors > 0 ? round(($singlePageVisitors / $uniqueVisitors) * 100) : 0;

        // Pages par visite (moyenne)
        $avgPagesPerVisit = $uniqueVisitors > 0 ? round($totalVisits / $uniqueVisitors, 1) : 0;

        // ═══ GRAPHIQUE DES VISITES (30 derniers jours) ══════════════

        $dailyVisits = SiteAnalytics::select(
            DB::raw($this->getDbFunction('DATE', 'visited_at') . ' as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('visited_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Remplir les jours manquants avec 0
        $visitsByDay = collect();
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $visitsByDay->push([
                'date' => now()->subDays($i)->format('d/m'),
                'day' => now()->subDays($i)->locale('fr')->isoFormat('ddd'),
                'count' => $dailyVisits->get($date)->count ?? 0,
            ]);
        }

        // ═══ TOP PAGES VISITÉES ══════════════════════════════════════

        $topPages = SiteAnalytics::select('page_url', DB::raw('COUNT(*) as visits'))
            ->where('visited_at', '>=', $startDate)
            ->groupBy('page_url')
            ->orderByDesc('visits')
            ->limit(10)
            ->get()
            ->map(function ($page) {
                return [
                    'url' => parse_url($page->page_url, PHP_URL_PATH) ?: '/',
                    'visits' => $page->visits,
                ];
            });

        // ═══ APPAREILS ═══════════════════════════════════════════════

        $deviceStats = SiteAnalytics::select('device_type', DB::raw('COUNT(*) as count'))
            ->where('visited_at', '>=', $startDate)
            ->whereNotNull('device_type')
            ->groupBy('device_type')
            ->get()
            ->mapWithKeys(fn($item) => [$item->device_type => $item->count]);

        $totalDevices = $deviceStats->sum();
        $devices = [
            'desktop' => [
                'count' => $deviceStats->get('desktop', 0),
                'percent' => $totalDevices > 0 ? round(($deviceStats->get('desktop', 0) / $totalDevices) * 100) : 0,
            ],
            'mobile' => [
                'count' => $deviceStats->get('mobile', 0),
                'percent' => $totalDevices > 0 ? round(($deviceStats->get('mobile', 0) / $totalDevices) * 100) : 0,
            ],
            'tablet' => [
                'count' => $deviceStats->get('tablet', 0),
                'percent' => $totalDevices > 0 ? round(($deviceStats->get('tablet', 0) / $totalDevices) * 100) : 0,
            ],
        ];

        // ═══ SOURCES DE TRAFIC ═══════════════════════════════════════

        $referrers = SiteAnalytics::select('referrer', DB::raw('COUNT(*) as count'))
            ->where('visited_at', '>=', $startDate)
            ->whereNotNull('referrer')
            ->where('referrer', '!=', '')
            ->groupBy('referrer')
            ->orderByDesc('count')
            ->limit(10)
            ->get()
            ->map(function ($ref) {
                $domain = parse_url($ref->referrer, PHP_URL_HOST);
                return [
                    'source' => $domain ?: 'Direct',
                    'visits' => $ref->count,
                ];
            });

        $directVisits = SiteAnalytics::where('visited_at', '>=', $startDate)
            ->where(function ($q) {
                $q->whereNull('referrer')->orWhere('referrer', '');
            })
            ->count();

        if ($directVisits > 0) {
            $referrers->prepend(['source' => 'Direct', 'visits' => $directVisits]);
        }

        // ═══ HEURES DE POINTE ════════════════════════════════════════

        $hourlyVisits = SiteAnalytics::select(
            DB::raw($this->getDbFunction('HOUR', 'visited_at') . ' as hour'),
            DB::raw('COUNT(*) as count')
        )
            ->where('visited_at', '>=', $startDate)
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->keyBy('hour');

        $peakHours = collect(range(0, 23))->map(function ($hour) use ($hourlyVisits) {
            return [
                'hour' => sprintf('%02d:00', $hour),
                'count' => $hourlyVisits->get($hour)->count ?? 0,
            ];
        });

        return view('admin.analytics.index', compact(
            'totalVisits',
            'uniqueVisitors',
            'visitsToday',
            'bounceRate',
            'avgPagesPerVisit',
            'visitsByDay',
            'topPages',
            'devices',
            'referrers',
            'peakHours',
            'days'
        ));
    }
}
