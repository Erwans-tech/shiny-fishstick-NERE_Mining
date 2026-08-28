@extends('admin.partials.layout')
@section('title', $partner->exists ? 'Modifier le partenaire' : 'Nouveau partenaire')
@section('page-title', $partner->exists ? 'Modifier le partenaire' : 'Nouveau partenaire')

@section('content')
<form method="POST"
      action="{{ $partner->exists ? route('admin.partners.update', $partner) : route('admin.partners.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($partner->exists) @method('PUT') @endif
    <div class="card">
        <div class="card-header">
            <h2>{{ $partner->exists ? $partner->name : 'Nouveau partenaire' }}</h2>
            <a href="{{ route('admin.partners.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Nom *</label>
                    <input type="text" name="name" value="{{ old('name', $partner->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Catégorie</label>
                    <input type="text" name="category" value="{{ old('category', $partner->category) }}" placeholder="Institutionnel, Technique…">
                </div>
                <div class="form-group">
                    <label>Site web</label>
                    <input type="url" name="website_url" value="{{ old('website_url', $partner->website_url) }}" placeholder="https://…">
                </div>
                <div class="form-group">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $partner->sort_order ?? 0) }}" min="0">
                </div>
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               {{ old('is_published', $partner->is_published ?? true) ? 'checked' : '' }}>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">Visible sur le site</label>
                    </div>
                </div>
                <div class="form-group full">
                    <label>Logo (image)</label>
                    @if($partner->logo_path)
                    @php $logoUrl = str_starts_with($partner->logo_path,'images/') ? asset($partner->logo_path) : \App\Helpers\StorageHelper::uploadUrl($partner->logo_path); @endphp
                    <div style="margin-bottom:10px;">
                        <img src="{{ $logoUrl }}" style="height:60px;object-fit:contain;">
                    </div>
                    @endif
                    <input type="file" name="logo" accept="image/*,.svg">
                    <span class="form-hint">PNG, JPG ou SVG — max 2 Mo.</span>
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">{{ $partner->exists ? '✓ Enregistrer' : '+ Ajouter' }}</button>
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
