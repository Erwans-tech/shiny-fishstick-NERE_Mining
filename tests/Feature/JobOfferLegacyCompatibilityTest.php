<?php

namespace Tests\Feature;

use App\Models\JobOffer;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class JobOfferLegacyCompatibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_open_scope_ignores_spontaneous_filter_when_column_is_missing(): void
    {
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('job_offers');

        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable()->unique();
            $table->string('department', 120);
            $table->string('location', 120)->default('Karma, Burkina Faso');
            $table->string('contract_type', 80);
            $table->string('experience_level', 80)->nullable();
            $table->string('salary_range', 120)->nullable();
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });

        JobOffer::create([
            'title'          => 'Offre legacy',
            'slug'           => 'offre-legacy',
            'department'     => 'Engineering',
            'location'       => 'Burkina Faso',
            'contract_type'  => 'CDI',
            'description'    => 'Description legacy',
            'is_published'   => true,
        ]);

        $this->assertCount(1, JobOffer::open()->get());
        $this->assertFalse(Schema::hasColumn('job_offers', 'is_spontaneous'));
    }
}
