@extends('admin.partials.layout')
@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')

{{-- ══ Alertes urgentes ════════════════════════════════════════ --}}
@if($counts['messages'] > 0 || $counts['applications_new'] > 0 || $expiringJobs->isNotEmpty())
<div style="display:flex; flex-direction:column; gap:8px; margin-bottom:24px;">
    @if($counts['messages'] > 0)
    <a href="{{ route('admin.messages.index') }}"
       style="display:flex; align-items:center; gap:12px; padding:12px 18px; background:#fee2e2; border:1px solid #fecaca; border-radius:8px; color:#991b1b; font:500 13px Inter,sans-serif; text-decoration:none;">
        <span style="font-size:16px;">✉️</span>
        <strong>{{ $counts['messages'] }} message(s) non lu(s)</strong> — Cliquez pour répondre →
    </a>
    @endif
    @if($counts['applications_new'] > 0)
    <a href="{{ route('admin.applications.index') }}"
       style="display:flex; align-items:center; gap:12px; padding:12px 18px; background:#fef9c3; border:1px solid #fde68a; border-radius:8px; color:#854d0e; font:500 13px Inter,sans-serif; text-decoration:none;">
        <span style="font-size:16px;">📋</span>
        <strong>{{ $counts['applications_new'] }} nouvelle(s) candidature(s)</strong> à examiner →
    </a>
    @endif
    @foreach($expiringJobs as $job)
    <div style="display:flex; align-items:center; gap:12px; padding:12px 18px; background:#ffedd5; border:1px solid #fed7aa; border-radius:8px; color:#9a3412; font:500 13px Inter,sans-serif;">
        <span style="font-size:16px;">⏰</span>
        Offre <strong>{{ $job->title }}</strong> expire le {{ $job->deadline->format('d/m/Y') }}
        <a href="{{ route('admin.jobs.edit', $job) }}" style="margin-left:auto; color:#9a3412; text-decoration:underline; font-size:12px;">Modifier →</a>
    </div>
    @endforeach
</div>
@endif

{{-- ══ Stat tiles — rangée 1 : KPIs principaux ══════════════════ --}}
<div class="stat-grid">

    <a href="{{ route('admin.news.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon stat-tile-icon--blue">📰</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num">{{ $counts['news'] }}</div>
            <div class="stat-tile-lbl">Actualités</div>
            <div class="stat-tile-sub">{{ $counts['news_published'] }} publiée(s) · {{ $counts['news_draft'] }} brouillon(s)</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

    <a href="{{ route('admin.jobs.index') }}" class="stat-tile {{ $counts['jobs'] === 0 ? 'stat-tile--warn' : '' }}" style="text-decoration:none;">
        <div class="stat-tile-icon stat-tile-icon--green">💼</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num">{{ $counts['jobs'] }}</div>
            <div class="stat-tile-lbl">Offres publiées</div>
            @if($counts['jobs_expiring'] > 0)
            <div class="stat-tile-sub" style="color:#854d0e;">⚠ {{ $counts['jobs_expiring'] }} expire(nt) bientôt</div>
            @else
            <div class="stat-tile-sub">Aucune expiration prochaine</div>
            @endif
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

    <a href="{{ route('admin.applications.index') }}" class="stat-tile {{ $counts['applications_new'] > 0 ? 'stat-tile--alert' : '' }}" style="text-decoration:none;">
        <div class="stat-tile-icon {{ $counts['applications_new'] > 0 ? 'stat-tile-icon--red' : '' }}">📋</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num">{{ $counts['applications'] }}</div>
            <div class="stat-tile-lbl">Candidatures</div>
            @if($counts['applications_new'] > 0)
            <div class="stat-tile-sub" style="color:#991b1b; font-weight:600;">🔴 {{ $counts['applications_new'] }} nouvelle(s)</div>
            @else
            <div class="stat-tile-sub">Tout examiné ✓</div>
            @endif
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

    <a href="{{ route('admin.messages.index') }}" class="stat-tile {{ $counts['messages'] > 0 ? 'stat-tile--alert' : '' }}" style="text-decoration:none;">
        <div class="stat-tile-icon {{ $counts['messages'] > 0 ? 'stat-tile-icon--red' : 'stat-tile-icon--green' }}">✉️</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num">{{ $counts['messages'] }}</div>
            <div class="stat-tile-lbl">Messages non lus</div>
            <div class="stat-tile-sub">{{ $counts['messages_total'] }} au total</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

</div>

{{-- ══ Stat tiles — rangée 2 : ressources ═══════════════════════ --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:28px;">

    <a href="{{ route('admin.reports.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">📄</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:22px;">{{ $counts['reports'] }}</div>
            <div class="stat-tile-lbl">Publications</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>
    <a href="{{ route('admin.press.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">📢</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:22px;">{{ $counts['press'] }}</div>
            <div class="stat-tile-lbl">Communiqués</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>
    <a href="{{ route('admin.media.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">🖼️</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:22px;">{{ $counts['media'] }}</div>
            <div class="stat-tile-lbl">Médias</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>
    <a href="{{ route('admin.newsletter.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">📧</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:22px;">{{ $counts['newsletter'] ?? 0 }}</div>
            <div class="stat-tile-lbl">Abonnés Newsletter</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>
    <a href="{{ route('admin.settings.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">⚙️</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:22px;">∞</div>
            <div class="stat-tile-lbl">Paramètres du site</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>
    <a href="{{ route('admin.partners.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">🤝</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:22px;">{{ $counts['partners'] }}</div>
            <div class="stat-tile-lbl">Partenaires</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

</div>

{{-- ══ Corps principal — 3 colonnes ════════════════════════════ --}}
<div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:20px; align-items:start;">

    {{-- ── Activité récente : Actualités ── --}}
    <div class="card">
        <div class="card-header">
            <h2>📰 Dernières actualités</h2>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">+ Ajouter</a>
        </div>
        <div style="divide-y">
            @forelse($recentNews as $news)
            <a href="{{ route('admin.news.edit', $news) }}"
               style="display:flex; align-items:center; gap:12px; padding:12px 20px; border-bottom:1px solid #f5f0e8; transition:background .15s; text-decoration:none;"
               onmouseover="this.style.background='#faf8f4'" onmouseout="this.style.background=''">
                <div style="flex:1; min-width:0;">
                    <div style="font:600 13px Inter,sans-serif; color:var(--green); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        {{ $news->title }}
                    </div>
                    <div style="font:12px Inter,sans-serif; color:var(--muted); margin-top:2px;">
                        {{ $news->category }} · {{ $news->created_at->diffForHumans() }}
                    </div>
                </div>
                @if($news->published_at && $news->published_at->isPast())
                    <span class="badge badge-green" style="flex-shrink:0;">Pub.</span>
                @elseif($news->published_at)
                    <span class="badge badge-yellow" style="flex-shrink:0;">Plan.</span>
                @else
                    <span class="badge badge-gray" style="flex-shrink:0;">Brouil.</span>
                @endif
            </a>
            @empty
            <div style="padding:20px; text-align:center; color:var(--muted); font-size:13px;">Aucune actualité</div>
            @endforelse
        </div>
        <div style="padding:12px 20px; border-top:1px solid var(--line); background:#faf8f4;">
            <a href="{{ route('admin.news.index') }}" style="font:600 12px Inter,sans-serif; color:var(--green);">
                Voir toutes les actualités →
            </a>
        </div>
    </div>

    {{-- ── Derniers messages de contact ── --}}
    <div class="card">
        <div class="card-header">
            <h2>✉️ Messages récents</h2>
            @if($counts['messages'] > 0)
            <span class="badge badge-red">{{ $counts['messages'] }} non lu(s)</span>
            @endif
        </div>
        @forelse($recentMessages as $msg)
        <a href="{{ route('admin.messages.show', $msg) }}"
           style="display:flex; align-items:flex-start; gap:12px; padding:12px 20px; border-bottom:1px solid #f5f0e8; transition:background .15s; text-decoration:none; {{ !$msg->read_at ? 'background:#fffbf0;' : '' }}"
           onmouseover="this.style.background='#faf8f4'" onmouseout="this.style.background='{{ !$msg->read_at ? '#fffbf0' : '' }}'">
            {{-- Avatar initiales --}}
            <div style="width:32px; height:32px; border-radius:50%; background:var(--green); color:#fff; display:flex; align-items:center; justify-content:center; font:700 12px Inter,sans-serif; flex-shrink:0;">
                {{ strtoupper(substr($msg->name, 0, 1)) }}
            </div>
            <div style="flex:1; min-width:0;">
                <div style="display:flex; align-items:center; gap:6px;">
                    <span style="font:600 13px Inter,sans-serif; color:var(--green);">{{ $msg->name }}</span>
                    @if(!$msg->read_at)<span style="width:6px;height:6px;border-radius:50%;background:var(--red);display:inline-block;"></span>@endif
                </div>
                <div style="font:12px Inter,sans-serif; color:var(--muted);">
                    {{ $msg->type }} · {{ $msg->created_at->diffForHumans() }}
                </div>
            </div>
        </a>
        @empty
        <div style="padding:20px; text-align:center; color:var(--muted); font-size:13px;">Aucun message</div>
        @endforelse
        <div style="padding:12px 20px; border-top:1px solid var(--line); background:#faf8f4;">
            <a href="{{ route('admin.messages.index') }}" style="font:600 12px Inter,sans-serif; color:var(--green);">
                Voir tous les messages →
            </a>
        </div>
    </div>

    {{-- ── Dernières candidatures ── --}}
    <div class="card">
        <div class="card-header">
            <h2>📋 Candidatures récentes</h2>
            @if($counts['applications_new'] > 0)
            <span class="badge badge-orange">{{ $counts['applications_new'] }} nou.</span>
            @endif
        </div>
        @forelse($recentApplications as $app)
        @php
            $statusColors = ['new'=>'badge-orange','reviewing'=>'badge-blue','interview'=>'badge-blue','accepted'=>'badge-green','rejected'=>'badge-gray'];
            $statusLabels = ['new'=>'Nouveau','reviewing'=>'Examen','interview'=>'Entretien','accepted'=>'Accepté','rejected'=>'Refusé'];
        @endphp
        <a href="{{ route('admin.applications.show', $app) }}"
           style="display:flex; align-items:flex-start; gap:12px; padding:12px 20px; border-bottom:1px solid #f5f0e8; transition:background .15s; text-decoration:none;"
           onmouseover="this.style.background='#faf8f4'" onmouseout="this.style.background=''">
            <div style="width:32px; height:32px; border-radius:50%; background:#dbeafe; color:#1e40af; display:flex; align-items:center; justify-content:center; font:700 12px Inter,sans-serif; flex-shrink:0;">
                {{ strtoupper(substr($app->first_name, 0, 1)) }}
            </div>
            <div style="flex:1; min-width:0;">
                <div style="font:600 13px Inter,sans-serif; color:var(--green); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ $app->first_name }} {{ $app->last_name }}
                </div>
                <div style="font:12px Inter,sans-serif; color:var(--muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ $app->jobOffer?->title ?? 'Candidature spontanée' }}
                </div>
            </div>
            <span class="badge {{ $statusColors[$app->status] ?? 'badge-gray' }}" style="flex-shrink:0; font-size:10px;">
                {{ $statusLabels[$app->status] ?? $app->status }}
            </span>
        </a>
        @empty
        <div style="padding:20px; text-align:center; color:var(--muted); font-size:13px;">Aucune candidature</div>
        @endforelse
        <div style="padding:12px 20px; border-top:1px solid var(--line); background:#faf8f4;">
            <a href="{{ route('admin.applications.index') }}" style="font:600 12px Inter,sans-serif; color:var(--green);">
                Voir toutes les candidatures →
            </a>
        </div>
    </div>

</div>

{{-- ══ Actions rapides ══════════════════════════════════════════ --}}
<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <h2>⚡ Actions rapides</h2>
        <span class="card-header-sub">Créer du contenu en un clic</span>
    </div>
    <div class="card-body">
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:12px;">
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                📰 Nouvelle actualité
            </a>
            <a href="{{ route('admin.jobs.create') }}" class="btn btn-gold">
                💼 Nouvelle offre d'emploi
            </a>
            <a href="{{ route('admin.reports.create') }}" class="btn btn-ghost">
                📄 Nouvelle publication
            </a>
            <a href="{{ route('admin.press.create') }}" class="btn btn-ghost">
                📢 Nouveau communiqué
            </a>
            <a href="{{ route('admin.media.create') }}" class="btn btn-ghost">
                🖼️ Ajouter un média
            </a>
            <a href="{{ route('admin.partners.create') }}" class="btn btn-ghost">
                🤝 Ajouter un partenaire
            </a>
        </div>
    </div>
</div>

{{-- Styles spécifiques dashboard --}}
<style>
@media(max-width:1200px){
    div[style*="grid-template-columns:1fr 1fr 1fr"] { grid-template-columns:1fr 1fr !important; }
}
@media(max-width:800px){
    div[style*="grid-template-columns:1fr 1fr 1fr"] { grid-template-columns:1fr !important; }
    div[style*="grid-template-columns:repeat(4,1fr)"] { grid-template-columns:1fr 1fr !important; }
    div[style*="grid-template-columns:repeat(3,1fr)"] { grid-template-columns:1fr 1fr !important; }
}
</style>

@endsection
