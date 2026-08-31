<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'type'];

    /**
     * Récupérer une valeur de setting par sa clé
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Définir une valeur de setting
     */
    public static function set(string $key, $value, string $type = 'text'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }

    /**
     * Récupérer tous les settings sous forme de key-value array
     */
    public static function all_settings(): array
    {
        return static::pluck('value', 'key')->toArray();
    }
}

