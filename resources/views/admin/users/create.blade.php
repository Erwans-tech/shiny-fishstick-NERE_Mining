@extends('admin.partials.layout')

@section('title', 'Nouvel Utilisateur')
@section('page-title', 'Nouvel Utilisateur')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Créer un nouveau compte</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}" class="form-grid">
            @csrf

            <div class="form-group">
                <label for="name">Nom complet *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Ex : Marie Traoré">
                @error('name')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="email">Adresse email *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Ex : marie.traore@nere-mining.bf">
                @error('email')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="password">Mot de passe *</label>
                <input type="password" id="password" name="password" required minlength="8" placeholder="Minimum 8 caractères">
                @error('password')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8">
            </div>

            <div class="form-group full">
                <label for="role">Rôle *</label>
                <select id="role" name="role" required>
                    <option value="">— Choisir un rôle —</option>
                    @foreach($roles as $value => $label)
                        <option value="{{ $value }}" {{ old('role') === $value ? 'selected' : '' }}>
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
                <button type="submit" class="btn btn-primary">✅ Créer l'utilisateur</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
