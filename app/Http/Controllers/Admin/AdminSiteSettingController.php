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
        $grouped = $settings->groupBy(function($s) {
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

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres du site mis à jour.');
    }
}
