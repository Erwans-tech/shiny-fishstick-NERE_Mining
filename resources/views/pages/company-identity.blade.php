{{-- Page : Notre identité --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<section>
    <div class="sub-nav">
        <a href="{{ $companyBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}" class="active">{{ __('site.subnav_company_identity', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.history')    : route('company.history') }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.values')     : route('company.values') }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
    </div>

    <p class="lead">{{ __('site.company_identity_lead', [], $loc) }}</p>

    @php
        $bgImages = [
            asset('images/identite/Image1-qwt443rdtdnnrn7bp8ramn12pvfx6i3sw3tfmpqolc.jpg'),
            asset('images/identite/Image2-qwt43i53g6u0aycarvjmokwh0mk24viuvs9he1z8qo.jpg'),
            asset('images/identite/Image3-qwt444p807oy395yjr5x74sjb9bae77j88gx3zpaf4.png')
        ];
    @endphp

    <style>
        .identity-card {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            color: #fff;
            border: none;
            border-radius: 18px;
            overflow: hidden;
            min-height: 360px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            transition: transform 0.4s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.4s;
            box-shadow: 0 10px 24px rgba(0,0,0,0.1);
        }
        .identity-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(0,0,0,0.15);
        }
        .identity-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(10, 14, 12, 0.18) 0%, rgba(10, 14, 12, 0.58) 42%, rgba(10, 14, 12, 0.82) 100%);
            z-index: 1;
            transition: opacity 0.3s ease;
        }
        .identity-card:hover::before {
            background: linear-gradient(180deg, rgba(10, 14, 12, 0.22) 0%, rgba(10, 14, 12, 0.62) 42%, rgba(10, 14, 12, 0.9) 100%);
        }
        .identity-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 160px;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.4) 100%);
            z-index: 1;
        }
        .identity-card > * {
            position: relative;
            z-index: 2;
            padding: 0 24px;
        }
        .identity-card .card-tag {
            background: rgba(255, 194, 71, 0.25);
            color: var(--gold);
            border: 1px solid rgba(255, 194, 71, 0.4);
            align-self: flex-start;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .identity-card h3 {
            color: #fff;
            margin-top: auto;
            margin-bottom: 12px;
            text-shadow: 0 2px 6px rgba(0,0,0,0.6);
            font-size: 22px;
            font-weight: 600;
            line-height: 1.3;
        }
        .identity-card p {
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 0 1px 3px rgba(0,0,0,0.6);
            font-size: 15px;
            line-height: 1.5;
            margin-bottom: 24px;
        }
    </style>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card identity-card" style="background-image: url('{{ $bgImages[$i-1] }}');">
            <div class="card-tag">{{ __('site.company_id'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.company_id'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.company_id'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Certifications & conformité --}}
<section class="sand">
    <h2>{{ $en ? 'Certifications & Compliance' : 'Certifications et conformité' }}</h2>
    <p class="lead">{{ $en
        ? 'Néré Mining maintains international standards and certifications to ensure operational excellence and environmental responsibility.'
        : 'Néré Mining respecte les normes internationales et certifications pour assurer l\'excellence opérationnelle et la responsabilité environnementale.'
    }}</p>

    <div class="grid-3" style="margin-top:32px;">
        {{-- ISO 9001:2008 --}}
        <div class="card" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:200px; text-align:center; background:rgba(255,255,255,.9); border:1px solid rgba(255,194,71,.3);">
            <div style="font-size:3rem; color:var(--gold); margin-bottom:12px; line-height:1;">✓</div>
            <div class="card-tag" style="margin-bottom:12px;">{{ $en ? 'Quality Management' : 'Gestion de la qualité' }}</div>
            <h3 style="margin:0;">ISO 9001:2008</h3>
            <p style="font-size:13px; margin-top:8px;">{{ $en ? 'International standard for quality management systems' : 'Norme internationale de systèmes de gestion de la qualité' }}</p>
        </div>

        {{-- EITI / ITIE --}}
        <div class="card" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:200px; text-align:center; background:rgba(255,255,255,.9); border:1px solid rgba(255,194,71,.3);">
            <div style="font-size:3rem; color:var(--gold); margin-bottom:12px; line-height:1;">✓</div>
            <div class="card-tag" style="margin-bottom:12px;">{{ $en ? 'Transparency' : 'Transparence' }}</div>
            <h3 style="margin:0;">{{ $en ? 'EITI' : 'ITIE' }}</h3>
            <p style="font-size:13px; margin-top:8px;">{{ $en ? 'Extractive Industries Transparency Initiative member' : 'Membre de l\'Initiative pour la transparence de l\'industrie extractive' }}</p>
        </div>

        {{-- Environmental Commitment --}}
        <div class="card" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:200px; text-align:center; background:rgba(255,255,255,.9); border:1px solid rgba(255,194,71,.3);">
            <div style="font-size:3rem; color:var(--gold); margin-bottom:12px; line-height:1;">✓</div>
            <div class="card-tag" style="margin-bottom:12px;">{{ $en ? 'Environmental' : 'Environnement' }}</div>
            <h3 style="margin:0;">{{ $en ? 'ESG Standards' : 'Normes RSE' }}</h3>
            <p style="font-size:13px; margin-top:8px;">{{ $en ? 'Environmental, Social & Governance standards compliance' : 'Conformité aux normes environnementales, sociales et de gouvernance' }}</p>
        </div>
    </div>
</section>
@endsection
