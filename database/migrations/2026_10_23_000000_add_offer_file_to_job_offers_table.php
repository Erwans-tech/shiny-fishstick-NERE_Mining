<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_offers', function (Blueprint $table) {
            $table->string('offer_file_path')->nullable();
            $table->string('department', 120)->nullable()->change();
            $table->string('contract_type', 80)->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }

    public function down(): void
    {
        DB::table('job_offers')->whereNull('department')->update(['department' => '']);
        DB::table('job_offers')->whereNull('contract_type')->update(['contract_type' => '']);
        DB::table('job_offers')->whereNull('description')->update(['description' => '']);

        Schema::table('job_offers', function (Blueprint $table) {
            $table->dropColumn('offer_file_path');
            $table->string('department', 120)->nullable(false)->change();
            $table->string('contract_type', 80)->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
        });
    }
};
