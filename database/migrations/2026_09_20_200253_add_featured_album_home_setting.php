<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ajouter le paramètre pour l'album mis en avant sur la page d'accueil
        DB::table('site_settings')->insert([
            'key' => 'home_featured_album_id',
            'value' => null,
            'type' => 'album_select',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('site_settings')->where('key', 'home_featured_album_id')->delete();
    }
};
