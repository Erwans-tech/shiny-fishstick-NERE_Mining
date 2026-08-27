<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'title',
        'caption',
        'image_path',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /** Scope : slides actives triées par ordre d'affichage. */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    /**
     * URL publique de l'image.
     * - Chemins commençant par "images/" → assets statiques dans public/
     * - Autres → uploads gérés via Storage::disk('public')
     */
    public function getUrlAttribute(): string
    {
        if (str_starts_with($this->image_path, 'images/')) {
            return asset($this->image_path);
        }

        return asset('uploads/' . $this->image_path);
    }

    /**
     * Slides par défaut utilisées quand la table est vide.
     * Retourne une collection avec la même structure que les slides en base.
     */
    public static function defaults(): \Illuminate\Support\Collection
    {
        return collect(range(1, 5))->map(fn ($i) => (object) [
            'id'         => null,
            'title'      => "Karma 0{$i}",
            'caption'    => null,
            'image_path' => "images/mining/karma-0{$i}.jpg",
            'is_active'  => true,
            'sort_order' => $i,
            'url'        => asset("images/mining/karma-0{$i}.jpg"),
        ]);
    }
}
