<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            // 'image' ou 'video'
            $table->string('type', 10)->default('image')->after('id');
            // Pour les vidéos : URL YouTube/Vimeo ou chemin fichier local
            $table->string('video_url', 500)->nullable()->after('image_path');
        });
    }

    public function down(): void
    {
        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn(['type', 'video_url']);
        });
    }
};
