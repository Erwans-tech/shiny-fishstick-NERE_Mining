{{-- Page : Réserves minérales --}}
@extends('layouts.app')

@section('content')
<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.karma') : route('karma') }}">{{ __('site.nav_karma', [], $loc) }}</a>
        <a href="{{ $en ? route('english.resources') : route('resources') }}">{{ __('site.nav_karma_resources', [], $loc) }}</a>
        <a href="{{ $en ? route('english.reserves') : route('reserves') }}" class="active">{{ __('site.nav_karma_reserves', [], $loc) }}</a>
    </div>

    <div class="grid-2" style="align-items:center;">
        <img class="card-img" src="{{ asset('images/mining/karma-05.jpg') }}"
             alt="{{ __('site.karma_reserves_image_alt', [], $loc) }}">
        <div>
            <p class="lead">{{ __('site.karma_reserves_lead', [], $loc) }}</p>
            <p>{{ __('site.karma_reserves_detail', [], $loc) }}</p>
        </div>
    </div>
</section>
@endsection