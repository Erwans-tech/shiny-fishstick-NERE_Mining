@php
    $loc = $loc ?? app()->getLocale();
    $en = $en ?? ($loc === 'en');
@endphp

@extends('layouts.app')

@section('content')
<section>
    <div style="max-width:980px; margin:0 auto; padding:40px 0 20px;">
        <div style="margin-bottom:24px;">
            <span style="display:inline-block; padding:8px 14px; border-radius:999px; background:rgba(255,194,71,.12); color:#4b1716; font-weight:700; letter-spacing:.08em; text-transform:uppercase; font-size:11px;">
                {{ $en ? 'Legal' : 'Juridique' }}
            </span>
            <h1 style="margin-top:18px; font-size:clamp(30px,4vw,52px); line-height:1.1; color:#281d18; letter-spacing:-.04em;">
                {{ $en ? 'Legal notice' : 'Mentions légales' }}
            </h1>
        </div>

        <div style="background:rgba(255,255,255,.82); border:1px solid rgba(234,220,197,.8); border-radius:18px; padding:28px 24px; box-shadow:0 10px 24px rgba(0,0,0,.04);">
            <p>
                {{ $en ? 'Néré Mining is responsible for the publication of this website.' : 'Néré Mining est responsable de la publication de ce site web.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">1. Publisher</h2>
            <p>
                {{ $en ? 'Néré Mining  - mining and industrial group active in Burkina Faso.' : 'Néré Mining  - groupe minier et industriel actif au Burkina Faso.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">2. Contact</h2>
            <p>
                {{ $en ? 'Contact details are indicated in the footer of the site and on the contact page.' : 'Les coordonnées de contact sont indiquées dans le pied de page du site et sur la page contact.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">3. Website hosting</h2>
            <p>
                {{ $en ? 'This website is hosted on the hosting provider selected for production. The relevant details are communicated in the project documentation.' : 'Ce site est hébergé par le fournisseur choisi pour la production. Les détails correspondants sont communiqués dans la documentation du projet.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">4. Intellectual property</h2>
            <p>
                {{ $en ? 'All content published on this site is protected by intellectual property rights unless otherwise stated.' : 'Tout le contenu publié sur ce site est protégé par les droits de propriété intellectuelle, sauf mention contraire.' }}
            </p>
        </div>
    </div>
</section>
@endsection
