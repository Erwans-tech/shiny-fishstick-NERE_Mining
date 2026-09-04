<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_analytics', function (Blueprint $table) {
            $table->string('ip_address', 64)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('site_analytics', function (Blueprint $table) {
            $table->string('ip_address', 45)->nullable()->change();
        });
    }
};