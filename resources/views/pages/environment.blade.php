{{-- Page : Environnement --}}
@extends('layouts.app')

@section('content')

<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
        <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}" class="active">{{ __('site.subnav_environment', [], $loc) }}</a>
        <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
        <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
    </div>

    <p class="lead">{{ __('site.environment_lead', [], $loc) }}</p>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.env_card'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.env_card'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.env_card'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

@endsection
