@extends('admin.partials.layout')
@section('title', $member->exists ? 'Modifier le membre' : 'Nouveau membre')
@section('page-title', $member->exists ? 'Modifier le membre' : 'Nouveau membre')

@section('content')
<form method="POST" action="{{ $member->exists ? route('admin.leadership.update', $member) : route('admin.leadership.store') }}" enctype="multipart/form-data">
    @csrf
    @if($member->exists) @method('PUT') @endif
    <div class="card">
        <div class="card-header">
            <h2>{{ $member->exists ? $member->name : 'Nouveau membre' }}</h2>
            <a href="{{ route('admin.leadership.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nom complet *</label>
                    <input type="text" name="name" value="{{ old('name', $member->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Fonction *</label>
                    <input type="text" name="title" value="{{ old('title', $member->title) }}" placeholder="Directeur Général" required>
                </div>
                <div class="form-group">
                    <label>Département</label>
                    <input type="text" name="department" value="{{ old('department', $member->department) }}" placeholder="Direction générale, Opérations...">
                </div>
                <div class="form-group">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" min="0">
                </div>
                <div class="form-group full">
                    <label>Photo</label>
                    @if($member->photo_path)
                    <div style="margin-bottom:10px;"><img src="{{ \App\Helpers\StorageHelper::uploadUrl($member->photo_path) }}" style="width:88px;height:88px;border-radius:50%;object-fit:cover;"></div>
                    @endif
                    <input type="file" name="photo" accept="image/*">
                    <span class="form-hint">JPG, PNG ou WebP — max 4 Mo.</span>
                </div>
                <div class="form-group full">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $member->is_published ?? true) ? 'checked' : '' }}>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">Visible sur le site</label>
                    </div>
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">{{ $member->exists ? 'Enregistrer' : 'Ajouter' }}</button>
                    <a href="{{ route('admin.leadership.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
