@extends('admin.partials.layout')
@section('title', 'Candidature de '.$application->full_name)
@section('page-title', 'Dossier de candidature')

@section('content')
<div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start;">

    {{-- LEFT --}}
    <div>
        {{-- En-tête candidat --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header">
                <div>
                    <h2 style="font-size:20px;">{{ $application->full_name }}</h2>
                    <div style="font:13px Inter,sans-serif;color:var(--muted);margin-top:4px;">
                        Candidature pour : <strong style="color:var(--green);">{{ $application->jobOffer?->title ?? 'Poste inconnu' }}</strong>
                    </div>
                </div>
                <a href="{{ route('admin.applications.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>E-mail</label>
                        <div style="padding:8px 0;">
                            <a href="mailto:{{ $application->email }}" style="color:var(--green);">{{ $application->email }}</a>
                        </div>
                    </div>
                    @if($application->phone)
                    <div class="form-group">
                        <label>Téléphone</label>
                        <div style="padding:8px 0;">{{ $application->phone }}</div>
                    </div>
                    @endif
                    @if($application->nationality)
                    <div class="form-group">
                        <label>Nationalité</label>
                        <div style="padding:8px 0;">{{ $application->nationality }}</div>
                    </div>
                    @endif
                    @if($application->current_position)
                    <div class="form-group">
                        <label>Poste actuel</label>
                        <div style="padding:8px 0;">{{ $application->current_position }}</div>
                    </div>
                    @endif
                    @if($application->experience_years)
                    <div class="form-group">
                        <label>Années d'expérience</label>
                        <div style="padding:8px 0;">{{ $application->experience_years }}</div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label>Reçue le</label>
                        <div style="padding:8px 0;color:var(--muted);">{{ $application->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Lettre de motivation --}}
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header"><h2>Lettre de motivation</h2></div>
            <div class="card-body">
                <div style="background:#f9f7f4;border:1px solid var(--line);border-radius:6px;padding:18px;font:15px/1.75 Inter,sans-serif;color:var(--ink);white-space:pre-line;">{{ $application->motivation }}</div>
            </div>
        </div>

        {{-- Pièces jointes --}}
        @if($application->cv_path || $application->cover_letter_path)
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header"><h2>Pièces jointes</h2></div>
            <div class="card-body" style="display:flex;gap:14px;flex-wrap:wrap;">
                @if($application->cv_path)
                <a href="{{ route('admin.applications.cv', $application) }}" target="_blank"
                   class="btn btn-gold" style="display:inline-flex;align-items:center;gap:8px;">
                    📎 Télécharger le CV
                </a>
                @endif
                @if($application->cover_letter_path)
                <a href="{{ route('admin.applications.cover-letter', $application) }}" target="_blank"
                   class="btn btn-ghost" style="display:inline-flex;align-items:center;gap:8px;">
                    📄 Lettre de motivation
                </a>
                @endif
            </div>
        </div>
        @endif

        {{-- Répondre --}}
        <div class="card">
            <div class="card-header"><h2>Répondre par e-mail</h2></div>
            <div class="card-body">
                <a href="mailto:{{ $application->email }}?subject=Votre candidature — {{ $application->jobOffer?->title }}"
                   class="btn btn-primary" style="display:inline-flex;align-items:center;gap:8px;">
                    ✉️ Envoyer un e-mail à {{ $application->first_name }}
                </a>
            </div>
        </div>
    </div>

    {{-- RIGHT — Actions --}}
    <div>
        <div class="card">
            <div class="card-header"><h2>Statut & Notes</h2></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.applications.status', $application) }}">
                    @csrf @method('PATCH')
                    <div class="form-group" style="margin-bottom:16px;">
                        <label>Statut de la candidature</label>
                        <select name="status" style="width:100%;margin-top:6px;">
                            @foreach($statuses as $key => $s)
                            <option value="{{ $key }}" {{ $application->status === $key ? 'selected' : '' }}>
                                {{ $s['label'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom:20px;">
                        <label>Notes internes</label>
                        <textarea name="admin_notes" style="width:100%;min-height:100px;margin-top:6px;border:1px solid var(--line);border-radius:6px;padding:10px 12px;font:14px Inter,sans-serif;resize:vertical;">{{ $application->admin_notes }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;">✓ Mettre à jour</button>
                </form>

                <div style="margin-top:16px;padding-top:16px;border-top:1px solid var(--line);">
                    <form method="POST" action="{{ route('admin.applications.destroy', $application) }}"
                          onsubmit="return confirm('Supprimer définitivement cette candidature ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width:100%;">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Info offre --}}
        <div class="card" style="margin-top:16px;">
            <div class="card-header"><h2>Offre liée</h2></div>
            <div class="card-body">
                @if($application->jobOffer)
                <div style="font:600 14px Inter,sans-serif;color:var(--green);margin-bottom:6px;">{{ $application->jobOffer->title }}</div>
                <div style="font:13px Inter,sans-serif;color:var(--muted);margin-bottom:12px;">
                    {{ $application->jobOffer->department }} · {{ $application->jobOffer->contract_type }}
                </div>
                <a href="{{ route('admin.jobs.edit', $application->jobOffer) }}" class="btn btn-ghost btn-sm">
                    Voir l'offre →
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
