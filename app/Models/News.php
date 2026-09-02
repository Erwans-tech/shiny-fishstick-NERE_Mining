<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    public function getRouteKey(): mixed
    {
        $slug = $this->attributes['slug'] ?? null;

        return ($slug !== null && $slug !== '') ? $slug : $this->getKey();
    }

    protected $fillable = [
        'title',
        'slug',
        'category',
        'excerpt',
        'content',
        'image_path',
        'published_at',
    ];

    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }

    protected static function booted(): void
    {
        static::creating(function (News $news): void {
            if (! $news->slug) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBindingQuery($query, $value, $field = null)
    {
        $field = $field ?? $this->getRouteKeyName();

        if ($field === 'slug' && is_numeric($value)) {
            return $query->where(function ($query) use ($value) {
                $query->where('slug', $value)
                    ->orWhere('id', $value);
            });
        }

        return $query->where($field, $value);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }
}
