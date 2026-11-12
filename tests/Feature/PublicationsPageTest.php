<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicationsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_publications_pages_render(): void
    {
        $this->get(route('reports.public'))->assertOk();
        $this->get(route('english.reports'))->assertOk();
    }
}
