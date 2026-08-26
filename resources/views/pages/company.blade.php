{{-- Page : Qui sommes-nous (hub) --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<section>
    <div class="sub-nav">
        <a href="{{ $companyBase }}" class="active">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.history')    : route('company.history') }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.values')     : route('company.values') }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
    </div>

    <p class="lead">{{ __('site.company_identity_lead', [], $loc) }}</p>

    <div class="company-overview-grid">
        <a href="{{ $en ? route('english.company.ceo') : route('company.ceo') }}" class="card" style="display:block;">
            <div class="card-tag">01</div>
            <h3>{{ __('site.subnav_company_ceo', [], $loc) }}</h3>
            <p>{{ __('site.company_pdg_quote', [], $loc) }}</p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
        </a>
        <a href="{{ $en ? route('english.company.identity') : route('company.identity') }}" class="card" style="display:block;">
            <div class="card-tag">02</div>
            <h3>{{ __('site.subnav_company_identity', [], $loc) }}</h3>
            <p>{{ __('site.company_identity_lead', [], $loc) }}</p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
        </a>
        <a href="{{ $en ? route('english.company.history') : route('company.history') }}" class="card" style="display:block;">
            <div class="card-tag">03</div>
            <h3>{{ __('site.subnav_company_history', [], $loc) }}</h3>
            <p>{{ __('site.company_history_lead', [], $loc) }}</p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
        </a>
        <a href="{{ $en ? route('english.company.values') : route('company.values') }}" class="card" style="display:block;">
            <div class="card-tag">04</div>
            <h3>{{ __('site.subnav_company_values', [], $loc) }}</h3>
            <p>{{ __('site.company_vision_lead', [], $loc) }}</p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
        </a>
        <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}" class="card">
            <div class="card-tag">05</div>
            <h3>{{ __('site.subnav_company_governance', [], $loc) }}</h3>
            <p>{{ __('site.company_gov_lead', [], $loc) }}</p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
        </a>
    </div>
</section>
@endsection
