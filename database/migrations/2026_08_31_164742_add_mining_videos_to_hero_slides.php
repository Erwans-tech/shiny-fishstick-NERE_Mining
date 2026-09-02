<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ajouter 5 slides vidéo minières au diaporama
        DB::table('hero_slides')->insertOrIgnore([
            // Vidéo 1: Open Pit Mining
            [
                'type' => 'video',
                'title' => 'Open Pit Mining Operations - 4K',
                'caption' => 'Vue aérienne spectaculaire du processus d\'extraction aurifère',
                'video_url' => 'https://www.youtube.com/watch?v=wZWkNKdNlR8',
                'image_path' => 'images/mining/mining-site-aerial-01.jpg',
                'is_active' => true,
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Vidéo 2: Gold Processing CIL
            [
                'type' => 'video',
                'title' => 'Gold Extraction Process - CIL Method',
                'caption' => 'Processus complet d\'extraction de l\'or par la technologie CIL',
                'video_url' => 'https://www.youtube.com/watch?v=-51k6U1j70U',
                'image_path' => 'images/mining/gold-processing-01.jpg',
                'is_active' => true,
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Vidéo 3: Mining Equipment
            [
                'type' => 'video',
                'title' => 'Modern Mining Equipment in Action',
                'caption' => 'Excavateurs et camions miniers professionnels - Caterpillar & Komatsu',
                'video_url' => 'https://www.youtube.com/watch?v=xKgm3tWLI5k',
                'image_path' => 'images/mining/mining-equipment-01.jpg',
                'is_active' => true,
                'sort_order' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Vidéo 4: Safety & Operations
            [
                'type' => 'video',
                'title' => 'Mining Site Safety & Operations',
                'caption' => 'Équipes opérationnelles et protocoles de sécurité - Excellence opérationnelle',
                'video_url' => 'https://www.youtube.com/watch?v=8g2X0h9g2Kc',
                'image_path' => 'images/mining/mining-workers-01.jpg',
                'is_active' => true,
                'sort_order' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Vidéo 5: Environmental Care
            [
                'type' => 'video',
                'title' => 'Mine Rehabilitation & Environmental Care',
                'caption' => 'Engagement pour la durabilité - Réhabilitation et protection de l\'environnement',
                'video_url' => 'https://www.youtube.com/watch?v=qXYx1rWJo0E',
                'image_path' => 'images/mining/mining-environment-01.jpg',
                'is_active' => true,
                'sort_order' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprimer les slides vidéo ajoutées
        DB::table('hero_slides')
            ->whereIn('video_url', [
                'https://www.youtube.com/watch?v=wZWkNKdNlR8',
                'https://www.youtube.com/watch?v=-51k6U1j70U',
                'https://www.youtube.com/watch?v=xKgm3tWLI5k',
                'https://www.youtube.com/watch?v=8g2X0h9g2Kc',
                'https://www.youtube.com/watch?v=qXYx1rWJo0E',
            ])
            ->delete();
    }
};
