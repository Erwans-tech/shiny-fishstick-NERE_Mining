<?php

namespace Tests\Feature;

use App\Mail\JobApplicationNotification;
use App\Models\JobApplication;
use App\Models\JobOffer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobApplicationMailRenderTest extends TestCase
{
    use RefreshDatabase;

    public function test_saved_application_email_links_to_the_admin_page(): void
    {
        $job = JobOffer::create([
            'title'          => 'Géologue',
            'department'     => 'Exploration',
            'location'       => 'Karma, Burkina Faso',
            'contract_type'  => 'CDI',
            'description'    => 'Description du poste',
            'deadline'       => now()->addMonth(),
            'is_published'   => true,
            'is_spontaneous' => false,
        ]);

        $application = JobApplication::create([
            'job_offer_id' => $job->id,
            'first_name'   => 'Awa',
            'last_name'    => 'Traore',
            'email'        => 'awa.traore@gmail.com',
            'motivation'   => 'Motivation de test.',
            'cv_path'      => 'applications/cv/absent.pdf',
        ]);

        (new JobApplicationNotification($application->load('jobOffer')))
            ->assertSeeInHtml(route('admin.applications.show', $application->id));
    }
}
