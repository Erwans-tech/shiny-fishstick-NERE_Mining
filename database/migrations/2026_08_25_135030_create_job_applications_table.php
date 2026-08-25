<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_offer_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone', 40)->nullable();
            $table->string('nationality', 80)->nullable();
            $table->string('current_position', 160)->nullable();
            $table->string('experience_years', 40)->nullable();
            $table->text('motivation');
            $table->string('cv_path')->nullable();
            $table->string('cover_letter_path')->nullable();
            $table->enum('status', ['new', 'reviewing', 'interview', 'rejected', 'accepted'])->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
