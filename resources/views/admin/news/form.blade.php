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
                    <span class="form-hint">PNG, JPG  - max 8 Mo. En local, la limite PHP doit être configurée à 8 Mo minimum.</span>

                    {{-- Recadrage (amélioration progressive : sans JS, l'upload classique reste inchangé) --}}
                    <div id="image-cropper" class="news-cropper" hidden>
                        <span class="form-hint">Déplacez et redimensionnez le cadre pour choisir la partie visible dans les cartes d'actualité (format 16:10). Molette ou pincement pour zoomer. Tant que le recadrage n'est pas validé, c'est l'image originale qui sera envoyée.</span>
                        <div class="news-cropper-stage">
                            <img id="image-cropper-source" alt="Image à recadrer">
                        </div>
                        <div class="news-cropper-actions">
                            <button type="button" class="btn btn-ghost btn-sm" data-crop-action="zoom-in" aria-label="Zoomer">+ Zoom</button>
                            <button type="button" class="btn btn-ghost btn-sm" data-crop-action="zoom-out" aria-label="Dézoomer">− Zoom</button>
                            <button type="button" class="btn btn-ghost btn-sm" data-crop-action="reset">Réinitialiser</button>
                            <span class="news-cropper-spacer"></span>
                            <button type="button" class="btn btn-ghost btn-sm" data-crop-action="keep">Garder l'original</button>
                            <button type="button" class="btn btn-primary btn-sm" data-crop-action="apply">✓ Valider le recadrage</button>
                        </div>
                    </div>
                    <div id="image-crop-result" class="news-crop-result" hidden>
                        <img id="image-crop-preview" alt="Aperçu de l'image envoyée">
                        <div>
                            <span class="form-hint" id="image-crop-status" aria-live="polite"></span>
                            <button type="button" class="btn btn-ghost btn-sm" data-crop-action="edit">Modifier le recadrage</button>
                        </div>
                    </div>
                </div>
                <div class="form-group full">
                    <label for="gallery_images">Images dans l'article</label>
                    @if($news->gallery_images)
                    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:10px;">
                        @foreach($news->gallery_images as $galleryImage)
                            <img src="{{ \App\Helpers\StorageHelper::uploadUrl($galleryImage) }}" alt="" style="width:110px;height:75px;border-radius:6px;object-fit:cover;">
                        @endforeach
                    </div>
                    <span class="form-hint" style="display:block;margin-bottom:8px;">Sélectionner de nouvelles images remplacera la galerie actuelle.</span>
                    @endif
                    <input id="gallery_images" type="file" name="gallery_images[]" accept="image/*" multiple>
                    <span class="form-hint">Jusqu'à 12 images, PNG ou JPG, 4 Mo maximum par image.</span>
                    @error('gallery_images')<div class="form-error">{{ $message }}</div>@enderror
                    @error('gallery_images.*')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group full">
                    <label for="video">Vidéo de l'article</label>
                    @if($news->video_path)
                    <video src="{{ \App\Helpers\StorageHelper::uploadUrl($news->video_path) }}" controls preload="metadata" style="display:block;width:320px;max-width:100%;border-radius:6px;margin-bottom:8px;"></video>
                    <label style="display:flex;gap:8px;align-items:center;font-weight:400;margin-bottom:8px;">
                        <input type="checkbox" name="remove_video" value="1"> Supprimer la vidéo actuelle
                    </label>
                    @endif
                    <input id="video" type="file" name="video" accept="video/mp4,video/webm">
                    <span class="form-hint">MP4 ou WebM, 200 Mo maximum. Comprimez la vidéo en 1080p avant l'envoi pour un chargement rapide.</span>
                    @error('video')<div class="form-error">{{ $message }}</div>@enderror
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

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/cropperjs/cropper.min.css') }}">
<style>
    .news-cropper { margin-top: 12px; padding: 14px; border: 1px solid var(--line); border-radius: 10px; background: var(--light); display: flex; flex-direction: column; gap: 10px; }
    .news-cropper[hidden], .news-crop-result[hidden] { display: none; }
    .news-cropper-stage { width: 100%; height: min(60vh, 460px); background: #2a211d; border-radius: 6px; overflow: hidden; }
    .news-cropper-stage img { display: block; max-width: 100%; }
    .news-cropper-actions { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; }
    .news-cropper-spacer { flex: 1; }
    .news-crop-result { margin-top: 12px; display: flex; flex-wrap: wrap; gap: 14px; align-items: center; }
    .news-crop-result img { width: 240px; max-width: 100%; aspect-ratio: 16 / 10; object-fit: cover; border-radius: 8px; border: 1px solid var(--line); }
    .news-crop-result > div { display: flex; flex-direction: column; align-items: flex-start; gap: 8px; }
</style>
@endpush

@push('scripts')
<script src="{{ asset('vendor/cropperjs/cropper.min.js') }}"></script>
<script>
(function () {
    'use strict';

    // Format des cartes d'actualité de /actualites : largeur de colonne ≈ 350 px
    // pour une hauteur d'image fixe de 220 px (object-fit: cover) → 16:10.
    var ASPECT = 16 / 10;
    var MAX_W = 1600, MAX_H = 1000, QUALITY = 0.9;
    var CROPPABLE = /^image\/(jpeg|png|webp|gif|bmp)$/;

    var input = document.getElementById('image');
    var panel = document.getElementById('image-cropper');
    var source = document.getElementById('image-cropper-source');
    var result = document.getElementById('image-crop-result');
    var preview = document.getElementById('image-crop-preview');
    var status = document.getElementById('image-crop-status');

    // Sans Cropper.js, DataTransfer ou canvas.toBlob : l'upload classique reste en place.
    if (!input || !panel || typeof window.Cropper !== 'function' || typeof window.DataTransfer !== 'function'
        || !HTMLCanvasElement.prototype.toBlob) {
        return;
    }
    try { new DataTransfer(); } catch (e) { return; }

    var cropper = null;
    var originalFile = null;

    // URLs data: (et non blob:) : la CSP du site autorise img-src 'self' data: https:.
    function readAsDataUrl(blob, done) {
        var reader = new FileReader();
        reader.onload = function () { done(reader.result); };
        reader.readAsDataURL(blob);
    }

    function setInputFile(file) {
        var dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
    }

    function formatSize(bytes) {
        return bytes >= 1048576 ? (bytes / 1048576).toFixed(1).replace('.', ',') + ' Mo' : Math.round(bytes / 1024) + ' Ko';
    }

    function destroyCropper() {
        if (cropper) { cropper.destroy(); cropper = null; }
        panel.hidden = true;
    }

    function showPreview(blob, text) {
        status.textContent = text;
        result.hidden = false;
        readAsDataUrl(blob, function (url) { preview.src = url; });
    }

    function openCropper() {
        var file = originalFile;
        // Remettre l'input sur le fichier original afin que si l'utilisateur
        // soumet sans revalider le recadrage, c'est bien l'original qui part.
        setInputFile(originalFile);
        destroyCropper();
        result.hidden = true;
        readAsDataUrl(file, function (url) {
            if (file !== originalFile) return; // une autre image a été choisie entre-temps
            panel.hidden = false;
            source.src = url;
            cropper = new Cropper(source, {
                aspectRatio: ASPECT,
                viewMode: 1,
                autoCropArea: 1,
                dragMode: 'move',
                responsive: true,
                checkCrossOrigin: false,
                checkOrientation: true,
            });
            panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
    }

    function keepOriginal() {
        setInputFile(originalFile);
        destroyCropper();
        showPreview(originalFile, 'Image originale conservée (' + formatSize(originalFile.size) + '). Les cartes l\'afficheront centrée.');
    }

    function applyCrop() {
        if (!cropper) return;
        var canvas = cropper.getCroppedCanvas({
            maxWidth: MAX_W,
            maxHeight: MAX_H,
            fillColor: '#fff',            // fond blanc pour les PNG transparents (sortie JPEG)
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });
        if (!canvas) { keepOriginal(); return; }
        canvas.toBlob(function (blob) {
            if (!blob) {
                keepOriginal();
                status.textContent = 'Le recadrage a échoué : l\'image originale sera envoyée.';
                return;
            }
            var baseName = (originalFile.name || 'image').replace(/\.[^.]+$/, '');
            var file = new File([blob], baseName + '-recadre.jpg', { type: 'image/jpeg', lastModified: Date.now() });
            setInputFile(file);
            destroyCropper();
            showPreview(file, 'Image recadrée prête à être envoyée : ' + canvas.width + ' × ' + canvas.height + ' px, ' + formatSize(file.size) + '.');
        }, 'image/jpeg', QUALITY);
    }

    input.addEventListener('change', function () {
        var file = input.files && input.files[0];
        destroyCropper();
        result.hidden = true;
        originalFile = null;
        if (!file || !CROPPABLE.test(file.type)) return;
        originalFile = file;
        openCropper();
    });

    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-crop-action]');
        if (!btn) return;
        var action = btn.getAttribute('data-crop-action');
        if (action === 'edit' && originalFile) { openCropper(); return; }
        if (!cropper) return;
        if (action === 'zoom-in') cropper.zoom(0.1);
        else if (action === 'zoom-out') cropper.zoom(-0.1);
        else if (action === 'reset') cropper.reset();
        else if (action === 'keep') keepOriginal();
        else if (action === 'apply') applyCrop();
    });
})();
</script>
@endpush
