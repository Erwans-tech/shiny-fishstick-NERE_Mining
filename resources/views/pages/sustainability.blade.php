{{-- Page : Développement durable (hub) --}}
@extends('layouts.app')

@section('content')

<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}" class="active">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
        <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
        <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
        <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
    </div>

    <style>
        .pillar-card {
            background: linear-gradient(180deg, #ffffff 0%, #f9f6f0 100%);
            border: 1px solid rgba(75,23,22,0.1);
            transition: transform 0.3s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.3s, border-color 0.3s;
        }
        .pillar-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 32px rgba(40,29,24,0.08);
            border-color: rgba(255,194,71,0.4);
        }
        .esg-metric { text-align:center; padding:20px; }
        .esg-value { font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px; }
        .esg-label { font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; }
    </style>
    <p class="lead">{{ __('site.sustain_lead', [], $loc) }}</p>

    @php
        $pillarLinks = [
            1 => $en ? route('english.communities')   : route('sustainability.communities'),
            2 => $en ? route('english.environment')   : route('sustainability.environment'),
            3 => $en ? route('english.hse')           : route('sustainability.hse'),
            4 => $en ? route('english.local-content') : route('sustainability.local-content'),
        ];
    @endphp

    <div class="grid-2">
        @foreach(range(1, 4) as $i)
        <a href="{{ $pillarLinks[$i] }}" class="card pillar-card sr" style="display:block;">
            <div class="card-tag">{{ __('site.sustain_pillar'.$i.'_num', [], $loc) }}</div>
            <h3>{{ __('site.sustain_pillar'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.sustain_pillar'.$i.'_p', [], $loc) }}</p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">
                {{ __('site.sustain_discover', [], $loc) }}
            </span>
        </a>
        @endforeach
    </div>
</section>

{{-- ESG Metrics & Performance --}}
<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;">{{ $en ? 'ESG Performance' : 'Performance ESG' }}</h2>
        <p style="text-align:center; color:var(--muted); font-size:15px; margin-bottom:40px; line-height:1.8;">{{ $en ? 'Our commitment to Environmental, Social, and Governance excellence drives sustainable value creation.' : 'Notre engagement pour excellence Environnementale, Sociale et Gouvernance crée de la valeur durable.' }}</p>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px;">
            <div class="esg-metric">
                <div class="esg-value">-32%</div>
                <div class="esg-label">{{ $en ? 'CO₂ Reduction (2020-2024)' : 'Réduction CO₂ (2020-2024)' }}</div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">-28%</div>
                <div class="esg-label">{{ $en ? 'Water Consumption Reduced' : 'Consommation Eau Réduite' }}</div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">95%</div>
                <div class="esg-label">{{ $en ? 'Waste Recycled/Reused' : 'Déchets Recyclés/Réutilisés' }}</div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">80%+</div>
                <div class="esg-label">{{ $en ? 'Local Hiring Rate' : 'Taux Recrutement Local' }}</div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">100%</div>
                <div class="esg-label">{{ $en ? 'Safety Culture' : 'Culture sécurité' }}</div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">100%</div>
                <div class="esg-label">{{ $en ? 'Conflict-Free Gold' : 'Or Conflit-Libre' }}</div>
            </div>
        </div>
    </div>
</section>

{{-- Sustainability Initiatives --}}
<section style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;">{{ $en ? 'Our Initiatives' : 'Nos Initiatives' }}</h2>
        <p style="text-align:center; color:var(--muted); font-size:15px; margin-bottom:40px; line-height:1.8;">{{ $en ? 'Strategic programs addressing environmental, social and economic priorities.' : 'Programmes stratégiques adressant priorités environnementales, sociales et économiques.' }}</p>
        
        <div class="grid-3">
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">🌍 {{ $en ? 'Environmental Stewardship' : 'Intendance Environnementale' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• {{ $en ? 'Land reclamation & biodiversity' : 'Restauration terrain & biodiversité' }}</li>
                    <li>• {{ $en ? 'Water resource management' : 'Gestion ressources hydriques' }}</li>
                    <li>• {{ $en ? 'Renewable energy projects' : 'Projets énergies renouvelables' }}</li>
                    <li>• {{ $en ? 'Emission reduction targets' : 'Objectifs réduction émissions' }}</li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">👥 {{ $en ? 'Community Development' : 'Développement Communautaire' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• {{ $en ? 'Education & scholarships' : 'Éducation & bourses' }}</li>
                    <li>• {{ $en ? 'Healthcare services' : 'Services santé' }}</li>
                    <li>• {{ $en ? 'Infrastructure development' : 'Développement infrastructures' }}</li>
                    <li>• {{ $en ? 'Local economic empowerment' : 'Autonomisation économique locale' }}</li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">🛡️ {{ $en ? 'Health & Safety Excellence' : 'Excellence Santé & Sécurité' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• {{ $en ? 'Zero-harm culture' : 'Culture zéro accident' }}</li>
                    <li>• {{ $en ? 'Occupational health programs' : 'Programmes santé professionnelle' }}</li>
                    <li>• {{ $en ? 'Safety training & certification' : 'Formation & certification sécurité' }}</li>
                    <li>• {{ $en ? 'Incident prevention systems' : 'Systèmes prévention incidents' }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
