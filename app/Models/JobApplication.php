<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    protected $fillable = [
        'job_offer_id', 'first_name', 'last_name', 'email', 'phone',
        'nationality', 'current_position', 'experience_years',
        'motivation', 'cv_path', 'cover_letter_path',
        'status', 'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    public function jobOffer(): BelongsTo
    {
        return $this->belongsTo(JobOffer::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public static function statusLabels(): array
    {
        return [
            'new'       => ['label' => 'Nouveau',         'badge' => 'badge-yellow'],
            'reviewing' => ['label' => 'En examen',       'badge' => 'badge-gray'],
            'interview' => ['label' => 'Entretien',       'badge' => 'badge-blue'],
            'accepted'  => ['label' => 'Accepté',         'badge' => 'badge-green'],
            'rejected'  => ['label' => 'Refusé',          'badge' => 'badge-red'],
        ];
    }
}
