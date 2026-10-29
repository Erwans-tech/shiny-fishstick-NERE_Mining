<?php

namespace Tests\Feature;

use App\Models\JobOffer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminJobOfferUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_published_job_offer_with_its_document(): void
    {
        Storage::fake('public');

        $this
            ->withSession([
                'admin_logged_in' => true,
                'admin_session_renewed' => true,
            ])
            ->get(route('admin.jobs.create'))
            ->assertOk()
            ->assertSee('name="title"', false)
            ->assertSee('name="offer_file"', false)
            ->assertSee('name="deadline"', false)
            ->assertSee('enctype="multipart/form-data"', false)
            ->assertDontSee('name="department"', false);

        $response = $this
            ->withSession([
                'admin_logged_in' => true,
                'admin_session_renewed' => true,
            ])
            ->post(route('admin.jobs.store'), [
                'title' => 'Ingénieur minier',
                'deadline' => now()->addMonth()->format('Y-m-d'),
                'offer_file' => UploadedFile::fake()->create('offre.pdf', 128, 'application/pdf'),
            ]);

        $response->assertRedirect(route('admin.jobs.index'));

        $job = JobOffer::query()->where('title', 'Ingénieur minier')->firstOrFail();

        $this->assertTrue($job->is_published);
        $this->assertNotEmpty($job->offer_file_path);
        Storage::disk('public')->assertExists($job->offer_file_path);

        $this
            ->withSession([
                'admin_logged_in' => true,
                'admin_session_renewed' => true,
            ])
            ->get(route('admin.jobs.index'))
            ->assertOk()
            ->assertSee('Consulter le fichier');

        $this
            ->get(route('jobs.show', $job))
            ->assertOk()
            ->assertSee('Consulter le document complet de l’offre');
    }
}
