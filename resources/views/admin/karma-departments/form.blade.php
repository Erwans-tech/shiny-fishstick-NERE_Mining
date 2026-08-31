@extends('admin.partials.layout')
@section('title', $department->exists ? 'Modifier le département' : 'Nouveau département')
@section('page-title', $department->exists ? 'Modifier le département' : 'Nouveau département')

@section('content')
<form method="POST"
      action="{{ $department->exists ? route('admin.karma-departments.update', $department) : route('admin.karma-departments.store') }}">
    @csrf
    @if($department->exists) @method('PUT') @endif
    <div class="card">
        <div class="card-header">
            <h2>{{ $department->exists ? $department->title_fr : 'Nouveau département' }}</h2>
            <a href="{{ route('admin.karma-departments.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Titre FR *</label>
                    <input type="text" name="title_fr" value="{{ old('title_fr', $department->title_fr) }}" required>
                </div>
                <div class="form-group">
                    <label>Titre EN *</label>
                    <input type="text" name="title_en" value="{{ old('title_en', $department->title_en) }}" required>
                </div>
                <div class="form-group">
                    <label>Tag FR *</label>
                    <input type="text" name="tag_fr" value="{{ old('tag_fr', $department->tag_fr) }}" required>
                </div>
                <div class="form-group">
                    <label>Tag EN *</label>
                    <input type="text" name="tag_en" value="{{ old('tag_en', $department->tag_en) }}" required>
                </div>
                <div class="form-group full">
                    <label>Description FR *</label>
                    <textarea name="body_fr" rows="5" required>{{ old('body_fr', $department->body_fr) }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Description EN *</label>
                    <textarea name="body_en" rows="5" required>{{ old('body_en', $department->body_en) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $department->sort_order ?? 0) }}" min="0">
                </div>
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               {{ old('is_published', $department->is_published ?? true) ? 'checked' : '' }}>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">Visible sur la page Karma</label>
                    </div>
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">{{ $department->exists ? '✓ Enregistrer' : '+ Ajouter' }}</button>
                    <a href="{{ route('admin.karma-departments.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
