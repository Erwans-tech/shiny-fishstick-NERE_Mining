@extends('admin.partials.layout')
@section('title', $slide->exists ? 'Modifier la slide' : 'Nouvelle slide')
@section('page-title', $slide->exists ? 'Modifier la slide' : 'Ajouter une slide au carrousel')

@section('content')

@php $currentType = old('type', $slide->type ?? 'image'); @endphp

<form method="POST"
      action="{{ $slide->exists ? route('admin.hero.update', $slide) : route('admin.hero.store') }}"
      enctype="multipart/form-data"
      id="hero-form">
    @csrf
    @if($slide->exists) @method('PUT') @endif

    <div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

        {{-- ── Colonne gauche — champs ──────────────────────────────── --}}
        <div>

            {{-- Sélecteur type image / vidéo --}}
            <div class="card" style="margin-bottom:16px;">
                <div class="card-header">
                    <h2>Type de slide</h2>
                    <a href="{{ route('admin.hero.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
                </div>
                <div class="card-body">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">

                        <label id="tab-image"
                               style="display:flex; align-items:center; gap:14px; padding:18px 20px; border:2px solid {{ $currentType === 'image' ? 'var(--gold)' : 'var(--line)' }}; border-radius:10px; cursor:pointer; background:{{ $currentType === 'image' ? 'var(--sand)' : '#fff' }}; transition:all .2s;"
                               onclick="setType('image')">
                            <input type="radio" name="type" value="image"
                                   {{ $currentType === 'image' ? 'checked' : '' }}
                                   style="display:none;" id="type-image">
                            <span style="font-size:28px;">🖼️</span>
                            <div>
                                <div style="font:600 14px Inter,sans-serif; color:var(--green);">Image</div>
                                <div style="font:12px Inter,sans-serif; color:var(--muted);">JPG, PNG, WebP, GIF</div>
                            </div>
                        </label>

                        <label id="tab-video"
                               style="display:flex; align-items:center; gap:14px; padding:18px 20px; border:2px solid {{ $currentType === 'video' ? 'var(--gold)' : 'var(--line)' }}; border-radius:10px; cursor:pointer; background:{{ $currentType === 'video' ? 'var(--sand)' : '#fff' }}; transition:all .2s;"
                               onclick="setType('video')">
                            <input type="radio" name="type" value="video"
                                   {{ $currentType === 'video' ? 'checked' : '' }}
                                   style="display:none;" id="type-video">
                            <span style="font-size:28px;">🎬</span>
                            <div>
                                <div style="font:600 14px Inter,sans-serif; color:var(--green);">Vidéo</div>
                                <div style="font:12px Inter,sans-serif; color:var(--muted);">YouTube, Vimeo ou MP4</div>
                            </div>
                        </label>

                    </div>
                </div>
            </div>

            {{-- Champs communs --}}
            <div class="card" style="margin-bottom:16px;">
                <div class="card-header"><h2>Informations générales</h2></div>
                <div class="card-body">
                    <div class="form-grid">

                        <div class="form-group full">
                            <label for="title">Titre (usage interne)</label>
                            <input id="title" type="text" name="title"
                                   value="{{ old('title', $slide->title) }}"
                                   placeholder="Ex : Panorama Karma — Août 2025">
                            <span class="form-hint">Visible uniquement dans l'admin, pas sur le site.</span>
                            @error('title')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group full">
                            <label for="caption">Légende <span style="font-weight:400; text-transform:none; letter-spacing:0;">(optionnelle — affichée sur le héro)</span></label>
                            <input id="caption" type="text" name="caption"
                                   value="{{ old('caption', $slide->caption) }}"
                                   placeholder="Ex : La mine de Karma vue du ciel"
                                   maxlength="255">
                            @error('caption')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Position</label>
                            <input id="sort_order" type="number" name="sort_order" min="0" max="99"
                                   value="{{ old('sort_order', $slide->sort_order ?? 0) }}">
                            <span class="form-hint">0 = première position.</span>
                        </div>

                        <div class="form-group" style="align-self:end;">
                            <div class="toggle-wrap" style="height:42px;">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $slide->is_active ?? true) ? 'checked' : '' }}>
                                <label for="is_active" style="text-transform:none; letter-spacing:0; font-size:14px; font-weight:500; color:var(--ink);">
                                    Slide visible sur le site
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Bloc IMAGE ──────────────────────────────────────────── --}}
            <div id="block-image" class="card" style="{{ $currentType !== 'image' ? 'display:none;' : '' }}">
                <div class="card-header"><h2>🖼️ Image</h2></div>
                <div class="card-body">

                    @if($slide->exists && $slide->image_path && $slide->isImage())
                    <div style="margin-bottom:14px;">
                        <img src="{{ $slide->url }}"
                             style="height:140px; border-radius:8px; object-fit:cover; border:1px solid var(--line);"
                             alt="Image actuelle">
                        <div style="font:600 10px Inter,sans-serif; letter-spacing:.1em; color:var(--muted); margin-top:6px; text-transform:uppercase;">
                            Image actuelle
                        </div>
                    </div>
                    @endif

                    <div id="image-drop-zone"
                         style="border:2px dashed var(--line); border-radius:10px; padding:28px 20px; text-align:center; cursor:pointer; transition:border-color .2s, background .2s;"
                         onclick="document.getElementById('image-input').click()"
                         ondragover="event.preventDefault(); this.style.borderColor='var(--gold)'; this.style.background='var(--sand)';"
                         ondragleave="this.style.borderColor='var(--line)'; this.style.background='';"
                         ondrop="handleDrop(event,'image-input','image-preview-wrap','image-drop-text')">
                        <div style="font-size:28px; margin-bottom:8px;">📷</div>
                        <div id="image-drop-text" style="font:500 14px Inter,sans-serif; color:var(--muted);">
                            Cliquez ou glissez une image ici
                        </div>
                        <div style="font:12px Inter,sans-serif; color:var(--muted); margin-top:5px;">
                            JPG · PNG · WebP · GIF — max 10 Mo — recommandé : 1920×1080 px
                        </div>
                    </div>
                    <input type="file" id="image-input" name="image" data-conditional-field="image"
                           accept="image/jpeg,image/png,image/webp,image/gif"
                           style="display:none;"
                           onchange="previewFile(this,'image-preview-wrap','image-drop-text','image-drop-zone')">

                    <div id="image-preview-wrap" style="display:none; margin-top:12px;">
                        <img id="image-preview"
                             style="height:140px; max-width:100%; border-radius:8px; object-fit:cover; border:2px solid var(--gold);"
                             alt="Aperçu">
                        <div style="font:600 11px Inter,sans-serif; color:var(--gold2); margin-top:5px; text-transform:uppercase; letter-spacing:.08em;">
                            ✓ Nouvelle image sélectionnée
                        </div>
                    </div>

                    @error('image')<div class="form-error" style="margin-top:8px;">{{ $message }}</div>@enderror
                </div>
            </div>

            {{-- Bloc VIDÉO ──────────────────────────────────────────── --}}
            <div id="block-video" class="card" style="{{ $currentType !== 'video' ? 'display:none;' : '' }}">
                <div class="card-header"><h2>🎬 Vidéo</h2></div>
                <div class="card-body">
                    <div class="form-grid">

                        {{-- URL YouTube / Vimeo --}}
                        <div class="form-group full">
                            <label for="video_url">URL de la vidéo *</label>
                            <input id="video_url" type="text" name="video_url" data-conditional-field="video_url"
                                   value="{{ old('video_url', $slide->video_url) }}"
                                   placeholder="https://www.youtube.com/watch?v=…  ou  https://vimeo.com/…">
                            <span class="form-hint">
                                Formats acceptés : lien YouTube (<code>youtu.be/…</code>, <code>youtube.com/watch?v=…</code>)
                                ou Vimeo (<code>vimeo.com/…</code>).
                                La vidéo sera intégrée en lecture automatique, muette, en boucle.
                            </span>
                            @error('video_url')<div class="form-error">{{ $message }}</div>@enderror
                        </div>

                        {{-- Aperçu vidéo --}}
                        <div class="form-group full" id="video-preview-container"
                             style="{{ old('video_url', $slide->video_url) ? '' : 'display:none;' }}">
                            <label>Aperçu</label>
                            <div style="position:relative; padding-bottom:35%; border-radius:8px; overflow:hidden; background:#000; border:1px solid var(--line);">
                                <iframe id="video-preview-frame"
                                        style="position:absolute; inset:0; width:100%; height:100%; border:0;"
                                        src="{{ $slide->embed_url ?? '' }}"
                                        allow="autoplay; encrypted-media"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        </div>

                        {{-- Image de couverture pour les vidéos --}}
                        <div class="form-group full">
                            <label>Image de couverture <span style="font-weight:400; text-transform:none; letter-spacing:0;">(optionnelle — affichée si la vidéo ne charge pas)</span></label>

                            @if($slide->exists && $slide->image_path && $slide->isVideo())
                            <div style="margin-bottom:10px;">
                                <img src="{{ $slide->url }}"
                                     style="height:100px; border-radius:6px; object-fit:cover; border:1px solid var(--line);"
                                     alt="Couverture actuelle">
                            </div>
                            @endif

                            <div id="cover-drop-zone"
                                 style="border:2px dashed var(--line); border-radius:8px; padding:20px; text-align:center; cursor:pointer; transition:border-color .2s;"
                                 onclick="document.getElementById('cover-input').click()"
                                 ondragover="event.preventDefault(); this.style.borderColor='var(--gold)';"
                                 ondragleave="this.style.borderColor='var(--line)';"
                                 ondrop="handleDrop(event,'cover-input','cover-preview-wrap','cover-drop-text')">
                                <div style="font-size:20px; margin-bottom:6px;">🎞️</div>
                                <div id="cover-drop-text" style="font:500 13px Inter,sans-serif; color:var(--muted);">
                                    Cliquez ou glissez une image de couverture (optionnel)
                                </div>
                            </div>
                            <input type="file" id="cover-input" name="cover_image" data-conditional-field="cover_image"
                                   accept="image/jpeg,image/png,image/webp"
                                   style="display:none;"
                                   onchange="previewFile(this,'cover-preview-wrap','cover-drop-text','cover-drop-zone')">
                            <div id="cover-preview-wrap" style="display:none; margin-top:10px;">
                                <img id="cover-preview"
                                     style="height:100px; border-radius:6px; object-fit:cover; border:2px solid var(--gold);"
                                     alt="Aperçu couverture">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Boutons --}}
            <div class="card" style="margin-top:16px;">
                <div class="card-body">
                    <div class="form-actions" style="border:0; padding:0; margin:0;">
                        <button type="submit" class="btn btn-primary">
                            {{ $slide->exists ? '✓ Enregistrer' : '+ Ajouter au carrousel' }}
                        </button>
                        <a href="{{ route('admin.hero.index') }}" class="btn btn-ghost">Annuler</a>
                        @if($slide->exists)
                        <form method="POST" action="{{ route('admin.hero.destroy', $slide) }}"
                              style="margin-left:auto;"
                              onsubmit="return confirm('Supprimer cette slide ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        {{-- ── Colonne droite — conseils ────────────────────────────── --}}
        <div style="position:sticky; top:76px;">
            <div class="card">
                <div class="card-header"><h2>💡 Conseils</h2></div>
                <div class="card-body" style="display:flex; flex-direction:column; gap:16px; font:13px Inter,sans-serif;">

                    <div id="tips-image" style="{{ $currentType !== 'image' ? 'display:none;' : '' }}">
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">📐</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Format recommandé</strong>
                            1920 × 1080 px (16:9). Images plus petites = risque de flou.</div>
                        </div>
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">⚡</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Performance</strong>
                            Compressez à &lt; 500 Ko (Squoosh.app ou TinyPNG).</div>
                        </div>
                        <div style="display:flex; gap:10px;">
                            <span style="font-size:16px;">🎨</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Zone de lisibilité</strong>
                            Le texte du héro couvre la gauche de l'image. Évitez les sujets importants dans le tiers gauche.</div>
                        </div>
                    </div>

                    <div id="tips-video" style="{{ $currentType !== 'video' ? 'display:none;' : '' }}">
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">▶️</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">YouTube / Vimeo</strong>
                            Collez l'URL normale de partage. La vidéo sera lue automatiquement, muette et en boucle.</div>
                        </div>
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">🔇</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Lecture muette</strong>
                            Les navigateurs exigent que les vidéos en lecture automatique soient muettes. C'est géré automatiquement.</div>
                        </div>
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">🖼️</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Image de couverture</strong>
                            Recommandée : elle s'affiche pendant le chargement de la vidéo et comme fallback.</div>
                        </div>
                        <div style="display:flex; gap:10px;">
                            <span style="font-size:16px;">🔢</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Durée</strong>
                            Une vidéo occupe une "slide". La durée d'affichage est celle de la vidéo (en boucle).</div>
                        </div>
                    </div>

                </div>
            </div>

            @if($slide->exists)
            <div class="card" style="margin-top:14px;">
                <div class="card-header"><h2>📊 Informations</h2></div>
                <div class="card-body" style="font:13px Inter,sans-serif; color:var(--muted); display:flex; flex-direction:column; gap:8px;">
                    <div><strong style="color:var(--ink);">Type :</strong>
                        <span class="badge {{ $slide->type === 'video' ? 'badge-blue' : 'badge-green' }}">
                            {{ $slide->type === 'video' ? '🎬 Vidéo' : '🖼️ Image' }}
                        </span>
                    </div>
                    @if($slide->image_path)
                    <div><strong style="color:var(--ink);">Fichier :</strong> {{ basename($slide->image_path) }}</div>
                    @endif
                    @if($slide->video_url)
                    <div><strong style="color:var(--ink);">URL vidéo :</strong>
                        <a href="{{ $slide->video_url }}" target="_blank" style="color:var(--green); word-break:break-all;">
                            {{ Str::limit($slide->video_url, 50) }}
                        </a>
                    </div>
                    @endif
                    <div><strong style="color:var(--ink);">Position :</strong> {{ $slide->sort_order + 1 }}</div>
                    <div><strong style="color:var(--ink);">Statut :</strong>
                        <span class="badge {{ $slide->is_active ? 'badge-green' : 'badge-gray' }}">
                            {{ $slide->is_active ? 'Visible' : 'Masquée' }}
                        </span>
                    </div>
                    <div><strong style="color:var(--ink);">Ajoutée le :</strong> {{ $slide->created_at?->format('d/m/Y à H:i') }}</div>
                </div>
            </div>
            @endif
        </div>

    </div>
</form>

<script>
function setType(type) {
    // Radio
    document.getElementById('type-' + type).checked = true;

    // Onglets visuels
    var imgTab   = document.getElementById('tab-image');
    var vidTab   = document.getElementById('tab-video');
    var active   = 'border:2px solid var(--gold); background:var(--sand);';
    var inactive = 'border:2px solid var(--line); background:#fff;';
    imgTab.style.cssText = imgTab.style.cssText.replace(/border:[^;]+;background:[^;]+;/, type === 'image' ? active : inactive);
    vidTab.style.cssText = vidTab.style.cssText.replace(/border:[^;]+;background:[^;]+;/, type === 'video' ? active : inactive);

    // Blocs
    document.getElementById('block-image').style.display = type === 'image' ? '' : 'none';
    document.getElementById('block-video').style.display = type === 'video' ? '' : 'none';

    // Conseils
    document.getElementById('tips-image').style.display = type === 'image' ? '' : 'none';
    document.getElementById('tips-video').style.display = type === 'video' ? '' : 'none';
}

function previewFile(input, wrapId, textId, zoneId) {
    if (!input.files || !input.files[0]) return;
    var file = input.files[0];
    var wrap = document.getElementById(wrapId);
    var previewImg = wrap ? wrap.querySelector('img') : null;

    if (previewImg && file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            wrap.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    var textEl = document.getElementById(textId);
    if (textEl) textEl.textContent = '✓ ' + file.name + ' (' + (file.size / 1024).toFixed(0) + ' Ko)';

    var zone = document.getElementById(zoneId);
    if (zone) { zone.style.borderColor = 'var(--gold)'; zone.style.background = 'var(--sand)'; }
}

function handleDrop(event, inputId, wrapId, textId) {
    event.preventDefault();
    var files = event.dataTransfer.files;
    if (!files.length) return;
    var input = document.getElementById(inputId);
    var dt = new DataTransfer();
    dt.items.add(files[0]);
    input.files = dt.files;
    previewFile(input, wrapId, textId, event.currentTarget.id);
    event.currentTarget.style.borderColor = 'var(--line)';
    event.currentTarget.style.background = '';
}

// Prévisualisation YouTube/Vimeo en temps réel
var videoInput = document.getElementById('video_url');
if (videoInput) {
    videoInput.addEventListener('input', function() {
        var url = this.value.trim();
        var embedUrl = getEmbedUrl(url);
        var container = document.getElementById('video-preview-container');
        var frame     = document.getElementById('video-preview-frame');
        if (embedUrl && container && frame) {
            frame.src = embedUrl;
            container.style.display = '';
        } else if (container) {
            container.style.display = 'none';
        }
    });
}

function getEmbedUrl(url) {
    // YouTube
    var ytMatch = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_\-]{11})/);
    if (ytMatch) {
        return 'https://www.youtube.com/embed/' + ytMatch[1] + '?autoplay=1&mute=1&loop=1&playlist=' + ytMatch[1] + '&controls=0&rel=0';
    }
    // Vimeo
    var vmMatch = url.match(/vimeo\.com\/(\d+)/);
    if (vmMatch) {
        return 'https://player.vimeo.com/video/' + vmMatch[1] + '?autoplay=1&muted=1&loop=1&background=1';
    }
    return null;
}

// ✅ NETTOYAGE AVANT SOUMISSION - Ne pas envoyer les champs conditionnels non pertinents
document.getElementById('hero-form').addEventListener('submit', function(e) {
    console.log('[Form Submit] Starting cleanup...');
    
    var selectedType = document.querySelector('input[name="type"]:checked')?.value;
    console.log('[Form Submit] Selected type:', selectedType);
    
    if (!selectedType) {
        console.error('[Form Submit] No type selected!');
        e.preventDefault();
        alert('Sélectionnez un type (Image ou Vidéo)');
        return false;
    }
    
    // Reset ALL conditional fields first
    console.log('[Form Submit] Resetting all conditional fields...');
    document.querySelectorAll('[data-conditional-field]').forEach(function(field) {
        field.removeAttribute('name');
        if (field.type === 'file') {
            field.value = '';
        } else {
            field.value = '';
        }
    });
    
    // Then re-enable ONLY the relevant ones for the selected type
    console.log('[Form Submit] Re-enabling relevant fields for type: ' + selectedType);
    
    if (selectedType === 'image') {
        // For image: enable only the image file input
        var imageField = document.getElementById('image-input');
        if (imageField) {
            imageField.setAttribute('name', 'image');
            console.log('[Form Submit] Enabled: image');
        }
    } else if (selectedType === 'video') {
        // For video: enable video_url and cover_image (if present)
        var videoUrlField = document.getElementById('video_url');
        var coverImageField = document.getElementById('cover-input');
        
        if (videoUrlField) {
            videoUrlField.setAttribute('name', 'video_url');
            console.log('[Form Submit] Enabled: video_url');
        }
        if (coverImageField) {
            coverImageField.setAttribute('name', 'cover_image');
            console.log('[Form Submit] Enabled: cover_image');
        }
    }
    
    console.log('[Form Submit] Cleanup complete. Submitting...');
});
</script>

@endsection
