{{-- Page : Santé et Sécurité --}}
@extends('layouts.app')

@section('content')

{{-- ── 1. Politique HSE ─────────────────────────────────── --}}
<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
        <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
        <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}" class="active">{{ __('site.subnav_hse', [], $loc) }}</a>
        <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
    </div>

    <h2>{{ __('site.hse_policy_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.hse_policy_lead', [], $loc) }}</p>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.hse_policy'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.hse_policy'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.hse_policy'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 2. Chiffres clés sécurité ───────────────────────── --}}
<section class="sand">
    <h2>{{ __('site.hse_lead', [], $loc) }}</h2>

    <div class="stat-band">
        @foreach(range(1, 4) as $i)
        <div class="stat-item">
            <span class="stat-value">{{ __('site.hse_stat'.$i.'_val', [], $loc) }}</span>
            <span class="stat-label">{{ __('site.hse_stat'.$i.'_label', [], $loc) }}</span>
        </div>
        @endforeach
    </div>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.hse_card'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.hse_card'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.hse_card'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 3. Certifications et audits ─────────────────────── --}}
<section>
    <h2>{{ __('site.hse_cert_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.hse_cert_lead', [], $loc) }}</p>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.hse_cert'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.hse_cert'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.hse_cert'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

@endsection
