<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leadership_members', function (Blueprint $table) {
            $table->unsignedTinyInteger('hierarchy_level')->default(2)->after('department');
        });
    }

    public function down(): void
    {
        Schema::table('leadership_members', function (Blueprint $table) {
            $table->dropColumn('hierarchy_level');
        });
    }
};
