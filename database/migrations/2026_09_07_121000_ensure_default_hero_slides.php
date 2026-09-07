<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();
        $slides = [
            ['type' => 'image', 'filename' => 'gyathursan-mine-5523376_1920.jpg', 'title' => 'Une mine de classe mondiale'],
            ['type' => 'image', 'filename' => 'pexels-gunshe-5125104.jpg', 'title' => 'Des opérations responsables'],
            ['type' => 'image', 'filename' => 'shibang-mechanical-2653706_1920.jpg', 'title' => 'L’excellence industrielle'],
            ['type' => 'image', 'filename' => 'tyna_janoch-excavator-2781676_1920.jpg', 'title' => 'Des équipes engagées'],
            ['type' => 'image', 'filename' => 'tyna_janoch-mine-2781686_1920.jpg', 'title' => 'Un territoire en mouvement'],
            ['type' => 'video', 'filename' => 'Video Project 1.mp4', 'title' => 'Karma, notre mine d’or'],
        ];

        foreach ($slides as $order => $slide) {
            DB::table('hero_slides')->insertOrIgnore([
                'type' => $slide['type'],
                'title' => $slide['title'],
                'caption' => null,
                'image_path' => "images/carousel/{$slide['filename']}",
                'video_url' => null,
                'is_active' => true,
                'sort_order' => $order,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        DB::table('hero_slides')
            ->whereIn('image_path', [
                'images/carousel/gyathursan-mine-5523376_1920.jpg',
                'images/carousel/pexels-gunshe-5125104.jpg',
                'images/carousel/shibang-mechanical-2653706_1920.jpg',
                'images/carousel/tyna_janoch-excavator-2781676_1920.jpg',
                'images/carousel/tyna_janoch-mine-2781686_1920.jpg',
                'images/carousel/Video Project 1.mp4',
            ])
            ->delete();
    }
};
