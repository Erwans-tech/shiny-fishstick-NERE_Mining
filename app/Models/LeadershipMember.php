<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadershipMember extends Model
{
    protected $fillable = [
        'name',
        'title',
        'department',
        'hierarchy_level',
        'photo_path',
        'is_published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }
}
