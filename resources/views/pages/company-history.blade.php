{{-- Page : Notre histoire --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<section>
    <div class="sub-nav">
        <a href="{{ $companyBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.history')    : route('company.history') }}" class="active">{{ __('site.subnav_company_history', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.values')     : route('company.values') }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
    </div>

    <p class="lead">{{ __('site.company_history_lead', [], $loc) }}</p>

    <div class="grid-2">
        {{-- Accordéon chronologique --}}
        <div>
            @foreach(range(1, 4) as $i)
            <details {{ $i === 1 ? 'open' : '' }}>
                <summary>{{ __('site.company_hist'.$i.'_title', [], $loc) }}</summary>
                <p>{{ __('site.company_hist'.$i.'_p', [], $loc) }}</p>
            </details>
            @endforeach
        </div>

        {{-- Chiffres clés --}}
        <div class="card" style="background: linear-gradient(135deg, rgba(255,194,71,0.1) 0%, rgba(255,255,255,1) 100%); border: 1px solid rgba(255,194,71,0.3); border-radius: 16px;">
            <h3 style="color:var(--ink);">{{ __('site.company_kpi_h3', [], $loc) }}</h3>
            <div class="stat-band" style="grid-template-columns:1fr 1fr; margin:0;">
                <div class="stat-item">
                    <span class="stat-value">409</span>
                    <span class="stat-label">{{ $en ? 'Direct employees' : 'Emplois directs' }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">1 500</span>
                    <span class="stat-label">{{ $en ? 'Subcontracted workers' : 'Travailleurs sous-traitants' }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">60%</span>
                    <span class="stat-label">{{ $en ? 'Local & regional employment' : 'Emploi local et régional' }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">99%</span>
                    <span class="stat-label">{{ $en ? 'Burkinabe workers' : 'Travailleurs burkinabè' }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
