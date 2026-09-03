<?php

namespace Database\Seeders;

use App\Models\MediaAsset;
use Illuminate\Database\Seeder;

class ExplorationGallerySeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            ['site-activite-2024.jpg', 'Vue générale des activités minières', 'Vue d’ensemble des installations et des activités de Néré Mining au Burkina Faso.'],
            ['equipe-terrain-01.jpeg', 'Équipe de terrain', 'Les équipes techniques organisent les opérations et le suivi des travaux sur le terrain.'],
            ['equipe-terrain-02.jpeg', 'Travaux d’exploration', 'Une équipe prépare les relevés et les observations nécessaires à l’évaluation des cibles.'],
            ['equipe-terrain-03.jpeg', 'Suivi technique', 'Le travail de terrain contribue à documenter les conditions géologiques et opérationnelles.'],
            ['karma-site-01.jpg', 'Site minier de Karma', 'Vue du site de Karma, cœur des opérations aurifères de Néré Mining.'],
            ['karma-site-02.jpg', 'Opérations à Karma', 'Les installations et les équipes mobilisées pour une exploitation structurée et responsable.'],
            ['karma-site-03.jpg', 'Infrastructures minières', 'Équipements et infrastructures participant à la continuité des opérations minières.'],
            ['rehabilitation-karma.jpg', 'Réhabilitation environnementale', 'Action de réhabilitation et de restauration des espaces dans la zone d’intervention de Karma.'],
            ['terrain-activite-01.jpeg', 'Activités sur le terrain', 'Travaux de terrain menés dans le cadre du développement des activités minières.'],
            ['terrain-activite-02.jpeg', 'Présence opérationnelle', 'La présence des équipes sur le terrain soutient la coordination et le suivi des opérations.'],
            ['terrain-activite-03.jpeg', 'Vie du site', 'Une scène de vie du site illustrant l’organisation quotidienne des activités.'],
            ['site-operations-01.jpg', 'Installations de production', 'Vue d’une zone opérationnelle du site minier de Karma.'],
            ['site-operations-02.jpg', 'Équipements et production', 'Les équipements de production et de maintenance au service des opérations.'],
            ['site-operations-03.jpg', 'Travaux miniers', 'Travaux et moyens techniques mobilisés sur le site de Karma.'],
            ['impact-environnemental.webp', 'Impact environnemental positif', 'Initiatives de restauration et de protection de l’environnement autour des activités minières.'],
        ];

        foreach ($photos as $order => [$filename, $title, $caption]) {
            MediaAsset::updateOrCreate(
                ['file_path' => 'images/gallery/' . $filename],
                [
                    'title' => $title,
                    'type' => 'image',
                    'placement' => 'gallery',
                    'caption' => $caption,
                    'is_published' => true,
                    'sort_order' => $order + 1,
                ]
            );
        }
    }
}