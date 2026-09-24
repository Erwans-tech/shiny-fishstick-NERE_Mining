<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class UpdateGoogleAnalyticsSeeder extends Seeder
{
    /**
     * Met à jour la configuration Google Analytics avec le nouvel ID
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'ga_measurement_id',
                'value' => 'G-01ZT389C0B',
                'type' => 'string',
            ],
            [
                'key' => 'ga_enabled',
                'value' => 'true',
                'type' => 'boolean',
            ],
            [
                'key' => 'analytics_enabled',
                'value' => 'true',
                'type' => 'boolean',
            ],
        ];

        foreach ($settings as $settingData) {
            $setting = SiteSetting::where('key', $settingData['key'])->first();
            
            if ($setting) {
                $setting->update(['value' => $settingData['value']]);
                $this->command->info("✓ Setting {$settingData['key']} mis à jour : {$settingData['value']}");
            } else {
                SiteSetting::create($settingData);
                $this->command->info("✓ Setting {$settingData['key']} créé : {$settingData['value']}");
            }
        }

        $this->command->info('');
        $this->command->info('Google Analytics configuré avec succès !');
        $this->command->info('ID de mesure : G-01ZT389C0B');
        $this->command->info('Status : Actif sur toutes les pages');
    }
}