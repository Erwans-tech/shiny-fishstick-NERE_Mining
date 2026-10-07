<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Aucun rôle pré-créé dans cette seeder
        // Les rôles sont simplement des valeurs d'enum dans la colonne role
        // admin, hr, site_manager

        // Les utilisateurs existants doivent être migrés vers le nouveau système
        // Cela sera fait via une migration de données
    }
}
