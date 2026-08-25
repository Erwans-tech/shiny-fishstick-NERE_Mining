<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PressDocument extends Model
{
    protected $fillable = ['title', 'document_type', 'description', 'file_path', 'published_at'];

    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }
}
