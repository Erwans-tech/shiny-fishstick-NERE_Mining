@extends('admin.partials.layout')
@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')

{{-- ══ Santé du site — indicateur rapide ═══════════════════════ --}}
@php
    $healthScore = collect($siteHealth)->filter()->count();
    $healthTotal = count($siteHealth);
    $healthPercent = round(($healthScore / $healthTotal) * 100);
    $healthColor = $healthPercent >= 75 ? '#10b981' : ($healthPercent >= 50 ? '#f59e0b' : '#ef4444');
@endphp

<div style="display:grid; grid-template-columns:2fr 1fr; gap:16px; margin-bottom:20px;">
    {{-- Santé du site --}}
    <div class="card">
        <div class="card-body" style="padding:20px;">
            <div style="display:flex; align-items:center; gap:16px;">
                <div style="position:relative; width:70px; height:70px;">
                    <svg width="70" height="70" style="transform:rotate(-90deg);">
                        <circle cx="35" cy="35" r="30" fill="none" stroke="#f5f0e8" stroke-width="8"/>
                        <circle cx="35" cy="35" r="30" fill="none" stroke="{{ $healthColor }}" stroke-width="8"
                                stroke-dasharray="{{ 188.4 * $healthPercent / 100 }} 188.4"
                                stroke-linecap="round"/>
                    </svg>
                    <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font:700 18px Inter,sans-serif; color:{{ $healthColor }};">
                        {{ $healthPercent }}%
                    </div>
                </div>
                <div style="flex:1;">
                    <h3 style="font:700 18px Inter,sans-serif; color:var(--ink); margin:0 0 6px;">
                        Santé du site
                    </h3>
                    <div style="font:13px Inter,sans-serif; color:var(--muted); line-height:1.5;">
                        {{ $healthScore }}/{{ $healthTotal }} éléments actifs
                    </div>
                    <div style="display:flex; gap:6px; margin-top:8px; flex-wrap:wrap;">
                        <span class="badge {{ $siteHealth['hero_active'] ? 'badge-green' : 'badge-gray' }}" style="font-size:10px;">
                            {{ $siteHealth['hero_active'] ? '✓' : '✗' }} Carrousel
                        </span>
                        <span class="badge {{ $siteHealth['jobs_active'] ? 'badge-green' : 'badge-gray' }}" style="font-size:10px;">
                            {{ $siteHealth['jobs_active'] ? '✓' : '✗' }} Offres d'emploi
                        </span>
                        <span class="badge {{ $siteHealth['news_recent'] ? 'badge-green' : 'badge-gray' }}" style="font-size:10px;">
                            {{ $siteHealth['news_recent'] ? '✓' : '✗' }} Actus récentes
                        </span>
                        <span class="badge {{ $siteHealth['partners_visible'] ? 'badge-green' : 'badge-gray' }}" style="font-size:10px;">
                            {{ $siteHealth['partners_visible'] ? '✓' : '✗' }} Partenaires
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Accès rapide au site --}}
    <div class="card">
        <div class="card-body" style="padding:20px; display:flex; flex-direction:column; justify-content:center; gap:10px;">
            <a href="/" target="_blank" class="btn btn-primary" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span style="font-size:16px;">🌐</span>
                Voir le site public
            </a>
            <a href="{{ route('admin.settings.index') }}" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span style="font-size:14px;">⚙️</span>
                Paramètres
            </a>
        </div>
    </div>
</div>

{{-- ══ Alertes urgentes ════════════════════════════════════════ --}}
@if($counts['messages'] > 0 || $counts['applications_new'] > 0 || $expiringJobs->isNotEmpty())
<div style="display:flex; flex-direction:column; gap:8px; margin-bottom:24px;">
    @if($counts['messages'] > 0)
    <a href="{{ route('admin.messages.index') }}"
       style="display:flex; align-items:center; gap:12px; padding:14px 18px; background:#fee2e2; border:1px solid #fecaca; border-radius:10px; color:#991b1b; font:500 14px Inter,sans-serif; text-decoration:none; transition:all .2s;"
       onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
        <span style="font-size:20px;">✉️</span>
        <div style="flex:1;">
            <strong>{{ $counts['messages'] }} message(s) non lu(s)</strong>
            <div style="font-size:12px; opacity:.8; margin-top:2px;">Répondez rapidement pour maintenir une bonne relation</div>
        </div>
        <span style="font-size:18px;">→</span>
    </a>
    @endif
    
    @if($counts['applications_new'] > 0)
    <a href="{{ route('admin.applications.index') }}"
       style="display:flex; align-items:center; gap:12px; padding:14px 18px; background:#fef9c3; border:1px solid #fde68a; border-radius:10px; color:#854d0e; font:500 14px Inter,sans-serif; text-decoration:none; transition:all .2s;"
       onmouseover="this.style.background='#fde68a'" onmouseout="this.style.background='#fef9c3'">
        <span style="font-size:20px;">📋</span>
        <div style="flex:1;">
            <strong>{{ $counts['applications_new'] }} nouvelle(s) candidature(s)</strong>
            <div style="font-size:12px; opacity:.8; margin-top:2px;">À examiner rapidement pour ne pas perdre de talents</div>
        </div>
        <span style="font-size:18px;">→</span>
    </a>
    @endif
    
    @foreach($expiringJobs as $job)
    <div style="display:flex; align-items:center; gap:12px; padding:14px 18px; background:#ffedd5; border:1px solid #fed7aa; border-radius:10px; color:#9a3412; font:500 14px Inter,sans-serif;">
        <span style="font-size:20px;">⏰</span>
        <div style="flex:1;">
            <strong>{{ $job->title }}</strong> expire le {{ $job->deadline->format('d/m/Y') }}
            <div style="font-size:12px; opacity:.8; margin-top:2px;">{{ $job->deadline->diffForHumans() }}</div>
        </div>
        <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-sm" style="background:#fff; color:#9a3412; border:1px solid #fed7aa;">
            Modifier
        </a>
    </div>
    @endforeach
</div>
@endif

{{-- ══ KPIs principaux avec tendances ══════════════════════════ --}}
<div class="stat-grid" style="margin-bottom:28px;">

    <a href="{{ route('admin.news.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon stat-tile-icon--blue">📰</div>
        <div class="stat-tile-body">
            <div style="display:flex; align-items:baseline; gap:8px;">
                <div class="stat-tile-num">{{ $counts['news'] }}</div>
                @if($trends['news']['direction'] !== 'stable')
                <span style="font:600 11px Inter,sans-serif; color:{{ $trends['news']['direction'] === 'up' ? '#10b981' : '#ef4444' }};">
                    {{ $trends['news']['direction'] === 'up' ? '↗' : '↘' }} {{ abs($trends['news']['percent']) }}%
                </span>
                @endif
            </div>
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
            <div style="display:flex; align-items:baseline; gap:8px;">
                <div class="stat-tile-num">{{ $counts['applications'] }}</div>
                @if($trends['applications']['direction'] !== 'stable')
                <span style="font:600 11px Inter,sans-serif; color:{{ $trends['applications']['direction'] === 'up' ? '#10b981' : '#ef4444' }};">
                    {{ $trends['applications']['direction'] === 'up' ? '↗' : '↘' }} {{ abs($trends['applications']['percent']) }}%
                </span>
                @endif
            </div>
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
            <div style="display:flex; align-items:baseline; gap:8px;">
                <div class="stat-tile-num">{{ $counts['messages'] }}</div>
                @if($trends['messages']['direction'] !== 'stable')
                <span style="font:600 11px Inter,sans-serif; color:{{ $trends['messages']['direction'] === 'up' ? '#10b981' : '#ef4444' }};">
                    {{ $trends['messages']['direction'] === 'up' ? '↗' : '↘' }} {{ abs($trends['messages']['percent']) }}%
                </span>
                @endif
            </div>
            <div class="stat-tile-lbl">Messages non lus</div>
            <div class="stat-tile-sub">{{ $counts['messages_total'] }} au total</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

</div>

{{-- ══ Graphique d'activité 7 derniers jours ═══════════════════ --}}
<div class="card" style="margin-bottom:28px;">
    <div class="card-header">
        <h2>📊 Activité des 7 derniers jours</h2>
        <span class="card-header-sub">Évolution quotidienne du contenu</span>
    </div>
    <div class="card-body" style="padding:24px;">
        <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:12px; margin-bottom:16px;">
            @foreach($last7Days as $day)
            <div style="display:flex; flex-direction:column; gap:6px; align-items:center;">
                <div style="font:600 11px Inter,sans-serif; color:var(--muted); text-transform:uppercase; letter-spacing:.05em;">
                    {{ $day['day'] }}
                </div>
                <div style="font:700 13px Inter,sans-serif; color:var(--ink); margin-bottom:4px;">
                    {{ $day['date'] }}
                </div>
                
                @php
                    $maxHeight = 80;
                    $maxValue = max(1, $last7Days->max('news'), $last7Days->max('applications'), $last7Days->max('messages'));
                    $newsHeight = $day['news'] > 0 ? max(4, ($day['news'] / $maxValue) * $maxHeight) : 0;
                    $appHeight = $day['applications'] > 0 ? max(4, ($day['applications'] / $maxValue) * $maxHeight) : 0;
                    $msgHeight = $day['messages'] > 0 ? max(4, ($day['messages'] / $maxValue) * $maxHeight) : 0;
                @endphp
                
                <div style="display:flex; align-items:flex-end; gap:3px; height:{{ $maxHeight }}px;">
                    <div style="width:14px; height:{{ $newsHeight }}px; background:#3b82f6; border-radius:3px 3px 0 0;" 
                         title="Actualités: {{ $day['news'] }}"></div>
                    <div style="width:14px; height:{{ $appHeight }}px; background:#10b981; border-radius:3px 3px 0 0;" 
                         title="Candidatures: {{ $day['applications'] }}"></div>
                    <div style="width:14px; height:{{ $msgHeight }}px; background:#f59e0b; border-radius:3px 3px 0 0;" 
                         title="Messages: {{ $day['messages'] }}"></div>
                </div>
                
                <div style="font:600 10px Inter,sans-serif; color:var(--muted);">
                    {{ $day['news'] + $day['applications'] + $day['messages'] }}
                </div>
            </div>
            @endforeach
        </div>
        
        <div style="display:flex; justify-content:center; gap:20px; padding-top:12px; border-top:1px solid var(--line);">
            <div style="display:flex; align-items:center; gap:6px; font:12px Inter,sans-serif; color:var(--muted);">
                <div style="width:12px; height:12px; background:#3b82f6; border-radius:2px;"></div>
                Actualités ({{ $trends['news']['current'] }})
            </div>
            <div style="display:flex; align-items:center; gap:6px; font:12px Inter,sans-serif; color:var(--muted);">
                <div style="width:12px; height:12px; background:#10b981; border-radius:2px;"></div>
                Candidatures ({{ $trends['applications']['current'] }})
            </div>
            <div style="display:flex; align-items:center; gap:6px; font:12px Inter,sans-serif; color:var(--muted);">
                <div style="width:12px; height:12px; background:#f59e0b; border-radius:2px;"></div>
                Messages ({{ $trends['messages']['current'] }})
            </div>
        </div>
    </div>
</div>

{{-- ══ Statistiques candidatures ═══════════════════════════════ --}}
@if(!empty($applicationStats))
<div class="card" style="margin-bottom:28px;">
    <div class="card-header">
        <h2>📋 Répartition des candidatures</h2>
        <a href="{{ route('admin.applications.index') }}" class="btn btn-ghost btn-sm">Voir tout →</a>
    </div>
    <div class="card-body" style="padding:24px;">
        @php
            $statusLabels = [
                'new' => ['label' => 'Nouvelles', 'color' => '#f59e0b', 'icon' => '🆕'],
                'reviewing' => ['label' => 'En examen', 'color' => '#3b82f6', 'icon' => '👀'],
                'interview' => ['label' => 'Entretien', 'color' => '#8b5cf6', 'icon' => '💬'],
                'accepted' => ['label' => 'Acceptées', 'color' => '#10b981', 'icon' => '✅'],
                'rejected' => ['label' => 'Refusées', 'color' => '#6b7280', 'icon' => '❌']
            ];
            $totalApps = array_sum($applicationStats);
        @endphp
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(140px, 1fr)); gap:16px;">
            @foreach($statusLabels as $status => $info)
                @php $count = $applicationStats[$status] ?? 0; @endphp
                <div style="text-align:center; padding:16px; border:2px solid {{ $count > 0 ? $info['color'] : '#e5e7eb' }}; border-radius:10px; background:{{ $count > 0 ? $info['color'].'15' : '#fafafa' }};">
                    <div style="font-size:24px; margin-bottom:8px;">{{ $info['icon'] }}</div>
                    <div style="font:700 28px Inter,sans-serif; color:{{ $info['color'] }}; margin-bottom:4px;">
                        {{ $count }}
                    </div>
                    <div style="font:600 12px Inter,sans-serif; color:var(--muted); text-transform:uppercase; letter-spacing:.05em;">
                        {{ $info['label'] }}
                    </div>
                    @if($totalApps > 0)
                    <div style="font:11px Inter,sans-serif; color:var(--muted); margin-top:4px;">
                        {{ round(($count / $totalApps) * 100) }}%
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- ══ Ressources rapides — grille compacte ════════════════════ --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-bottom:28px;">
    <a href="{{ route('admin.hero.index') }}" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">🎬</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;">{{ $counts['hero_slides'] ?? 0 }}</div>
            <div class="stat-tile-lbl" style="font-size:11px;">Carrousel</div>
        </div>
    </a>
    <a href="{{ route('admin.reports.index') }}" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">📄</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;">{{ $counts['reports'] }}</div>
            <div class="stat-tile-lbl" style="font-size:11px;">Publications</div>
        </div>
    </a>
    <a href="{{ route('admin.press.index') }}" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">📢</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;">{{ $counts['press'] }}</div>
            <div class="stat-tile-lbl" style="font-size:11px;">Communiqués</div>
        </div>
    </a>
    <a href="{{ route('admin.media.index') }}" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">🖼️</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;">{{ $counts['media'] }}</div>
            <div class="stat-tile-lbl" style="font-size:11px;">Médias</div>
        </div>
    </a>
    <a href="{{ route('admin.newsletter.index') }}" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">📧</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;">{{ $counts['newsletter'] ?? 0 }}</div>
            <div class="stat-tile-lbl" style="font-size:11px;">Abonnés</div>
        </div>
    </a>
    <a href="{{ route('admin.certifications.index') }}" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">🏆</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;">{{ $counts['certifications'] ?? 0 }}</div>
            <div class="stat-tile-lbl" style="font-size:11px;">Certifications</div>
        </div>
    </a>
    <a href="{{ route('admin.partners.index') }}" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">🤝</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;">{{ $counts['partners'] }}</div>
            <div class="stat-tile-lbl" style="font-size:11px;">Partenaires</div>
        </div>
    </a>
    <a href="{{ route('admin.settings.index') }}" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">⚙️</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;">∞</div>
            <div class="stat-tile-lbl" style="font-size:11px;">Paramètres</div>
        </div>
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
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>📰</span> Nouvelle actualité
            </a>
            <a href="{{ route('admin.jobs.create') }}" class="btn btn-gold" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>💼</span> Nouvelle offre d'emploi
            </a>
            <a href="{{ route('admin.reports.create') }}" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>📄</span> Nouvelle publication
            </a>
            <a href="{{ route('admin.press.create') }}" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>📢</span> Nouveau communiqué
            </a>
            <a href="{{ route('admin.media.create') }}" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>🖼️</span> Ajouter un média
            </a>
            <a href="{{ route('admin.partners.create') }}" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>🤝</span> Ajouter un partenaire
            </a>
        </div>
    </div>
</div>

{{-- ══ Raccourcis clavier ═══════════════════════════════════════ --}}
<script>
document.addEventListener('keydown', function(e) {
    // Alt + N : Nouvelle actualité
    if (e.altKey && e.key === 'n') {
        e.preventDefault();
        window.location.href = '{{ route("admin.news.create") }}';
    }
    // Alt + J : Nouvelle offre d'emploi
    if (e.altKey && e.key === 'j') {
        e.preventDefault();
        window.location.href = '{{ route("admin.jobs.create") }}';
    }
    // Alt + M : Messages
    if (e.altKey && e.key === 'm') {
        e.preventDefault();
        window.location.href = '{{ route("admin.messages.index") }}';
    }
    // Alt + C : Candidatures
    if (e.altKey && e.key === 'c') {
        e.preventDefault();
        window.location.href = '{{ route("admin.applications.index") }}';
    }
});
</script>

{{-- Styles spécifiques dashboard --}}
<style>
.stat-tile--compact {
    padding: 16px 14px !important;
    min-height: auto !important;
}
.stat-tile--compact .stat-tile-arrow {
    display: none;
}

@media(max-width:1200px){
    div[style*="grid-template-columns:1fr 1fr 1fr"] { grid-template-columns:1fr 1fr !important; }
    div[style*="grid-template-columns:2fr 1fr"] { grid-template-columns:1fr !important; }
}
@media(max-width:800px){
    div[style*="grid-template-columns:1fr 1fr 1fr"] { grid-template-columns:1fr !important; }
    div[style*="grid-template-columns:repeat(4,1fr)"] { grid-template-columns:1fr 1fr !important; }
    div[style*="grid-template-columns:repeat(3,1fr)"] { grid-template-columns:1fr 1fr !important; }
}
</style>

@endsection
