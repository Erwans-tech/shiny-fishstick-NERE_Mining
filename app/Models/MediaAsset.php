<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaAsset extends Model
{
    protected $fillable = ['title', 'type', 'placement', 'file_path', 'external_url', 'caption', 'is_published', 'sort_order'];

    protected $attributes = [
        'type'         => 'image',
        'placement'    => 'gallery',
        'file_path'    => '',
        'is_published' => true,
        'sort_order'   => 0,
    ];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeGallery($query)
    {
        return $query->published()->where('placement', 'gallery')->orderBy('sort_order');
    }

    public function scopeHomepageSlideshow($query)
    {
        return $query->published()
            ->where('type', 'image')
            ->where('placement', 'homepage_slideshow')
            ->orderBy('sort_order');
    }

    /**
     * Retourne l'URL publique du fichier.
     * - Chemins commençant par "images/" → fichiers seedés dans public/images/
     * - Autres → fichiers uploadés via Storage::disk('public') dans public/uploads/
     */
    public function getUrlAttribute(): ?string
    {
        if ($this->external_url) {
            return $this->external_url;
        }

        if (!$this->file_path) return null;

        if (str_starts_with($this->file_path, 'images/')) {
            return asset($this->file_path);
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->file_path);
    }

    public function getEmbedUrlAttribute(): ?string
    {
        if (!$this->external_url) return null;

        if ($this->type === 'google_drive') {
            if (preg_match('~/(?:d|file/d)/([a-zA-Z0-9_-]+)~', $this->external_url, $matches)) {
                return 'https://drive.google.com/file/d/' . $matches[1] . '/preview';
            }

            return $this->external_url;
        }

        if ($this->type === 'youtube') {
            $parts = parse_url($this->external_url);
            $host = strtolower($parts['host'] ?? '');
            $videoId = '';

            if ($host === 'youtu.be' || $host === 'www.youtu.be') {
                $videoId = trim($parts['path'] ?? '', '/');
            } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com'], true)) {
                parse_str($parts['query'] ?? '', $query);
                $videoId = $query['v'] ?? '';
                if (!$videoId && preg_match('~/(?:embed|shorts)/([^/?]+)~', $parts['path'] ?? '', $matches)) {
                    $videoId = $matches[1];
                }
            }

            return $videoId ? 'https://www.youtube.com/embed/' . $videoId : $this->external_url;
        }

        return null;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        if ($this->type !== 'youtube' || !$this->external_url) return null;

        if (preg_match('~/embed/([^/?]+)~', $this->embed_url ?? '', $matches)) {
            return 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg';
        }

        return null;
    }
}
