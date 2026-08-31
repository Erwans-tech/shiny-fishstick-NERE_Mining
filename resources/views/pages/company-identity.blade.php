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
            overflow: hidden;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        .identity-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(20, 35, 25, 0.4) 0%, rgba(13, 29, 19, 0.95) 100%);
            z-index: 1;
            transition: opacity 0.3s ease;
        }
        .identity-card:hover::before {
            background: linear-gradient(180deg, rgba(20, 35, 25, 0.5) 0%, rgba(13, 29, 19, 1) 100%);
        }
        .identity-card > * {
            position: relative;
            z-index: 2;
        }
        .identity-card .card-tag {
            background: rgba(255, 194, 71, 0.2);
            color: var(--gold);
            border: 1px solid rgba(255, 194, 71, 0.3);
            align-self: flex-start;
        }
        .identity-card h3 {
            color: #fff;
            margin-top: auto;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        .identity-card p {
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
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
@endsection
