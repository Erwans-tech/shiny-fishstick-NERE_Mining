{{-- Page : Nos projets en développement --}}
@extends('layouts.app')

@section('content')

{{-- Projet CIL en tête de rubrique --}}
<section class="sand" id="cil-project">
    <div class="grid-2" style="align-items:center;">
        <div>
            <div class="card-tag">{{ __('site.nav_projects_cil', [], $loc) }}</div>
            <h2>{{ __('site.cil_project_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.cil_project_lead', [], $loc) }}</p>
            <a class="btn btn-dark" style="display:inline-block;"
               href="{{ $en ? route('english.projects.cil') : route('projects.cil') }}">
                {{ __('site.cil_project_cta', [], $loc) }}
            </a>
        </div>
        <img class="card-img" src="{{ asset('images/cil/cil-01.png') }}"
             alt="{{ __('site.cil_project_image_alt', [], $loc) }}">
    </div>
</section>

{{-- Projets d'exploration --}}
<section id="exploration">
    <h2>{{ __('site.projects_expl_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.projects_expl_lead', [], $loc) }}</p>

    <div class="projects-grid">
        @foreach(range(1, 3) as $i)
        <article class="card project-card">
            <div class="card-tag">{{ __('site.projects_card'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.projects_card'.$i.'_h3', [], $loc) }}</h3>
            <p>{!! __('site.projects_card'.$i.'_p', [], $loc) !!}</p>
        </article>
        @endforeach
    </div>
</section>

{{-- Carte des permis --}}
<section class="sand">
    <h2>{{ __('site.projects_map_h2', [], $loc) }}</h2>
    <div class="permits-placeholder">
        <div style="font-size:40px; margin-bottom:16px;">🗺️</div>
        <p style="font-size:16px; font-weight:600; color:var(--green); margin-bottom:8px;">
            {{ __('site.projects_map_icon_label', [], $loc) }}
        </p>
        <p>{{ __('site.projects_map_soon', [], $loc) }}</p>
    </div>
</section>

{{-- Rejoignez-nous --}}
<section id="partnerships">
    <h2>{{ __('site.projects_join_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.projects_join_lead', [], $loc) }}</p>

    <div class="grid-2">
        <div class="card">
            <div class="card-tag">{{ __('site.projects_part1_tag', [], $loc) }}</div>
            <h3>{{ __('site.projects_part1_h3', [], $loc) }}</h3>
            <p>{{ __('site.projects_part1_p', [], $loc) }}</p>
            <a class="btn btn-dark"
               style="margin-top:16px; display:inline-block;"
               href="{{ ($en ? route('english.contact') : route('contact')) }}?type=partenariat">
                {{ __('site.projects_part1_btn', [], $loc) }}
            </a>
        </div>
        <div class="card">
            <div class="card-tag">{{ __('site.projects_part2_tag', [], $loc) }}</div>
            <h3>{{ __('site.projects_part2_h3', [], $loc) }}</h3>
            <p>{{ __('site.projects_part2_p', [], $loc) }}</p>
            <a class="btn btn-gold"
               style="margin-top:16px; display:inline-block;"
               href="{{ ($en ? route('english.contact') : route('contact')) }}?type=investissement">
                {{ __('site.projects_part2_btn', [], $loc) }}
            </a>
        </div>
    </div>
</section>

@endsection
