{{-- Page : Vision & Valeurs --}}
@extends('layouts.app')

@section('content')
@php
    $companyBase = $en ? route('english.company') : route('company');
    $values = [1, 2, 3, 4];
    $valueLetters = ['I', 'P', 'R', 'E'];
@endphp

<section class="company-values-section">
    <div class="sub-nav">
        <a href="{{ $companyBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.history')    : route('company.history') }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.values')     : route('company.values') }}" class="active">{{ __('site.subnav_company_values', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
    </div>

    <div class="values-hero" aria-label="IPRE">
        <img src="{{ asset('images/ipre-banner.jpg') }}" alt="IPRE" class="values-hero-image">
        <div class="values-hero-overlay">
            <span class="values-hero-kicker">IPRE</span>
            <h2>{{ $en ? 'Integrity, Professionalism, Respect, Team Spirit' : 'Intégrité, Professionnalisme, Respect, Esprit d’équipe' }}</h2>
            <p>{{ $en ? 'These principles guide every decision, every action and every relationship we build.' : 'Ces principes guident chaque décision, chaque action et chaque relation que nous bâtissons.' }}</p>
        </div>
    </div>

    <div class="grid-2 values-grid">
        @foreach($values as $i)
        <div class="card values-card values-card--{{ $i }}">
            <div class="values-card-top">
                <div class="values-card-icon">{{ $valueLetters[$i - 1] }}</div>
                <div class="card-tag">{{ __('site.company_v'.$i.'_tag', [], $loc) }}</div>
            </div>
            <h3>{{ __('site.company_v'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.company_v'.$i.'_p', [], $loc) }}</p>
            <div class="values-card-footer">
                <span>{{ $valueLetters[$i - 1] }}</span>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
