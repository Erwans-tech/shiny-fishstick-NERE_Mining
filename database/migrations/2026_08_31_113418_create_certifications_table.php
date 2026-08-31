<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // ISO 9001, EITI, ESG, etc
            $table->text('description')->nullable();
            $table->string('logo_path')->nullable();  // chemin vers le logo
            $table->date('issued_at')->nullable();  // date d'émission
            $table->date('expires_at')->nullable();  // date d'expiration (null = pas d'expiration)
            $table->integer('sort_order')->default(0);  // ordre d'affichage
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
