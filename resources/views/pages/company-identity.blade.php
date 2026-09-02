{{-- Page : Notre identité --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<section>
    <div class="sub-nav">
        <a href="{{ $companyBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}" class="active">{{ __('site.subnav_company_identity', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.history')    : route('company.history') }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.values')     : route('company.values') }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
        <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
    </div>

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
        .identity-card { min-height: 0; display: flex; flex-direction: column; justify-content: flex-start; border-top: 3px solid var(--gold); transition: transform .3s cubic-bezier(.2,1,.36,1), box-shadow .3s; }
        .identity-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(0,0,0,0.15);
        }
        .identity-card .card-tag {
            background: rgba(255, 194, 71, 0.18);
            color: var(--green);
            border: 1px solid rgba(75, 23, 22, 0.15);
            align-self: flex-start;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .identity-card h3 {
            color: var(--green);
            margin-top: 22px;
            margin-bottom: 12px;
            font-size: 22px;
            font-weight: 600;
            line-height: 1.3;
        }
        .identity-card p {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.5;
        }
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
        <p>En premier lieu, le Néré (<em>Parkia biglobosa</em>) est un arbre providentiel et polyvalent. Dans les traditions sahéliennes, chaque composante de cet arbre (de ses feuilles à ses gousses, en passant par ses graines, son écorce et son bois) est valorisée pour l’alimentation humaine, animale ou l’artisanat. Au-delà de ses vertus nutritives, le Néré est un pilier écologique : il enrichit durablement les sols grâce à la fixation de l’azote et déploie un système racinaire puissant qui combat efficacement l’érosion. Véritable moteur des économies rurales, il incarne la durabilité et s’impose comme un modèle d’inclusion au cœur des systèmes agroforestiers.</p>
        <p>C’est cette richesse et cette résilience qui ont inspiré l’identité visuelle de notre société. Le logo de Néré Mining puise sa force dans la fleur stylisée du Néré. Représentant une coupe transversale de cette fleur, son cercle central d’un jaune éclatant symbolise la mine d’or, protégée et nourrie par son environnement.</p>
        <p>Enfin, par une heureuse harmonie linguistique, « Néré » signifie également « belle » en mooré, la principale langue parlée au Burkina Faso.</p>
        <p>À travers ce nom et ce symbole, Néré Mining réaffirme sa vision : celle d’une entreprise minière souveraine, aux racines profondes, génératrice de valeur partagée pour les communautés et bâtisseuse d’un avenir radieux pour le Burkina Faso.</p>
    </div>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card identity-card">
            <div class="card-tag">{{ __('site.company_id'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.company_id'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.company_id'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Certifications & conformité --}}
<section class="sand">
    <h2>{{ $en ? 'Certifications & Compliance' : 'Certifications et conformité' }}</h2>
    <p class="lead">{{ $en
        ? 'Néré Mining maintains international standards and certifications to ensure operational excellence and environmental responsibility.'
        : 'Néré Mining respecte les normes internationales et certifications pour assurer l\'excellence opérationnelle et la responsabilité environnementale.'
    }}</p>

    <div class="grid-3" style="margin-top:32px;">
        {{-- ISO 9001:2008 --}}
        <div class="card" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:200px; text-align:center; background:rgba(255,255,255,.9); border:1px solid rgba(255,194,71,.3);">
            <div style="font-size:3rem; color:var(--gold); margin-bottom:12px; line-height:1;">✓</div>
            <div class="card-tag" style="margin-bottom:12px;">{{ $en ? 'Quality Management' : 'Gestion de la qualité' }}</div>
            <h3 style="margin:0;">ISO 9001:2008</h3>
            <p style="font-size:13px; margin-top:8px;">{{ $en ? 'International standard for quality management systems' : 'Norme internationale de systèmes de gestion de la qualité' }}</p>
        </div>

        {{-- EITI / ITIE --}}
        <div class="card" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:200px; text-align:center; background:rgba(255,255,255,.9); border:1px solid rgba(255,194,71,.3);">
            <div style="font-size:3rem; color:var(--gold); margin-bottom:12px; line-height:1;">✓</div>
            <div class="card-tag" style="margin-bottom:12px;">{{ $en ? 'Transparency' : 'Transparence' }}</div>
            <h3 style="margin:0;">{{ $en ? 'EITI' : 'ITIE' }}</h3>
            <p style="font-size:13px; margin-top:8px;">{{ $en ? 'Extractive Industries Transparency Initiative member' : 'Membre de l\'Initiative pour la transparence de l\'industrie extractive' }}</p>
        </div>

        {{-- Environmental Commitment --}}
        <div class="card" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:200px; text-align:center; background:rgba(255,255,255,.9); border:1px solid rgba(255,194,71,.3);">
            <div style="font-size:3rem; color:var(--gold); margin-bottom:12px; line-height:1;">✓</div>
            <div class="card-tag" style="margin-bottom:12px;">{{ $en ? 'Environmental' : 'Environnement' }}</div>
            <h3 style="margin:0;">{{ $en ? 'ESG Standards' : 'Normes RSE' }}</h3>
            <p style="font-size:13px; margin-top:8px;">{{ $en ? 'Environmental, Social & Governance standards compliance' : 'Conformité aux normes environnementales, sociales et de gouvernance' }}</p>
        </div>
    </div>
</section>
@endsection
