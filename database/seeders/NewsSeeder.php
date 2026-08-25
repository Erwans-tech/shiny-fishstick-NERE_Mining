<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::query()->delete();

        News::create([
            'title' => 'Construire une valeur durable autour de Karma',
            'category' => 'Communautes',
            'excerpt' => 'Néré Mining développe des partenariats et des compétences locales au service du territoire.',
            'image_path' => 'images/mining/karma-01.jpg',
            'published_at' => now()->subDays(12),
        ]);

        News::create([
            'title' => 'Une exploitation miniere responsable et moderne',
            'category' => 'Environnement',
            'excerpt' => 'Nos équipes suivent l’impact de nos opérations et protègent les ressources locales.',
            'image_path' => 'images/mining/karma-03.jpg',
            'published_at' => now()->subDays(28),
        ]);

        News::create([
            'title' => 'Les competences burkinabe au coeur de notre equipe',
            'category' => 'Talents',
            'excerpt' => 'La formation et le développement des talents locaux accompagnent la croissance de Karma.',
            'image_path' => 'images/mining/karma-04.jpg',
            'published_at' => now()->subDays(45),
        ]);
    }
}
