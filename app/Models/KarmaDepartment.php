<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KarmaDepartment extends Model
{
    protected $fillable = [
        'tag_fr',
        'tag_en',
        'title_fr',
        'title_en',
        'body_fr',
        'body_en',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order'   => 'integer',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('sort_order');
    }

    public function localizedTag(?string $locale = null): string
    {
        return $this->localized('tag', $locale);
    }

    public function localizedTitle(?string $locale = null): string
    {
        return $this->localized('title', $locale);
    }

    public function localizedBody(?string $locale = null): string
    {
        return $this->localized('body', $locale);
    }

    private function localized(string $field, ?string $locale): string
    {
        $locale = $locale ?? app()->getLocale();
        $en = ($this->{$field.'_en'} ?? '') ?: ($this->{$field.'_fr'} ?? '');
        $fr = $this->{$field.'_fr'} ?? '';

        return $locale === 'en' ? $en : $fr;
    }
}
