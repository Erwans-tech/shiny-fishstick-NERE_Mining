<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhotoAlbum extends Model
{
    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'is_published',
        'show_on_homepage',
        'sort_order'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'show_on_homepage' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Relation : Un album a plusieurs médias
     */
    public function media(): HasMany
    {
        return $this->hasMany(MediaAsset::class, 'album_id')->orderBy('sort_order');
    }

    /**
     * Relation : Médias publiés uniquement
     */
    public function publishedMedia(): HasMany
    {
        return $this->media()->where('is_published', true);
    }

    /**
     * Scope : Albums publiés
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope : Album à afficher sur la page d'accueil
     */
    public function scopeForHomepage($query)
    {
        return $query->where('is_published', true)
                     ->where('show_on_homepage', true)
                     ->with('publishedMedia')
                     ->orderBy('sort_order')
                     ->orderBy('created_at', 'desc');
    }

    /**
     * Accessor : URL de l'image de couverture
     */
    public function getCoverUrlAttribute(): ?string
    {
        if (!$this->cover_image) {
            // Utiliser la première image du média comme couverture par défaut
            $firstMedia = $this->publishedMedia()->first();
            return $firstMedia ? $firstMedia->url : null;
        }

        if (str_starts_with($this->cover_image, 'images/')) {
            return asset($this->cover_image);
        }

        return \Illuminate\Support\Facades\Storage::disk(config('filesystems.default'))->url($this->cover_image);
    }

    /**
     * Compter le nombre de photos dans l'album
     */
    public function getPhotoCountAttribute(): int
    {
        // Si la relation est déjà chargée, utiliser ça
        if ($this->relationLoaded('publishedMedia')) {
            return $this->publishedMedia->count();
        }
        
        // Sinon faire une requête count
        return $this->publishedMedia()->count();
    }

    /**
     * Obtenir les 4 premières images pour le carousel
     */
    public function getPreviewImagesAttribute()
    {
        // Si la relation est déjà chargée, utiliser ça
        if ($this->relationLoaded('publishedMedia')) {
            return $this->publishedMedia->where('type', 'image')->take(4);
        }
        
        // Sinon faire une requête
        return $this->publishedMedia()
            ->where('type', 'image')
            ->limit(4)
            ->get();
    }
}
