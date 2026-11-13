<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('video_path');
            $table->string('poster_path')->nullable();
            $table->date('video_date');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // The two videos already on the site; files paths starting with
        // "videos/" or "images/" live in public/, the others in storage.
        DB::table('videos')->insert([
            [
                'title'        => 'Néré Mining au SAMAO 2026',
                'title_en'     => 'Néré Mining at SAMAO 2026',
                'video_path'   => 'videos/presentation-nere-mining.mp4',
                'poster_path'  => 'images/video-cover-nere-samao-2026.png',
                'video_date'   => '2026-10-06',
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'title'        => 'Néré Mining, le film',
                'title_en'     => 'Néré Mining, the film',
                'video_path'   => 'videos/nere-mining-film-720p.mp4',
                'poster_path'  => 'videos/nere-mining-film-poster.jpg',
                'video_date'   => '2026-11-11',
                'is_published' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
