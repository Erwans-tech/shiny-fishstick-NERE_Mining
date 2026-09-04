<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LocalContentSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('TRUNCATE TABLE certifications, hero_slides, karma_departments, leadership_members, media_assets, news, partners, press_documents, reports, site_settings RESTART IDENTITY CASCADE');

        $sql = File::get(database_path('local-content.sql'));
        $sql = preg_replace('/^\\\\(?:un)?restrict.*$/m', '', $sql) ?? $sql;
        $sql = preg_replace('/^SET transaction_timeout = 0;\s*$/m', '', $sql) ?? $sql;

        DB::unprepared($sql);
    }
}
