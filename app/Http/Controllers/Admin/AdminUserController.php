<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_admin) {
                abort(403, 'Accès interdit - Administrateur requis');
            }
            return $next($request);
        });
    }

    /**
     * Affiche la liste des utilisateurs administrateurs
     */
    public function index()
    {
        $admins = User::admin()->orderBy('created_at', 'desc')->get();
        
        return view('admin.users.index', compact('admins'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel admin
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Enregistre un nouvel administrateur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ], [
            'name.required' => 'Le nom est requis.',
            'name.max' => 'Le nom ne peut dépasser 255 caractères.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $validated['is_admin'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Administrateur créé avec succès : ' . $user->name);
    }

    /**
     * Affiche les détails d'un administrateur
     */
    public function show(User $user)
    {
        // Vérifier que c'est bien un admin
        if (!$user->is_admin) {
            abort(404, 'Administrateur non trouvé');
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Affiche le formulaire d'édition d'un admin
     */
    public function edit(User $user)
    {
        // Vérifier que c'est bien un admin
        if (!$user->is_admin) {
            abort(404, 'Administrateur non trouvé');
        }

        // Empêcher de modifier son propre compte via cette interface
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas modifier votre propre compte via cette interface.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Met à jour un administrateur
     */
    public function update(Request $request, User $user)
    {
        // Vérifier que c'est bien un admin
        if (!$user->is_admin) {
            abort(404, 'Administrateur non trouvé');
        }

        // Empêcher de modifier son propre compte
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas modifier votre propre compte.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ], [
            'name.required' => 'Le nom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_admin' => $validated['is_admin'],
        ];

        // Mettre à jour le mot de passe seulement s'il est fourni
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Administrateur mis à jour avec succès : ' . $user->name);
    }

    /**
     * Supprime un administrateur
     */
    public function destroy(User $user)
    {
        // Vérifier que c'est bien un admin
        if (!$user->is_admin) {
            abort(404, 'Administrateur non trouvé');
        }

        // Empêcher de supprimer son propre compte
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // Vérifier qu'il reste au moins un admin
        $adminCount = User::admin()->count();
        if ($adminCount <= 1) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Impossible de supprimer le dernier administrateur.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Administrateur supprimé avec succès : ' . $userName);
    }

    /**
     * Désactive/Active un administrateur
     */
    public function toggleStatus(User $user)
    {
        if (!$user->is_admin) {
            abort(404, 'Administrateur non trouvé');
        }

        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas modifier votre propre statut.');
        }

        // Logique pour désactiver (on pourrait ajouter un champ 'active' au modèle)
        // Pour l'instant, on change juste le statut admin
        $user->update(['is_admin' => !$user->is_admin]);

        $status = $user->is_admin ? 'activé' : 'désactivé';
        
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Administrateur ' . $status . ' : ' . $user->name);
    }
}