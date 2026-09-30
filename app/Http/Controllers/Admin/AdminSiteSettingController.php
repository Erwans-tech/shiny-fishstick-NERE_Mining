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

        // Charger les albums pour le dropdown
        $albums = [];
        try {
            $albums = \App\Models\PhotoAlbum::orderBy('title')->get();
        } catch (\Exception $e) {
            // Table pas encore migrée
        }

        return view('admin.settings.index', compact('settings', 'grouped', 'albums'));
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

    /**
     * Envoie un e-mail de test vers l'adresse RH configurée, pour valider
     * la configuration SMTP sans avoir à passer par le formulaire public.
     * Envoi synchrone volontaire (sendNow) : l'admin veut le résultat immédiat.
     */
    public function sendTestEmail()
    {
        $to = SiteSetting::get('hr_email_address');

        if (! $to) {
            return redirect()->route('admin.settings.index')
                ->with('error', "Aucune adresse e-mail de destination n'est enregistrée. Renseignez-la ci-dessus avant de tester.");
        }

        $mailer = config('mail.default');

        if ($mailer === 'log') {
            return redirect()->route('admin.settings.index')
                ->with('error', "MAIL_MAILER vaut « log » : les e-mails sont écrits dans storage/logs/laravel.log et ne sont jamais envoyés. Passez MAIL_MAILER=smtp dans le fichier .env, puis php artisan config:clear.");
        }

        $from = config('mail.from.address');

        try {
            \Mail::to($to)->sendNow(new \App\Mail\TestEmailNotification($to));

            \Log::info("E-mail de test envoyé a {$to} via le mailer {$mailer} (from: {$from})");

            return redirect()->route('admin.settings.index')
                ->with('success', "E-mail de test envoyé à {$to}. Vérifie ta boîte (et le dossier spam / indésirables).");
        } catch (\Throwable $e) {
            \Log::error('Echec du test e-mail: ' . $e->getMessage());

            return redirect()->route('admin.settings.index')
                ->with('error', "Échec de l'envoi : " . $e->getMessage());
        }
    }
}
