<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class JobOffer extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'contract_type',
        'experience_level',
        'salary_range',
        'description',
        'requirements',
        'deadline',
        'is_published',
        'is_spontaneous',
    ];

    protected function casts(): array
    {
        return [
            'deadline'       => 'date',
            'is_published'   => 'boolean',
            'is_spontaneous' => 'boolean',
        ];
    }

    /** Auto-generate slug on save if missing. */
    protected static function booted(): void
    {
        static::saving(function (JobOffer $job) {
            if (empty($job->slug)) {
                $job->slug = static::makeUniqueSlug($job->title, $job->id);
            }
        });
    }

    public static function makeUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i    = 1;

        while (
            static::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /** Route model binding by slug. */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    /** Scope : offres publiées, non expirées, NON spontanées. */
    public function scopeOpen($query)
    {
        $query->where('is_published', true)
            ->when(Schema::hasColumn($this->getTable(), 'is_spontaneous'), function ($query) {
                $query->where('is_spontaneous', false);
            })
            ->where(function ($q) {
                $q->whereNull('deadline')->orWhere('deadline', '>=', today());
            });

        return $query;
    }

    /** Scope : récupère l'offre de candidature spontanée active. */
    public function scopeSpontaneous($query)
    {
        return $query
            ->where('is_published', true)
            ->where('is_spontaneous', true);
    }

    /** Experience levels list. */
    public static function experienceLevels(): array
    {
        return [
            'junior'    => ['fr' => 'Junior (0–2 ans)',    'en' => 'Junior (0–2 yrs)'],
            'mid'       => ['fr' => 'Intermédiaire (2–5 ans)', 'en' => 'Mid-level (2–5 yrs)'],
            'senior'    => ['fr' => 'Senior (5–10 ans)',   'en' => 'Senior (5–10 yrs)'],
            'expert'    => ['fr' => 'Expert (10 ans +)',   'en' => 'Expert (10+ yrs)'],
            'internship' => ['fr' => 'Stage',               'en' => 'Internship'],
        ];
    }

    public function experienceLabelFr(): string
    {
        return static::experienceLevels()[$this->experience_level]['fr'] ?? $this->experience_level ?? '';
    }

    public function experienceLabelEn(): string
    {
        return static::experienceLevels()[$this->experience_level]['en'] ?? $this->experience_level ?? '';
    }
}
