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
        $value = $locale === 'en'
            ? ($this->{$field.'_en'} ?? '')
            : ($this->{$field.'_fr'} ?? '');

        if (trim((string) $value) !== '') {
            return $value;
        }

        $fallback = $locale === 'en'
            ? ($this->{$field.'_fr'} ?? '')
            : ($this->{$field.'_en'} ?? '');

        if (trim((string) $fallback) !== '') {
            return $fallback;
        }

        return $this->defaultLocalizedValue($field, $locale);
    }

    private function defaultLocalizedValue(string $field, string $locale): string
    {
        $title = trim((string) $this->localizedTitle($locale));

        if ($field === 'tag') {
            return $locale === 'en' ? 'Department' : 'Département';
        }

        if ($field === 'title') {
            return $locale === 'en'
                ? ($title !== '' ? $title : 'Mine department')
                : ($title !== '' ? $title : 'Département de la mine');
        }

        return $locale === 'en'
            ? 'This department supports the mine’s daily operations, ensures safety and helps deliver long-term value to local stakeholders.'
            : 'Ce département soutient le fonctionnement quotidien de la mine, assure la sécurité et contribue à créer de la valeur durable pour les parties prenantes locales.';
    }
}
