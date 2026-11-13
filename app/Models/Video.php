<?php

namespace App\Models;

use App\Helpers\StorageHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'title_en',
        'video_path',
        'poster_path',
        'video_date',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'video_date'   => 'date',
            'is_published' => 'boolean',
        ];
    }

    /** Published videos, most recent first. */
    public function scopeForSite(Builder $query): Builder
    {
        return $query->where('is_published', true)->latest('video_date')->latest('id');
    }

    public function titleFor(string $locale): string
    {
        return $locale === 'en' && $this->title_en ? $this->title_en : $this->title;
    }

    public function videoUrl(): string
    {
        return self::fileUrl($this->video_path);
    }

    public function posterUrl(): ?string
    {
        return $this->poster_path ? self::fileUrl($this->poster_path) : null;
    }

    /** Paths under videos/ or images/ are versioned in public/, the rest are uploads. */
    public static function fileUrl(string $path): string
    {
        return str_starts_with($path, 'videos/') || str_starts_with($path, 'images/')
            ? asset($path)
            : StorageHelper::uploadUrl($path);
    }

    public function isUploaded(string $path): bool
    {
        return ! str_starts_with($path, 'videos/') && ! str_starts_with($path, 'images/');
    }
}
