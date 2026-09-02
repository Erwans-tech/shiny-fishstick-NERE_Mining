<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteSetting;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            ['key' => 'carousel_autoplay', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_interval', 'value' => '5000', 'type' => 'number'],
            ['key' => 'carousel_transition_speed', 'value' => '800', 'type' => 'number'],
            ['key' => 'carousel_pause_on_hover', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_show_indicators', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_show_arrows', 'value' => 'true', 'type' => 'boolean'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }
    }

    public function down(): void
    {
        SiteSetting::whereIn('key', [
            'carousel_autoplay',
            'carousel_interval',
            'carousel_transition_speed',
            'carousel_pause_on_hover',
            'carousel_show_indicators',
            'carousel_show_arrows',
        ])->delete();
    }
};
