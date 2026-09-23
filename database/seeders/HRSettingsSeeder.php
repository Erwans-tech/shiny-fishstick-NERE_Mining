<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class HRSettingsSeeder extends Seeder
{
    /**
     * Ajoute les paramètres pour la gestion RH et l'envoi automatique d'e-mails
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'hr_email_address',
                'value' => '',
                'type' => 'email',
            ],
            [
                'key' => 'hr_auto_forward_messages',
                'value' => 'true',
                'type' => 'boolean',
            ],
            [
                'key' => 'hr_auto_forward_applications',
                'value' => 'true',
                'type' => 'boolean',
            ],
        ];

        foreach ($settings as $settingData) {
            $exists = SiteSetting::where('key', $settingData['key'])->exists();
            
            if (!$exists) {
                SiteSetting::create($settingData);
                $this->command->info("✓ Setting {$settingData['key']} créé avec succès");
            } else {
                $this->command->info("⚠ Setting {$settingData['key']} existe déjà");
            }
        }
    }
}
