<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AdminLoginController extends Controller
{
    /** Affiche le formulaire de connexion admin. */
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /** Traite la tentative de connexion. */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Rate limiting : max 5 tentatives / minute par IP
        $throttleKey = 'admin-login:' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => "Trop de tentatives. Réessayez dans {$seconds} secondes."]);
        }

        $user = User::where('email', $request->email)
                    ->where('is_admin', true)
                    ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            RateLimiter::hit($throttleKey, 60);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Identifiants incorrects ou accès non autorisé.']);
        }

        // Succès
        RateLimiter::clear($throttleKey);

        $request->session()->regenerate();
        session([
            'admin_logged_in' => true,
            'admin_id'        => $user->id,
            'admin_name'      => $user->name,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Bienvenue, ' . $user->name . ' !');
    }

    /** Déconnexion admin. */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_id', 'admin_name']);
        $request->session()->regenerate();

        return redirect()->route('admin.login')
            ->with('success', 'Déconnexion réussie.');
    }
}
