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

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.company_id'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.company_id'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.company_id'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>
@endsection
