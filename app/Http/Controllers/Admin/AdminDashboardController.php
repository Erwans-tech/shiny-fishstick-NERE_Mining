<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\ContactMessage;
use App\Models\HeroSlide;
use App\Models\JobApplication;
use App\Models\JobOffer;
use App\Models\MediaAsset;
use App\Models\News;
use App\Models\NewsletterSubscriber;
use App\Models\Partner;
use App\Models\PressDocument;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Compteurs principaux
        $counts = [
            'news'             => News::count(),
            'news_published'   => News::whereNotNull('published_at')->where('published_at', '<=', now())->count(),
            'news_draft'       => News::whereNull('published_at')->count(),
            'reports'          => Report::count(),
            'jobs'             => JobOffer::where('is_published', true)->where('is_spontaneous', false)->count(),
            'jobs_expiring'    => JobOffer::open()->whereNotNull('deadline')
                                    ->where('deadline', '<=', now()->addDays(7))->count(),
            'applications'     => JobApplication::count(),
            'applications_new' => JobApplication::whereNull('read_at')->count(),
            'partners'         => Partner::where('is_published', true)->count(),
            'media'            => MediaAsset::count(),
            'press'            => PressDocument::count(),
            'messages'         => ContactMessage::whereNull('read_at')->count(),
            'messages_total'   => ContactMessage::count(),
            'newsletter'       => NewsletterSubscriber::count(),
            'certifications'   => Certification::active()->count(),
            'hero_slides'      => HeroSlide::where('is_active', true)->count(),
        ];

        // Activité des 7 derniers jours (pour graphique)
        $last7Days = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo);
            return [
                'date' => $date->format('d/m'),
                'day'  => $date->locale('fr')->isoFormat('ddd'),
                'news' => News::whereDate('created_at', $date)->count(),
                'applications' => JobApplication::whereDate('created_at', $date)->count(),
                'messages' => ContactMessage::whereDate('created_at', $date)->count(),
            ];
        });

        // Métriques de tendance (comparaison 7 derniers jours vs. 7 précédents)
        $trends = [
            'news' => $this->calculateTrend(News::class),
            'applications' => $this->calculateTrend(JobApplication::class),
            'messages' => $this->calculateTrend(ContactMessage::class),
            'newsletter' => $this->calculateTrend(NewsletterSubscriber::class),
        ];

        // Top 3 actualités les plus récentes publiées
        $topNews = News::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get(['id', 'title', 'category', 'published_at', 'slug']);

        // Activité récente — 5 dernières actualités
        $recentNews = News::latest()->take(5)->get(['id', 'title', 'category', 'published_at', 'created_at']);

        // 5 derniers messages
        $recentMessages = ContactMessage::latest()->take(5)->get(['id', 'name', 'email', 'type', 'read_at', 'created_at']);

        // 5 dernières candidatures
        $recentApplications = JobApplication::with('jobOffer:id,title')
            ->latest()->take(5)->get(['id', 'first_name', 'last_name', 'email', 'status', 'job_offer_id', 'created_at']);

        // Offres à expiration proche (7 jours)
        $expiringJobs = JobOffer::open()
            ->whereNotNull('deadline')
            ->where('deadline', '<=', now()->addDays(7))
            ->orderBy('deadline')
            ->take(3)
            ->get(['id', 'title', 'deadline', 'slug']);

        // Statistiques candidatures par statut
        $applicationStats = JobApplication::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Santé du site
        $siteHealth = [
            'hero_active' => HeroSlide::where('is_active', true)->exists(),
            'jobs_active' => JobOffer::where('is_published', true)->exists(),
            'news_recent' => News::whereNotNull('published_at')
                ->where('published_at', '>=', now()->subDays(30))
                ->exists(),
            'partners_visible' => Partner::where('is_published', true)->exists(),
        ];

        return view('admin.dashboard', compact(
            'counts',
            'last7Days',
            'trends',
            'topNews',
            'recentNews',
            'recentMessages',
            'recentApplications',
            'expiringJobs',
            'applicationStats',
            'siteHealth'
        ));
    }

    /**
     * Calculate trend: % change between last 7 days and previous 7 days
     */
    private function calculateTrend(string $model): array
    {
        $last7 = $model::where('created_at', '>=', now()->subDays(7))->count();
        $prev7 = $model::whereBetween('created_at', [now()->subDays(14), now()->subDays(7)])->count();

        if ($prev7 === 0) {
            $percent = $last7 > 0 ? 100 : 0;
        } else {
            $percent = round((($last7 - $prev7) / $prev7) * 100);
        }

        return [
            'current' => $last7,
            'previous' => $prev7,
            'percent' => $percent,
            'direction' => $percent > 0 ? 'up' : ($percent < 0 ? 'down' : 'stable'),
        ];
    }

    /**
     * Dashboard alternatif sans CSRF (pour diagnostic)
     */
    public function dashboardAlt()
    {
        $stats = [
            'users_count' => \App\Models\User::count(),
            'admin_count' => \App\Models\User::where('is_admin', true)->count(),
            'news_count' => News::count(),
            'jobs_count' => JobOffer::count(),
            'messages_count' => ContactMessage::count(),
            'app_env' => config('app.env'),
            'session_driver' => config('session.driver'),
            'admin_user' => session('admin_name', 'Inconnu'),
        ];
        
        return view('admin.dashboard-alt', compact('stats'));
    }
}
