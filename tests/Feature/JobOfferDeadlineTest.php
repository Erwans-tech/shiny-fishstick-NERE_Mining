<?php

namespace Tests\Feature;

use App\Models\JobOffer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JobOfferDeadlineTest extends TestCase
{
    use RefreshDatabase;

    private function adminSession(): array
    {
        return [
            'admin_logged_in' => true,
            'admin_session_renewed' => true,
        ];
    }

    private function makeOffer(string $title, ?string $deadline): JobOffer
    {
        return JobOffer::create([
            'title'          => $title,
            'department'     => 'Production',
            'location'       => 'Karma, Burkina Faso',
            'contract_type'  => 'CDI',
            'description'    => 'Description du poste',
            'deadline'       => $deadline,
            'is_published'   => true,
            'is_spontaneous' => false,
        ]);
    }

    public function test_offer_is_visible_until_its_deadline_day_included(): void
    {
        $job = $this->makeOffer('Géologue', today()->format('Y-m-d'));

        $this->get(route('jobs.index'))->assertOk()->assertSee('Géologue');
        $this->get(route('jobs.show', $job))->assertOk();
    }

    public function test_expired_offer_is_hidden_from_the_site(): void
    {
        $job = $this->makeOffer('Foreur expiré', today()->subDay()->format('Y-m-d'));

        $this->get(route('jobs.index'))->assertOk()->assertDontSee('Foreur expiré');
        $this->get(route('jobs.show', $job))->assertNotFound();
        $this->post(route('jobs.apply', $job), [])->assertNotFound();
    }

    public function test_expired_offer_is_listed_in_admin_archive(): void
    {
        $this->makeOffer('Offre en cours', today()->addWeek()->format('Y-m-d'));
        $this->makeOffer('Offre expirée', today()->subDay()->format('Y-m-d'));

        $this->withSession($this->adminSession())
            ->get(route('admin.jobs.index'))
            ->assertOk()
            ->assertSee('Offre en cours')
            ->assertDontSee('Offre expirée');

        $this->withSession($this->adminSession())
            ->get(route('admin.jobs.index', ['status' => 'archived']))
            ->assertOk()
            ->assertSee('Offre expirée')
            ->assertSee('Archivée')
            ->assertDontSee('Offre en cours');
    }

    public function test_deadline_is_required_and_cannot_be_in_the_past_on_creation(): void
    {
        Storage::fake('public');

        $this->withSession($this->adminSession())
            ->post(route('admin.jobs.store'), [
                'title' => 'Sans date',
                'offer_file' => UploadedFile::fake()->create('offre.pdf', 64, 'application/pdf'),
            ])
            ->assertSessionHasErrors('deadline');

        $this->withSession($this->adminSession())
            ->post(route('admin.jobs.store'), [
                'title' => 'Date passée',
                'deadline' => today()->subDay()->format('Y-m-d'),
                'offer_file' => UploadedFile::fake()->create('offre.pdf', 64, 'application/pdf'),
            ])
            ->assertSessionHasErrors('deadline');

        $this->assertDatabaseCount('job_offers', 0);
    }
}
