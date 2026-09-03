{{-- Page : Modèle opérationnel de Karma --}}
@extends('layouts.app')
@section('content')
<style>
    .future-steps { position:relative; display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:1px; overflow:hidden; background:#5f3a28; border:1px solid rgba(255,194,71,.35); border-radius:18px; box-shadow:0 18px 44px rgba(75,23,22,.2); }
    .future-step { position:relative; min-height:360px; padding:32px 26px 28px; overflow:hidden; background:linear-gradient(145deg,rgba(42,16,16,.98),rgba(75,23,22,.94)); border:0; transition:transform .3s ease,background .3s ease,box-shadow .3s ease; }
    .future-step::before { content:""; position:absolute; inset:0; background:linear-gradient(120deg,transparent 25%,rgba(255,194,71,.1) 50%,transparent 75%); transform:translateX(-120%); transition:transform .7s ease; pointer-events:none; }
    .future-step::after { content:""; position:absolute; top:22px; right:22px; width:46px; height:46px; border:1px solid rgba(255,194,71,.3); border-radius:50%; box-shadow:0 0 0 8px rgba(255,194,71,.04); }
    .future-step:hover { z-index:1; background:linear-gradient(145deg,#4b1716,#8b3424); transform:translateY(-6px); box-shadow:0 18px 32px rgba(28,7,7,.35); }
    .future-step:hover::before { transform:translateX(120%); }
    .future-step + .future-step { border-left:1px solid rgba(255,194,71,.18); }
    .future-step .step-num { position:relative; z-index:1; margin-bottom:52px; color:rgba(255,194,71,.2); font:700 58px/1 Inter,sans-serif; letter-spacing:.08em; }
    .future-step h4 { position:relative; z-index:1; margin-bottom:16px; color:#fff; font:700 15px/1.3 Inter,sans-serif; letter-spacing:.12em; text-transform:uppercase; }
    .future-step p { position:relative; z-index:1; margin:0; color:rgba(255,255,255,.72); font:14px/1.75 Inter,sans-serif; text-align:left; }
    @media(max-width:900px) { .future-steps { grid-template-columns:repeat(2,minmax(0,1fr)); } .future-step { min-height:300px; } }
    @media(max-width:540px) { .future-steps { grid-template-columns:1fr; } .future-step { min-height:0; } .future-step + .future-step { border-left:0; border-top:1px solid rgba(255,194,71,.18); } }
</style>
<div class="karma-page">
<section id="modele-operationnel" class="sand">
    <h2>{{ __('site.karma_model_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_model_lead', [], $loc) }}</p>
    <div class="future-steps" role="list">
        @foreach(range(1, 4) as $i)
        <article class="future-step" role="listitem"><div class="step-num">0{{ $i }}</div><h4>{{ __('site.karma_step'.$i.'_h4', [], $loc) }}</h4><p>{{ __('site.karma_step'.$i.'_p', [], $loc) }}</p></article>
        @endforeach
    </div>
</section>
</div>
@endsection
