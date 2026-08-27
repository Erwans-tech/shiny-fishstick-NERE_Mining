<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('title', 160)->nullable();         // Légende admin (non affichée sur le site)
            $table->string('caption', 255)->nullable();        // Texte optionnel superposé sur l'image
            $table->string('image_path');                      // Chemin relatif à public/ ou uploads/
            $table->boolean('is_active')->default(true);       // Visible sur le site
            $table->unsignedSmallInteger('sort_order')->default(0); // Ordre d'affichage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
