<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = [
        'section',
        'key',
        'label_fr',
        'label_en',
        'value_fr',
        'value_en',
        'icon',
        'suffix',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return ['is_published' => 'boolean', 'sort_order' => 'integer'];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('sort_order')->orderBy('id');
    }

    public function localized(string $field, string $locale = 'fr'): string
    {
        $value = $this->{$field . '_' . $locale} ?? '';
        return trim((string) $value) !== '' ? (string) $value : (string) ($this->{$field . '_fr'} ?? '');
    }
}
