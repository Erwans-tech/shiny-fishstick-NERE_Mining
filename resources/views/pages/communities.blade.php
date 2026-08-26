{{-- Page : Nos Communautés --}}
@extends('layouts.app')

@section('content')

@php
    $sustainBase = $en ? route('english.sustainability') : route('sustainability');
@endphp

<section>
    <div class="sub-nav">
        <a href="{{ $sustainBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}" class="active">{{ __('site.subnav_communities', [], $loc) }}</a>
        <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
        <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
        <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
    </div>

    <p class="lead">{{ __('site.communities_lead', [], $loc) }}</p>

    <div class="grid-2">
        <div>
            <h3>{{ __('site.communities_policy_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_policy_p', [], $loc) }}</p>
            <h3 style="margin-top:28px;">{{ __('site.communities_dialogue_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_dialogue_p', [], $loc) }}</p>
        </div>
        <div>
            <h3>{{ __('site.communities_invest_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_invest_p', [], $loc) }}</p>
            <div class="card" style="background:var(--sand); border:0; margin-top:20px;">
                <h4>{{ __('site.communities_achiev_h4', [], $loc) }}</h4>
                <p>{{ __('site.communities_achiev_p', [], $loc) }}</p>
            </div>
        </div>
    </div>
</section>

{{-- Mécanisme de gestion des plaintes --}}
<section class="sand">
    <h2>{{ __('site.communities_complaint_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.communities_complaint_lead', [], $loc) }}</p>
    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.communities_step'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.communities_step'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_step'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Partenaires communautaires --}}
<section>
    <h2>{{ __('site.communities_partners_h2', [], $loc) }}</h2>
    <p>{{ __('site.communities_partners_p', [], $loc) }}</p>
</section>

@endsection
