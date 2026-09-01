@extends('admin.partials.layout')

@section('title', 'Modifier Administrateur')
@section('page-title', 'Modifier Administrateur')

@section('content')
<div class="admin-header">
    <h1>✏️ Modifier Administrateur</h1>
    <div class="admin-actions">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            ← Retour à la liste
        </a>
        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary">
            👁️ Voir les détails
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h2>Modifier : {{ $user->name }}</h2>
        <p class="text-muted">Modifiez les informations de cet administrateur.</p>
    </div>
    
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Nom complet <span class="required">*</span></label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       class="form-control @error('name') error @enderror"
                       required
                       placeholder="Ex: Jean Dupont">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Adresse email <span class="required">*</span></label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       class="form-control @error('email') error @enderror"
                       required
                       placeholder="Ex: jean.dupont@nere-mining.com">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-control @error('password') error @enderror"
                       minlength="8"
                       placeholder="Laissez vide pour conserver l'actuel">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <small class="form-help">Laissez vide pour conserver le mot de passe actuel</small>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="form-control"
                       minlength="8"
                       placeholder="Retapez le nouveau mot de passe">
            </div>
        </div>
        
        <div class="form-group">
            <label class="checkbox-label">
                <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" 
                       name="is_admin" 
                       value="1" 
                       {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                <span class="checkbox-custom"></span>
                Accès administrateur
            </label>
            <small class="form-help">Décochez pour retirer les privilèges administrateur</small>
            @error('is_admin')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="user-meta">
            <div class="meta-item">
                <strong>Créé le :</strong> {{ $user->created_at->format('d/m/Y à H:i') }}
            </div>
            <div class="meta-item">
                <strong>Dernière modification :</strong> {{ $user->updated_at->format('d/m/Y à H:i') }}
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                💾 Sauvegarder les modifications
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                Annuler
            </a>
        </div>
    </form>
</div>

<style>
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: var(--ink);
}

.required {
    color: var(--red);
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--line);
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.15s;
}

.form-control:focus {
    outline: none;
    border-color: var(--green);
    box-shadow: 0 0 0 3px rgba(75, 23, 22, 0.1);
}

.form-control.error {
    border-color: var(--red);
}

.error-message {
    color: var(--red);
    font-size: 13px;
    margin-top: 4px;
}

.form-help {
    color: var(--muted);
    font-size: 12px;
    margin-top: 4px;
    display: block;
}

.checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: normal;
}

.checkbox-label input[type="checkbox"] {
    margin-right: 8px;
}

.user-meta {
    background: var(--sand);
    padding: 16px;
    border-radius: 6px;
    margin: 20px 0;
    border: 1px solid var(--line);
}

.meta-item {
    margin-bottom: 8px;
    font-size: 13px;
    color: var(--muted);
}

.meta-item:last-child {
    margin-bottom: 0;
}

.form-actions {
    display: flex;
    gap: 12px;
    padding-top: 20px;
    border-top: 1px solid var(--line);
    margin-top: 30px;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>
@endsection