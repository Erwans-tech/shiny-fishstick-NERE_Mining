<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AdminSystemController extends Controller
{
    /**
     * Page de diagnostic système (accessible sans auth pour debugging)
     */
    public function diagnose()
    {
        $info = [
            'app_env' => config('app.env'),
            'app_debug' => config('app.debug'),
            'app_key_set' => !empty(config('app.key')),
            'session_driver' => config('session.driver'),
            'cache_driver' => config('cache.default'),
            'db_connection' => config('database.default'),
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
        ];

        // Tests de base de données
        try {
            DB::connection()->getPdo();
            $info['database_connected'] = true;
            $info['users_count'] = DB::table('users')->count();
            $info['admin_count'] = DB::table('users')->where('is_admin', true)->count();
            
            // Test sessions table
            if (config('session.driver') === 'database') {
                $info['sessions_table_exists'] = DB::getSchemaBuilder()->hasTable('sessions');
            }
        } catch (\Exception $e) {
            $info['database_connected'] = false;
            $info['database_error'] = $e->getMessage();
        }

        // Test cache
        try {
            Cache::put('test_key', 'test_value', 60);
            $info['cache_working'] = Cache::get('test_key') === 'test_value';
            Cache::forget('test_key');
        } catch (\Exception $e) {
            $info['cache_working'] = false;
            $info['cache_error'] = $e->getMessage();
        }

        return response()->json($info, 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Créer l'admin par défaut (pour diagnostic)
     */
    public function createAdmin(Request $request)
    {
        try {
            $adminEmail = 'admin@nere-mining.com';
            $adminPassword = 'NereAdmin2024!';

            $user = \App\Models\User::updateOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => 'Administrateur Néré Mining',
                    'password' => \Illuminate\Support\Facades\Hash::make($adminPassword),
                    'is_admin' => true,
                    'email_verified_at' => now(),
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Admin créé/mis à jour avec succès',
                'admin_email' => $adminEmail,
                'admin_password' => $adminPassword,
                'user_id' => $user->id
            ], 200, [], JSON_PRETTY_PRINT);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500, [], JSON_PRETTY_PRINT);
        }
    }

    /**
     * Force create admin via GET (plus simple pour debugging)
     */
    public function forceCreateAdmin()
    {
        try {
            $adminEmail = 'admin@nere-mining.com';
            $adminPassword = 'NereAdmin2024!';

            // Vérifier d'abord si l'admin existe
            $existingAdmin = \App\Models\User::where('email', $adminEmail)->first();
            
            if ($existingAdmin) {
                // Mettre à jour le mot de passe
                $existingAdmin->update([
                    'password' => \Illuminate\Support\Facades\Hash::make($adminPassword),
                    'is_admin' => true,
                ]);
                $action = 'mis à jour';
            } else {
                // Créer un nouvel admin
                $existingAdmin = \App\Models\User::create([
                    'name' => 'Administrateur Néré Mining',
                    'email' => $adminEmail,
                    'password' => \Illuminate\Support\Facades\Hash::make($adminPassword),
                    'is_admin' => true,
                    'email_verified_at' => now(),
                ]);
                $action = 'créé';
            }

            $html = "
            <!DOCTYPE html>
            <html>
            <head><title>Admin $action</title></head>
            <body style='font-family:sans-serif; padding:20px; max-width:600px; margin:0 auto;'>
                <h2>✅ Utilisateur admin $action avec succès!</h2>
                <div style='background:#f0f9ff; padding:15px; border-radius:8px; margin:20px 0;'>
                    <strong>Informations de connexion:</strong><br>
                    📧 Email: <code>$adminEmail</code><br>
                    🔑 Mot de passe: <code>$adminPassword</code><br>
                    🆔 User ID: {$existingAdmin->id}
                </div>
                <div style='margin:20px 0;'>
                    <a href='/gestion-nm/login-alt' style='background:#4b1716; color:white; padding:10px 20px; text-decoration:none; border-radius:4px;'>🔗 Aller au login</a>
                </div>
                <div style='background:#fef3cd; padding:15px; border-radius:8px; margin:20px 0;'>
                    ⚠️ <strong>Important:</strong> Changez le mot de passe après la première connexion !
                </div>
            </body>
            </html>";
            
            return response($html);

        } catch (\Exception $e) {
            return response("
            <h2>❌ Erreur lors de la création de l'admin</h2>
            <p><strong>Erreur:</strong> {$e->getMessage()}</p>
            <p><a href='/gestion-nm/diagnostic'>🔍 Voir diagnostic système</a></p>
            ");
        }
    }
}