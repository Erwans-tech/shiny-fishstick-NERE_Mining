{{-- Page : Mot du PDG --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<section>
    <div class="sub-nav">
        <a href="{{ $companyBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}" class="active">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.history')    : route('company.history') }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.values')     : route('company.values') }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
    </div>

    <style>
        .pdg-block {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 48px;
            align-items: center;
            background: linear-gradient(135deg, #ffffff 0%, #f6f1ea 100%);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 12px 32px rgba(40,29,24,0.06);
            margin-top: 40px;
        }
        .pdg-photo {
            height: 380px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4b1716 0%, #2d0d10 100%);
            box-shadow: 0 12px 24px rgba(75,23,22,0.2);
            position: relative;
            overflow: hidden;
        }
        .pdg-photo::after {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at top right, rgba(255,194,71,0.1), transparent 60%);
        }
        .pdg-quote {
            font-size: clamp(24px, 3vw, 32px);
            line-height: 1.4;
            color: var(--ink);
            font-weight: 300;
            margin-bottom: 32px;
            position: relative;
        }
        .pdg-quote::before {
            content: '«';
            position: absolute;
            left: -40px;
            top: -20px;
            font-size: 80px;
            color: rgba(229,167,47,0.3);
            font-family: serif;
            line-height: 1;
        }
        .pdg-name { font-size: 20px; font-weight: 700; color: var(--green); margin-bottom: 4px; }
        .pdg-title { font-size: 14px; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: 0.1em; }

        @media(max-width: 900px) {
            .pdg-block { grid-template-columns: 1fr; gap: 32px; padding: 32px 24px; }
            .pdg-quote::before { left: -10px; top: -30px; }
        }
    </style>

    <div class="pdg-block sr">
        <div>
            <div class="pdg-photo">
                <span style="color:rgba(255,255,255,.35); font-size:13px; text-align:center; position:relative; z-index:2;">
                    {{ __('site.company_photo_placeholder', [], $loc) }}
                </span>
            </div>
        </div>
        <div>
            <p class="pdg-quote">
                {{ __('site.company_pdg_quote', [], $loc) }}
            </p>
            <div class="pdg-name">{{ __('site.company_pdg_name', [], $loc) }}</div>
            <div class="pdg-title">{{ __('site.company_pdg_company', [], $loc) }}</div>
        </div>
    </div>
</section>
@endsection
