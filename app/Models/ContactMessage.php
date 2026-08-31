<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message', 'type', 'read_at', 'status', 'admin_notes'];

    protected function casts(): array
    {
        return ['read_at' => 'datetime'];
    }
}
