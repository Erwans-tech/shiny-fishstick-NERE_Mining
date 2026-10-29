<?php

namespace Tests\Feature;

use App\Mail\JobApplicationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Mail\PendingMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Mockery;
use RuntimeException;
use Tests\TestCase;

class SpontaneousApplicationMailTest extends TestCase
{
    use RefreshDatabase;

    public function test_spontaneous_application_is_emailed_to_hr_before_it_is_saved(): void
    {
        Storage::fake('local');

        $pendingMail = Mockery::mock(PendingMail::class);
        $pendingMail->shouldReceive('send')
            ->once()
            ->with(Mockery::type(JobApplicationNotification::class))
            ->andReturnUsing(function (JobApplicationNotification $notification): void {
                $this->assertDatabaseCount('job_applications', 0);
                $notification->build();
                $this->assertCount(1, $notification->attachments);
            });

        Mail::shouldReceive('to')
            ->once()
            ->with('infos@nere-mining.com')
            ->andReturn($pendingMail);

        $this->from(route('spontaneous'))
            ->post(route('spontaneous.apply'), [
                'first_name' => 'Awa',
                'last_name' => 'Traore',
                'email' => 'awa.traore@gmail.com',
                'motivation' => str_repeat('Je souhaite rejoindre votre entreprise et contribuer à vos projets. ', 2),
                'cv' => UploadedFile::fake()->create('cv.pdf', 100, 'application/pdf'),
            ])
            ->assertRedirect(route('spontaneous'))
            ->assertSessionHas('apply_success');

        $this->assertDatabaseCount('job_applications', 1);
        $this->assertCount(1, Storage::disk('local')->allFiles('applications/cv'));
    }

    public function test_spontaneous_application_is_not_saved_when_hr_email_fails(): void
    {
        Storage::fake('local');

        Mail::shouldReceive('to')
            ->once()
            ->with('infos@nere-mining.com')
            ->andThrow(new RuntimeException('SMTP indisponible.'));

        $this->from(route('spontaneous'))
            ->post(route('spontaneous.apply'), [
                'first_name' => 'Awa',
                'last_name' => 'Traore',
                'email' => 'awa.traore@gmail.com',
                'motivation' => str_repeat('Je souhaite rejoindre votre entreprise et contribuer à vos projets. ', 2),
                'cv' => UploadedFile::fake()->create('cv.pdf', 100, 'application/pdf'),
            ])
            ->assertRedirect(route('spontaneous'))
            ->assertSessionHasErrors('mail');

        $this->assertDatabaseCount('job_applications', 0);
        $this->assertSame([], Storage::disk('local')->allFiles('applications/cv'));
    }
}
