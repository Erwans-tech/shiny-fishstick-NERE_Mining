{{-- Page : Vision & Valeurs --}}
@extends('layouts.app')

@section('content')
@php
    $companyBase = $en ? route('english.company') : route('company');
    $values = [1, 2, 3, 4];
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
    </div>

    <div class="grid-4 values-grid">
        @foreach($values as $i)
        <div class="card values-card">
            <div class="card-tag">{{ __('site.company_v'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.company_v'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.company_v'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>
@endsection
