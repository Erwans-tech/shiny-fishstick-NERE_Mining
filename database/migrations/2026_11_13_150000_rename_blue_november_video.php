<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('videos')
            ->where('video_path', 'videos/nere-mining-film-720p.mp4')
            ->update([
                'title'      => 'Novembre bleu à Néré Mining : les travailleurs mobilisés pour le dépistage du cancer de la prostate',
                'title_en'   => 'Blue November at Néré Mining: workers mobilised for prostate cancer screening',
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        DB::table('videos')
            ->where('video_path', 'videos/nere-mining-film-720p.mp4')
            ->update([
                'title'      => 'Néré Mining, le film',
                'title_en'   => 'Néré Mining, the film',
                'updated_at' => now(),
            ]);
    }
};
