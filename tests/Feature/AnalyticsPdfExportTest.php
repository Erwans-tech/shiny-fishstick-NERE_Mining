<?php

namespace Tests\Feature;

use App\Models\SiteAnalytics;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AnalyticsPdfExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_download_statistics_as_pdf(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin-test@nere-mining.bf'],
            ['name' => 'Admin Test', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        foreach (['/', '/', '/carrieres', '/contact'] as $i => $path) {
            SiteAnalytics::create([
                'page_url'    => 'https://www.nere-mining.bf' . $path,
                'ip_address'  => 'visitor-' . ($i % 2),
                'device_type' => $i % 2 ? 'mobile' : 'desktop',
                'visited_at'  => now()->subDays($i),
            ]);
        }

        $response = $this->withSession([
            'admin_logged_in'       => true,
            'admin_id'              => $admin->id,
            'admin_role'            => 'admin',
            'admin_session_renewed' => true,
        ])->get(route('admin.analytics.export', ['days' => 30, 'format' => 'pdf']));

        $response->assertOk()->assertHeader('content-type', 'application/pdf');
        $this->assertStringStartsWith('%PDF', $response->getContent());
        $this->assertStringContainsString('nere-mining-statistiques-30j-', $response->headers->get('content-disposition'));

        if ($out = env('ANALYTICS_PDF_PREVIEW')) {
            file_put_contents($out, $response->getContent());
        }
    }

    public function test_statistics_page_still_renders(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin-test@nere-mining.bf'],
            ['name' => 'Admin Test', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        $this->withSession([
            'admin_logged_in'       => true,
            'admin_id'              => $admin->id,
            'admin_role'            => 'admin',
            'admin_session_renewed' => true,
        ])->get(route('admin.analytics.index', ['days' => 7]))
            ->assertOk()
            ->assertSee('Exporter en PDF');
    }
}
