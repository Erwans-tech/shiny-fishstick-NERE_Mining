<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Crée le compte administrateur par défaut.
     * Changer le mot de passe en production via :
     *   php artisan tinker --execute="App\Models\User::where('email','admin@nere-mining.bf')->first()->update(['password'=>bcrypt('NOUVEAU_MDP')])"
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@nere-mining.bf'],
            [
                'name'     => 'Administrateur Néré Mining',
                'password' => Hash::make('NereMining@2026!'),
                'is_admin' => true,
            ]
        );
    }
}
