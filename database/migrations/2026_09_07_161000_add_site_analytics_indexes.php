<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_analytics', function (Blueprint $table): void {
            $table->index(['visited_at', 'device_type'], 'site_analytics_visited_device_idx');
            $table->index(['visited_at', 'page_url'], 'site_analytics_visited_page_idx');
            $table->index(['visited_at', 'referrer'], 'site_analytics_visited_referrer_idx');
        });
    }

    public function down(): void
    {
        Schema::table('site_analytics', function (Blueprint $table): void {
            $table->dropIndex('site_analytics_visited_device_idx');
            $table->dropIndex('site_analytics_visited_page_idx');
            $table->dropIndex('site_analytics_visited_referrer_idx');
        });
    }
};
