{{-- Page : Impact de Karma --}}
@extends('layouts.app')
@section('content')
<style>
    .karma-page .karma-impact-card .card-tag {
        margin-bottom:18px;
        padding:7px 14px;
        font-size:14px;
        letter-spacing:.09em;
        line-height:1.3;
        text-align:center;
    }
    @media (max-width:600px) {
        .karma-page .karma-impact-card .card-tag { font-size:12px; }
    }
</style>
<div class="karma-page">
<section id="impact">
    <h2>{{ __('site.karma_impact_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_impact_lead', [], $loc) }}</p>
    <div class="grid-2">
        <div>
            <h3>{{ __('site.karma_imp_jobs_h3', [], $loc) }}</h3>
            @foreach(range(1, 3) as $i)
            <div class="card karma-impact-card" style="margin-bottom:18px;"><div class="card-tag">{{ __('site.karma_imp_job'.$i.'_tag', [], $loc) }}</div><p>{{ __('site.karma_imp_job'.$i.'_p', [], $loc) }}</p></div>
            @endforeach
        </div>
        <div>
            <h3>{{ __('site.karma_imp_eco_h3', [], $loc) }}</h3>
            @foreach(range(1, 3) as $i)
            <div class="card karma-impact-card" style="margin-bottom:18px;"><div class="card-tag">{{ __('site.karma_imp_eco'.$i.'_tag', [], $loc) }}</div><p>{{ __('site.karma_imp_eco'.$i.'_p', [], $loc) }}</p></div>
            @endforeach
        </div>
    </div>
</section>
</div>
@endsection
