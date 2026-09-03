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
    .future-crawler { position:absolute; z-index:3; left:0; bottom:8px; width:94px; height:48px; opacity:0; pointer-events:none; transform:translateX(-110px); transition:transform .55s cubic-bezier(.22,1,.36,1),opacity .25s ease; filter:drop-shadow(0 6px 7px rgba(0,0,0,.42)); }
    .future-crawler::before { content:""; position:absolute; left:7px; bottom:0; width:80px; height:15px; border:2px solid #0d0c0c; border-radius:10px; background:repeating-linear-gradient(90deg,#30221d 0 9px,#bd8731 9px 11px); box-shadow:inset 0 3px 0 rgba(255,194,71,.18); }
    .future-crawler::after { content:""; position:absolute; left:19px; bottom:13px; width:53px; height:21px; border-radius:4px 9px 3px 3px; background:linear-gradient(135deg,#ffc247,#c77920); border:2px solid #704319; box-shadow:-14px 7px 0 -5px #a9631d; }
    .future-crawler-cab { position:absolute; left:45px; bottom:30px; width:26px; height:17px; border:2px solid #704319; border-bottom:0; border-radius:4px 6px 0 0; background:linear-gradient(135deg,#ffe08a,#d89127); box-shadow:inset 6px 0 rgba(255,255,255,.25); }
    .future-crawler-arm { position:absolute; left:67px; bottom:31px; width:27px; height:4px; background:#ffc247; transform:rotate(-27deg); transform-origin:left center; border-radius:2px; box-shadow:0 0 0 1px #704319; }
    .future-crawler[data-machine="drill"] .future-crawler-arm { height:5px; transform:rotate(-55deg); }
    .future-crawler[data-machine="loader"] .future-crawler-arm { transform:rotate(12deg); width:30px; }
    .future-crawler[data-machine="dozer"] .future-crawler-arm { left:14px; bottom:18px; transform:rotate(8deg); width:23px; }
    .future-crawler-label { position:absolute; left:50%; bottom:51px; transform:translateX(-50%); color:#ffc247; font:700 8px/1 Inter,sans-serif; letter-spacing:.12em; text-transform:uppercase; white-space:nowrap; }
    .future-steps:hover .future-crawler { opacity:1; }
    @media (prefers-reduced-motion: reduce) { .future-crawler { display:none; } }
    @media(max-width:900px) { .future-steps { grid-template-columns:repeat(2,minmax(0,1fr)); } .future-step { min-height:300px; } }
    @media(max-width:540px) { .future-steps { grid-template-columns:1fr; } .future-step { min-height:0; } .future-step + .future-step { border-left:0; border-top:1px solid rgba(255,194,71,.18); } }
</style>
<div class="karma-page">
<section id="modele-operationnel" class="sand">
    <h2>{{ __('site.karma_model_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_model_lead', [], $loc) }}</p>
    <div class="future-steps" role="list">
        <div class="future-crawler" aria-hidden="true" data-machine="excavator"><span class="future-crawler-label">CATERPILLAR</span><span class="future-crawler-cab"></span><span class="future-crawler-arm"></span></div>
        @foreach(range(1, 4) as $i)
        <article class="future-step" role="listitem"><div class="step-num">0{{ $i }}</div><h4>{{ __('site.karma_step'.$i.'_h4', [], $loc) }}</h4><p>{{ __('site.karma_step'.$i.'_p', [], $loc) }}</p></article>
        @endforeach
    </div>
</section>
</div>
<script>
    document.querySelectorAll('.future-steps').forEach(function (track) {
        var crawler = track.querySelector('.future-crawler');
        var steps = track.querySelectorAll('.future-step');
        if (!crawler) return;
        steps.forEach(function (step) {
            step.addEventListener('mouseenter', function () {
                var machines = ['drill', 'excavator', 'loader', 'dozer'];
                crawler.dataset.machine = machines[Array.prototype.indexOf.call(steps, step)] || 'excavator';
                var trackRect = track.getBoundingClientRect();
                var stepRect = step.getBoundingClientRect();
                var position = stepRect.left - trackRect.left + (stepRect.width - crawler.offsetWidth) / 2;
                crawler.style.transform = 'translateX(' + position + 'px)';
            });
        });
        track.addEventListener('mouseleave', function () {
            crawler.style.opacity = '0';
        });
        track.addEventListener('mouseenter', function () {
            crawler.style.opacity = '1';
        });
    });
</script>
@endsection
