{{-- Page : Santé et Sécurité --}}
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sustainability-animations.css') }}">
@endpush

@section('content')

{{-- ── 1. Politique HSE ─────────────────────────────────── --}}
<section class="sa-animated-section" style="padding-top:40px;">
    <div class="sa-particles-container" data-count="5"></div>

    <p class="lead sa-reveal">{{ __('site.hse_policy_lead', [], $loc) }}</p>

    <div class="grid-3" style="margin-top:24px;">
        @foreach(range(1, 3) as $i)
        <div class="sa-program-card sa-reveal sa-delay-{{ $i }}">
            <div class="card-tag">{{ __('site.hse_policy'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.hse_policy'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.hse_policy'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 2. Politique Santé-Sécurité au Travail ───────── --}}
<section class="sa-sand-animated hse-commitment" style="padding:70px 5vw; position:relative;">
    <div style="max-width:980px; margin:0 auto; position:relative; z-index:1;">
        <div class="sa-section-heading sa-reveal">
            
            <div class="sa-divider"></div>
        </div>

        <div class="hse-commitment__body sa-reveal sa-delay-1">
            <p>Chez Riverstone Karma, la santé et la sécurité des personnes constituent une priorité fondamentale. Notre ambition est de mener nos activités « sans préjudice », en mettant en place et en maintenant un système efficace de gestion de la santé et de la sécurité au travail. Nous nous engageons à respecter les lois, réglementations, normes applicables et bonnes pratiques en matière de santé et de sécurité, et à offrir à nos employés, sous-traitants et autres parties prenantes un environnement de travail sûr et sain.</p>

            <p>La prévention des risques repose sur la responsabilité de tous, à tous les niveaux de l'organisation. Riverstone Karma veille à mettre à disposition les ressources, équipements de protection et formations nécessaires, tout en favorisant la participation et la consultation des travailleurs. Chaque collaborateur est encouragé à contribuer à sa propre sécurité et à celle de ses collègues, à signaler les situations dangereuses et bénéficie du droit de refuser un travail présentant un danger. La prévention, l'évaluation et la réduction continue des risques professionnels constituent ainsi des principes essentiels de nos opérations.</p>

            <p>Nous nous inscrivons également dans une démarche d'amélioration continue, fondée sur des systèmes de gestion conformes à des normes reconnues internationalement, des audits périodiques, le suivi de nos performances et une communication ouverte avec nos employés et parties prenantes. Nous ne tolérons aucune violation délibérée des règles de santé et de sécurité. Toute situation ou condition de travail susceptible de présenter un risque peut être signalée en toute confidentialité par téléphone, par courriel ou au moyen des boîtes à idées disponibles sur le site.</p>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

{{-- ── 3. Chiffres clés sécurité ──────────────────────── --}}
<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">

        {{-- Stat Band Améliorée --}}
        <div class="stat-band sa-reveal" style="margin-top:0; margin-bottom:40px;">
            @foreach(range(1, 4) as $i)
            <div class="stat-item sa-stat-item-enhanced">
                <span class="stat-value" data-count="{{ $i }}" data-original="{{ __('site.hse_stat'.$i.'_val', [], $loc) }}">{{ __('site.hse_stat'.$i.'_val', [], $loc) }}</span>
                <span class="stat-label">{{ __('site.hse_stat'.$i.'_label', [], $loc) }}</span>
            </div>
            @endforeach
        </div>

        <div class="grid-3">
            @foreach(range(1, 3) as $i)
            <div class="sa-step-card sa-reveal sa-delay-{{ $i }}" data-step="{{ $i }}">
                <div class="card-tag">{{ __('site.hse_card'.$i.'_tag', [], $loc) }}</div>
                <h3>{{ __('site.hse_card'.$i.'_h3', [], $loc) }}</h3>
                <p>{{ __('site.hse_card'.$i.'_p', [], $loc) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── 4. Conformité & Amélioration Continue ──────────── --}}
<section class="sa-dark-section" style="padding:70px 5vw; color:#fff;">
    <div style="max-width:960px; margin:0 auto; text-align:center; position:relative; z-index:1;">

        <div class="sa-reveal">
            <div style="font-size:48px; margin-bottom:20px;">⚖️</div>
            
            <div style="width:60px; height:3px; background:linear-gradient(90deg,var(--gold),var(--gold2)); border-radius:2px; margin:0 auto 24px;"></div>
            <p style="color:rgba(255,255,255,0.8); font-size:16px; line-height:1.8; max-width:700px; margin:0 auto 32px; text-align:center;">
                {{ $en
                    ? 'Néré Mining relies on internal controls, inspections and independent reviews to strengthen operational discipline and accountability.'
                    : 'Néré Mining s\'appuie sur des contrôles internes, des inspections et des revues indépendantes pour renforcer la discipline opérationnelle et la responsabilité.'
                }}
            </p>
        </div>

        {{-- Piliers de conformité --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:16px; margin-top:16px;">
            @foreach([
                ['icon'=>'📋','label'=>$en?'Internal Controls':'Contrôles Internes'],
                ['icon'=>'🔍','label'=>$en?'Independent Audits':'Audits Indépendants'],
                ['icon'=>'📈','label'=>$en?'Continuous Improvement':'Amélioration Continue'],
                ['icon'=>'🏆','label'=>$en?'ISO Certifications':'Certifications ISO'],
            ] as $k => $pilier)
            <div class="sa-reveal sa-delay-{{ $k+1 }}" style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); border-radius:14px; padding:24px 16px; text-align:center; transition:background .3s, transform .3s; cursor:default;"
                 onmouseover="this.style.background='rgba(255,194,71,0.12)'; this.style.transform='translateY(-4px)'"
                 onmouseout="this.style.background='rgba(255,255,255,0.07)'; this.style.transform=''">
                <div style="font-size:32px; margin-bottom:10px;">{{ $pilier['icon'] }}</div>
                <div style="font-size:13px; color:rgba(255,255,255,0.8); font-weight:500; letter-spacing:.04em; text-transform:uppercase;">{{ $pilier['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('js/sustainability-animations.js') }}"></script>
@endpush

@endsection
