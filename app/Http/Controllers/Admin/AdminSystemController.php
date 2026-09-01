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
}