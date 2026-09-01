<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_analytics', function (Blueprint $table) {
            $table->id();
            $table->string('page_url');                    // URL visitée
            $table->string('page_title')->nullable();       // Titre de la page
            $table->string('referrer')->nullable();         // Provenance (Google, direct, etc.)
            $table->string('user_agent')->nullable();       // Navigateur
            $table->string('device_type', 20)->nullable();  // mobile, desktop, tablet
            $table->string('country', 2)->nullable();       // Code pays (FR, US, etc.)
            $table->string('ip_address', 45)->nullable();   // IP (hashée pour RGPD)
            $table->timestamp('visited_at')->useCurrent();  // Date/heure de visite
            
            // Index pour les requêtes rapides
            $table->index('page_url');
            $table->index('visited_at');
            $table->index('device_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_analytics');
    }
};
