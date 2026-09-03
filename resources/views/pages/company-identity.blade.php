{{-- Page : Notre identité --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<section>

    <p class="lead">{{ __('site.company_identity_lead', [], $loc) }}</p>

    @php
        $identityImages = [
            asset('images/identite/Image1-qwt443rdtdnnrn7bp8ramn12pvfx6i3sw3tfmpqolc.jpg'),
            asset('images/identite/Image2-qwt43i53g6u0aycarvjmokwh0mk24viuvs9he1z8qo.jpg'),
            asset('images/identite/Image3-qwt444p807oy395yjr5x74sjb9bae77j88gx3zpaf4.png')
        ];
    @endphp

    <style>
        .identity-gallery { margin: 36px 0 56px; }
        .identity-gallery figure { margin: 0; aspect-ratio: 16 / 10; overflow: hidden; border-radius: 18px; background: var(--ink); box-shadow: 0 10px 24px rgba(0,0,0,.12); }
        .identity-gallery img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform .5s cubic-bezier(.2,1,.36,1); }
        .identity-gallery figure:hover img { transform: scale(1.04); }
        .identity-description { max-width: 920px; margin: 0 auto 56px; padding: 34px clamp(22px, 4vw, 48px); border-left: 4px solid var(--gold); background: rgba(255,244,220,.7); }
        .identity-description h2 { margin-bottom: 22px; color: var(--green); }
        .identity-description p + p { margin-top: 16px; }
    </style>

    <div class="grid-3 identity-gallery" aria-label="Images de l’identité de Néré Mining">
        @foreach($identityImages as $image)
            <figure>
                <img src="{{ $image }}" alt="{{ $en ? 'Néré Mining identity image' : 'Image illustrant l’identité de Néré Mining' }}" loading="lazy">
            </figure>
        @endforeach
    </div>

    <div class="identity-description">
        <h2>Le sens des symboles : Racines, présent et avenir au Burkina Faso</h2>
        <p>Le nom « Néré » porte en lui plusieurs résonances, à la fois culturelle, écologique et humaine, profondément ancrées dans l’identité du Burkina Faso.</p>
        <p>En premier lieu, le Néré (<em>Parkia biglobosa</em>) est un arbre providentiel et polyvalent. Dans les traditions sahéliennes, chaque composante de cet arbre est valorisée pour l’alimentation humaine, animale ou l’artisanat. Au-delà de ses vertus nutritives, le Néré est un pilier écologique : il enrichit durablement les sols grâce à la fixation de l’azote et déploie un système racinaire puissant qui combat efficacement l’érosion. Véritable moteur des économies rurales, il incarne la durabilité et l’inclusion au cœur des systèmes agroforestiers.</p>
        <p>C’est cette richesse et cette résilience qui ont inspiré l’identité visuelle de notre société. Le logo de Néré Mining puise sa force dans la fleur stylisée du Néré. Son cercle central d’un jaune éclatant symbolise la mine d’or, protégée et nourrie par son environnement.</p>
        <p>Enfin, par une heureuse harmonie linguistique, « Néré » signifie également « belle » en mooré, la principale langue parlée au Burkina Faso.</p>
        <p>À travers ce nom et ce symbole, Néré Mining réaffirme sa vision : celle d’une entreprise minière souveraine, aux racines profondes, génératrice de valeur partagée pour les communautés et bâtisseuse d’un avenir radieux pour le Burkina Faso.</p>
    </div>

</section>

@endsection
