@extends('admin.partials.layout')
@section('title', $job->exists ? 'Modifier l\'offre' : 'Nouvelle offre')
@section('page-title', $job->exists ? 'Modifier l\'offre' : 'Nouvelle offre')

@section('content')
<form method="POST" enctype="multipart/form-data"
      action="{{ $job->exists ? route('admin.jobs.update', $job) : route('admin.jobs.store') }}">
    @csrf
    @if($job->exists) @method('PUT') @endif
    <div class="card">
        <div class="card-header">
            <h2>{{ $job->exists ? $job->title : "Nouvelle offre d'emploi" }}</h2>
            <div style="display:flex;gap:8px;align-items:center;">
                @if($job->exists)
                    <a href="{{ route('jobs.show', $job) }}" target="_blank" class="btn btn-ghost btn-sm">Voir sur le site ↗</a>
                    <span class="badge {{ $job->is_published ? 'badge-green' : 'badge-gray' }}">
                        {{ $job->is_published ? 'Publié' : 'Brouillon' }}
                    </span>
                @endif
                <a href="{{ route('admin.jobs.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label for="title">Intitulé du poste *</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $job->title) }}" required
                           placeholder="Ex : Ingénieur minier senior">
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group full">
                    <label for="offer_file">Document de l'offre d'emploi {{ $job->exists ? '' : '*' }}</label>
                    @if($job->offer_file_path)
                        <p class="form-hint">
                            Document actuel :
                            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($job->offer_file_path) }}"
                               target="_blank" rel="noopener">consulter le fichier</a>
                        </p>
                    @endif
                    <input id="offer_file" type="file" name="offer_file" accept=".pdf,.doc,.docx"
                           {{ $job->exists ? '' : 'required' }}>
                    <span class="form-hint">Formats acceptés : PDF, DOC ou DOCX (10 Mo maximum).</span>
                    @error('offer_file')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">
                        {{ $job->exists ? '✓ Enregistrer les modifications' : '+ Créer l\'offre' }}
                    </button>
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
