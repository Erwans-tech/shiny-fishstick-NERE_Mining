<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_contents', function (Blueprint $table) {
            // Increase icon column size from varchar(20) to varchar(100)
            $table->string('icon', 100)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('site_contents', function (Blueprint $table) {
            // Revert to original size
            $table->string('icon', 20)->nullable()->change();
        });
    }
};
