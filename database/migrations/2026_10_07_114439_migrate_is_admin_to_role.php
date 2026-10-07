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
        // Vérifier que la colonne is_admin existe avant de l'utiliser
        if (Schema::hasColumn('users', 'is_admin')) {
            // Convertir les utilisateurs existants avec is_admin=true en role=admin
            \DB::table('users')
                ->where('is_admin', true)
                ->update(['role' => 'admin']);

            // Les autres restent avec le rôle par défaut (site_manager)
            \DB::table('users')
                ->where('is_admin', false)
                ->update(['role' => 'site_manager']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restaurer is_admin basé sur le rôle (si la colonne existe)
        if (Schema::hasColumn('users', 'is_admin')) {
            \DB::table('users')
                ->where('role', 'admin')
                ->update(['is_admin' => true]);

            \DB::table('users')
                ->whereIn('role', ['hr', 'site_manager'])
                ->update(['is_admin' => false]);
        }
    }
};
