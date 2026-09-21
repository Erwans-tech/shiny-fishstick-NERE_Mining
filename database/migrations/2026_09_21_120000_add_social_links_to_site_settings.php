<?php

use App\Models\SiteSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['facebook', 'linkedin', 'instagram', 'youtube'] as $network) {
            SiteSetting::updateOrCreate(
                ['key' => 'social_' . $network],
                ['value' => '', 'type' => 'url']
            );
        }
    }

    public function down(): void
    {
        SiteSetting::whereIn('key', [
            'social_facebook',
            'social_linkedin',
            'social_instagram',
            'social_youtube',
        ])->delete();
    }
};
