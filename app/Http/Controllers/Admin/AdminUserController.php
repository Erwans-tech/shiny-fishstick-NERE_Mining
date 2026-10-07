<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs administrateurs
     */
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'hr', 'site_manager'])
            ->orderBy('role', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel admin
     */
    public function create()
    {
        $roles = [
            'admin' => 'Administrateur',
            'hr' => 'RH',
            'site_manager' => 'Gérant du site',
        ];

        return view('admin.users.create', compact('roles'));
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
            'role' => 'required|in:admin,hr,site_manager',
        ], [
            'name.required' => 'Le nom est requis.',
            'name.max' => 'Le nom ne peut dépasser 255 caractères.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'L\'email doit être valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'role.required' => 'Le rôle est requis.',
            'role.in' => 'Le rôle sélectionné est invalide.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès : ' . $user->name);
    }

    /**
     * Affiche les détails d'un administrateur
     */
    public function show(User $user)
    {
        // Vérifier que c'est bien un utilisateur admin/RH/Gérant
        if (!in_array($user->role, ['admin', 'hr', 'site_manager'])) {
            abort(404, 'Utilisateur non trouvé');
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Affiche le formulaire d'édition d'un admin
     */
    public function edit(User $user)
    {
        // Vérifier que c'est bien un utilisateur admin
        if (!in_array($user->role, ['admin', 'hr', 'site_manager'])) {
            abort(404, 'Utilisateur non trouvé');
        }

        // Empêcher de modifier son propre compte via cette interface
        if ((int) $user->id === (int) session('admin_id')) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas modifier votre propre compte via cette interface.');
        }

        $roles = [
            'admin' => 'Administrateur',
            'hr' => 'RH',
            'site_manager' => 'Gérant du site',
        ];

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Met à jour un administrateur
     */
    public function update(Request $request, User $user)
    {
        // Vérifier que c'est bien un utilisateur admin
        if (!in_array($user->role, ['admin', 'hr', 'site_manager'])) {
            abort(404, 'Utilisateur non trouvé');
        }

        // Empêcher de modifier son propre compte
        if ((int) $user->id === (int) session('admin_id')) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas modifier votre propre compte.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,hr,site_manager',
        ], [
            'name.required' => 'Le nom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'role.required' => 'Le rôle est requis.',
            'role.in' => 'Le rôle sélectionné est invalide.',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        // Mettre à jour le mot de passe seulement s'il est fourni
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour avec succès : ' . $user->name);
    }

    /**
     * Supprime un administrateur
     */
    public function destroy(User $user)
    {
        // Vérifier que c'est bien un utilisateur admin
        if (!in_array($user->role, ['admin', 'hr', 'site_manager'])) {
            abort(404, 'Utilisateur non trouvé');
        }

        // Empêcher de supprimer son propre compte
        if ((int) $user->id === (int) session('admin_id')) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // Vérifier qu'il reste au moins un admin
        $adminCount = User::where('role', 'admin')->count();
        if ($adminCount <= 1) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Impossible de supprimer le dernier administrateur.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé avec succès : ' . $userName);
    }
}
