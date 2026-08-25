@extends('admin.partials.layout')
@section('title', $job->exists ? 'Modifier l\'offre' : 'Nouvelle offre')
@section('page-title', $job->exists ? 'Modifier l\'offre' : 'Nouvelle offre')

@section('content')
<form method="POST"
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

                {{-- Titre --}}
                <div class="form-group full">
                    <label>Intitulé du poste *</label>
                    <input type="text" name="title" value="{{ old('title', $job->title) }}" required
                           placeholder="Ex : Ingénieur minier senior">
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                {{-- Département + Lieu --}}
                <div class="form-group">
                    <label>Département *</label>
                    <input type="text" name="department" value="{{ old('department', $job->department) }}" required
                           placeholder="Ex : Mining, Processing, HSE…">
                </div>
                <div class="form-group">
                    <label>Lieu *</label>
                    <input type="text" name="location"
                           value="{{ old('location', $job->location ?? 'Karma, Burkina Faso') }}" required>
                </div>

                {{-- Type de contrat + Niveau d'expérience --}}
                <div class="form-group">
                    <label>Type de contrat *</label>
                    <input type="text" name="contract_type"
                           value="{{ old('contract_type', $job->contract_type) }}"
                           placeholder="CDI, CDD, Stage…" required>
                </div>
                <div class="form-group">
                    <label>Niveau d'expérience</label>
                    <select name="experience_level">
                        <option value="">— Non précisé —</option>
                        @foreach(\App\Models\JobOffer::experienceLevels() as $key => $labels)
                        <option value="{{ $key }}" {{ old('experience_level', $job->experience_level) === $key ? 'selected' : '' }}>
                            {{ $labels['fr'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Rémunération + Date limite --}}
                <div class="form-group">
                    <label>Rémunération / Fourchette salariale</label>
                    <input type="text" name="salary_range"
                           value="{{ old('salary_range', $job->salary_range) }}"
                           placeholder="Ex : Selon profil · 400–600 k FCFA/mois">
                </div>
                <div class="form-group">
                    <label>Date limite de candidature</label>
                    <input type="date" name="deadline"
                           value="{{ old('deadline', $job->deadline?->format('Y-m-d')) }}">
                    <span class="form-hint">Laisser vide pour une offre sans date d'expiration.</span>
                </div>

                {{-- Description --}}
                <div class="form-group full">
                    <label>Description du poste *</label>
                    <textarea name="description" style="min-height:180px;" required
                              placeholder="Décrivez les missions, le contexte et les responsabilités du poste…">{{ old('description', $job->description) }}</textarea>
                </div>

                {{-- Profil recherché --}}
                <div class="form-group full">
                    <label>Profil recherché / Exigences</label>
                    <textarea name="requirements" style="min-height:130px;"
                              placeholder="Liste les critères : diplôme, expérience, compétences. Un critère par ligne.">{{ old('requirements', $job->requirements) }}</textarea>
                    <span class="form-hint">Un critère par ligne — chaque ligne sera affichée avec une coche ✓ sur le site.</span>
                </div>

                {{-- Publié --}}
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               {{ old('is_published', $job->is_published) ? 'checked' : '' }}>
                        <label for="is_published"
                               style="text-transform:none;letter-spacing:0;font-size:14px;font-weight:500;color:var(--ink);">
                            Publier cette offre (visible sur le site)
                        </label>
                    </div>
                </div>

                {{-- Spontanée --}}
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_spontaneous" value="0">
                        <input type="checkbox" id="is_spontaneous" name="is_spontaneous" value="1"
                               {{ old('is_spontaneous', $job->is_spontaneous ?? false) ? 'checked' : '' }}>
                        <label for="is_spontaneous"
                               style="text-transform:none;letter-spacing:0;font-size:14px;font-weight:500;color:var(--ink);">
                            Candidature spontanée
                            <span style="font:400 12px Inter,sans-serif;color:var(--muted);display:block;">
                                Cette offre n'apparaît pas dans la liste — elle alimente uniquement la page candidature spontanée.
                            </span>
                        </label>
                    </div>
                </div>

                {{-- Candidatures --}}
                @if($job->exists)
                <div class="form-group" style="align-self:center;">
                    @php $appCount = $job->applications()->count(); @endphp
                    <a href="{{ route('admin.applications.index', ['job' => $job->id]) }}"
                       style="display:inline-flex;align-items:center;gap:8px;font:500 13px Inter,sans-serif;color:var(--green);">
                        📋 {{ $appCount }} candidature(s) reçue(s) →
                    </a>
                </div>
                @endif

                {{-- Actions --}}
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">
                        {{ $job->exists ? '✓ Enregistrer les modifications' : '+ Créer l\'offre' }}
                    </button>
                    <a href="{{ route('admin.jobs.index') }}" class="btn btn-ghost">Annuler</a>
                    @if($job->exists)
                    <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}"
                          style="margin-left:auto;"
                          onsubmit="return confirm('Supprimer définitivement cette offre et ses candidatures ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
