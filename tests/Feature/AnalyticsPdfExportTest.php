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

    public function test_pages_and_sources_are_merged(): void
    {
        $visits = [
            ['https://www.nere-mining.bf/index.php/karma', null],
            ['https://www.nere-mining.bf/karma?lang=fr', ''],
            ['https://www.nere-mining.bf/index.php', 'https://www.nere-mining.bf/contact'],
            ['https://www.nere-mining.bf/', 'https://nere-mining.bf/'],
            ['https://www.nere-mining.bf/', 'https://www.google.com/search?q=nere'],
        ];

        foreach ($visits as $i => [$url, $referrer]) {
            SiteAnalytics::create(['page_url' => $url, 'referrer' => $referrer, 'ip_address' => 'v' . $i, 'visited_at' => now()]);
        }

        $admin = User::firstOrCreate(
            ['email' => 'admin-test@nere-mining.bf'],
            ['name' => 'Admin Test', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        $response = $this->withSession([
            'admin_logged_in'       => true,
            'admin_id'              => $admin->id,
            'admin_role'            => 'admin',
            'admin_session_renewed' => true,
        ])->get(route('admin.analytics.index'))->assertOk();

        $this->assertSame(
            [['url' => '/', 'visits' => 3], ['url' => '/karma', 'visits' => 2]],
            $response->viewData('topPages')->all()
        );
        $this->assertEqualsCanonicalizing(
            [
                ['source' => 'Direct', 'visits' => 2],
                ['source' => 'Navigation sur le site', 'visits' => 2],
                ['source' => 'www.google.com', 'visits' => 1],
            ],
            $response->viewData('referrers')->all()
        );
    }

    public function test_visits_are_recorded_without_index_php(): void
    {
        SiteAnalytics::track(\Illuminate\Http\Request::create('https://www.nere-mining.bf/index.php/karma?x=1', 'GET', server: ['SCRIPT_NAME' => '/index.php', 'SCRIPT_FILENAME' => public_path('index.php')]));

        $this->assertStringNotContainsString('index.php', SiteAnalytics::latest('id')->value('page_url'));
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
