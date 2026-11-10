@extends('admin.partials.layout')

@section('title', 'Modifier — ' . $user->name)
@section('page-title', 'Modifier un utilisateur')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Modifier : {{ $user->name }}</h2>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-ghost btn-sm">👁️ Voir</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="form-grid">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom complet *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="email">Adresse email *</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" minlength="8" placeholder="Laisser vide pour conserver l'actuel">
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
                <span class="form-hint">Laisser vide pour conserver le mot de passe actuel.</span>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" minlength="8">
            </div>

            <div class="form-group full">
                <label for="role">Rôle *</label>
                <select id="role" name="role" required>
                    @foreach($roles as $value => $label)
                        <option value="{{ $value }}" {{ old('role', $user->role) === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <span class="form-hint">
                    <strong>Administrateur</strong> — accès complet. 
                    <strong>RH</strong> — candidatures, messages, newsletter et offres d'emploi. 
                    <strong>Gérant du site</strong> — contenu éditorial et configuration publique.
                </span>
                @error('role')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-actions full">
                <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">Annuler</a>
            </div>
        </form>

        <div style="margin-top:24px;padding-top:16px;border-top:1px solid var(--line);font:12px Inter,sans-serif;color:var(--muted);">
            Créé le {{ $user->created_at->format('d/m/Y à H:i') }} · Modifié le {{ $user->updated_at->format('d/m/Y à H:i') }}
        </div>
    </div>
</div>
@endsection
