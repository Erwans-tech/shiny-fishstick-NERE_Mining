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
    <h2>{{ __('site.cil_project_value_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.cil_project_value_p', [], $loc) }}</p>
</section>
@endsection