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
                    <label for="image">Image de couverture</label>
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

@if($news->exists)
<!-- Section pour gérer les images internes -->
<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <h2>Images du contenu</h2>
    </div>
    <div class="card-body">
        <!-- Upload d'images -->
        <form method="POST" action="{{ route('admin.news-images.upload', $news) }}" enctype="multipart/form-data" id="upload-form">
            @csrf
            <div class="form-group full">
                <label for="images">Ajouter des images au contenu</label>
                <input id="images" type="file" name="images[]" multiple accept="image/*">
                <span class="form-hint">Vous pouvez sélectionner plusieurs images à la fois. Max 4 Mo par image.</span>
            </div>
            <div class="form-actions full">
                <button type="submit" class="btn btn-secondary">+ Ajouter des images</button>
            </div>
        </form>

        @if($news->images->count() > 0)
        <div style="margin-top:30px;">
            <h3 style="margin-bottom:15px;">Images du contenu ({{ $news->images->count() }})</h3>
            <div id="images-list" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:15px;">
                @foreach($news->images as $image)
                <div class="image-card" data-image-id="{{ $image->id }}" style="position:relative;border:1px solid #ddd;border-radius:6px;overflow:hidden;">
                    <img src="{{ $image->getUrlAttribute() }}" style="width:100%;height:150px;object-fit:cover;display:block;">
                    <div style="padding:10px;background:#f5f5f5;font-size:12px;">
                        <strong>Position: {{ $image->position }}</strong>
                    </div>
                    <div style="position:absolute;top:5px;right:5px;display:flex;gap:5px;">
                        <button type="button" class="btn btn-xs btn-ghost edit-image" data-image-id="{{ $image->id }}" title="Éditer">✎</button>
                        <form method="POST" action="{{ route('admin.news-images.destroy', $image) }}" style="display:inline;" onsubmit="return confirm('Supprimer cette image ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger" title="Supprimer">✕</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Formulaire pour mettre à jour les métadonnées -->
            <div id="edit-modal" style="display:none;margin-top:30px;padding:20px;background:#f9f9f9;border-radius:6px;">
                <h3>Éditer l'image</h3>
                <form id="edit-form" method="POST" style="margin-top:15px;">
                    @csrf @method('PUT')
                    <div class="form-group full">
                        <label for="modal-alt-text">Texte alternatif (alt)</label>
                        <input id="modal-alt-text" type="text" name="alt_text" value="" placeholder="Description pour l'accessibilité">
                    </div>
                    <div class="form-group full">
                        <label for="modal-caption">Légende</label>
                        <textarea id="modal-caption" name="caption" placeholder="Légende facultative" style="min-height:60px;"></textarea>
                    </div>
                    <div class="form-actions full">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" class="btn btn-ghost" onclick="document.getElementById('edit-modal').style.display='none';">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
        @else
        <p style="color:#999;text-align:center;padding:20px;">Aucune image pour le moment.</p>
        @endif
    </div>
</div>

<script>
document.querySelectorAll('.edit-image').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const imageId = this.dataset.imageId;
        const modal = document.getElementById('edit-modal');
        const form = document.getElementById('edit-form');
        
        // Faire une requête pour récupérer les données
        fetch(`/admin/news-images/${imageId}`)
            .then(r => r.json())
            .then(data => {
                document.getElementById('modal-alt-text').value = data.alt_text || '';
                document.getElementById('modal-caption').value = data.caption || '';
                form.action = `/admin/news-images/${imageId}`;
                modal.style.display = 'block';
                modal.scrollIntoView({ behavior: 'smooth' });
            });
    });
});

// Upload avec feedback
document.getElementById('upload-form').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('images');
    if (!fileInput.files.length) {
        e.preventDefault();
        alert('Veuillez sélectionner au moins une image.');
    }
});
</script>
@endif

@endsection
