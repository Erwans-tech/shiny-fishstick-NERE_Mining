@extends('admin.partials.layout')
@section('title', $video->exists ? 'Modifier la vidéo' : 'Nouvelle vidéo')
@section('page-title', $video->exists ? 'Modifier la vidéo' : 'Nouvelle vidéo')

@section('content')
<form method="POST"
      action="{{ $video->exists ? route('admin.videos.update', $video) : route('admin.videos.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($video->exists) @method('PUT') @endif
    <div class="card">
        <div class="card-header">
            <h2>{{ $video->exists ? $video->title : 'Nouvelle vidéo' }}</h2>
            <a href="{{ route('admin.videos.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label for="title">Titre *</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $video->title) }}" required>
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label for="title_en">Titre en anglais</label>
                    <input id="title_en" type="text" name="title_en" value="{{ old('title_en', $video->title_en) }}">
                    <span class="form-hint">Affiché sur la version anglaise du site. Sinon, le titre français est utilisé.</span>
                </div>
                <div class="form-group">
                    <label for="video_date">Date de la vidéo *</label>
                    <input id="video_date" type="date" name="video_date" value="{{ old('video_date', $video->video_date?->format('Y-m-d')) }}" required>
                    <span class="form-hint">Les vidéos sont affichées de la plus récente à la plus ancienne.</span>
                    @error('video_date')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               {{ old('is_published', $video->is_published ?? true) ? 'checked' : '' }}>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">Visible sur le site</label>
                    </div>
                </div>
                <div class="form-group full">
                    <label for="video">Fichier vidéo {{ $video->exists ? '' : '*' }}</label>
                    @if($video->exists)
                    <video src="{{ $video->videoUrl() }}" controls preload="metadata" @if($video->posterUrl()) poster="{{ $video->posterUrl() }}" @endif
                           style="display:block;width:360px;max-width:100%;border-radius:6px;margin-bottom:8px;"></video>
                    <span class="form-hint" style="display:block;margin-bottom:8px;">Choisir un nouveau fichier remplacera la vidéo actuelle.</span>
                    @endif
                    <input id="video" type="file" name="video" accept="video/mp4,video/webm" {{ $video->exists ? '' : 'required' }}>
                    <span class="form-hint">MP4 ou WebM, 512 Mo maximum. Une vidéo comprimée en 1080p (30 à 50 Mo) se charge bien plus vite pour les visiteurs.</span>
                    @error('video')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group full">
                    <label for="poster">Image d'aperçu</label>
                    @if($video->posterUrl())
                    <img src="{{ $video->posterUrl() }}" alt="" style="display:block;height:100px;border-radius:6px;object-fit:cover;margin-bottom:8px;">
                    @endif
                    <input id="poster" type="file" name="poster" accept="image/*">
                    <span class="form-hint">Affichée avant la lecture. JPG ou PNG, 4 Mo maximum, format 16:9 de préférence.</span>
                    @error('poster')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">{{ $video->exists ? '✓ Enregistrer' : '+ Ajouter la vidéo' }}</button>
                    <a href="{{ route('admin.videos.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
