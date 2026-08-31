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
            opacity: 0;
            transform: translateY(18px);
            animation: pdgReveal .8s cubic-bezier(.22,1,.36,1) forwards, float 6s ease-in-out infinite;
            animation-delay: 0s, 0.8s;
        }
        @keyframes pdgReveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-8px);
            }
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
            transition: transform .35s ease, box-shadow .35s ease;
        }
        .pdg-photo:hover {
            transform: scale(1.02);
            box-shadow: 0 18px 30px rgba(75,23,22,0.18);
        }
        .pdg-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            filter: saturate(0.95) contrast(1.04);
            transition: transform .45s ease, filter .45s ease;
        }
        .pdg-photo:hover img {
            transform: scale(1.04);
            filter: saturate(1.08) contrast(1.08);
        }
        .pdg-photo::after {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at top right, rgba(255,194,71,0.1), transparent 60%);
        }
        .pdg-quote {
            font-size: clamp(18px, 2.1vw, 25px);
            line-height: 1.7;
            color: var(--ink);
            font-weight: 400;
            margin-bottom: 32px;
            position: relative;
            text-align: justify;
            text-wrap: pretty;
            opacity: 0;
            transform: translateY(12px);
            animation: quoteReveal .8s ease .15s forwards;
        }
        @keyframes quoteReveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                <img src="{{ asset('images/ceo/pdg.jpg') }}" alt="{{ __('site.company_pdg_name', [], $loc) }}">
            </div>
        </div>
        <div>
            <div class="pdg-quote">
                {{ __('site.company_pdg_quote', [], $loc) }}
            </div>
            <div class="pdg-name">{{ __('site.company_pdg_name', [], $loc) }}</div>
            <div class="pdg-title">{{ __('site.company_pdg_company', [], $loc) }}</div>
        </div>
    </div>
</section>
@endsection
