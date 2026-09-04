{{-- Page : Nos Communautés --}}
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sustainability-animations.css') }}">
@endpush

@section('content')
@php $sustainBase = $en ? route('english.sustainability') : route('sustainability'); @endphp

<style>
    /* Styles spécifiques communautés */
    .community-page section { position:relative; }
    .community-intro { padding-top:28px; }
    .community-panel { height:100%; padding:28px; background:rgba(255,255,255,.72); border:1px solid var(--line); border-top:3px solid var(--gold); border-radius:10px; box-shadow:0 10px 26px rgba(40,29,24,.06); transition:transform .3s ease, box-shadow .3s; }
    .community-panel:hover { transform:translateY(-4px); box-shadow:0 18px 40px rgba(40,29,24,.1); }
    .community-panel h3 { margin-bottom:12px; color:var(--green); }
    .community-panel p { line-height:1.75; }
    .community-image-card--panel { margin-top:24px; border:0; border-radius:8px; box-shadow:none; }
    .community-image-card--panel img { aspect-ratio:16/9; object-fit:cover; border-radius:8px; transition:transform .4s ease; }
    .community-image-card--panel:hover img { transform:scale(1.03); }
    .community-image-card--panel figcaption { padding:10px 0 0; font-size:13px; color:var(--muted); }
    .community-images-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 300px), 1fr)); gap:32px; max-width:1180px; margin:48px auto 0; }
    .community-image-card { margin:0; background:#fff; border-radius:12px; overflow:hidden; border:1px solid var(--line); box-shadow:0 8px 24px rgba(40,29,24,.08); transition:transform .3s ease, box-shadow .3s ease; }
    .community-image-card:hover { transform:translateY(-6px); box-shadow:0 16px 40px rgba(40,29,24,.14); }
    .community-image-card img { width:100%; height:auto; display:block; object-fit:cover; aspect-ratio:16/9; transition:transform .4s ease; }
    .community-image-card:hover img { transform:scale(1.04); }
    .community-image-card figcaption { padding:16px 20px; font-size:14px; line-height:1.6; color:var(--muted); }
    @media (max-width:700px) {
        .community-intro>.lead { font-size:16px; }
        .community-panel { padding:22px; }
        .community-images-grid { gap:24px; margin-top:32px; }
    }
</style>

<div class="community-page">

{{-- ── 1. Intro + Politique ─────────────────────────── --}}
<section class="sa-animated-section community-intro">
    <div class="sa-particles-container" data-count="5"></div>

    <div class="sa-section-heading sa-reveal" style="text-align:left; max-width:none; margin-bottom:32px;">
        <h2 style="color:var(--green); font-size:clamp(26px,4vw,42px); text-align:left;">
            {{ $en ? 'Community Relations Department: The Showcase of Karma' : 'Le Département des Relations Communautaires : La Vitrine de Karma' }}
        </h2>
    </div>

    <p class="lead sa-reveal sa-delay-1">
        {{ $en
            ? 'The Community Relations Department is an essential link in the management system of the Karma mine. It is responsible for implementing the company\'s community relations policy. As such, it acts as an interface between the mine and neighboring communities.'
            : 'Le Département des relations communautaires constitue un maillon essentiel dans le dispositif managérial de la mine de Karma. Il est chargé de la mise en œuvre de la politique des relations communautaires de la société. À ce titre, il joue le rôle d\'interface entre la mine et les communautés riveraines.'
        }}
    </p>

    <div class="grid-2 community-grid" style="align-items:stretch; gap:32px;">
        <div class="community-panel sa-reveal sa-delay-2">
            <h3>{{ $en ? 'Our Relational Strategy' : 'Notre Stratégie Relationnelle' }}</h3>
            <p>{{ $en ? 'Our strategy is based on the following principles:' : 'Notre stratégie est fondée sur les principes suivants :' }}</p>

            <ul class="sa-animated-list" style="font-size:15px; margin-top:16px;">
                <li>
                    <span class="sa-list-bullet">+</span>
                    <span>{{ $en ? 'Respect for the customs and traditions of communities' : 'Le respect des us et coutumes des communautés' }}</span>
                </li>
                <li>
                    <span class="sa-list-bullet">+</span>
                    <span>{{ $en ? 'Permanent dialogue: regular consultations with all stakeholders' : 'Le dialogue permanent : concertations régulières avec l\'ensemble des parties prenantes' }}</span>
                </li>
            </ul>

            {{-- Impact géographique --}}
            <div class="sa-step-card sa-reveal" data-step="44" style="margin-top:24px; background:var(--sand);">
                <h4 style="color:var(--green); margin-bottom:10px;">{{ $en ? 'Geographic Impact' : 'Impact Géographique' }}</h4>
                <p style="font-size:14px; margin:0;">
                    {{ $en
                        ? 'The Karma mine directly impacts 11 villages and indirectly affects 23 villages, for a total of 44 localities in its area of influence.'
                        : 'La mine de Karma impacte directement 11 villages et indirectement 23 villages, soit un total de 44 localités dans son rayon d\'influence.'
                    }}
                </p>
            </div>

            <figure class="community-image-card community-image-card--panel sa-reveal sa-delay-3">
                <picture>
                    <source srcset="{{ asset('images/communaute/forage-chateau-eau-solaire-namissiguima.webp') }}" type="image/webp">
                    <img src="{{ asset('images/communaute/forage-chateau-eau-solaire-namissiguima.png') }}"
                         alt="{{ $en ? 'Solar water tower in Namissiguima' : 'Château d\'eau solaire à Namissiguima' }}"
                         loading="lazy" />
                </picture>
                <figcaption>
                    {{ $en ? 'Solar water tower in Namissiguima' : 'Château d\'eau solaire à Namissiguima' }}
                </figcaption>
            </figure>
        </div>

        <div class="community-panel sa-reveal sa-delay-3">
            <h3>{{ $en ? 'Monitoring and Liaison Committee (CSL)' : 'Comité de Suivi et de Liaison (CSL)' }}</h3>
            <p>
                {{ $en
                    ? 'Created at the start of mine operations, the CSL is the consultation and dialogue framework par excellence that brings together all mine stakeholders. It holds two ordinary sessions per year.'
                    : 'Créé dès le démarrage des activités de la mine, le CSL est le cadre de concertation et de dialogue par excellence qui regroupe toutes les parties prenantes de la mine. Il tient deux sessions ordinaires dans l\'année.'
                }}
            </p>
            <p style="margin-top:16px;">
                {{ $en
                    ? 'In addition to this formalized structure, there are other frameworks that allow the mine to maintain periodic exchanges with specific social components such as customary and religious authorities, artisanal miners, and administrative authorities.'
                    : 'Parallèlement à cette structure formalisée, il existe d\'autres cadres qui permettent à la mine d\'entretenir des échanges périodiques avec certaines composantes sociales spécifiques.'
                }}
            </p>
            <p style="margin-top:16px; color:var(--muted); font-size:15px;">
                {{ $en
                    ? 'These regular exchanges strengthen trust, support peaceful coexistence and ensure that community concerns are considered in the mine\'s actions.'
                    : 'Ces échanges réguliers renforcent la confiance, favorisent une cohabitation pacifique et permettent de prendre en compte les préoccupations des communautés.'
                }}
            </p>

            <div class="card sa-glow-hover" style="background:#fff; border:1px solid var(--line); margin-top:24px;">
                <h4 style="color:var(--green); margin-bottom:12px;">{{ $en ? 'Intervention Areas' : 'Domaines d\'Intervention' }}</h4>
                <p style="margin-bottom:12px; font-size:14px;">{{ $en ? 'Our interventions focus on:' : 'Les interventions de la mine prennent en compte :' }}</p>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px;">
                    @foreach([
                        $en?'Education':'Éducation',
                        $en?'Health':'Santé',
                        $en?'Access to potable water':'Accès à l\'eau potable',
                        $en?'Women\'s empowerment':'Autonomisation des femmes',
                        $en?'Youth employability':'Employabilité des jeunes',
                    ] as $area)
                    <div style="display:flex; align-items:center; gap:8px; padding:8px; background:rgba(255,194,71,.06); border-radius:8px; font-size:13px; color:var(--muted);">
                        <span style="color:var(--gold2); font-weight:700;">✓</span>
                        {{ $area }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Photo CSL --}}
    <div class="community-images-grid">
        <figure class="community-image-card sa-reveal">
            <picture>
                <source srcset="{{ asset('images/communaute/session-comite-suivi-liaison-ouahigouya-2026.webp') }}" type="image/webp">
                <img src="{{ asset('images/communaute/session-comite-suivi-liaison-ouahigouya-2026.jpg') }}"
                     alt="{{ $en ? 'CSL session in Ouahigouya February 2026' : 'Session CSL à Ouahigouya février 2026' }}"
                     loading="lazy" />
            </picture>
            <figcaption>
                {{ $en ? 'CSL session in Ouahigouya - February 2026' : 'Session du CSL à Ouahigouya - Février 2026' }}
            </figcaption>
        </figure>
    </div>
</section>

{{-- ── 2. Réalisations 2014-2025 ─────────────────────── --}}
<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">

        <div class="sa-section-heading sa-reveal">
            <h2>{{ $en ? 'Main Achievements 2014-2025' : 'Principales Réalisations 2014-2025' }}</h2>
            <div class="sa-divider"></div>
            <p style="color:var(--muted); font-size:15px; line-height:1.8; margin:0;">
                {{ $en
                    ? 'All these actions are part of the State\'s economic, social and cultural development policy.'
                    : 'Toutes ces actions s\'inscrivent dans la politique de développement économique, social et culturel de l\'État.'
                }}
            </p>
        </div>

        @php
            $achievements = [
                ['icon'=>'🎓','title'=>$en?'Education':'Éducation','amount'=>$en?'Nearly 150M FCFA':'Près de 150M FCFA','items'=>$en?['Construction and rehabilitation of schools','Solar electrification','Provision of school furniture','Promotion of excellence','Improvement of learning conditions']:['Construction et réhabilitation d\'écoles','Électrification solaire','Dotation en mobilier scolaire','Promotion de l\'excellence','Amélioration des conditions d\'apprentissage']],
                ['icon'=>'🏥','title'=>$en?'Health':'Santé','amount'=>$en?'More than 160M FCFA':'Plus de 160M FCFA','items'=>$en?['Construction and equipment of Namissiguima CSPS','Provision of ambulances','Rehabilitation of Kononga CSPS']:['Construction et équipement du CSPS de Namissiguima','Mise à disposition d\'ambulances','Réhabilitation du CSPS de Kononga']],
                ['icon'=>'💧','title'=>$en?'Access to Water':'Accès à l\'Eau','amount'=>$en?'More than 240M FCFA':'Plus de 240M FCFA','items'=>$en?['Construction of wells and boreholes','Pastoral boreholes','Water reservoirs','Water towers and potable water supply systems']:['Réalisation de puits et forages','Forages pastoraux','Retenues d\'eau','Châteaux d\'eau et systèmes d\'adduction d\'eau potable']],
                ['icon'=>'🌾','title'=>$en?'Livelihoods & Economic Development':'Moyens de Subsistance & Développement Économique','amount'=>$en?'More than 350M FCFA':'Plus de 350M FCFA','items'=>$en?['Support to Project Affected Persons (PAP)','Agricultural inputs','Professional training','Market gardening and livestock','Income generating activities']:['Appui aux Personnes Affectées par le Projet','Intrants agricoles','Formations professionnelles','Maraîchage et élevage','Activités génératrices de revenus']],
                ['icon'=>'🛣️','title'=>$en?'Infrastructure & Accessibility':'Infrastructures & Désenclavement','amount'=>$en?'More than 519M FCFA':'Plus de 519M FCFA','items'=>$en?['Paving of 7.5 km of RD149 road','Associated sanitation works','Improved mobility and reduced dust nuisances']:['Bitumage de 7,5 km de la RD149','Travaux d\'assainissement associés','Forte amélioration de la mobilité et réduction des nuisances de poussière']],
            ];
        @endphp

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px,1fr)); gap:24px; margin-top:48px;">
            @foreach($achievements as $k => $ach)
            <div class="sa-achievement-card sa-reveal sa-delay-{{ $k+1 }}">
                <div class="sa-category-icon">{{ $ach['icon'] }}</div>
                <h3 style="color:var(--green); font-size:18px; margin-bottom:12px;">{{ $ach['title'] }}</h3>
                <div class="sa-achievement-amount">{{ $ach['amount'] }}</div>
                <ul class="sa-animated-list" style="margin-top:12px;">
                    @foreach($ach['items'] as $item)
                    <li>
                        <span class="sa-list-bullet" style="font-size:11px;">•</span>
                        <span style="font-size:13px; color:var(--muted); line-height:1.6;">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>

        {{-- Total Investment Banner --}}
        <div class="sa-total-banner sa-reveal">
            <div class="sa-particles-container" data-count="4"></div>
            <div class="sa-total-label">{{ $en ? 'Total Community Investment 2014-2025' : 'Investissement Communautaire Total 2014-2025' }}</div>
            <div class="sa-total-value">1.419 {{ $en ? 'Billion' : 'Milliard' }} FCFA</div>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

{{-- ── 3. Impact Communautaire 2024 ─────────────────── --}}
<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2>{{ $en ? 'Community Impact 2024' : 'Impact Communautaire 2024' }}</h2>
            <div class="sa-divider"></div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:20px; margin-top:40px;">
            @php
                $impacts = [
                    ['val'=>'850','count'=>850,'suffix'=>'','label'=>$en?'Students in Programs':'Étudiants en Programmes','icon'=>'🎓','bar'=>'85%'],
                    ['val'=>'12','count'=>12,'suffix'=>'','label'=>$en?'Healthcare Clinics':'Cliniques Santé','icon'=>'🏥','bar'=>'60%'],
                    ['val'=>'85%','count'=>85,'suffix'=>'%','label'=>$en?'Grievances Resolved':'Griefs Résolus','icon'=>'🤝','bar'=>'85%'],
                    ['val'=>'42km','count'=>42,'suffix'=>'km','label'=>$en?'Roads Built/Maintained':'Routes Construites/Entretenues','icon'=>'🛣️','bar'=>'70%'],
                ];
            @endphp
            @foreach($impacts as $k => $imp)
            <div class="sa-metric-card sa-reveal sa-delay-{{ $k+1 }}">
                <div style="font-size:28px; margin-bottom:8px;">{{ $imp['icon'] }}</div>
                <div class="sa-metric-value sustain-metric__value community-stat"
                     data-count="{{ $imp['count'] }}"
                     data-suffix="{{ $imp['suffix'] }}"
                     data-original="{{ $imp['val'] }}">{{ $imp['val'] }}</div>
                <div style="font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; margin-top:8px; line-height:1.4;">{{ $imp['label'] }}</div>
                <div class="sa-progress-bar" style="margin-top:12px;">
                    <div class="sa-progress-fill" data-width="{{ $imp['bar'] }}"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── 4. Projets FMD ────────────────────────────────── --}}
<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <p class="lead sa-reveal">{{ __('site.communities_fmd_lead', [], $loc) }}</p>
    <h3 class="sa-reveal sa-delay-1" style="margin-bottom:24px;">{{ __('site.communities_fmd_projects_h3', [], $loc) }}</h3>
    <div class="grid-2" style="margin-top:24px;">
        @foreach(range(1, 4) as $i)
        <div class="sa-program-card sa-reveal sa-delay-{{ $i }}">
            <div class="card-tag">{{ __('site.communities_fmd_proj'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.communities_fmd_proj'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_fmd_proj'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
    <div class="sa-wave-bottom"></div>
</section>

{{-- ── 5. Nos Programmes ─────────────────────────────── --}}
<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2>{{ $en ? 'Our Programs' : 'Nos Programmes' }}</h2>
            <div class="sa-divider"></div>
        </div>
        <div class="grid-3" style="margin-top:48px;">
            @php
                $programs = [
                    ['icon'=>'📚','title'=>$en?'Education Initiative':'Initiative Éducation','items'=>$en?['850+ students in scholarship programs','Technical vocational training','Teacher development programs','School infrastructure improvements']:['850+ étudiants en bourses','Formation technique professionnelle','Programmes développement enseignants','Améliorations infrastructures scolaires']],
                    ['icon'=>'💊','title'=>$en?'Healthcare Program':'Programme Santé','items'=>$en?['12 community health clinics','Free medical consultations','Maternal & child health focus','Nutritional support programs']:['12 cliniques santé communautaire','Consultations médicales gratuites','Focus santé maternelle & infantile','Programmes soutien nutritionnel']],
                    ['icon'=>'🏗️','title'=>$en?'Infrastructure Development':'Développement Infrastructures','items'=>$en?['42km of roads built/maintained','Water supply systems','Electricity access expansion','Market and community centers']:['42km routes construites/entretenues','Systèmes approvisionnement eau','Expansion accès électricité','Marchés et centres communautaires']],
                ];
            @endphp
            @foreach($programs as $k => $prog)
            <div class="sa-program-card sa-reveal sa-delay-{{ $k+1 }}">
                <div style="font-size:36px; margin-bottom:14px;">{{ $prog['icon'] }}</div>
                <h3 style="color:var(--green); margin-bottom:14px; font-size:17px;">{{ $prog['title'] }}</h3>
                <ul class="sa-animated-list">
                    @foreach($prog['items'] as $item)
                    <li>
                        <span class="sa-list-bullet" style="font-size:11px;">✓</span>
                        <span style="font-size:13px; color:var(--muted); line-height:1.6;">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── 6. Mécanisme de gestion des plaintes ──────────── --}}
<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div class="sa-section-heading sa-reveal" style="margin-bottom:32px;">
        <h2>{{ $en ? 'Grievance and Conflict Management' : 'Mécanisme de Gestion des Plaintes et des Conflits' }}</h2>
        <div class="sa-divider"></div>
    </div>
    <p class="lead sa-reveal sa-delay-1">
        {{ $en
            ? 'In order to cultivate and maintain peaceful and harmonious relations with communities, the mine has developed grievance and conflict management mechanisms. These systems prioritize dialogue, respect and transparency.'
            : 'Dans l\'objectif de cultiver et d\'entretenir des relations pacifiques et harmonieuses avec les communautés, la mine a élaboré des mécanismes de gestion des plaintes et des conflits. Ces dispositifs privilégient le dialogue, le respect et la transparence.'
        }}
    </p>
    <div class="grid-3" style="margin-top:16px;">
        @foreach(range(1, 3) as $i)
        <div class="sa-step-card sa-reveal sa-delay-{{ $i }}" data-step="{{ $i }}">
            <div class="card-tag">{{ __('site.communities_step'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.communities_step'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_step'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
    <div class="sa-wave-bottom"></div>
</section>

{{-- ── 7. Carte des villages ─────────────────────────── --}}
<section class="sa-animated-section" style="padding:70px 5vw;">
    <p class="lead sa-reveal">{{ __('site.communities_map_lead', [], $loc) }}</p>
    <div class="grid-2" style="margin-top:24px;">
        <div class="map-wrap sa-reveal sa-delay-1">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125836.0!2d-2.2!3d13.63!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMine+de+Karma!5e0!3m2!1s{{ $loc }}!2sbf!4v1"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="{{ $en ? 'Map of impacted villages' : 'Carte des villages impactés' }}">
            </iframe>
        </div>
        <div class="sa-partner-card sa-reveal sa-delay-2" style="align-self:start;">
            <div class="card-tag">{{ $en ? 'Surrounding villages' : 'Villages riverains' }}</div>
            <p>{{ __('site.communities_map_note', [], $loc) }}</p>
            <p style="margin-top:16px; padding-top:16px; border-top:1px solid var(--line); font-size:13px; color:var(--muted);">
                {{ __('site.communities_map_soon', [], $loc) }}
            </p>
        </div>
    </div>
</section>

{{-- ── 8. Partenaires communautaires ─────────────────── --}}
<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <p class="lead sa-reveal">{{ __('site.communities_partners_p', [], $loc) }}</p>
    <h3 class="sa-reveal sa-delay-1" style="margin-bottom:24px;">{{ __('site.communities_partners_types_h3', [], $loc) }}</h3>
    <div class="grid-2" style="margin-top:16px;">
        @foreach(range(1, 4) as $i)
        <div class="sa-partner-card sa-reveal sa-delay-{{ $i }}">
            <div class="card-tag">{{ __('site.communities_partner'.$i.'_tag', [], $loc) }}</div>
            <p>{{ __('site.communities_partner'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
    <div class="sa-wave-bottom"></div>
</section>

</div>

@push('scripts')
<script src="{{ asset('js/sustainability-animations.js') }}"></script>
@endpush

@endsection
