{{-- Page : Projet CIL --}}
@extends('layouts.app')

@section('content')
<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.projects') : route('projects') }}">{{ __('site.nav_projects', [], $loc) }}</a>
        <a href="{{ $en ? route('english.projects.cil') : route('projects.cil') }}" class="active">{{ __('site.nav_projects_cil', [], $loc) }}</a>
    </div>

    <h2>{{ __('site.cil_project_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.cil_project_lead', [], $loc) }}</p>

    <div class="grid-2" style="margin-top:36px;">
        <div class="card">
            <div class="card-tag">{{ __('site.cil_project_location_tag', [], $loc) }}</div>
            <h3>{{ __('site.cil_project_location_h3', [], $loc) }}</h3>
            <p>{{ __('site.cil_project_location_p', [], $loc) }}</p>
        </div>
        <div class="card">
            <div class="card-tag">{{ __('site.cil_project_assets_tag', [], $loc) }}</div>
            <h3>{{ __('site.cil_project_assets_h3', [], $loc) }}</h3>
            <p>{{ __('site.cil_project_assets_p', [], $loc) }}</p>
        </div>
    </div>
</section>

<section class="sand">
    <h2>{{ __('site.cil_project_gallery_h2', [], $loc) }}</h2>
    <div class="grid-3">
        @foreach([
            ['cil-01.png', 'cil_project_image_1_alt'],
            ['cil-02.jpg', 'cil_project_image_2_alt'],
            ['cil-lexiviation.jpg', 'cil_project_image_3_alt'],
            ['cil-03.png', 'cil_project_image_4_alt'],
            ['cil-04.png', 'cil_project_image_5_alt'],
        ] as [$image, $alt])
        <figure class="card" style="padding:0; overflow:hidden;">
            <img src="{{ asset('images/cil/'.$image) }}"
                 alt="{{ __('site.'.$alt, [], $loc) }}"
                 style="width:100%; height:220px; object-fit:cover;">
        </figure>
        @endforeach
    </div>
</section>

<section class="sand">
    <h2>{{ __('site.cil_project_value_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.cil_project_value_p', [], $loc) }}</p>
</section>
@endsection