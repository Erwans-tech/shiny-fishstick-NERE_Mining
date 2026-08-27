{{-- Page : Ressources minérales --}}
@extends('layouts.app')

@section('content')
<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.karma') : route('karma') }}">{{ __('site.nav_karma', [], $loc) }}</a>
        <a href="{{ $en ? route('english.resources') : route('resources') }}" class="active">{{ __('site.nav_karma_resources', [], $loc) }}</a>
        <a href="{{ $en ? route('english.reserves') : route('reserves') }}">{{ __('site.nav_karma_reserves', [], $loc) }}</a>
    </div>

    <h2>{{ __('site.karma_resources_h2', [], $loc) }}</h2>
    <div class="grid-2" style="align-items:center;">
        <div>
            <p class="lead">{{ __('site.karma_resources_lead', [], $loc) }}</p>
            <p>{{ __('site.karma_resources_detail', [], $loc) }}</p>
        </div>
        <img class="card-img" src="{{ asset('images/mining/karma-02.jpg') }}"
             alt="{{ __('site.karma_resources_image_alt', [], $loc) }}">
    </div>
</section>
@endsection