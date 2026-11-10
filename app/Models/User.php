<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected static function booted(): void
    {
        static::creating(function (User $user): void {
            $user->public_uuid ??= (string) Str::uuid();
            $user->role ??= 'site_manager'; // Default role
        });
    }

    public function getRouteKeyName(): string
    {
        return 'public_uuid';
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /**
     * Récupérer le rôle de l'utilisateur
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Vérifier si l'utilisateur a un rôle spécifique
     */
    public function hasRole($roleName)
    {
        return $this->role === $roleName;
    }

    /**
     * Vérifier si l'utilisateur est admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Vérifier si l'utilisateur est RH
     */
    public function isHR()
    {
        return $this->role === 'hr';
    }

    /**
     * Vérifier si l'utilisateur est gérant du site
     */
    public function isSiteManager()
    {
        return $this->role === 'site_manager';
    }

    /**
     * Vérifier si l'utilisateur a l'un des rôles spécifiés
     */
    public function hasAnyRole($roles)
    {
        $rolesArray = is_array($roles) ? $roles : func_get_args();
        return in_array($this->role, $rolesArray);
    }

    /**
     * Libellés des rôles (config/admin_roles.php)
     *
     * @return array<string, string>
     */
    public static function roleLabels(): array
    {
        return config('admin_roles.labels', []);
    }

    /**
     * Libellé lisible d'un rôle
     */
    public static function roleLabel(?string $role): string
    {
        return static::roleLabels()[$role] ?? 'Inconnu';
    }

    /**
     * Le rôle donne-t-il accès à au moins une des sections admin ?
     * Source unique utilisée par le middleware, le menu et le tableau de bord.
     */
    public static function roleCanAccess(?string $role, string ...$sections): bool
    {
        if ($role === null) {
            return false;
        }

        $allowed = config("admin_roles.sections.{$role}", []);

        if (in_array('*', $allowed, true)) {
            return true;
        }

        return array_intersect($sections, $allowed) !== [];
    }

    /**
     * L'utilisateur a-t-il accès à au moins une des sections admin ?
     */
    public function canAccessSection(string ...$sections): bool
    {
        return static::roleCanAccess($this->role, ...$sections);
    }

    /** Scope : only admin users */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /** Scope : only HR users */
    public function scopeHR($query)
    {
        return $query->where('role', 'hr');
    }

    /** Scope : only site manager users */
    public function scopeSiteManager($query)
    {
        return $query->where('role', 'site_manager');
    }
}
