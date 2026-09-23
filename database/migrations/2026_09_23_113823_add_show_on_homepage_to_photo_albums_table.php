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
        Schema::table('photo_albums', function (Blueprint $table) {
            $table->boolean('show_on_homepage')->default(false)->after('is_published');
            $table->index('show_on_homepage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_albums', function (Blueprint $table) {
            $table->dropIndex(['show_on_homepage']);
            $table->dropColumn('show_on_homepage');
        });
    }
};
