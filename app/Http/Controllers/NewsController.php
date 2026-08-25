<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Facades\App;

class NewsController extends Controller
{
    public function index()
    {
        App::setLocale('fr');
        return view('news.index', [
            'locale' => 'fr',
            'news'   => News::published()->latest('published_at')->paginate(9),
        ]);
    }

    public function show(News $news)
    {
        abort_unless($news->published_at && $news->published_at->isPast(), 404);
        App::setLocale('fr');
        return view('news.show', ['locale' => 'fr', 'news' => $news]);
    }

    public function indexEn()
    {
        App::setLocale('en');
        return view('news.index', [
            'locale' => 'en',
            'news'   => News::published()->latest('published_at')->paginate(9),
        ]);
    }

    public function showEn(News $news)
    {
        abort_unless($news->published_at && $news->published_at->isPast(), 404);
        App::setLocale('en');
        return view('news.show', ['locale' => 'en', 'news' => $news]);
    }
}
