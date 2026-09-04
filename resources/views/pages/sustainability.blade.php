{{-- Page : Développement durable (hub) --}}
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sustainability-animations.css') }}">
@endpush

@section('content')

{{-- ── 1. Hub Piliers ────────────────────────────────── --}}
<section class="sa-animated-section" style="padding-top:40px;">

    <div class="sa-particles-container" data-count="6"></div>

    <div class="sa-section-heading sa-reveal">
        <p class="lead" style="max-width:780px; margin:0 auto 32px;">{{ __('site.sustain_lead', [], $loc) }}</p>
    </div>

    @php
        $pillarLinks = [
            1 => $en ? route('english.communities')   : route('sustainability.communities'),
            2 => $en ? route('english.environment')   : route('sustainability.environment'),
            3 => $en ? route('english.hse')           : route('sustainability.hse'),
            4 => $en ? route('english.local-content') : route('sustainability.local-content'),
        ];
        $pillarIcons = ['🤝', '🌿', '🛡️', '🏭'];
        $pillarColors = [
            'linear-gradient(135deg,rgba(255,194,71,.15),rgba(75,23,22,.08))',
            'linear-gradient(135deg,rgba(45,90,39,.15),rgba(255,194,71,.08))',
            'linear-gradient(135deg,rgba(215,47,47,.12),rgba(75,23,22,.08))',
            'linear-gradient(135deg,rgba(26,58,92,.15),rgba(255,194,71,.08))',
        ];
    @endphp

    <div class="grid-2" style="gap:28px;">
        @foreach(range(1, 4) as $i)
        <a href="{{ $pillarLinks[$i] }}" class="sa-pillar-card sa-reveal sa-delay-{{ $i }}" style="display:block; text-decoration:none;">
            <div class="sa-pillar-icon" style="background: {{ $pillarColors[$i-1] }}; font-size:32px;">
                {{ $pillarIcons[$i-1] }}
            </div>
            <div class="card-tag">{{ __('site.sustain_pillar'.$i.'_num', [], $loc) }}</div>
            <h3>{{ __('site.sustain_pillar'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.sustain_pillar'.$i.'_p', [], $loc) }}</p>
            <span class="sa-btn-animated" style="margin-top:20px; display:inline-flex;">
                <span>{{ __('site.sustain_discover', [], $loc) }}</span>
                <span class="sa-btn-arrow">→</span>
            </span>
        </a>
        @endforeach
    </div>
</section>

{{-- ── 2. ESG Performance ───────────────────────────── --}}
<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">
        <div class="sa-section-heading sa-reveal">
            <h2>{{ $en ? 'ESG Performance' : 'Performance ESG' }}</h2>
            <div class="sa-divider"></div>
            <p style="color:var(--muted); font-size:15px; line-height:1.8; margin:0;">
                {{ $en ? 'Our commitment to Environmental, Social, and Governance excellence drives sustainable value creation.' : 'Notre engagement pour excellence Environnementale, Sociale et Gouvernance crée de la valeur durable.' }}
            </p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(165px,1fr)); gap:20px; margin-top:48px;">

            @php
                $esgData = [
                    ['count'=>32,'prefix'=>'-','suffix'=>'%','label'=>$en?'CO₂ Reduction (2020-2024)':'Réduction CO₂ (2020-2024)','bar'=>'32%','icon'=>'🌱'],
                    ['count'=>28,'prefix'=>'-','suffix'=>'%','label'=>$en?'Water Consumption Reduced':'Consommation Eau Réduite','bar'=>'28%','icon'=>'💧'],
                    ['count'=>95,'suffix'=>'%','label'=>$en?'Waste Recycled/Reused':'Déchets Recyclés/Réutilisés','bar'=>'95%','icon'=>'♻️'],
                    ['count'=>80,'suffix'=>'%+','label'=>$en?'Local Hiring Rate':'Taux Recrutement Local','bar'=>'80%','icon'=>'👷'],
                    ['count'=>100,'suffix'=>'%','label'=>$en?'Safety Culture':'Culture sécurité','bar'=>'100%','icon'=>'🛡️'],
                    ['count'=>100,'suffix'=>'%','label'=>$en?'Conflict-Free Gold':'Or Conflit-Libre','bar'=>'100%','icon'=>'✨'],
                ];
            @endphp

            @foreach($esgData as $j => $metric)
            <div class="sa-metric-card sa-reveal sa-delay-{{ $j+1 }}">
                <div style="font-size:28px; margin-bottom:10px;">{{ $metric['icon'] }}</div>
                <div class="sa-metric-value esg-value"
                     data-count="{{ $metric['count'] }}"
                     @isset($metric['prefix']) data-prefix="{{ $metric['prefix'] }}" @endisset
                     data-suffix="{{ $metric['suffix'] ?? '' }}"
                     data-original="{{ ($metric['prefix']??'').$metric['count'].($metric['suffix']??'') }}">
                    {{ ($metric['prefix']??'').$metric['count'].($metric['suffix']??'') }}
                </div>
                <div style="font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; margin-top:8px; line-height:1.4;">{{ $metric['label'] }}</div>
                <div class="sa-progress-bar" style="margin-top:14px;">
                    <div class="sa-progress-fill" data-width="{{ $metric['bar'] }}" style="background:linear-gradient(90deg,var(--gold),var(--gold2));"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

{{-- ── 3. Nos Initiatives ───────────────────────────── --}}
<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2>{{ $en ? 'Our Initiatives' : 'Nos Initiatives' }}</h2>
            <div class="sa-divider"></div>
            <p style="color:var(--muted); font-size:15px; line-height:1.8; margin:0;">
                {{ $en ? 'Strategic programs addressing environmental, social and economic priorities.' : 'Programmes stratégiques adressant priorités environnementales, sociales et économiques.' }}
            </p>
        </div>

        <div class="grid-3" style="margin-top:48px;">
            @php
                $initiatives = [
                    ['icon'=>'🌍','title'=>$en?'Environmental Stewardship':'Intendance Environnementale','items'=>$en?['Land reclamation & biodiversity','Water resource management','Renewable energy projects','Emission reduction targets']:['Restauration terrain & biodiversité','Gestion ressources hydriques','Projets énergies renouvelables','Objectifs réduction émissions']],
                    ['icon'=>'👥','title'=>$en?'Community Development':'Développement Communautaire','items'=>$en?['Education & scholarships','Healthcare services','Infrastructure development','Local economic empowerment']:['Éducation & bourses','Services santé','Développement infrastructures','Autonomisation économique locale']],
                    ['icon'=>'🛡️','title'=>$en?'Health & Safety Excellence':'Excellence Santé & Sécurité','items'=>$en?['Zero-harm culture','Occupational health programs','Safety training & certification','Incident prevention systems']:['Culture zéro accident','Programmes santé professionnelle','Formation & certification sécurité','Systèmes prévention incidents']],
                ];
            @endphp
            @foreach($initiatives as $k => $init)
            <div class="sa-program-card sa-reveal sa-delay-{{ $k+1 }}">
                <div style="font-size:40px; margin-bottom:16px; display:block;">{{ $init['icon'] }}</div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:18px;">{{ $init['title'] }}</h3>
                <ul class="sa-animated-list">
                    @foreach($init['items'] as $item)
                    <li>
                        <span class="sa-list-bullet">✓</span>
                        <span style="font-size:14px; color:var(--muted); line-height:1.6;">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('js/sustainability-animations.js') }}"></script>
@endpush

@endsection
