<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_offers', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');
            $table->string('experience_level', 80)->nullable()->after('contract_type');
            $table->string('salary_range', 120)->nullable()->after('experience_level');
        });
    }

    public function down(): void
    {
        Schema::table('job_offers', function (Blueprint $table) {
            $table->dropColumn(['slug', 'experience_level', 'salary_range']);
        });
    }
};
