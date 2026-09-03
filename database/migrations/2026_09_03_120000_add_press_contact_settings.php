<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            ['key' => 'press_contact_name', 'value' => '[Nom du Responsable Communication]', 'type' => 'text'],
            ['key' => 'press_contact_job', 'value' => 'Responsable Communication & Relations Presse — Néré Mining S.A.', 'type' => 'text'],
            ['key' => 'press_contact_photo', 'value' => '', 'type' => 'url'],
            ['key' => 'press_contact_phone', 'value' => '+226 25 33 35 69', 'type' => 'text'],
            ['key' => 'press_contact_email', 'value' => 'presse@nere-mining.bf', 'type' => 'email'],
            ['key' => 'press_contact_hours', 'value' => 'Lundi – Vendredi, 8h – 17h (GMT+0)', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            DB::table('site_settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }
    }

    public function down(): void
    {
        DB::table('site_settings')->whereIn('key', [
            'press_contact_name',
            'press_contact_job',
            'press_contact_photo',
            'press_contact_phone',
            'press_contact_email',
            'press_contact_hours',
        ])->delete();
    }
};