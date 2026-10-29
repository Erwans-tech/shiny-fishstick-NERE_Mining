<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Adresse de contact unique affichée sur tout le site
        DB::table('site_settings')
            ->whereIn('key', ['company_email', 'contact_email', 'press_contact_email'])
            ->update(['value' => 'infos@nere-mining.com', 'updated_at' => now()]);
    }

    public function down(): void
    {
        DB::table('site_settings')->where('key', 'company_email')->update(['value' => 'info@nere-mining.bf']);
        DB::table('site_settings')->where('key', 'contact_email')->update(['value' => 'info@nere-mining.bf']);
        DB::table('site_settings')->where('key', 'press_contact_email')->update(['value' => 'presse@nere-mining.bf']);
    }
};
