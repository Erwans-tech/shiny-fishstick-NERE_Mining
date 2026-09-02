{{-- Page : Nos Communautés --}}
@extends('layouts.app')

@section('content')
@php $sustainBase = $en ? route('english.sustainability') : route('sustainability'); @endphp

{{-- ── 1. Politique + Dialogue ─────────────────────────── --}}
<section>
    <div class="sub-nav">
        <a href="{{ $sustainBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}" class="active">{{ __('site.subnav_communities', [], $loc) }}</a>
        <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
        <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
        <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
    </div>

    <h2 style="color:var(--green); margin-bottom:20px; font-size:32px;">{{ $en ? 'Community Relations Department: The Showcase of Karma' : 'Le Département des Relations Communautaires : La Vitrine de Karma' }}</h2>

    <p class="lead">
        {{ $en 
            ? 'The Community Relations Department is an essential link in the management system of the Karma mine. It is responsible for implementing the company\'s community relations policy. As such, it acts as an interface between the mine and neighboring communities.' 
            : 'Le Département des relations communautaires constitue un maillon essentiel dans le dispositif managérial de la mine de Karma. Il est chargé de la mise en œuvre de la politique des relations communautaires de la société. À ce titre, il joue le rôle d\'interface entre la mine et les communautés riveraines.' 
        }}
    </p>

    <div class="grid-2">
        <div>
            {{-- Principes stratégiques --}}
            <h3>{{ $en ? 'Our Relational Strategy' : 'Notre Stratégie Relationnelle' }}</h3>
            <p>{{ $en ? 'Our strategy is based on the following principles:' : 'Notre stratégie est fondée sur les principes suivants :' }}</p>
            <ul style="list-style:none; padding:0; margin:16px 0; font-size:15px; line-height:1.8;">
                <li style="margin-bottom:12px; padding-left:24px; position:relative;">
                    <span style="position:absolute; left:0; color:var(--gold);">✓</span>
                    {{ $en ? 'Respect for the customs and traditions of communities' : 'Le respect des us et coutumes des communautés' }}
                </li>
                <li style="padding-left:24px; position:relative;">
                    <span style="position:absolute; left:0; color:var(--gold);">✓</span>
                    {{ $en ? 'Permanent dialogue: regular consultations with all stakeholders (customary, religious and administrative authorities, economic actors, civil society actors, artisanal miners)' : 'Le dialogue permanent : concertations régulières avec l\'ensemble des parties prenantes (autorités coutumières et religieuses et administratives, économiques, acteurs de la société civile artisans miniers)' }}
                </li>
            </ul>

            {{-- Impact géographique --}}
            <div class="card" style="background:var(--sand); border:1px solid var(--line); margin-top:24px;">
                <h4 style="color:var(--green); margin-bottom:12px;">{{ $en ? 'Geographic Impact' : 'Impact Géographique' }}</h4>
                <p>
                    {{ $en 
                        ? 'The Karma mine directly impacts 11 villages and indirectly affects 23 villages, for a total of 44 localities in its area of influence.' 
                        : 'La mine de Karma impacte directement 11 villages et indirectement 23 villages, soit un total de 44 localités dans son rayon d\'influence.' 
                    }}
                </p>
            </div>
        </div>
        <div>
            {{-- Comité de suivi --}}
            <h3>{{ $en ? 'Monitoring and Liaison Committee (CSL)' : 'Comité de Suivi et de Liaison (CSL)' }}</h3>
            <p>
                {{ $en 
                    ? 'Created at the start of mine operations, the CSL is the consultation and dialogue framework par excellence that brings together all mine stakeholders. It holds two ordinary sessions per year.' 
                    : 'Créé dès le démarrage des activités de la mine, le comité de suivi et de liaison (CSL) est le cadre de concertation et de dialogue par excellence qui regroupe toutes les parties prenantes de la mine. Il tient deux sessions ordinaires dans l\'année.' 
                }}
            </p>
            <p style="margin-top:16px;">
                {{ $en 
                    ? 'In addition to this formalized structure, there are other frameworks that allow the mine to maintain periodic exchanges with specific social components such as customary and religious authorities, artisanal miners, and administrative authorities.' 
                    : 'Parallèlement à cette structure formalisée, il existe d\'autres cadres qui permettent à la mine d\'entretenir des échanges périodiques avec certaines composantes sociales spécifiques tels que les autorités coutumières et religieuses, les artisans miniers et les autorités administratives.' 
                }}
            </p>
            <p style="margin-top:16px; color:var(--muted);">
                {{ $en
                    ? 'These regular exchanges strengthen trust, support peaceful coexistence and ensure that community concerns are considered in the mine\'s actions.'
                    : 'Ces échanges réguliers renforcent la confiance, favorisent une cohabitation pacifique et permettent de prendre en compte les préoccupations des communautés dans les actions de la mine.'
                }}
            </p>

            {{-- Domaines d'intervention --}}
            <div class="card" style="background:#fff; border:1px solid var(--line); margin-top:24px;">
                <h4 style="color:var(--green); margin-bottom:12px;">{{ $en ? 'Intervention Areas' : 'Domaines d\'Intervention' }}</h4>
                <p style="margin-bottom:12px;">{{ $en ? 'Our interventions focus on:' : 'Les interventions de la mine prennent en compte :' }}</p>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8;">
                    <li style="padding-left:20px; position:relative; margin-bottom:8px;">
                        <span style="position:absolute; left:0;">🎓</span> {{ $en ? 'Education' : 'Éducation' }}
                    </li>
                    <li style="padding-left:20px; position:relative; margin-bottom:8px;">
                        <span style="position:absolute; left:0;">🏥</span> {{ $en ? 'Health' : 'Santé' }}
                    </li>
                    <li style="padding-left:20px; position:relative; margin-bottom:8px;">
                        <span style="position:absolute; left:0;">💧</span> {{ $en ? 'Access to potable water' : 'Accès à l\'eau potable' }}
                    </li>
                    <li style="padding-left:20px; position:relative; margin-bottom:8px;">
                        <span style="position:absolute; left:0;">👩</span> {{ $en ? 'Women\'s empowerment' : 'Autonomisation des femmes' }}
                    </li>
                    <li style="padding-left:20px; position:relative;">
                        <span style="position:absolute; left:0;">👨‍💼</span> {{ $en ? 'Youth employability' : 'Employabilité des jeunes' }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ── 1b. Main Achievements 2014-2025 ───────────────────── --}}
<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;">{{ $en ? 'Main Achievements 2014-2025' : 'Principales Réalisations 2014-2025' }}</h2>
        <p style="text-align:center; color:var(--muted); font-size:15px; margin-bottom:40px; line-height:1.8;">
            {{ $en 
                ? 'All these actions are part of the State\'s economic, social and cultural development policy.' 
                : 'Toutes ces actions s\'inscrivent dans la politique de développement économique, social et culturel de l\'État.' 
            }}
        </p>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:24px;">
            {{-- Éducation --}}
            <div style="background:#fff; padding:32px; border-radius:12px; border:1px solid var(--line);">
                <div style="font-size:24px; margin-bottom:12px;">🎓</div>
                <h3 style="color:var(--green); font-size:20px; margin-bottom:16px;">{{ $en ? 'Education' : 'Éducation' }}</h3>
                <div style="font-size:28px; font-weight:700; color:var(--gold); margin-bottom:12px;">{{ $en ? 'Nearly 150M FCFA' : 'Près de 150M FCFA' }}</div>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:8px;">• {{ $en ? 'Construction and rehabilitation of schools' : 'Construction et réhabilitation d\'écoles' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Solar electrification' : 'Électrification solaire' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Provision of school furniture' : 'Dotation en mobilier scolaire' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Promotion of excellence' : 'Promotion de l\'excellence' }}</li>
                    <li>• {{ $en ? 'Improvement of learning conditions' : 'Amélioration des conditions d\'apprentissage' }}</li>
                </ul>
            </div>

            {{-- Santé --}}
            <div style="background:#fff; padding:32px; border-radius:12px; border:1px solid var(--line);">
                <div style="font-size:24px; margin-bottom:12px;">🏥</div>
                <h3 style="color:var(--green); font-size:20px; margin-bottom:16px;">{{ $en ? 'Health' : 'Santé' }}</h3>
                <div style="font-size:28px; font-weight:700; color:var(--gold); margin-bottom:12px;">{{ $en ? 'More than 160M FCFA' : 'Plus de 160M FCFA' }}</div>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:8px;">• {{ $en ? 'Construction and equipment of Namissiguima CSPS' : 'Construction et équipement du CSPS de Namissiguima' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Provision of ambulances' : 'Mise à disposition d\'ambulances' }}</li>
                    <li>• {{ $en ? 'Rehabilitation of Kononga CSPS' : 'Réhabilitation du CSPS de Kononga' }}</li>
                </ul>
            </div>

            {{-- Accès à l'eau --}}
            <div style="background:#fff; padding:32px; border-radius:12px; border:1px solid var(--line);">
                <div style="font-size:24px; margin-bottom:12px;">💧</div>
                <h3 style="color:var(--green); font-size:20px; margin-bottom:16px;">{{ $en ? 'Access to Water' : 'Accès à l\'Eau' }}</h3>
                <div style="font-size:28px; font-weight:700; color:var(--gold); margin-bottom:12px;">{{ $en ? 'More than 240M FCFA' : 'Plus de 240M FCFA' }}</div>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:8px;">• {{ $en ? 'Construction of wells and boreholes' : 'Réalisation de puits et forages' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Pastoral boreholes' : 'Forages pastoraux' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Water reservoirs' : 'Retenues d\'eau' }}</li>
                    <li>• {{ $en ? 'Water towers and potable water supply systems' : 'Châteaux d\'eau et systèmes d\'adduction d\'eau potable' }}</li>
                </ul>
            </div>

            {{-- Moyens de subsistance --}}
            <div style="background:#fff; padding:32px; border-radius:12px; border:1px solid var(--line);">
                <div style="font-size:24px; margin-bottom:12px;">🌾</div>
                <h3 style="color:var(--green); font-size:20px; margin-bottom:16px;">{{ $en ? 'Livelihoods & Economic Development' : 'Moyens de Subsistance & Développement Économique' }}</h3>
                <div style="font-size:28px; font-weight:700; color:var(--gold); margin-bottom:12px;">{{ $en ? 'More than 350M FCFA' : 'Plus de 350M FCFA' }}</div>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:8px;">• {{ $en ? 'Support to Project Affected Persons (PAP)' : 'Appui aux Personnes Affectées par le Projet (PAP)' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Agricultural inputs' : 'Intrants agricoles' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Professional training' : 'Formations professionnelles' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Market gardening and livestock farming' : 'Maraîchage et élevage' }}</li>
                    <li>• {{ $en ? 'Income generating activities' : 'Activités génératrices de revenus' }}</li>
                </ul>
            </div>

            {{-- Infrastructures --}}
            <div style="background:#fff; padding:32px; border-radius:12px; border:1px solid var(--line);">
                <div style="font-size:24px; margin-bottom:12px;">🛣️</div>
                <h3 style="color:var(--green); font-size:20px; margin-bottom:16px;">{{ $en ? 'Infrastructure & Accessibility' : 'Infrastructures & Désenclavement' }}</h3>
                <div style="font-size:28px; font-weight:700; color:var(--gold); margin-bottom:12px;">{{ $en ? 'More than 519M FCFA' : 'Plus de 519M FCFA' }}</div>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:8px;">• {{ $en ? 'Flagship project: paving of 7.5 km of RD149 road' : 'Réalisation phare : bitumage de 7,5 km de la RD149' }}</li>
                    <li style="margin-bottom:8px;">• {{ $en ? 'Associated sanitation works' : 'Travaux d\'assainissement associés' }}</li>
                    <li>• {{ $en ? 'Significant improvement in mobility and reduction of dust nuisances' : 'Forte amélioration de la mobilité et réduction des nuisances de poussière' }}</li>
                </ul>
            </div>
        </div>

        {{-- Total Investment --}}
        <div style="margin-top:48px; text-align:center; padding:32px; background:linear-gradient(135deg, #4B1716 0%, #281D18 100%); border-radius:12px; color:#fff;">
            <div style="font-size:14px; text-transform:uppercase; letter-spacing:0.1em; margin-bottom:12px; opacity:0.8;">{{ $en ? 'Total Community Investment 2014-2025' : 'Investissement Communautaire Total 2014-2025' }}</div>
            <div style="font-size:48px; font-weight:700; color:var(--gold);">1.419 {{ $en ? 'Billion' : 'Milliard' }} FCFA</div>
        </div>
    </div>
</section>

{{-- ── 1c. Community Impact Metrics ───────────────────── --}}
<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;">{{ $en ? 'Community Impact 2024' : 'Impact Communautaire 2024' }}</h2>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px;">
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">850</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Students in Programs' : 'Étudiants en Programmes' }}</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">12</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Healthcare Clinics' : 'Cliniques Santé' }}</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">85%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'of Grievances Resolved' : 'Griefs Résolus' }}</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">42km</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Roads Built/Maintained' : 'Routes Construites/Entretenues' }}</div>
            </div>
        </div>
    </div>
</section>

{{-- ── 2. FMD — projets réalisés ───────────────────────── --}}
<section class="sand">
    <p class="lead">{{ __('site.communities_fmd_lead', [], $loc) }}</p>
    <h3 style="margin-bottom:20px;">{{ __('site.communities_fmd_projects_h3', [], $loc) }}</h3>
    <div class="grid-3" style="grid-template-columns:repeat(2,1fr);">
        @foreach(range(1, 4) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.communities_fmd_proj'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.communities_fmd_proj'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_fmd_proj'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 2b. Detailed Initiatives ───────────────────────── --}}
<section style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:40px; font-size:36px; font-weight:600;">{{ $en ? 'Our Programs' : 'Nos Programmes' }}</h2>
        
        <div class="grid-3">
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px; font-size:18px;">🎓 {{ $en ? 'Education Initiative' : 'Initiative Éducation' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:10px;">• {{ $en ? '850+ students in scholarship programs' : '850+ étudiants en bourses' }}</li>
                    <li style="margin-bottom:10px;">• {{ $en ? 'Technical vocational training' : 'Formation technique professionnelle' }}</li>
                    <li style="margin-bottom:10px;">• {{ $en ? 'Teacher development programs' : 'Programmes développement enseignants' }}</li>
                    <li>• {{ $en ? 'School infrastructure improvements' : 'Améliorations infrastructures scolaires' }}</li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px; font-size:18px;">🏥 {{ $en ? 'Healthcare Program' : 'Programme Santé' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:10px;">• {{ $en ? '12 community health clinics' : '12 cliniques santé communautaire' }}</li>
                    <li style="margin-bottom:10px;">• {{ $en ? 'Free medical consultations' : 'Consultations médicales gratuites' }}</li>
                    <li style="margin-bottom:10px;">• {{ $en ? 'Maternal & child health focus' : 'Focus santé maternelle & infantile' }}</li>
                    <li>• {{ $en ? 'Nutritional support programs' : 'Programmes soutien nutritionnel' }}</li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px; font-size:18px;">🛣️ {{ $en ? 'Infrastructure Development' : 'Développement Infrastructures' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:10px;">• {{ $en ? '42km of roads built/maintained' : '42km routes construites/entretenues' }}</li>
                    <li style="margin-bottom:10px;">• {{ $en ? 'Water supply systems' : 'Systèmes approvisionnement eau' }}</li>
                    <li style="margin-bottom:10px;">• {{ $en ? 'Electricity access expansion' : 'Expansion accès électricité' }}</li>
                    <li>• {{ $en ? 'Market and community centers' : 'Marchés et centres communautaires' }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ── 3. Mécanisme de gestion des plaintes ────────────── --}}
<section class="sand">
    <h2 style="text-align:center; color:var(--green); margin-bottom:20px; font-size:32px;">{{ $en ? 'Grievance and Conflict Management' : 'Mécanisme de Gestion des Plaintes et des Conflits' }}</h2>
    <p class="lead">
        {{ $en 
            ? 'In order to cultivate and maintain peaceful and harmonious relations with communities, the mine has developed grievance and conflict management mechanisms. These systems prioritize dialogue, respect and transparency.' 
            : 'Dans l\'objectif de cultiver et d\'entretenir des relations pacifiques et harmonieuses avec les communautés, la mine a élaboré des mécanismes de gestion des plaintes et des conflits. Ces dispositifs privilégient le dialogue, le respect et la transparence.' 
        }}
    </p>
    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.communities_step'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.communities_step'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_step'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 4. Carte des villages impactés ─────────────────── --}}
<section class="sand">
    <p class="lead">{{ __('site.communities_map_lead', [], $loc) }}</p>

    <div class="grid-2">
        {{-- Carte Google Maps --}}
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125836.0!2d-2.2!3d13.63!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMine+de+Karma!5e0!3m2!1s{{ $loc }}!2sbf!4v1"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="{{ $en ? 'Map of impacted villages' : 'Carte des villages impactés' }}">
            </iframe>
        </div>
        {{-- Note explicative --}}
        <div class="card" style="background:#fff; align-self:start;">
            <div class="card-tag">{{ $en ? 'Surrounding villages' : 'Villages riverains' }}</div>
            <p>{{ __('site.communities_map_note', [], $loc) }}</p>
            <p style="margin-top:16px; padding-top:16px; border-top:1px solid var(--line); font-size:13px; color:var(--muted);">
                {{ __('site.communities_map_soon', [], $loc) }}
            </p>
        </div>
    </div>
</section>

{{-- ── 5. Partenaires communautaires ───────────────────── --}}
<section>
    <p class="lead">{{ __('site.communities_partners_p', [], $loc) }}</p>
    <h3 style="margin-bottom:20px;">{{ __('site.communities_partners_types_h3', [], $loc) }}</h3>
    <div class="grid-3" style="grid-template-columns:repeat(2,1fr);">
        @foreach(range(1, 4) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.communities_partner'.$i.'_tag', [], $loc) }}</div>
            <p>{{ __('site.communities_partner'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>

    <div style="margin-top:32px; text-align:center;">
        <a class="btn btn-dark"
           href="{{ ($en ? route('english.contact') : route('contact')) }}?type=communaute">
            {{ __('site.contact_us', [], $loc) }}
        </a>
    </div>
</section>

@endsection
