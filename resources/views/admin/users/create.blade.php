@extends('admin.partials.layout')

@section('title', 'Nouvel Administrateur')
@section('page-title', 'Nouvel Administrateur')

@section('content')
<div class="admin-header">
    <h1>➕ Nouvel Administrateur</h1>
    <div class="admin-actions">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            ← Retour à la liste
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h2>Créer un nouveau compte administrateur</h2>
        <p class="text-muted">Les administrateurs peuvent accéder au panel d'administration et gérer le contenu du site.</p>
    </div>
    
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Nom complet <span class="required">*</span></label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
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
                       value="{{ old('email') }}" 
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
                <label for="password">Mot de passe <span class="required">*</span></label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-control @error('password') error @enderror"
                       required
                       minlength="8"
                       placeholder="Minimum 8 caractères">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                <small class="form-help">Le mot de passe doit contenir au moins 8 caractères</small>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe <span class="required">*</span></label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="form-control"
                       required
                       minlength="8"
                       placeholder="Retapez le mot de passe">
            </div>
        </div>
        
        <div class="form-group">
            <label class="checkbox-label">
                <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" 
                       name="is_admin" 
                       value="1" 
                       {{ old('is_admin', 1) ? 'checked' : '' }}>
                <span class="checkbox-custom"></span>
                Accès administrateur
            </label>
            <small class="form-help">Cochez pour donner les privilèges administrateur à cet utilisateur</small>
            @error('is_admin')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                ✅ Créer l'Administrateur
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