{{-- Page : Nos projets en développement --}}
@extends('layouts.app')

@section('content')

{{-- Projet CIL en tête de rubrique --}}
<style>
    .project-card {
        background: linear-gradient(180deg, #ffffff 0%, #f4eee6 100%);
        border: 1px solid rgba(75,23,22,0.1);
        border-radius: 16px;
        transition: transform 0.3s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.3s, border-color 0.3s;
    }
    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(40,29,24,0.08);
        border-color: rgba(255,194,71,0.5);
    }
</style>
<section class="sand sr" id="cil-project">
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
        <img style="width: 100%; max-width: 100%; height: auto; border-radius: 6px; box-shadow: 0 4px 18px rgba(0,0,0,.08);" src="{{ asset('images/cil/cil-01.png') }}"
             alt="{{ __('site.cil_project_image_alt', [], $loc) }}">
    </div>
</section>

{{-- Projets d'exploration --}}
<section id="exploration">
    <h2>{{ __('site.projects_expl_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.projects_expl_lead', [], $loc) }}</p>

    <div class="projects-grid">
        @foreach(range(1, 3) as $i)
        <article class="card project-card sr">
            <div class="card-tag">{{ __('site.projects_card'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.projects_card'.$i.'_h3', [], $loc) }}</h3>
            <p>{!! __('site.projects_card'.$i.'_p', [], $loc) !!}</p>
        </article>
        @endforeach
    </div>
</section>

<section class="sand sr" style="margin-top: 24px;">
    <div class="card" style="padding: 28px;">
        <div class="card-tag">{{ $en ? 'Priority' : 'Priorité' }}</div>
        <h3>{{ $en ? 'A disciplined exploration strategy' : 'Une stratégie d’exploration disciplinée' }}</h3>
        <p style="margin:0; text-align:justify;">
            {{ $en
                ? 'Each project is evaluated through geological analysis, resource potential and a realistic development timeline. The objective is to identify deposits that can create value while staying aligned with responsible mining standards and local expectations.'
                : 'Chaque projet est évalué selon son potentiel géologique, sa valeur économique et un calendrier de développement réaliste. L’objectif est d’identifier des gisements capables de créer de la valeur tout en restant alignés avec les normes minières responsables et les attentes locales.' }}
        </p>
    </div>
</section>



@endsection
