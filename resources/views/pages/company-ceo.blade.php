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


    <div class="pdg-block">
        <div>
            <div class="pdg-photo" style="height:320px; border-radius:6px; display:flex; align-items:center; justify-content:center; background:#5a2020;">
                <span style="color:rgba(255,255,255,.35); font-size:13px; text-align:center;">
                    {{ __('site.company_photo_placeholder', [], $loc) }}
                </span>
            </div>
        </div>
        <div>
            <p class="pdg-quote" style="font-size:24px; line-height:1.5; color:rgba(255,255,255,.9);">
                {{ __('site.company_pdg_quote', [], $loc) }}
            </p>
            <div class="pdg-name">{{ __('site.company_pdg_name', [], $loc) }}</div>
            <div class="pdg-title">{{ __('site.company_pdg_company', [], $loc) }}</div>
        </div>
    </div>
</section>
@endsection
