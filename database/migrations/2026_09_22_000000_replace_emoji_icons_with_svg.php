<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // IMPORTANT: Only update if the icon STARTS with an emoji
        // This prevents breaking existing SVG paths
        
        // Replace emoji icons with SVG paths in site_contents  
        DB::table('site_contents')
            ->where('icon', '👥')
            ->update(['icon' => 'social-logos/people.svg']);
            
        DB::table('site_contents')
            ->where('icon', '🧰')
            ->update(['icon' => 'social-logos/tools.svg']);
            
        DB::table('site_contents')
            ->where('icon', '📍')
            ->update(['icon' => 'social-logos/location.svg']);
            
        DB::table('site_contents')
            ->where('icon', '🇧🇫')
            ->update(['icon' => 'social-logos/flag-bf.svg']);
            
        DB::table('site_contents')
            ->where('icon', '🏘️')
            ->update(['icon' => 'social-logos/village.svg']);
            
        DB::table('site_contents')
            ->where('icon', '🗺️')
            ->update(['icon' => 'social-logos/map.svg']);
            
        DB::table('site_contents')
            ->where('icon', '🤝')
            ->update(['icon' => 'social-logos/handshake.svg']);
            
        DB::table('site_contents')
            ->where('icon', '🛣️')
            ->update(['icon' => 'social-logos/road.svg']);
    }

    public function down(): void
    {
        // Restore emoji icons only if they're currently SVG paths
        DB::table('site_contents')
            ->where('icon', 'social-logos/people.svg')
            ->update(['icon' => '👥']);
            
        DB::table('site_contents')
            ->where('icon', 'social-logos/tools.svg')
            ->update(['icon' => '🧰']);
            
        DB::table('site_contents')
            ->where('icon', 'social-logos/location.svg')
            ->update(['icon' => '📍']);
            
        DB::table('site_contents')
            ->where('icon', 'social-logos/flag-bf.svg')
            ->update(['icon' => '🇧🇫']);
            
        DB::table('site_contents')
            ->where('icon', 'social-logos/village.svg')
            ->update(['icon' => '🏘️']);
            
        DB::table('site_contents')
            ->where('icon', 'social-logos/map.svg')
            ->update(['icon' => '🗺️']);
            
        DB::table('site_contents')
            ->where('icon', 'social-logos/handshake.svg')
            ->update(['icon' => '🤝']);
            
        DB::table('site_contents')
            ->where('icon', 'social-logos/road.svg')
            ->update(['icon' => '🛣️']);
    }
};
