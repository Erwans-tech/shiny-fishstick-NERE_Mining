<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    /**
     * Get hardcoded default news (no database dependency)
     */
    private function getDefaultNews($locale = 'fr')
    {
        $en = $locale === 'en';
        
        return collect([
            (object) [
                'id' => 1,
                'title' => $en ? 'Néré Mining: Commitment to Sustainable Development' : 'Néré Mining : Engagement pour le Développement Durable',
                'excerpt' => $en ? 'Néré Mining reaffirms its commitment to responsible practices and sustainable development in all its operations.' : 'Néré Mining réaffirme son engagement envers des pratiques responsables et le développement durable dans toutes ses opérations.',
                'category' => $en ? 'Sustainability' : 'Développement Durable',
                'image_path' => 'images/news/actualite1.jpeg',
                'published_at' => now()->subDays(10),
                'slug' => 'nere-mining-engagement-developpement-durable',
            ],
            (object) [
                'id' => 2,
                'title' => $en ? 'Karma Mine: Record Gold Production' : 'Mine de Karma : Production d\'Or Record',
                'excerpt' => $en ? 'The Karma mine achieves a new production milestone, confirming the efficiency of its operations and local expertise.' : 'La mine de Karma atteint un nouveau record de production, confirmant l\'efficacité de ses opérations et l\'expertise locale.',
                'category' => $en ? 'Operations' : 'Opérations',
                'image_path' => 'images/news/actualite2.jpg',
                'published_at' => now()->subDays(20),
                'slug' => 'mine-karma-production-or-record',
            ],
            (object) [
                'id' => 3,
                'title' => $en ? 'Community Engagement: New Partnership Initiatives' : 'Engagement Communautaire : Nouvelles Initiatives de Partenariat',
                'excerpt' => $en ? 'Néré Mining launches new programs to support local communities and enhance social impact in the Northern Region.' : 'Néré Mining lance de nouveaux programmes pour soutenir les communautés locales et renforcer son impact social dans la région du Nord.',
                'category' => $en ? 'Community' : 'Communauté',
                'image_path' => 'images/news/actualite3.png',
                'published_at' => now()->subDays(30),
                'slug' => 'engagement-communautaire-nouvelles-initiatives',
            ],
        ]);
    }

    public function index()
    {
        App::setLocale('fr');
        
        // Try to get news from database, otherwise use hardcoded defaults
        $dbNews = News::published()->latest('published_at')->get();
        $newsItems = $dbNews->isEmpty() ? $this->getDefaultNews('fr') : $dbNews;
        
        // Manual pagination
        $perPage = 9;
        $currentPage = request()->get('page', 1);
        $paginator = new LengthAwarePaginator(
            $newsItems->forPage($currentPage, $perPage),
            $newsItems->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        
        return view('news.index', [
            'locale' => 'fr',
            'news'   => $paginator,
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
        
        // Try to get news from database, otherwise use hardcoded defaults
        $dbNews = News::published()->latest('published_at')->get();
        $newsItems = $dbNews->isEmpty() ? $this->getDefaultNews('en') : $dbNews;
        
        // Manual pagination
        $perPage = 9;
        $currentPage = request()->get('page', 1);
        $paginator = new LengthAwarePaginator(
            $newsItems->forPage($currentPage, $perPage),
            $newsItems->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        
        return view('news.index', [
            'locale' => 'en',
            'news'   => $paginator,
        ]);
    }

    public function showEn(News $news)
    {
        abort_unless($news->published_at && $news->published_at->isPast(), 404);
        App::setLocale('en');
        return view('news.show', ['locale' => 'en', 'news' => $news]);
    }
}
