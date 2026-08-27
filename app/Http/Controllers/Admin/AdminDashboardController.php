<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\JobApplication;
use App\Models\JobOffer;
use App\Models\MediaAsset;
use App\Models\News;
use App\Models\Partner;
use App\Models\PressDocument;
use App\Models\Report;

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
            'applications_new' => JobApplication::where('status', 'new')->count(),
            'partners'         => Partner::where('is_published', true)->count(),
            'media'            => MediaAsset::count(),
            'press'            => PressDocument::count(),
            'messages'         => ContactMessage::whereNull('read_at')->count(),
            'messages_total'   => ContactMessage::count(),
        ];

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
            ->get(['id', 'title', 'deadline']);

        return view('admin.dashboard', compact(
            'counts',
            'recentNews',
            'recentMessages',
            'recentApplications',
            'expiringJobs'
        ));
    }
}
