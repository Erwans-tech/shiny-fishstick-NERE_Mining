@extends('admin.partials.layout')
@section('title', $news->exists ? 'Modifier l\'article' : 'Nouvel article')
@section('page-title', $news->exists ? 'Modifier l\'article' : 'Nouvel article')

@section('content')
<form method="POST"
      action="{{ $news->exists ? route('admin.news.update', $news) : route('admin.news.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($news->exists) @method('PUT') @endif

    <div class="card">
        <div class="card-header">
            <h2>{{ $news->exists ? 'Modifier : '.$news->title : 'Nouvel article' }}</h2>
            <a href="{{ route('admin.news.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label for="title">Titre *</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $news->title) }}" required>
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="category">Catégorie *</label>
                    <input id="category" type="text" name="category" value="{{ old('category', $news->category) }}" placeholder="Ex : Exploitation, RSE, Communiqué…" required>
                    @error('category')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="published_at">Date de publication</label>
                    <input id="published_at" type="date" name="published_at"
                           value="{{ old('published_at', $news->published_at?->format('Y-m-d')) }}">
                    <span class="form-hint">Laisser vide pour enregistrer en brouillon.</span>
                </div>
                <div class="form-group full">
                    <label for="excerpt">Extrait</label>
                    <textarea id="excerpt" name="excerpt" style="min-height:80px;">{{ old('excerpt', $news->excerpt) }}</textarea>
                </div>
                <div class="form-group full">
                    <label for="content">Contenu</label>
                    <textarea id="content" name="content" style="min-height:220px;">{{ old('content', $news->content) }}</textarea>
                </div>
                <div class="form-group full">
                    <label for="image">Image principale</label>
                    @if($news->image_path)
                    <div style="margin-bottom:10px;">
                        <img src="{{ \App\Helpers\StorageHelper::uploadUrl($news->image_path) }}" style="height:100px;border-radius:6px;object-fit:cover;">
                    </div>
                    @endif
                    <input id="image" type="file" name="image" accept="image/*">
                    <span class="form-hint">PNG, JPG — max 8 Mo. En local, la limite PHP doit être configurée à 8 Mo minimum.</span>
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">
                        {{ $news->exists ? '✓ Enregistrer' : '+ Créer l\'article' }}
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
