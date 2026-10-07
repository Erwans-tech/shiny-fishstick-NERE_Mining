<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\JobOffer;
use App\Models\Report;
use App\Models\MediaAsset;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class SiteManagerDashboardController extends Controller
{
    /**
     * Tableau de bord du Gérant du site
     */
    public function index()
    {
        $stats = [
            'total_news' => News::count(),
            'published_news' => News::where('published', true)->count(),
            'draft_news' => News::where('published', false)->count(),
            'total_jobs' => JobOffer::count(),
            'active_jobs' => JobOffer::where('active', true)->count(),
            'total_media' => MediaAsset::count(),
            'total_reports' => Report::count(),
            'published_reports' => Report::where('published', true)->count(),
            'hero_slides' => HeroSlide::count(),
        ];

        // Dernières actualités
        $recent_news = News::latest()->take(5)->get();

        // Offres d'emploi actives
        $active_jobs = JobOffer::where('active', true)->take(5)->get();

        return view('admin.site-manager.dashboard', compact('stats', 'recent_news', 'active_jobs'));
    }

    /**
     * Gestion des actualités
     */
    public function news()
    {
        $news = News::latest()->paginate(15);
        return view('admin.site-manager.news', compact('news'));
    }

    /**
     * Gestion des offres d'emploi
     */
    public function jobs()
    {
        $jobs = JobOffer::latest()->paginate(15);
        return view('admin.site-manager.jobs', compact('jobs'));
    }

    /**
     * Gestion des publications/rapports
     */
    public function reports()
    {
        $reports = Report::latest()->paginate(15);
        return view('admin.site-manager.reports', compact('reports'));
    }

    /**
     * Gestion des médias
     */
    public function media()
    {
        $media = MediaAsset::latest()->paginate(15);
        return view('admin.site-manager.media', compact('media'));
    }

    /**
     * Gestion du carrousel d'accueil
     */
    public function heroSlides()
    {
        $slides = HeroSlide::orderBy('order', 'asc')->paginate(15);
        return view('admin.site-manager.hero-slides', compact('slides'));
    }

    /**
     * Vue d'ensemble du contenu du site
     */
    public function contentOverview()
    {
        $overview = [
            'news' => [
                'total' => News::count(),
                'published' => News::where('published', true)->count(),
                'draft' => News::where('published', false)->count(),
            ],
            'jobs' => [
                'total' => JobOffer::count(),
                'active' => JobOffer::where('active', true)->count(),
                'inactive' => JobOffer::where('active', false)->count(),
            ],
            'reports' => [
                'total' => Report::count(),
                'published' => Report::where('published', true)->count(),
            ],
            'media' => [
                'total' => MediaAsset::count(),
            ],
        ];

        return view('admin.site-manager.content-overview', compact('overview'));
    }

    /**
     * Exporte les statistiques de contenu
     */
    public function exportStats()
    {
        $data = [
            'news' => News::count(),
            'published_news' => News::where('published', true)->count(),
            'jobs' => JobOffer::count(),
            'active_jobs' => JobOffer::where('active', true)->count(),
            'reports' => Report::count(),
            'media' => MediaAsset::count(),
        ];

        $csv = "Métrique,Valeur\n";
        foreach ($data as $key => $value) {
            $csv .= "\"{$key}\",\"{$value}\"\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="stats-' . now()->format('Y-m-d') . '.csv"');
    }
}
