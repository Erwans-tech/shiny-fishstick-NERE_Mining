<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email', 'max:180'],
            'password' => ['required', 'string', 'min:8', 'max:128'],
        ]);

        // ── Rate limiting : 5 tentatives/min par IP, 10/heure par email ──
        $ipKey    = 'admin-login-ip:' . $request->ip();
        $emailKey = 'admin-login-email:' . $request->input('email');

        if (RateLimiter::tooManyAttempts($ipKey, 5)) {
            $wait = RateLimiter::availableIn($ipKey);
            Log::warning('Brute-force admin login bloque', ['ip' => $request->ip()]);
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => "Trop de tentatives. Réessayez dans {$wait}s."]);
        }

        if (RateLimiter::tooManyAttempts($emailKey, 10)) {
            $wait = RateLimiter::availableIn($emailKey);
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => "Compte temporairement verrouillé. Réessayez dans {$wait}s."]);
        }

        $user = User::where('email', $request->input('email'))
                    ->where('is_admin', true)
                    ->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            RateLimiter::hit($ipKey, 60);
            RateLimiter::hit($emailKey, 3600);

            // Log la tentative échouée
            Log::warning('Tentative connexion admin echouee', [
                'ip'    => $request->ip(),
                'email' => $request->input('email'),
            ]);

            return back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Identifiants incorrects ou accès non autorisé.']);
        }

        // ── Succès ────────────────────────────────────────────────
        RateLimiter::clear($ipKey);
        RateLimiter::clear($emailKey);

        // Régénérer la session pour prévenir la fixation de session
        $request->session()->regenerate();

        session([
            'admin_logged_in'     => true,
            'admin_id'            => $user->id,
            'admin_name'          => $user->name,
            'admin_session_renewed' => false,
            'admin_login_at'      => now()->timestamp,
        ]);

        Log::info('Connexion admin reussie', [
            'user_id' => $user->id,
            'ip'      => $request->ip(),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Bienvenue, ' . $user->name . ' !');
    }

    public function logout(Request $request)
    {
        $userId = session('admin_id');
        Log::info('Deconnexion admin', ['user_id' => $userId, 'ip' => $request->ip()]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Déconnexion réussie.');
    }
}
