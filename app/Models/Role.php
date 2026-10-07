<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Récupérer tous les utilisateurs qui ont ce rôle
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Récupérer toutes les permissions de ce rôle
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    /**
     * Vérifier si le rôle a une permission
     */
    public function hasPermission($permissionName)
    {
        return $this->permissions()->where('name', $permissionName)->exists();
    }
}

