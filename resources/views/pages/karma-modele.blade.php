{{-- Page : Modèle opérationnel de Karma --}}
@extends('layouts.app')
@section('content')
<div class="karma-page">
<section id="modele-operationnel" class="sand">
    <h2>{{ __('site.karma_model_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_model_lead', [], $loc) }}</p>
    <div class="steps" style="border:1px solid var(--line);border-radius:8px;overflow:hidden;background:#fff;margin-bottom:40px;">
        @foreach(range(1, 4) as $i)
        <div class="step"><div class="step-num">0{{ $i }}</div><h4>{{ __('site.karma_step'.$i.'_h4', [], $loc) }}</h4><p>{{ __('site.karma_step'.$i.'_p', [], $loc) }}</p></div>
        @endforeach
    </div>
</section>
</div>
@endsection
