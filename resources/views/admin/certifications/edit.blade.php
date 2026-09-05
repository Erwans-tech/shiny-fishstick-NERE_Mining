@extends('admin.partials.layout')
@section('title', 'Modifier certification')
@section('page-title', 'Modifier certification')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>🏆 Modifier {{ $certification->name }}</h2>
        <a href="{{ route('admin.certifications.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
    </div>

    <form method="POST" action="{{ route('admin.certifications.update', $certification) }}" enctype="multipart/form-data" class="card-body">
        @csrf @method('PUT')

        <div class="form-group">
            <label for="name">Nom de la certification *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $certification->name) }}" required
                   placeholder="Ex: ISO 9001, EITI, ESG"
                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
            @error('name')<span style="color:var(--red); font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Décrire cette certification..."
                      style="width:100%; min-height:100px; padding:10px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif; resize:vertical;">{{ old('description', $certification->description) }}</textarea>
            @error('description')<span style="color:var(--red); font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label for="issued_at">Date d'émission</label>
                <input type="date" name="issued_at" id="issued_at" value="{{ old('issued_at', $certification->issued_at?->format('Y-m-d')) }}"
                       style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                @error('issued_at')<span style="color:var(--red); font-size:12px;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="expires_at">Date d'expiration</label>
                <input type="date" name="expires_at" id="expires_at" value="{{ old('expires_at', $certification->expires_at?->format('Y-m-d')) }}"
                       style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                <small style="color:var(--muted);">Laissez vide si pas d'expiration</small>
                @error('expires_at')<span style="color:var(--red); font-size:12px;">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group">
            <label for="logo">Logo / Image</label>
            @if($certification->logo_path)
                <div style="margin-bottom:12px; display:flex; align-items:center; gap:12px;">
                    <img src="{{ asset('storage/'.$certification->logo_path) }}" alt="{{ $certification->name }}" style="max-height:60px; border-radius:4px;">
                    <span style="font-size:12px; color:var(--muted);">Logo actuel</span>
                </div>
            @endif
            <input type="file" name="logo" id="logo" accept="image/*"
                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
            <small style="color:var(--muted);">PNG, JPG, JPEG (max 2 MB)  - Laissez vide pour garder l'image actuelle</small>
            @error('logo')<span style="color:var(--red); font-size:12px;">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $certification->is_active) ? 'checked' : '' }}>
                Actif
            </label>
        </div>

        <div style="display:flex; gap:12px; margin-top:20px;">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.certifications.index') }}" class="btn btn-ghost">Annuler</a>
        </div>
    </form>
</div>
@endsection
