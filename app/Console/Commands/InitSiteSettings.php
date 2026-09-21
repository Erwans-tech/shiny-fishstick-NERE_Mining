<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SiteSetting;

class InitSiteSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:init {--force : Force overwrite existing settings}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize site settings with default values';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Initializing site settings...');

        $settings = [
            // Carrousel Hero
            ['key' => 'carousel_autoplay', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_interval', 'value' => '5000', 'type' => 'number'],
            ['key' => 'carousel_transition_speed', 'value' => '800', 'type' => 'number'],
            ['key' => 'carousel_pause_on_hover', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_show_indicators', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_show_arrows', 'value' => 'true', 'type' => 'boolean'],

            // Album mis en avant
            ['key' => 'home_featured_album_id', 'value' => '', 'type' => 'album_select'],

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

            // Social media
            ['key' => 'social_linkedin', 'value' => '', 'type' => 'url'],
            ['key' => 'social_facebook', 'value' => '', 'type' => 'url'],
            ['key' => 'social_twitter', 'value' => '', 'type' => 'url'],

            // SEO/Meta
            ['key' => 'seo_title', 'value' => 'Néré Mining - L\'or d\'une valeur durable', 'type' => 'text'],
            ['key' => 'seo_description', 'value' => 'Néré Mining, groupe aurifère burkinabè engagé pour une mine responsable à Karma. Exploitation durable et création de valeur partagée.', 'type' => 'textarea'],
        ];

        $created = 0;
        $updated = 0;
        $skipped = 0;

        foreach ($settings as $setting) {
            $exists = SiteSetting::where('key', $setting['key'])->first();

            if ($exists && !$this->option('force')) {
                $skipped++;
                continue;
            }

            if ($exists) {
                $exists->update([
                    'value' => $setting['value'],
                    'type' => $setting['type']
                ]);
                $updated++;
                $this->line("  ✓ Updated: {$setting['key']}");
            } else {
                SiteSetting::create($setting);
                $created++;
                $this->line("  + Created: {$setting['key']}");
            }
        }

        $this->newLine();
        $this->info("✅ Done!");
        $this->line("  Created: {$created}");
        $this->line("  Updated: {$updated}");
        $this->line("  Skipped: {$skipped}");

        if ($skipped > 0 && !$this->option('force')) {
            $this->newLine();
            $this->comment("💡 Use --force to overwrite existing settings");
        }

        return 0;
    }
}
