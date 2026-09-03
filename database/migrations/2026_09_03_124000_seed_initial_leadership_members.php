<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::table('leadership_members')->exists()) {
            return;
        }

        DB::table('leadership_members')->insert([
            [
                'name' => 'Dr. Justin Elie OUEDRAOGO',
                'title' => 'Président Directeur Général',
                'department' => null,
                'hierarchy_level' => 1,
                'photo_path' => 'images/mining/mining-workers-01.jpg',
                'is_published' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Justin SAVADOGO',
                'title' => 'Directeur Général Adjoint',
                'department' => 'Administration & Finance',
                'hierarchy_level' => 2,
                'photo_path' => 'images/mining/gold-processing-01.jpg',
                'is_published' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pascal Y. OUEDRAOGO',
                'title' => 'Directeur Général Adjoint',
                'department' => 'Approvisionnements',
                'hierarchy_level' => 2,
                'photo_path' => 'images/mining/mining-equipment-01.jpg',
                'is_published' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laurent Michel DABIRE',
                'title' => 'Directeur Général Adjoint',
                'department' => 'Affaires Corporatives & Juridiques',
                'hierarchy_level' => 2,
                'photo_path' => 'images/mining/mining-site-aerial-01.jpg',
                'is_published' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Augustine OBENG-FORI',
                'title' => 'DGA par intérim',
                'department' => 'Opérations',
                'hierarchy_level' => 2,
                'photo_path' => 'images/mining/mining-environment-01.jpg',
                'is_published' => true,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        DB::table('leadership_members')
            ->whereIn('name', [
                'Dr. Justin Elie OUEDRAOGO',
                'Justin SAVADOGO',
                'Pascal Y. OUEDRAOGO',
                'Laurent Michel DABIRE',
                'Augustine OBENG-FORI',
            ])
            ->delete();
    }
};
