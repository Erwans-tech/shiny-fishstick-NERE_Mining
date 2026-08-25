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
                        @foreach(['image','video','document'] as $t)
                        <option value="{{ $t }}" {{ old('type', $asset->type ?? 'image') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
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
                    <label>Fichier</label>
                    @if($asset->file_path)
                        @if($asset->type === 'image' && $asset->file_path)
                        <img src="{{ asset('uploads/'.$asset->file_path) }}" style="height:100px;border-radius:6px;object-fit:cover;">
                    @else
                        <div style="margin-bottom:10px;"><a href="{{ asset('uploads/'.$asset->file_path) }}" target="_blank" class="badge badge-green">Fichier actuel ↗</a></div>
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
