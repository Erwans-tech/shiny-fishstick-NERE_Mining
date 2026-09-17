#!/usr/bin/env php
<?php

/**
 * Script de création/réinitialisation du compte administrateur
 * 
 * Usage (depuis la racine du projet):
 *   php create_admin_account.php
 * 
 * Ce script crée ou réinitialise le compte admin avec les credentials par défaut.
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "    CRÉATION/RÉINITIALISATION COMPTE ADMIN\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "\n";

// Credentials par défaut
$email = env('ADMIN_EMAIL', 'admin@nere-mining.bf');
$password = env('ADMIN_PASSWORD', 'AdminNereMining2026!');
$name = 'Administrateur Néré Mining';

echo "Email    : {$email}\n";
echo "Password : {$password}\n";
echo "Nom      : {$name}\n";
echo "\n";

// Vérifier si un compte existe déjà
$existingUser = User::where('email', $email)->first();

if ($existingUser) {
    echo "⚠️  Un compte avec cet email existe déjà.\n";
    echo "Voulez-vous réinitialiser le mot de passe ? (o/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    fclose($handle);
    
    if (trim(strtolower($line)) !== 'o') {
        echo "\n❌ Opération annulée.\n\n";
        exit(0);
    }
    
    // Mise à jour du mot de passe
    $existingUser->password = Hash::make($password);
    $existingUser->is_admin = true;
    $existingUser->name = $name;
    $existingUser->save();
    
    echo "\n✅ Mot de passe réinitialisé avec succès !\n";
    echo "   ID: {$existingUser->id}\n";
    echo "   Email: {$existingUser->email}\n";
    echo "   Admin: " . ($existingUser->is_admin ? 'OUI' : 'NON') . "\n";
    
} else {
    // Création du nouveau compte
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
        'is_admin' => true,
    ]);
    
    echo "\n✅ Compte admin créé avec succès !\n";
    echo "   ID: {$user->id}\n";
    echo "   Email: {$user->email}\n";
    echo "   Admin: " . ($user->is_admin ? 'OUI' : 'NON') . "\n";
}

echo "\n";
echo "🔐 CONNEXION:\n";
echo "   URL: http://192.168.10.202/gestion-nm\n";
echo "   Email: {$email}\n";
echo "   Password: {$password}\n";
echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "\n";

exit(0);
