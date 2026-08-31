<?php

namespace Tests\Feature;

use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminNewsletterSubscribersTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_newsletter_subscribers(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        NewsletterSubscriber::create([
            'email' => 'alice@example.com',
            'subscribed_at' => now()->subDays(2),
        ]);

        $this->withSession([
            'admin_logged_in' => true,
            'admin_id' => $admin->id,
            'admin_name' => $admin->name,
        ])->get('/gestion-nm/newsletter')
            ->assertOk()
            ->assertSee('alice@example.com');
    }
}
