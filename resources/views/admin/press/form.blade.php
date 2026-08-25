@extends('admin.partials.layout')
@section('title', $document->exists ? 'Modifier le communiqué' : 'Nouveau communiqué')
@section('page-title', $document->exists ? 'Modifier le communiqué' : 'Nouveau communiqué')

@section('content')
<form method="POST"
      action="{{ $document->exists ? route('admin.press.update', $document) : route('admin.press.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($document->exists) @method('PUT') @endif
    <div class="card">
        <div class="card-header">
            <h2>{{ $document->exists ? $document->title : 'Nouveau communiqué' }}</h2>
            <a href="{{ route('admin.press.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Titre *</label>
                    <input type="text" name="title" value="{{ old('title', $document->title) }}" required>
                </div>
                <div class="form-group">
                    <label>Type de document *</label>
                    <input type="text" name="document_type" value="{{ old('document_type', $document->document_type) }}" placeholder="Communiqué, Rapport, Presse…" required>
                </div>
                <div class="form-group">
                    <label>Date de publication</label>
                    <input type="date" name="published_at" value="{{ old('published_at', $document->published_at?->format('Y-m-d')) }}">
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description">{{ old('description', $document->description) }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Fichier (PDF, DOC)</label>
                    @if($document->file_path)<div style="margin-bottom:8px;"><a href="{{ asset('uploads/'.$document->file_path) }}" target="_blank" class="badge badge-green">Fichier actuel ↗</a></div>@endif
                    <input type="file" name="file" accept=".pdf,.doc,.docx">
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">{{ $document->exists ? '✓ Enregistrer' : '+ Créer' }}</button>
                    <a href="{{ route('admin.press.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
