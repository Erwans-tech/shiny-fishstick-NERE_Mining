<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_english_cookie_banner_and_partners_page_are_localized(): void
    {
        $this->get('/en/cookies-policy')
            ->assertOk()
            ->assertSee('Cookie preferences')
            ->assertSee('Accept')
            ->assertSee('/en/cookies-policy');

        $this->get('/en/partners')
            ->assertOk()
            ->assertSee('Our institutional and technical partners')
            ->assertDontSee('Les partenaires seront publiés prochainement.');
    }
}
