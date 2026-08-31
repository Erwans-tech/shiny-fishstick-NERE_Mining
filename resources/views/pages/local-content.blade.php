{{-- Page : Contenu Local --}}
@extends('layouts.app')
@section('content')
<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
        <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
        <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
        <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}" class="active">{{ __('site.subnav_local_content', [], $loc) }}</a>
    </div>

    <h2>{{ __('site.local_policy_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.local_policy_lead', [], $loc) }}</p>

    <div class="grid-2">
        {{-- Recrutement local --}}
        <div class="card">
            <div class="card-tag">{{ __('site.local_card1_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_recruit_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_recruit_p', [], $loc) }}</p>
        </div>
        {{-- Achats locaux --}}
        <div class="card">
            <div class="card-tag">{{ __('site.local_card2_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_purchase_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_purchase_p', [], $loc) }}</p>
        </div>
    </div>

    {{-- Résultats chiffrés --}}
    <div class="stat-band" style="margin-top:32px;">
        <div class="stat-item">
            <span class="stat-value">80%</span>
            <span class="stat-label">{{ $en ? 'Burkinabe workforce' : "Main-d'œuvre burkinabè" }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-value">1 200+</span>
            <span class="stat-label">{{ $en ? 'Direct & indirect jobs' : 'Emplois directs et indirects' }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-value">{{ $en ? 'Local' : 'Local' }}</span>
            <span class="stat-label">{{ $en ? 'Recruitment priority' : 'Recrutement prioritaire' }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-value">0</span>
            <span class="stat-label">{{ $en ? 'Application fee' : 'Coût de candidature' }}</span>
        </div>
    </div>
</section>

{{-- Programme de développement des fournisseurs --}}
<section class="sand">
    <h2>{{ __('site.local_supplier_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.local_supplier_lead', [], $loc) }}</p>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.local_supp'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_supp'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_supp'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>

</section>

@endsection
