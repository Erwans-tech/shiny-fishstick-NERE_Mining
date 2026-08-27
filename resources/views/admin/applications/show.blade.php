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
                @php
                    $applicationTemplateKey = match($application->status) {
                        'interview' => 'interview',
                        'accepted' => 'accepted',
                        'rejected' => 'rejected',
                        default => 'received',
                    };
                    $applicationTemplates = [
                        'received' => [
                            'label' => 'Accusé de réception',
                            'subject' => 'Votre candidature — '.$application->jobOffer?->title,
                            'body' => "Bonjour :first_name,\n\nNous vous confirmons la bonne réception de votre candidature au poste de :job_title. Notre équipe va étudier votre dossier avec attention et reviendra vers vous dès que possible.\n\nCordialement,\nL'équipe Néré Mining",
                        ],
                        'interview' => [
                            'label' => 'Proposer un entretien',
                            'subject' => 'Entretien — '.$application->jobOffer?->title,
                            'body' => "Bonjour :first_name,\n\nAprès examen de votre candidature au poste de :job_title, nous souhaitons échanger avec vous lors d'un entretien. Merci de nous indiquer vos disponibilités afin que nous puissions convenir d'un créneau.\n\nCordialement,\nL'équipe Néré Mining",
                        ],
                        'accepted' => [
                            'label' => 'Candidature retenue',
                            'subject' => 'Suite à votre candidature — '.$application->jobOffer?->title,
                            'body' => "Bonjour :first_name,\n\nNous avons le plaisir de vous informer que votre candidature au poste de :job_title a retenu notre attention. Nous vous contacterons prochainement pour vous communiquer les prochaines étapes.\n\nCordialement,\nL'équipe Néré Mining",
                        ],
                        'rejected' => [
                            'label' => 'Réponse négative',
                            'subject' => 'Suite à votre candidature — '.$application->jobOffer?->title,
                            'body' => "Bonjour :first_name,\n\nNous vous remercions pour l'intérêt porté à Néré Mining et pour le temps consacré à votre candidature au poste de :job_title. Après étude attentive de votre dossier, nous ne sommes malheureusement pas en mesure de donner une suite favorable à votre candidature.\n\nNous vous souhaitons pleine réussite dans vos projets.\n\nCordialement,\nL'équipe Néré Mining",
                        ],
                    ];
                @endphp
                <div class="form-group" style="margin-bottom:14px;">
                    <label for="application-template">Réponse pré-enregistrée</label>
                    <select id="application-template" style="width:100%;margin-top:6px;">
                        @foreach($applicationTemplates as $key => $template)
                            <option value="{{ $key }}" {{ $applicationTemplateKey === $key ? 'selected' : '' }}>{{ $template['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <textarea id="application-reply" style="width:100%;min-height:170px;margin-bottom:14px;border:1px solid var(--line);border-radius:6px;padding:12px;font:14px/1.6 Inter,sans-serif;resize:vertical;"></textarea>
                <a id="application-mail-link" href="#" class="btn btn-primary" style="display:inline-flex;align-items:center;gap:8px;">
                    ✉️ Préparer l’e-mail à {{ $application->first_name }}
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

@push('scripts')
<script>
    (() => {
        const templates = @json($applicationTemplates);
        const firstName = @json($application->first_name);
        const jobTitle = @json($application->jobOffer?->title ?? 'l’offre sélectionnée');
        const recipient = @json($application->email);
        const selector = document.getElementById('application-template');
        const reply = document.getElementById('application-reply');
        const link = document.getElementById('application-mail-link');

        const refreshMailto = () => {
            const template = templates[selector.value];
            const body = reply.value.replaceAll(':first_name', firstName).replaceAll(':job_title', jobTitle);
            link.href = `mailto:${recipient}?subject=${encodeURIComponent(template.subject)}&body=${encodeURIComponent(body)}`;
        };

        const selectTemplate = () => {
            reply.value = templates[selector.value].body;
            refreshMailto();
        };

        selector.addEventListener('change', selectTemplate);
        reply.addEventListener('input', refreshMailto);
        selectTemplate();
    })();
</script>
@endpush
