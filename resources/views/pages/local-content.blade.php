{{-- Page : Contenu Local --}}
@extends('layouts.app')

@section('content')

<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
        <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
        <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
        <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}" class="active">{{ __('site.subnav_local_content', [], $loc) }}</a>
    </div>

    <p class="lead">{{ __('site.local_lead', [], $loc) }}</p>

    <div class="grid-2">
        <div class="card">
            <div class="card-tag">{{ __('site.local_card1_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_card1_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_card1_p', [], $loc) }}</p>
        </div>
        <div class="card">
            <div class="card-tag">{{ __('site.local_card2_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_card2_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_card2_p', [], $loc) }}</p>
        </div>
        <div class="card" style="grid-column:span 2;">
            <div class="card-tag">{{ __('site.local_card3_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_card3_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_card3_p', [], $loc) }}</p>
            <a class="btn btn-dark"
               style="margin-top:16px; display:inline-block;"
               href="{{ ($en ? route('english.contact') : route('contact')) }}?type=fournisseur">
                {{ __('site.local_card3_btn', [], $loc) }}
            </a>
        </div>
    </div>
</section>

@endsection
