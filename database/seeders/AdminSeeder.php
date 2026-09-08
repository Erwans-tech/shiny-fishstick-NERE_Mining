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
        $email = config('app.admin_email') ?: env('ADMIN_EMAIL');
        $password = config('app.admin_password') ?: env('ADMIN_PASSWORD');

        if (! $email || ! $password) {
            throw new \RuntimeException('ADMIN_EMAIL and ADMIN_PASSWORD must be configured before seeding the admin account.');
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name'     => 'Administrateur Néré Mining',
                'password' => Hash::make($password),
                'is_admin' => true,
            ]
        );
    }
}
