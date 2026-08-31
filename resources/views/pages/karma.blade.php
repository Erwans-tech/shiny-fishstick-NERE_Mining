{{-- Page : Mine de Karma --}}
@extends('layouts.app')

@section('content')

<style>
    .karma-page h2,
    .karma-page h3,
    .karma-page h4 { text-align: center; }
    .karma-page > section > .lead,
    .karma-page .card p { text-align: justify; }
</style>

<div class="karma-page">
{{-- Présentation & localisation --}}
<section id="presentation">
    <h2>{{ __('site.karma_pres_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_pres_lead', [], $loc) }}</p>

    <div class="grid-2" style="margin-bottom:40px;">
        <div>
            <div class="card" style="margin-bottom:20px;">
                <h4>{{ __('site.karma_history_h4', [], $loc) }}</h4>
                <p>{{ __('site.karma_history_p', [], $loc) }}</p>
            </div>
            <div class="card" style="margin-bottom:20px;">
                <h4>{{ __('site.karma_loc_h4', [], $loc) }}</h4>
                <p>{!! nl2br(e(__('site.karma_loc_p', [], $loc))) !!}</p>
            </div>
            <div class="card">
                <h4>{{ __('site.karma_area_h4', [], $loc) }}</h4>
                <p>{{ __('site.karma_area_p', [], $loc) }}</p>
            </div>
        </div>
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125836.0!2d-2.2!3d13.63!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMine+de+Karma!5e0!3m2!1s{{ $loc }}!2sbf!4v1"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="{{ $en ? 'Location of the Karma mine' : 'Localisation de la mine de Karma' }}">
            </iframe>
        </div>
    </div>
</section>

{{-- Chiffres de production --}}
<section id="exploitation" class="sand">
    <h2>{{ __('site.karma_prod_h2', [], $loc) }}</h2>
    <div class="stat-band">
        <div class="stat-item"><span class="stat-value">80 koz</span><span class="stat-label">{{ $en ? 'Annual gold production' : "Production annuelle d'or" }}</span></div>
        <div class="stat-item"><span class="stat-value">1 200+</span><span class="stat-label">{{ $en ? 'Direct & indirect jobs' : 'Emplois directs et indirects' }}</span></div>
        <div class="stat-item"><span class="stat-value">80%</span><span class="stat-label">{{ $en ? 'Burkinabe staff' : 'Personnel burkinabè' }}</span></div>
        <div class="stat-item"><span class="stat-value">{{ $en ? 'EITI' : 'ITIE' }}</span><span class="stat-label">{{ $en ? 'Transparency member' : 'Membre transparence' }}</span></div>
    </div>
    <div class="grid-3">
        <div class="card">
            <img class="card-img" src="{{ asset('images/mining/karma-01.jpg') }}" alt="{{ $en ? 'Mining operation' : 'Opération minière' }}">
            <h3>{{ __('site.karma_card1_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_card1_p', [], $loc) }}</p>
        </div>
        <div class="card">
            <img class="card-img" src="{{ asset('images/mining/karma-03.jpg') }}" alt="{{ $en ? 'Processing' : 'Traitement' }}">
            <h3>{{ __('site.karma_card2_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_card2_p', [], $loc) }}</p>
        </div>
        <div class="card">
            <img class="card-img" src="{{ asset('images/mining/karma-04.jpg') }}" alt="{{ $en ? 'Teams' : 'Équipes' }}">
            <h3>{{ __('site.karma_card3_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_card3_p', [], $loc) }}</p>
        </div>
    </div>
</section>

{{-- Organisation --}}
<section id="organisation">
    <h2>{{ __('site.karma_org_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_org_lead', [], $loc) }}</p>
    <div class="grid-3">
        @forelse($karmaDepartments ?? collect() as $dept)
        <div class="card">
            <div class="card-tag">{{ $dept->localizedTag($loc) }}</div>
            <h3>{{ $dept->localizedTitle($loc) }}</h3>
            <p>{{ $dept->localizedBody($loc) }}</p>
        </div>
        @empty
        @foreach(range(1, 9) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.karma_dept'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.karma_dept'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_dept'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
        @endforelse
    </div>
</section>

{{-- Modèle opérationnel --}}
<section id="modele-operationnel" class="sand">
    <h2>{{ __('site.karma_model_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_model_lead', [], $loc) }}</p>
    <div class="steps" style="border:1px solid var(--line); border-radius:8px; overflow:hidden; background:#fff; margin-bottom:40px;">
        @foreach(range(1, 4) as $i)
        <div class="step">
            <div class="step-num">0{{ $i }}</div>
            <h4>{{ __('site.karma_step'.$i.'_h4', [], $loc) }}</h4>
            <p>{{ __('site.karma_step'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Impact --}}
<section id="impact">
    <h2>{{ __('site.karma_impact_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_impact_lead', [], $loc) }}</p>
    <div class="grid-2">
        <div>
            <h3>{{ __('site.karma_imp_jobs_h3', [], $loc) }}</h3>
            @foreach(range(1, 3) as $i)
            <div class="card" style="margin-bottom:14px;">
                <div class="card-tag">{{ __('site.karma_imp_job'.$i.'_tag', [], $loc) }}</div>
                <p>{{ __('site.karma_imp_job'.$i.'_p', [], $loc) }}</p>
            </div>
            @endforeach
        </div>
        <div>
            <h3>{{ __('site.karma_imp_eco_h3', [], $loc) }}</h3>
            @foreach(range(1, 3) as $i)
            <div class="card" style="margin-bottom:14px;">
                <div class="card-tag">{{ __('site.karma_imp_eco'.$i.'_tag', [], $loc) }}</div>
                <p>{{ __('site.karma_imp_eco'.$i.'_p', [], $loc) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

</div>
@endsection
