<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Company info
            ['key' => 'company_address', 'value' => 'Adresse de l\'entreprise', 'type' => 'text'],
            ['key' => 'company_phone', 'value' => '+221 XX XXX XXXX', 'type' => 'text'],
            ['key' => 'company_email', 'value' => 'info@neremining.sn', 'type' => 'email'],
            ['key' => 'company_website', 'value' => 'https://www.neremining.sn', 'type' => 'url'],
            
            // Footer
            ['key' => 'footer_copyright', 'value' => '© '.date('Y').' Néré Mining. Tous droits réservés.', 'type' => 'text'],
            ['key' => 'footer_description', 'value' => 'Néré Mining est une mine d\'or opérée selon les standards environnementaux et sociaux les plus élevés.', 'type' => 'textarea'],
            
            // Social media
            ['key' => 'social_linkedin', 'value' => '', 'type' => 'url'],
            ['key' => 'social_facebook', 'value' => '', 'type' => 'url'],
            ['key' => 'social_twitter', 'value' => '', 'type' => 'url'],
            
            // SEO/Meta
            ['key' => 'seo_title', 'value' => 'Néré Mining - Exploitation minière responsable', 'type' => 'text'],
            ['key' => 'seo_description', 'value' => 'Découvrez Néré Mining, une mine d\'or au Sénégal engagée dans l\'exploitation durable et responsable.', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::create($setting);
        }
    }
}
