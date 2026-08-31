<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeNewsLinksTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_news_cards_link_to_existing_articles(): void
    {
        $first = News::create([
            'title' => 'Premier article',
            'category' => 'Communiqué',
            'excerpt' => 'Résumé du premier article',
            'content' => 'Contenu complet du premier article.',
            'published_at' => now()->subDay(),
        ]);

        $second = News::create([
            'title' => 'Deuxième article',
            'category' => 'Exploration',
            'excerpt' => 'Résumé du deuxième article',
            'content' => 'Contenu complet du deuxième article.',
            'published_at' => now()->subHours(3),
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('/actualites/' . $first->id, false);
        $response->assertSee('/actualites/' . $second->id, false);
        $response->assertDontSee('/actualites/0');
    }

    public function test_news_detail_page_renders_for_existing_published_article(): void
    {
        $article = News::create([
            'title' => 'Article de test',
            'category' => 'Institutionnel',
            'excerpt' => 'Résumé de l’article de test',
            'content' => 'Contenu de l’article de test.',
            'published_at' => now()->subHour(),
        ]);

        $this->get('/actualites/' . $article->id)
            ->assertOk()
            ->assertSee('Article de test');
    }
}
