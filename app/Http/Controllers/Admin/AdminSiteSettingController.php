<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSiteSettingController extends Controller
{
    public function index()
    {
        // Récupérer tous les settings
        $settings = SiteSetting::orderBy('key')->get();

        // Grouper par catégorie (avant le _ dans la clé)
        $grouped = $settings->groupBy(function ($s) {
            return explode('_', $s->key)[0];
        });

        return view('admin.settings.index', compact('settings', 'grouped'));
    }

    /**
     * Mettre à jour les settings
     */
    public function update(Request $request)
    {
        $settings = $request->input('settings', []);
        $storedSettings = SiteSetting::whereIn('key', array_keys($settings))->get()->keyBy('key');
        $rules = [];

        foreach ($storedSettings as $setting) {
            $rule = ['nullable', 'string', 'max:5000'];

            if ($setting->type === 'number') {
                $rule = ['required', 'integer', 'min:0', 'max:86400000'];
            } elseif ($setting->type === 'email') {
                $rule[] = 'email';
            } elseif ($setting->type === 'url') {
                $rule[] = 'url';
            }

            $rules['settings.' . $setting->key] = $rule;
        }

        $validated = $request->validate($rules);

        foreach ($storedSettings as $key => $setting) {
            $value = $validated['settings'][$key] ?? '';
            if ($setting->type === 'boolean') {
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false';
            }
            SiteSetting::set($key, $value, $setting->type);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres du site mis à jour.');
    }
}
