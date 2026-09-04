<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroSlide extends Model
{
    protected $fillable = [
        'type',
        'title',
        'caption',
        'image_path',
        'video_url',
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

    /** Slide de type image ? */
    public function isImage(): bool
    {
        return ($this->type ?? 'image') === 'image';
    }

    /** Slide de type vidéo ? */
    public function isVideo(): bool
    {
        return $this->type === 'video';
    }

    /**
     * URL d'embed pour les vidéos YouTube/Vimeo.
     * Retourne null si ce n'est pas une vidéo hébergée.
     */
    public function getEmbedUrlAttribute(): ?string
    {
        if (! $this->isVideo() || ! $this->video_url) {
            return null;
        }

        $url = $this->video_url;

        // YouTube : youtu.be/ID ou youtube.com/watch?v=ID ou /embed/ID
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_\-]{11})/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1]
                . '?autoplay=1&mute=1&loop=1&playlist=' . $m[1]
                . '&controls=0&showinfo=0&rel=0';
        }

        // Vimeo : vimeo.com/ID
        if (preg_match('/vimeo\.com\/(\d+)/', $url, $m)) {
            return 'https://player.vimeo.com/video/' . $m[1]
                . '?autoplay=1&muted=1&loop=1&background=1';
        }

        // URL directe (fichier local uploadé)
        return null;
    }

    /**
     * URL publique du média (image ou vidéo locale).
     */
    public function getUrlAttribute(): string
    {
        if (! $this->image_path) {
            return $this->video_url ?? '';
        }

        if (str_starts_with($this->image_path, 'images/')) {
            return url($this->image_path);
        }

        $diskName = config('filesystems.default', 'public');
        $disk = Storage::disk($diskName);
        $path = $this->image_path;

        if ($disk->exists($path)) {
            $diskConfig = config('filesystems.disks');
            $baseUrl = rtrim((string) ($diskConfig[$diskName]['url'] ?? ''), '/');
            return $baseUrl . '/' . ltrim($path, '/');
        }

        return '';
    }

    /** Scope : slides actives triées par ordre d'affichage. */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Slides par défaut utilisées quand la table est vide.
     * Retourne une collection avec la même structure que les slides en base.
     */
    public static function defaults(): \Illuminate\Support\Collection
    {
        return collect([
            ['type' => 'image', 'filename' => 'gyathursan-mine-5523376_1920.jpg', 'title' => 'Une mine de classe mondiale'],
            ['type' => 'image', 'filename' => 'pexels-gunshe-5125104.jpg', 'title' => 'Des opérations responsables'],
            ['type' => 'image', 'filename' => 'shibang-mechanical-2653706_1920.jpg', 'title' => 'L’excellence industrielle'],
            ['type' => 'image', 'filename' => 'tyna_janoch-excavator-2781676_1920.jpg', 'title' => 'Des équipes engagées'],
            ['type' => 'image', 'filename' => 'tyna_janoch-mine-2781686_1920.jpg', 'title' => 'Un territoire en mouvement'],
            ['type' => 'video', 'filename' => 'Video Project 1.mp4', 'title' => 'Karma, notre mine d’or'],
        ])->map(fn($slide, $index) => (object) [
            'id'         => null,
            'type'       => $slide['type'],
            'title'      => $slide['title'],
            'caption'    => null,
            'image_path' => "images/carousel/{$slide['filename']}",
            'video_url'  => null,
            'is_active'  => true,
            'sort_order' => $index,
            'url'        => url("images/carousel/{$slide['filename']}"),
            'embed_url'  => null,
        ]);
    }
}
