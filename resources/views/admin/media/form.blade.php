@extends('admin.partials.layout')
@section('title', $asset->exists ? 'Modifier le média' : 'Nouveau média')
@section('page-title', $asset->exists ? 'Modifier' : 'Nouveau média')

@section('content')
<form method="POST"
      action="{{ $asset->exists ? route('admin.media.update', $asset) : route('admin.media.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($asset->exists) @method('PUT') @endif
    <div class="card">
        <div class="card-header">
            <h2>{{ $asset->exists ? $asset->title : 'Nouveau média' }}</h2>
            <a href="{{ route('admin.media.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Titre *</label>
                    <input type="text" name="title" value="{{ old('title', $asset->title) }}" required>
                </div>
                <div class="form-group">
                    <label>Type *</label>
                    <select name="type">
                        @foreach(['image' => 'Image', 'video' => 'Vidéo', 'document' => 'Document', 'youtube' => 'YouTube', 'google_drive' => 'Google Drive'] as $value => $label)
                        <option value="{{ $value }}" {{ old('type', $asset->type ?? 'image') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Emplacement *</label>
                    <select name="placement">
                        <option value="gallery" {{ old('placement', $asset->placement ?? 'gallery') === 'gallery' ? 'selected' : '' }}>Médiathèque</option>
                        <option value="homepage_slideshow" {{ old('placement', $asset->placement ?? 'gallery') === 'homepage_slideshow' ? 'selected' : '' }}>Diaporama de l’accueil</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $asset->sort_order ?? 0) }}" min="0">
                </div>
                <div class="form-group full">
                    <label>Légende</label>
                    <textarea name="caption" style="min-height:80px;">{{ old('caption', $asset->caption) }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Lien YouTube ou Google Drive</label>
                    @if($asset->external_url)
                        <div style="margin-bottom:10px;"><a href="{{ $asset->external_url }}" target="_blank" rel="noopener" class="badge badge-green">Lien actuel ↗</a></div>
                    @endif
                    <input type="url" name="external_url" value="{{ old('external_url', $asset->external_url) }}" placeholder="https://www.youtube.com/watch?v=... ou https://drive.google.com/file/d/...">
                    <small style="display:block;margin-top:6px;color:var(--muted);">Obligatoire pour les types YouTube et Google Drive.</small>
                </div>
                <div class="form-group full">
                    <label>Fichier</label>
                    @if($asset->file_path)
                        @if($asset->type === 'image' && $asset->file_path)
                        <img src="{{ $asset->url }}" style="height:100px;border-radius:6px;object-fit:cover;">
                    @else
                        <div style="margin-bottom:10px;"><a href="{{ $asset->url }}" target="_blank" class="badge badge-green">Fichier actuel ↗</a></div>
                    @endif
                    @endif
                    <input type="file" name="file">
                </div>
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               {{ old('is_published', $asset->is_published ?? true) ? 'checked' : '' }}>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">Visible dans la médiathèque</label>
                    </div>
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">{{ $asset->exists ? '✓ Enregistrer' : '+ Ajouter' }}</button>
                    <a href="{{ route('admin.media.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
