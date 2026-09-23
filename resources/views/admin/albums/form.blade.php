@extends('admin.partials.layout')
@section('title', $album->exists ? 'Modifier l\'album' : 'Nouvel album')
@section('page-title', $album->exists ? 'Modifier l\'album' : 'Nouvel album')

@section('content')
<form method="POST"
      action="{{ $album->exists ? route('admin.albums.update', $album) : route('admin.albums.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($album->exists) @method('PUT') @endif
    
    <div class="card">
        <div class="card-header">
            <h2>{{ $album->exists ? $album->title : 'Nouvel album' }}</h2>
            <a href="{{ route('admin.albums.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Titre de l'album *</label>
                    <input type="text" name="title" value="{{ old('title', $album->title) }}" required 
                           placeholder="Ex: Visite du Ministre - Février 2026">
                    @error('title')
                        <small style="color:var(--red);display:block;margin-top:6px;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description" rows="4" 
                              placeholder="Décrivez le contexte de cet album photo...">{{ old('description', $album->description) }}</textarea>
                    @error('description')
                        <small style="color:var(--red);display:block;margin-top:6px;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group full">
                    <label>Image de couverture</label>
                    @if($album->exists && $album->cover_image)
                        <div style="margin-bottom:12px;">
                            <img src="{{ $album->cover_url }}" alt="Couverture" 
                                 style="height:120px;border-radius:8px;object-fit:cover;border:2px solid var(--line);">
                            <small style="display:block;margin-top:6px;color:var(--muted);">Image actuelle</small>
                        </div>
                    @endif
                    <input type="file" name="cover_image_file" accept="image/jpeg,image/png,image/webp">
                    <small style="display:block;margin-top:6px;color:var(--muted);">
                        Si non fournie, la première photo de l'album sera utilisée. Formats: JPG, PNG, WebP (max 5MB)
                    </small>
                    @error('cover_image_file')
                        <small style="color:var(--red);display:block;margin-top:6px;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $album->sort_order ?? 0) }}" min="0">
                    <small style="display:block;margin-top:6px;color:var(--muted);">
                        Les albums sont affichés du plus petit au plus grand numéro
                    </small>
                    @error('sort_order')
                        <small style="color:var(--red);display:block;margin-top:6px;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               {{ old('is_published', $album->is_published ?? true) ? 'checked' : '' }}>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">
                            Publier sur le site
                        </label>
                    </div>
                    <small style="display:block;margin-top:6px;color:var(--muted);">
                        Décochez pour garder l'album en brouillon
                    </small>
                </div>

                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">
                        {{ $album->exists ? '✓ Enregistrer' : '+ Créer l\'album' }}
                    </button>
                    <a href="{{ route('admin.albums.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>

    @if($album->exists)
    <div class="card" style="margin-top:24px;background:var(--sand);">
        <div class="card-body">
            <h3 style="margin-bottom:12px;font-size:16px;">📸 Ajouter des photos à cet album</h3>
            <p style="margin-bottom:12px;color:var(--muted);">
                Pour ajouter des photos à cet album, allez dans <strong>Médiathèque</strong> et sélectionnez l'album 
                lors de l'ajout ou modification d'un média.
            </p>
            <a href="{{ route('admin.media.create') }}" class="btn btn-primary">+ Ajouter une photo</a>
            @if($album->media_count > 0)
                <a href="{{ route('admin.albums.show', $album) }}" class="btn btn-ghost">
                    👁️ Voir les {{ $album->media_count }} photos
                </a>
            @endif
        </div>
    </div>
    @endif
</form>
@endsection
