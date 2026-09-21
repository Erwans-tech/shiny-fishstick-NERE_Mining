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
            // Carrousel Hero
            ['key' => 'carousel_autoplay', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_interval', 'value' => '5000', 'type' => 'number'],
            ['key' => 'carousel_transition_speed', 'value' => '800', 'type' => 'number'],
            ['key' => 'carousel_pause_on_hover', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_show_indicators', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_show_arrows', 'value' => 'true', 'type' => 'boolean'],

            // Album mis en avant sur la page d'accueil
            ['key' => 'home_featured_album_id', 'value' => '', 'type' => 'album_select'],
            ['key' => 'home_description', 'value' => 'Néré Mining SA est une entreprise minière aurifère majoritairement détenue par des capitaux burkinabè. À travers l’exploitation de sa mine de Karma et ses activités d’exploration, Néré Mining ambitionne de contribuer au développement d’un secteur minier national performant, responsable et créateur de valeur pour le Burkina Faso.', 'type' => 'textarea'],

            // Company info
            ['key' => 'company_address', 'value' => 'Ouagadougou, Burkina Faso', 'type' => 'text'],
            ['key' => 'company_phone', 'value' => '+226 25 33 35 69', 'type' => 'text'],
            ['key' => 'company_email', 'value' => 'info@nere-mining.bf', 'type' => 'email'],
            ['key' => 'company_website', 'value' => 'https://www.nere-mining.bf', 'type' => 'url'],

            // Press contact
            ['key' => 'press_contact_name', 'value' => 'Service Communication', 'type' => 'text'],
            ['key' => 'press_contact_job', 'value' => 'Responsable Communication & Relations Presse - Néré Mining S.A.', 'type' => 'text'],
            ['key' => 'press_contact_photo', 'value' => '', 'type' => 'url'],
            ['key' => 'press_contact_phone', 'value' => '+226 25 33 35 69', 'type' => 'text'],
            ['key' => 'press_contact_email', 'value' => 'presse@nere-mining.bf', 'type' => 'email'],
            ['key' => 'press_contact_hours', 'value' => 'Lundi – Vendredi, 8h – 17h (GMT+0)', 'type' => 'text'],

            // Footer
            ['key' => 'footer_copyright', 'value' => '© ' . date('Y') . ' Néré Mining. Tous droits réservés.', 'type' => 'text'],
            ['key' => 'footer_description', 'value' => 'Néré Mining est une société minière burkinabè engagée dans une exploitation responsable et durable de l\'or à la mine Karma.', 'type' => 'textarea'],
            ['key' => 'ceo_message_fr', 'value' => 'Bienvenue sur le site officiel de Néré Mining.\n\nÀ travers ces pages, vous découvrirez nos activités de prospection, d’extraction, de production et de commercialisation de l’or, menées depuis notre site de Karma.', 'type' => 'textarea'],
            ['key' => 'ceo_message_en', 'value' => 'Welcome to the official website of Néré Mining.\n\nThrough these pages, you will discover our gold exploration, extraction, production and marketing activities, carried out from our Karma site.', 'type' => 'textarea'],

            // Social media
            ['key' => 'social_linkedin', 'value' => '', 'type' => 'url'],
            ['key' => 'social_facebook', 'value' => '', 'type' => 'url'],
            ['key' => 'social_twitter', 'value' => '', 'type' => 'url'],

            // SEO/Meta
            ['key' => 'seo_title', 'value' => 'Néré Mining - L\'or d\'une valeur durable', 'type' => 'text'],
            ['key' => 'seo_description', 'value' => 'Néré Mining, groupe aurifère burkinabè engagé pour une mine responsable à Karma. Exploitation durable et création de valeur partagée.', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type']
                ]
            );
        }
    }
}
