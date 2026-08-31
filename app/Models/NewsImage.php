<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class NewsImage extends Model
{
    protected $fillable = [
        'news_id',
        'image_path',
        'alt_text',
        'caption',
        'position',
    ];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
        ];
    }

    /**
     * Relation : une image appartient à une actualité
     */
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    /**
     * URL publique de l'image
     */
    public function getUrlAttribute(): string
    {
        if (! $this->image_path) {
            return '';
        }

        $disk = Storage::disk(config('filesystems.default', 'public'));

        if ($disk->exists($this->image_path)) {
            return $disk->url($this->image_path);
        }

        return asset($this->image_path);
    }

    /**
     * Supprimer l'image du stockage
     */
    public function deleteFile(): bool
    {
        if ($this->image_path) {
            try {
                Storage::disk('public')->delete($this->image_path);
                return true;
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Delete news image failed: ' . $e->getMessage());
                return false;
            }
        }
        return true;
    }
}
