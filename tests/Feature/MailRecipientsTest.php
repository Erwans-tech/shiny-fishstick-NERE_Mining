<?php

namespace Tests\Feature;

use App\Mail\ContactMessageNotification;
use App\Mail\JobApplicationNotification;
use App\Models\JobOffer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailRecipientsTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_offer_application_is_emailed_to_recruitment(): void
    {
        Mail::fake();

        $job = JobOffer::create([
            'title'          => 'Ingénieur des mines',
            'slug'           => 'ingenieur-des-mines',
            'department'     => 'Production',
            'location'       => 'Karma, Burkina Faso',
            'contract_type'  => 'CDI',
            'description'    => 'Description du poste',
            'is_published'   => true,
            'is_spontaneous' => false,
        ]);

        $this->post(route('jobs.apply', $job), [
            'first_name' => 'Awa',
            'last_name'  => 'Traore',
            'email'      => 'awa.traore@gmail.com',
            'motivation' => str_repeat('Je souhaite rejoindre votre entreprise et contribuer à vos projets. ', 2),
        ])->assertSessionHas('apply_success');

        Mail::assertSent(JobApplicationNotification::class, function (JobApplicationNotification $mail) {
            return $mail->hasTo('karmarecrutement@nere-mining.com');
        });
    }

    public function test_contact_message_is_emailed_to_infos(): void
    {
        Mail::fake();

        $this->post(route('contact.store'), [
            'name'    => 'Awa Traore',
            'email'   => 'awa.traore@gmail.com',
            'subject' => 'Demande d’information',
            'message' => 'Bonjour, je souhaite obtenir des informations.',
            'type'    => 'general',
        ])->assertSessionHas('success');

        Mail::assertSent(ContactMessageNotification::class, function (ContactMessageNotification $mail) {
            return $mail->hasTo('infos@nere-mining.com');
        });
    }
}
