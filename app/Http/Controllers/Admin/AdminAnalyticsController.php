<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteAnalytics;
use Illuminate\Http\Request;
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
        $days = (int) request('days', 30);
        $days = in_array($days, [7, 30, 90, 365], true) ? $days : 30;
        
        // Filtres optionnels
        $pageFilter = request('page', '');
        $deviceFilter = request('device', '');
        
        $startDate = now()->subDays($days);

        // ═══ STATISTIQUES GLOBALES ═══════════════════════════════════

        // Total visites
        $totalVisits = SiteAnalytics::where('visited_at', '>=', $startDate)->count();

        $previousTotalVisits = SiteAnalytics::whereBetween('visited_at', [
            $startDate->copy()->subDays($days),
            $startDate,
        ])->count();
        $visitsChange = $previousTotalVisits > 0
            ? round((($totalVisits - $previousTotalVisits) / $previousTotalVisits) * 100)
            : null;

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

        // ═══ NOUVELLES MÉTRIQUES D'ENGAGEMENT ════════════════════════

        // Taux de rebond par rapport à la période précédente
        $previousSinglePageVisitors = SiteAnalytics::select('ip_address')
            ->whereBetween('visited_at', [
                $startDate->copy()->subDays($days),
                $startDate,
            ])
            ->groupBy('ip_address')
            ->havingRaw('COUNT(*) = 1')
            ->count();
        $previousUniqueVisitors = SiteAnalytics::whereBetween('visited_at', [
            $startDate->copy()->subDays($days),
            $startDate,
        ])->distinct('ip_address')->count('ip_address');
        $previousBounceRate = $previousUniqueVisitors > 0 ? round(($previousSinglePageVisitors / $previousUniqueVisitors) * 100) : 0;
        $bounceRateChange = $previousBounceRate > 0 ? $bounceRate - $previousBounceRate : null;

        // Temps d'engagement moyen (en secondes)
        $engagementTime = 0;
        if ($uniqueVisitors > 0) {
            $avgVisitDuration = SiteAnalytics::where('visited_at', '>=', $startDate)
                ->selectRaw('AVG(EXTRACT(EPOCH FROM (visited_at - LAG(visited_at) OVER (PARTITION BY ip_address ORDER BY visited_at)))) as avg_duration')
                ->value('avg_duration');
            $engagementTime = max(0, round($avgVisitDuration ?? 0));
        }

        // Visites récurrentes (visiteurs qui reviennent)
        $recurringVisitors = SiteAnalytics::where('visited_at', '>=', $startDate)
            ->select('ip_address')
            ->groupBy('ip_address')
            ->havingRaw('COUNT(*) > 1')
            ->count();
        $recurringRate = $uniqueVisitors > 0 ? round(($recurringVisitors / $uniqueVisitors) * 100) : 0;

        // Pages vues totales
        $totalPageViews = $totalVisits;

        // Visites en croissance cette semaine vs semaine précédente
        $thisWeekVisits = SiteAnalytics::where('visited_at', '>=', now()->startOfWeek())
            ->where('visited_at', '<', now()->endOfWeek())
            ->count();
        $lastWeekVisits = SiteAnalytics::whereBetween('visited_at', [
            now()->subWeek()->startOfWeek(),
            now()->subWeek()->endOfWeek(),
        ])->count();
        $weeklyChange = $lastWeekVisits > 0
            ? round((($thisWeekVisits - $lastWeekVisits) / $lastWeekVisits) * 100)
            : null;

        // ═══ GRAPHIQUE DES VISITES (période sélectionnée) ══════════

        $dailyVisits = SiteAnalytics::select(
            DB::raw($this->getDbFunction('DATE', 'visited_at') . ' as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('visited_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Remplir les jours manquants avec 0
        $visitsByDay = collect();
        for ($i = $days - 1; $i >= 0; $i--) {
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
            'previousTotalVisits',
            'visitsChange',
            'uniqueVisitors',
            'visitsToday',
            'bounceRate',
            'bounceRateChange',
            'avgPagesPerVisit',
            'visitsByDay',
            'topPages',
            'devices',
            'referrers',
            'peakHours',
            'days',
            'engagementTime',
            'recurringVisitors',
            'recurringRate',
            'totalPageViews',
            'thisWeekVisits',
            'lastWeekVisits',
            'weeklyChange',
            'pageFilter',
            'deviceFilter'
        ));
    }

    public function export(Request $request)
    {
        $days = (int) $request->input('days', 30);
        $days = in_array($days, [7, 30, 90, 365], true) ? $days : 30;
        $format = $request->input('format', 'csv'); // csv ou json
        $startDate = now()->subDays($days);
        
        $rows = SiteAnalytics::where('visited_at', '>=', $startDate)
            ->latest('visited_at')
            ->get(['visited_at', 'page_url', 'referrer', 'device_type', 'country']);

        if ($format === 'json') {
            return response()->json([
                'export_date' => now()->toIso8601String(),
                'period_days' => $days,
                'total_records' => $rows->count(),
                'data' => $rows->map(function ($row) {
                    return [
                        'date' => $row->visited_at?->format('Y-m-d H:i:s'),
                        'page' => $row->page_url,
                        'source' => $row->referrer ?: 'Direct',
                        'device' => $row->device_type ?: 'Unknown',
                        'country' => $row->country ?: 'Unknown',
                    ];
                })
            ], 200, [
                'Content-Disposition' => 'attachment; filename="nere-mining-statistiques-' . $days . 'j.json"',
            ]);
        }

        // CSV export (par défaut)
        return response()->streamDownload(function () use ($rows): void {
            $output = fopen('php://output', 'w');
            
            // BOM for UTF-8 in Excel
            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));
            
            // En-têtes
            fputcsv($output, ['Date', 'Page', 'Source', 'Appareil', 'Pays'], ';');

            foreach ($rows as $row) {
                fputcsv($output, [
                    $row->visited_at?->format('Y-m-d H:i:s') ?: '',
                    $row->page_url ?: '',
                    $row->referrer ?: 'Direct',
                    $row->device_type ?: 'Inconnu',
                    $row->country ?: 'Inconnu',
                ], ';');
            }

            fclose($output);
        }, 'nere-mining-statistiques-' . $days . 'j.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
