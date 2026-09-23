<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Replace emoji icons with SVG paths in site_contents
        $updates = [
            ['old' => '👥', 'new' => 'social-logos/people.svg'],
            ['old' => '🧰', 'new' => 'social-logos/tools.svg'],
            ['old' => '📍', 'new' => 'social-logos/location.svg'],
            ['old' => '🇧🇫', 'new' => 'social-logos/flag-bf.svg'],
            ['old' => '🏘️', 'new' => 'social-logos/village.svg'],
            ['old' => '🗺️', 'new' => 'social-logos/map.svg'],
            ['old' => '🤝', 'new' => 'social-logos/handshake.svg'],
            ['old' => '🛣️', 'new' => 'social-logos/road.svg'],
        ];

        foreach ($updates as $update) {
            DB::table('site_contents')
                ->where('icon', $update['old'])
                ->update(['icon' => $update['new']]);
        }
    }

    public function down(): void
    {
        // Restore emoji icons
        $updates = [
            ['old' => 'social-logos/people.svg', 'new' => '👥'],
            ['old' => 'social-logos/tools.svg', 'new' => '🧰'],
            ['old' => 'social-logos/location.svg', 'new' => '📍'],
            ['old' => 'social-logos/flag-bf.svg', 'new' => '🇧🇫'],
            ['old' => 'social-logos/village.svg', 'new' => '🏘️'],
            ['old' => 'social-logos/map.svg', 'new' => '🗺️'],
            ['old' => 'social-logos/handshake.svg', 'new' => '🤝'],
            ['old' => 'social-logos/road.svg', 'new' => '🛣️'],
        ];

        foreach ($updates as $update) {
            DB::table('site_contents')
                ->where('icon', $update['old'])
                ->update(['icon' => $update['new']]);
        }
    }
};
