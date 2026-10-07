<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Récupérer tous les rôles qui ont cette permission
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}

