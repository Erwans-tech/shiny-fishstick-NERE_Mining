<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
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
        return view('admin.dashboard', [
            'counts' => [
                'news'     => News::count(),
                'reports'  => Report::count(),
                'jobs'     => JobOffer::where('is_published', true)->count(),
                'partners' => Partner::count(),
                'media'    => MediaAsset::count(),
                'press'    => PressDocument::count(),
                'messages' => ContactMessage::whereNull('read_at')->count(),
            ],
        ]);
    }
}
