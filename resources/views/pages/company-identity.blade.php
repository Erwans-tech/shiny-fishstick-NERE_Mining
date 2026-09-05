{{-- Page : Notre identité --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

@section('masthead')
<div class="identity-masthead">
    <div class="identity-masthead__images" aria-hidden="true">
        <span style="background-image:url('{{ asset('images/identite/Image1-qwt443rdtdnnrn7bp8ramn12pvfx6i3sw3tfmpqolc.jpg') }}');"></span>
        <span style="background-image:url('{{ asset('images/identite/Image2-qwt43i53g6u0aycarvjmokwh0mk24viuvs9he1z8qo.jpg') }}');"></span>
        <span style="background-image:url('{{ asset('images/identite/Image3-qwt444p807oy395yjr5x74sjb9bae77j88gx3zpaf4.png') }}');"></span>
    </div>
    <div class="identity-masthead__veil"></div>
    <div class="identity-masthead__content">
        <h1>{{ __('site.company_identity_h1', [], $loc) }}</h1>
        <div class="breadcrumb">
            <a href="{{ $en ? route('english') : url('/') }}">{{ __('site.home_link', [], $loc) }}</a>
            › <a href="{{ $en ? route('english.company') : route('company') }}">{{ __('site.nav_company', [], $loc) }}</a>
            › {{ __('site.company_identity_breadcrumb', [], $loc) }}
        </div>
    </div>
</div>
@endsection

<section>

    @php
        $identityImages = [
            asset('images/identite/Image1-qwt443rdtdnnrn7bp8ramn12pvfx6i3sw3tfmpqolc.jpg'),
            asset('images/identite/Image2-qwt43i53g6u0aycarvjmokwh0mk24viuvs9he1z8qo.jpg'),
            asset('images/identite/Image3-qwt444p807oy395yjr5x74sjb9bae77j88gx3zpaf4.png')
        ];
    @endphp

    <style>
        .identity-masthead { position:relative; min-height:360px; display:grid; place-items:center; overflow:hidden; color:#fff; background:var(--green); }
        .identity-masthead__images { position:absolute; inset:0; display:grid; grid-template-columns:repeat(3,1fr); gap:3px; opacity:.78; transform:scale(1.03); }
        .identity-masthead__images span { display:block; background-position:center; background-size:cover; filter:saturate(.9); }
        .identity-masthead__veil { position:absolute; inset:0; background:linear-gradient(90deg,rgba(45,13,16,.94),rgba(75,23,22,.68) 50%,rgba(45,13,16,.9)),linear-gradient(180deg,transparent 30%,rgba(20,8,6,.5)); }
        .identity-masthead__content { position:relative; z-index:1; width:min(100% - 40px,1100px); text-align:center; }
        .identity-masthead h1 { display:inline-block; max-width:100%; margin:0 auto 20px; padding:18px 28px; color:#fff; background:rgba(35,9,10,.52); border:1px solid var(--gold); border-left:8px solid var(--gold); border-radius:4px; font-size:clamp(30px,4.8vw,62px); line-height:1.08; text-shadow:0 4px 18px rgba(0,0,0,.55); box-shadow:0 0 0 5px rgba(255,194,71,.08),0 10px 30px rgba(20,8,6,.25); }
        .identity-masthead .breadcrumb { justify-content:center; color:rgba(255,255,255,.72); }
        .identity-masthead .breadcrumb a { color:var(--gold); }
        @media (max-width:700px) { .identity-masthead { min-height:300px; } .identity-masthead__images { grid-template-columns:1fr; } .identity-masthead__images span:not(:first-child) { display:none; } .identity-masthead h1 { padding:14px 18px; font-size:clamp(28px,8vw,44px); } }
        .identity-gallery { margin: 36px 0 56px; }
        .identity-gallery figure { margin: 0; aspect-ratio: 16 / 10; overflow: hidden; border-radius: 18px; background: var(--ink); box-shadow: 0 10px 24px rgba(0,0,0,.12); }
        .identity-gallery img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform .5s cubic-bezier(.2,1,.36,1); }
        .identity-gallery figure:hover img { transform: scale(1.04); }
        .identity-description { position:relative; max-width:920px; margin:0 auto 56px; padding:42px clamp(24px,5vw,58px); border:1px solid rgba(75,23,22,.12); border-left:6px solid var(--gold); border-radius:4px 16px 16px 4px; background:linear-gradient(135deg,rgba(255,248,232,.96),rgba(255,244,220,.78)); box-shadow:0 16px 36px rgba(40,29,24,.08),inset 0 1px 0 rgba(255,255,255,.8); overflow:hidden; }
        .identity-description h2 { max-width:760px; margin:0 auto 24px; color:var(--green); font-size:clamp(24px,3vw,34px); line-height:1.18; text-align:center; }
        .identity-description p { max-width:790px; color:var(--muted); font-size:15px; line-height:1.85; }
        .identity-description p + p { margin-top:18px; }
        @media (max-width:700px) { .identity-description { padding:30px 22px; border-left-width:4px; border-radius:3px 12px 12px 3px; } .identity-description p { font-size:14px; line-height:1.75; } }
    </style>

    <div class="grid-3 identity-gallery" aria-label="Images de l’identité de Néré Mining">
        @foreach($identityImages as $image)
            <figure>
                <img src="{{ $image }}" alt="{{ $en ? 'Néré Mining identity image' : 'Image illustrant l’identité de Néré Mining' }}" loading="lazy">
            </figure>
        @endforeach
    </div>

    <div class="identity-description">
        <h2>{{ __('site.company_identity_symbols_h2', [], $loc) }}</h2>
        <p>{{ __('site.company_identity_symbols_p1', [], $loc) }}</p>
        <p>{{ __('site.company_identity_symbols_p2', [], $loc) }}</p>
        <p>{{ __('site.company_identity_symbols_p3', [], $loc) }}</p>
        <p>{{ __('site.company_identity_symbols_p4', [], $loc) }}</p>
        <p>{{ __('site.company_identity_symbols_p5', [], $loc) }}</p>
    </div>

</section>

@endsection
