<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->uuid('public_uuid')->nullable()->unique()->after('id');
        });

        foreach (\App\Models\User::query()->whereNull('public_uuid')->cursor() as $user) {
            $user->forceFill(['public_uuid' => (string) Str::uuid()])->saveQuietly();
        }

        Schema::table('users', function (Blueprint $table): void {
            $table->uuid('public_uuid')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropUnique(['public_uuid']);
            $table->dropColumn('public_uuid');
        });
    }
};
