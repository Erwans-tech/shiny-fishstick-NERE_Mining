{{-- Page : Environnement --}}
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sustainability-animations.css') }}">
@endpush

@section('content')

{{-- ── 1. Politique environnementale ──────────────────── --}}
<section class="sa-animated-section" style="padding-top:40px;">
    <div class="sa-particles-container" data-count="6"></div>

    <p class="lead sa-reveal">{{ __('site.env_policy_lead', [], $loc) }}</p>

    <div class="grid-3" style="margin-top:24px;">
        @foreach(range(1, 3) as $i)
        <div class="sa-program-card sa-reveal sa-delay-{{ $i }}">
            <div class="card-tag">{{ __('site.env_policy'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.env_policy'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.env_policy'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 2. Performance Environnementale ────────────────── --}}
<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">

        <div class="sa-section-heading sa-reveal">
            <h2>{{ $en ? 'Environmental Performance' : 'Performance Environnementale' }}</h2>
            <div class="sa-divider"></div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:20px; margin-top:48px;">
            @php
                $envMetrics = [
                    ['icon'=>'☁️','count'=>32,'prefix'=>'-','suffix'=>'%','label'=>$en?'CO₂ Emissions Reduced':'Émissions CO₂ Réduites','sub'=>'2020-2024','bar'=>'32%'],
                    ['icon'=>'💧','count'=>28,'prefix'=>'-','suffix'=>'%','label'=>$en?'Water Consumption':'Consommation Eau','sub'=>$en?'Reduction efficiency':'Amélioration efficacité','bar'=>'28%'],
                    ['icon'=>'♻️','count'=>95,'suffix'=>'%','label'=>$en?'Waste Recycled':'Déchets Recyclés','sub'=>$en?'or reused annually':'ou réutilisés annuels','bar'=>'95%'],
                    ['icon'=>'✨','count'=>100,'suffix'=>'%','label'=>$en?'Conflict-Free Gold':'Or Conflit-Libre','sub'=>$en?'Responsible sourcing':'Approvisionnement responsable','bar'=>'100%'],
                ];
            @endphp
            @foreach($envMetrics as $k => $m)
            <div class="sa-metric-card sa-reveal sa-delay-{{ $k+1 }}">
                <div style="font-size:28px; margin-bottom:8px;">{{ $m['icon'] }}</div>
                <div class="sa-metric-value sustain-metric__value"
                     data-count="{{ $m['count'] }}"
                     @isset($m['prefix']) data-prefix="{{ $m['prefix'] }}" @endisset
                     data-suffix="{{ $m['suffix'] }}"
                     data-original="{{ ($m['prefix']??'').$m['count'].$m['suffix'] }}">
                    {{ ($m['prefix']??'').$m['count'].$m['suffix'] }}
                </div>
                <div style="font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; margin-top:8px; line-height:1.4;">{{ $m['label'] }}</div>
                <div style="font-size:11px; color:var(--muted); margin-top:4px; opacity:0.8;">{{ $m['sub'] }}</div>
                <div class="sa-progress-bar" style="margin-top:12px;">
                    <div class="sa-progress-fill" data-width="{{ $m['bar'] }}"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

{{-- ── 3. Mesures de mitigation ───────────────────────── --}}
<section class="sa-animated-section" style="padding:70px 5vw;">
    <p class="lead sa-reveal">{{ __('site.env_mitigation_lead', [], $loc) }}</p>
    <div class="grid-3" style="margin-top:24px;">
        @foreach(range(1, 3) as $i)
        <div class="sa-program-card sa-reveal sa-delay-{{ $i }}">
            <div class="card-tag">{{ __('site.env_mitigation'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.env_mitigation'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.env_mitigation'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 4. Eau, Déchets & Émissions ─────────────────── --}}
<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">

        <p class="lead sa-reveal">{{ __('site.env_water_lead', [], $loc) }}</p>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start; margin-top:32px;">
            <div class="sa-program-card sa-reveal sa-delay-1">
                <div style="font-size:32px; margin-bottom:14px;">💧</div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px;">{{ $en ? 'Water Management' : 'Gestion de l\'Eau' }}</h3>
                <ul class="sa-animated-list">
                    @foreach([
                        $en?'Rainwater harvesting & storage systems':'Systèmes récupération eau pluie',
                        $en?'Wastewater treatment & recycling':'Traitement & recyclage eaux usées',
                        $en?'Groundwater monitoring programs':'Programmes suivi eau souterraine',
                        $en?'Community water access initiatives':'Initiatives accès eau communautaire',
                        $en?'Biodiversity & wetland protection':'Protection biodiversité & zones humides',
                    ] as $item)
                    <li>
                        <span class="sa-list-bullet" style="font-size:11px;">•</span>
                        <span style="font-size:14px; color:var(--muted); line-height:1.6;">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="sa-program-card sa-reveal sa-delay-2">
                <div style="font-size:32px; margin-bottom:14px;">🏭</div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px;">{{ $en ? 'Waste & Emissions' : 'Déchets & Émissions' }}</h3>
                <ul class="sa-animated-list">
                    @foreach([
                        $en?'Tailings management & disposal':'Gestion & disposition des rejets',
                        $en?'Hazardous waste segregation & treatment':'Séparation & traitement déchets dangereux',
                        $en?'Greenhouse gas reduction targets':'Objectifs réduction gaz serre',
                        $en?'Renewable energy transition (solar pilot)':'Transition énergies renouvelables (pilot solaire)',
                        $en?'Air quality monitoring & dust control':'Suivi qualité air & contrôle poussières',
                    ] as $item)
                    <li>
                        <span class="sa-list-bullet" style="font-size:11px;">•</span>
                        <span style="font-size:14px; color:var(--muted); line-height:1.6;">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Cards Réhabilitation & Biodiversité --}}
        <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:24px; margin-top:40px;">
            <div class="sa-achievement-card sa-reveal sa-delay-1">
                <div class="sa-category-icon">🌱</div>
                <div class="card-tag">{{ $en ? 'Land Rehabilitation' : 'Réhabilitation Terrains' }}</div>
                <h3 style="color:var(--green); margin-bottom:10px;">{{ $en ? 'Post-Mining Land Use' : 'Utilisation Terre Post-Minière' }}</h3>
                <p style="font-size:14px; margin:0;">
                    {{ $en ? 'Closure plans include reforestation, agricultural use restoration, and creation of wildlife habitats compatible with community needs.' : 'Plans de fermeture incluent reboisement, restauration usage agricole, création habitats faune compatible besoins communautaires.' }}
                </p>
            </div>
            <div class="sa-achievement-card sa-reveal sa-delay-2">
                <div class="sa-category-icon">🦋</div>
                <div class="card-tag">{{ $en ? 'Biodiversity' : 'Biodiversité' }}</div>
                <h3 style="color:var(--green); margin-bottom:10px;">{{ $en ? 'Flora & Fauna Protection' : 'Protection Flore & Faune' }}</h3>
                <p style="font-size:14px; margin:0;">
                    {{ $en ? 'Regular biodiversity surveys, protected species monitoring, and habitat corridors maintained throughout operations and closure phases.' : 'Surveys biodiversité réguliers, suivi espèces protégées, corridors habitat maintenus opérations & fermeture.' }}
                </p>
            </div>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

@push('scripts')
<script src="{{ asset('js/sustainability-animations.js') }}"></script>
@endpush

@endsection
