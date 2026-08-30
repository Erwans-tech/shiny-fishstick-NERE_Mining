{{-- Page : Nos Communautés --}}
@extends('layouts.app')

@section('content')
@php $sustainBase = $en ? route('english.sustainability') : route('sustainability'); @endphp

{{-- ── 1. Politique + Dialogue ─────────────────────────── --}}
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
            {{-- Politique de relations communautaires --}}
            <h3>{{ __('site.communities_policy_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_policy_p', [], $loc) }}</p>

            {{-- Dialogue communautaire --}}
            <h3 style="margin-top:36px;">{{ __('site.communities_dialogue_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_dialogue_p', [], $loc) }}</p>
        </div>
        <div>
            {{-- Investissements sociaux --}}
            <h3>{{ __('site.communities_invest_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_invest_p', [], $loc) }}</p>
            <div class="card" style="background:var(--sand); border:0; margin-top:16px;">
                <h4>{{ __('site.communities_achiev_h4', [], $loc) }}</h4>
                <p>{{ __('site.communities_achiev_p', [], $loc) }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ── 2. FMD — projets réalisés ───────────────────────── --}}
<section class="sand">
    <p class="lead">{{ __('site.communities_fmd_lead', [], $loc) }}</p>
    <h3 style="margin-bottom:20px;">{{ __('site.communities_fmd_projects_h3', [], $loc) }}</h3>
    <div class="grid-3" style="grid-template-columns:repeat(2,1fr);">
        @foreach(range(1, 4) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.communities_fmd_proj'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.communities_fmd_proj'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.communities_fmd_proj'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 3. Mécanisme de gestion des plaintes ────────────── --}}
<section>
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

{{-- ── 4. Carte des villages impactés ─────────────────── --}}
<section class="sand">
    <p class="lead">{{ __('site.communities_map_lead', [], $loc) }}</p>

    <div class="grid-2">
        {{-- Carte Google Maps --}}
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125836.0!2d-2.2!3d13.63!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMine+de+Karma!5e0!3m2!1s{{ $loc }}!2sbf!4v1"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="{{ $en ? 'Map of impacted villages' : 'Carte des villages impactés' }}">
            </iframe>
        </div>
        {{-- Note explicative --}}
        <div class="card" style="background:#fff; align-self:start;">
            <div class="card-tag">{{ $en ? 'Surrounding villages' : 'Villages riverains' }}</div>
            <p>{{ __('site.communities_map_note', [], $loc) }}</p>
            <p style="margin-top:16px; padding-top:16px; border-top:1px solid var(--line); font-size:13px; color:var(--muted);">
                {{ __('site.communities_map_soon', [], $loc) }}
            </p>
        </div>
    </div>
</section>

{{-- ── 5. Partenaires communautaires ───────────────────── --}}
<section>
    <p class="lead">{{ __('site.communities_partners_p', [], $loc) }}</p>
    <h3 style="margin-bottom:20px;">{{ __('site.communities_partners_types_h3', [], $loc) }}</h3>
    <div class="grid-3" style="grid-template-columns:repeat(2,1fr);">
        @foreach(range(1, 4) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.communities_partner'.$i.'_tag', [], $loc) }}</div>
            <p>{{ __('site.communities_partner'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>

    <div style="margin-top:32px; text-align:center;">
        <a class="btn btn-dark"
           href="{{ ($en ? route('english.contact') : route('contact')) }}?type=communaute">
            {{ __('site.contact_us', [], $loc) }}
        </a>
    </div>
</section>

@endsection
