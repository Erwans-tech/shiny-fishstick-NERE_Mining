@extends('admin.partials.layout')
@section('title', $slide->exists ? 'Modifier la slide' : 'Nouvelle slide')
@section('page-title', $slide->exists ? 'Modifier la slide' : 'Ajouter une slide au carrousel')

@section('content')

<form method="POST"
      action="{{ $slide->exists ? route('admin.hero.update', $slide) : route('admin.hero.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($slide->exists) @method('PUT') @endif

    <div style="display:grid; grid-template-columns:1fr 360px; gap:20px; align-items:start;">

        {{-- LEFT — champs --}}
        <div class="card">
            <div class="card-header">
                <h2>{{ $slide->exists ? 'Modifier : '.($slide->title ?? 'Slide sans titre') : 'Nouvelle slide hero' }}</h2>
                <a href="{{ route('admin.hero.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
            </div>
            <div class="card-body">
                <div class="form-grid">

                    {{-- Titre (usage interne) --}}
                    <div class="form-group full">
                        <label for="title">Titre (usage interne)</label>
                        <input id="title" type="text" name="title"
                               value="{{ old('title', $slide->title) }}"
                               placeholder="Ex : Vue panoramique Karma — Oct. 2025">
                        <span class="form-hint">Ce titre n'est pas affiché sur le site. Il sert uniquement à identifier la slide dans l'admin.</span>
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    {{-- Légende (optionnelle, affichée sur le site) --}}
                    <div class="form-group full">
                        <label for="caption">Légende <span style="font-weight:400; text-transform:none; letter-spacing:0;">(optionnelle — affichée sur le héro)</span></label>
                        <input id="caption" type="text" name="caption"
                               value="{{ old('caption', $slide->caption) }}"
                               placeholder="Ex : La mine de Karma vue du ciel, province du Zondoma"
                               maxlength="255">
                        <span class="form-hint">Si renseignée, apparaît en bas à gauche de l'image dans le carrousel.</span>
                        @error('caption')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    {{-- Ordre --}}
                    <div class="form-group">
                        <label for="sort_order">Position dans le carrousel</label>
                        <input id="sort_order" type="number" name="sort_order" min="0" max="99"
                               value="{{ old('sort_order', $slide->sort_order ?? 0) }}">
                        <span class="form-hint">0 = première position. Vous pouvez aussi réordonner par glisser-déposer depuis la liste.</span>
                    </div>

                    {{-- Actif --}}
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

                    {{-- Upload image --}}
                    <div class="form-group full">
                        <label>Image {{ $slide->exists ? '(laisser vide pour conserver)' : '*' }}</label>

                        {{-- Aperçu image actuelle --}}
                        @if($slide->exists && $slide->image_path)
                        <div style="margin-bottom:12px; position:relative; display:inline-block;">
                            <img src="{{ $slide->url }}"
                                 id="current-preview"
                                 style="height:160px; max-width:100%; border-radius:8px; object-fit:cover; border:1px solid var(--line);"
                                 alt="{{ $slide->title }}">
                            <div style="position:absolute; top:8px; left:8px; background:rgba(0,0,0,.55); color:#fff; padding:3px 8px; border-radius:4px; font:600 10px Inter,sans-serif; letter-spacing:.08em;">
                                IMAGE ACTUELLE
                            </div>
                        </div>
                        @endif

                        {{-- Zone de dépôt --}}
                        <div id="drop-zone"
                             style="border:2px dashed var(--line); border-radius:10px; padding:32px 20px; text-align:center; cursor:pointer; transition:border-color .2s, background .2s;"
                             onclick="document.getElementById('image-input').click()"
                             ondragover="event.preventDefault(); this.style.borderColor='var(--gold)'; this.style.background='var(--sand)';"
                             ondragleave="this.style.borderColor='var(--line)'; this.style.background='';"
                             ondrop="handleDrop(event)">
                            <div style="font-size:32px; margin-bottom:10px;">📷</div>
                            <div id="drop-text" style="font:500 14px Inter,sans-serif; color:var(--muted);">
                                Cliquez ou glissez une image ici
                            </div>
                            <div style="font:12px Inter,sans-serif; color:var(--muted); margin-top:6px;">
                                JPG, PNG ou WebP — max 8 Mo — recommandé : 1920×1080 px
                            </div>
                        </div>
                        <input type="file" id="image-input" name="image"
                               accept="image/jpeg,image/png,image/webp"
                               style="display:none;"
                               onchange="previewImage(this)" {{ $slide->exists ? '' : 'required' }}>

                        {{-- Nouvelle preview --}}
                        <div id="new-preview-wrap" style="display:none; margin-top:12px;">
                            <img id="new-preview"
                                 style="height:160px; max-width:100%; border-radius:8px; object-fit:cover; border:2px solid var(--gold);"
                                 alt="Aperçu">
                            <div style="font:600 11px Inter,sans-serif; color:var(--gold2); margin-top:6px; letter-spacing:.08em; text-transform:uppercase;">
                                ✓ Nouvelle image sélectionnée
                            </div>
                        </div>

                        @error('image')<div class="form-error" style="margin-top:8px;">{{ $message }}</div>@enderror
                    </div>

                    {{-- Boutons --}}
                    <div class="form-actions full">
                        <button type="submit" class="btn btn-primary">
                            {{ $slide->exists ? '✓ Enregistrer les modifications' : '+ Ajouter au carrousel' }}
                        </button>
                        <a href="{{ route('admin.hero.index') }}" class="btn btn-ghost">Annuler</a>
                        @if($slide->exists)
                        <form method="POST" action="{{ route('admin.hero.destroy', $slide) }}"
                              style="margin-left:auto;"
                              onsubmit="return confirm('Supprimer cette slide définitivement ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT — conseils --}}
        <div>
            <div class="card">
                <div class="card-header"><h2>💡 Conseils</h2></div>
                <div class="card-body" style="display:flex; flex-direction:column; gap:16px;">
                    <div style="display:flex; gap:10px;">
                        <span style="font-size:18px; flex-shrink:0;">📐</span>
                        <div>
                            <div style="font:600 12px Inter,sans-serif; color:var(--green); margin-bottom:3px;">Format recommandé</div>
                            <div style="font:13px Inter,sans-serif; color:var(--muted);">1920 × 1080 px (paysage 16:9). Des formats plus petits seront zoomés et peuvent sembler flous.</div>
                        </div>
                    </div>
                    <div style="display:flex; gap:10px;">
                        <span style="font-size:18px; flex-shrink:0;">🎨</span>
                        <div>
                            <div style="font:600 12px Inter,sans-serif; color:var(--green); margin-bottom:3px;">Zone de lisibilité</div>
                            <div style="font:13px Inter,sans-serif; color:var(--muted);">Le texte du héro se superpose sur la gauche de l'image. Évitez les sujets importants dans le tiers gauche.</div>
                        </div>
                    </div>
                    <div style="display:flex; gap:10px;">
                        <span style="font-size:18px; flex-shrink:0;">⚡</span>
                        <div>
                            <div style="font:600 12px Inter,sans-serif; color:var(--green); margin-bottom:3px;">Performance</div>
                            <div style="font:13px Inter,sans-serif; color:var(--muted);">Compressez vos images avant l'upload (outils : Squoosh, TinyPNG). Cible : < 500 Ko par image.</div>
                        </div>
                    </div>
                    <div style="display:flex; gap:10px;">
                        <span style="font-size:18px; flex-shrink:0;">🔢</span>
                        <div>
                            <div style="font:600 12px Inter,sans-serif; color:var(--green); margin-bottom:3px;">Nombre de slides</div>
                            <div style="font:13px Inter,sans-serif; color:var(--muted);">3 à 6 slides sont idéales. Chaque slide est affichée pendant 5 secondes.</div>
                        </div>
                    </div>
                </div>
            </div>

            @if($slide->exists)
            <div class="card" style="margin-top:16px;">
                <div class="card-header"><h2>📊 Informations</h2></div>
                <div class="card-body" style="font:13px Inter,sans-serif; color:var(--muted); display:flex; flex-direction:column; gap:10px;">
                    <div><strong style="color:var(--ink);">Fichier :</strong> {{ basename($slide->image_path) }}</div>
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
function previewImage(input) {
    if (!input.files || !input.files[0]) return;
    var file = input.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('new-preview').src = e.target.result;
        document.getElementById('new-preview-wrap').style.display = 'block';
        document.getElementById('drop-text').textContent = '✓ ' + file.name + ' (' + (file.size/1024).toFixed(0) + ' Ko)';
        document.getElementById('drop-zone').style.borderColor = 'var(--gold)';
        document.getElementById('drop-zone').style.background = 'var(--sand)';
    };
    reader.readAsDataURL(file);
}

function handleDrop(event) {
    event.preventDefault();
    var files = event.dataTransfer.files;
    if (files.length) {
        var input = document.getElementById('image-input');
        var dt = new DataTransfer();
        dt.items.add(files[0]);
        input.files = dt.files;
        previewImage(input);
    }
    event.currentTarget.style.borderColor = 'var(--line)';
    event.currentTarget.style.background = '';
}
</script>
@endsection
