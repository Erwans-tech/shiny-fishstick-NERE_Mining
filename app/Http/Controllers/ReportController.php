<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Facades\App;

class ReportController extends Controller
{
    public function index()
    {
        App::setLocale('fr');
        return view('reports.index', [
            'locale'  => 'fr',
            'reports' => Report::published()->latest('published_at')->get(),
        ]);
    }

    public function indexEn()
    {
        App::setLocale('en');
        return view('reports.index', [
            'locale'  => 'en',
            'reports' => Report::published()->latest('published_at')->get(),
        ]);
    }
}
