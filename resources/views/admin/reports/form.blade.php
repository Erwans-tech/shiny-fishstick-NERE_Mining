@extends('admin.partials.layout')
@section('title', $report->exists ? 'Modifier la publication' : 'Nouvelle publication')
@section('page-title', $report->exists ? 'Modifier' : 'Nouvelle publication')

@section('content')
<form method="POST"
      action="{{ $report->exists ? route('admin.reports.update', $report) : route('admin.reports.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($report->exists) @method('PUT') @endif
    <div class="card">
        <div class="card-header">
            <h2>{{ $report->exists ? $report->title : 'Nouvelle publication' }}</h2>
            <a href="{{ route('admin.reports.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Titre *</label>
                    <input type="text" name="title" value="{{ old('title', $report->title) }}" required>
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Catégorie *</label>
                    <input type="text" name="category" value="{{ old('category', $report->category) }}" placeholder="RSE, Activité, Technique…" required>
                </div>
                <div class="form-group">
                    <label>Date de publication</label>
                    <input type="date" name="published_at" value="{{ old('published_at', $report->published_at?->format('Y-m-d')) }}">
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description">{{ old('description', $report->description) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Fichier PDF</label>
                    @if($report->file_path)<div style="margin-bottom:8px;"><a href="{{ asset('uploads/'.$report->file_path) }}" target="_blank" class="badge badge-green">Fichier actuel ↗</a></div>@endif
                    <input type="file" name="file" accept=".pdf">
                </div>
                <div class="form-group">
                    <label>Image de couverture</label>
                    @if($report->cover_image)<div style="margin-bottom:8px;"><img src="{{ asset('uploads/'.$report->cover_image) }}" style="height:80px;border-radius:4px;object-fit:cover;"></div>@endif
                    <input type="file" name="cover" accept="image/*">
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">{{ $report->exists ? '✓ Enregistrer' : '+ Créer' }}</button>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
