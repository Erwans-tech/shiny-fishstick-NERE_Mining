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
                {{ $en ? 'Cookies policy' : 'Politique cookies' }}
            </h1>
        </div>

        <div style="background:rgba(255,255,255,.82); border:1px solid rgba(234,220,197,.8); border-radius:18px; padding:28px 24px; box-shadow:0 10px 24px rgba(0,0,0,.04);">
            <p>
                {{ $en ? 'This site uses cookies to ensure proper functioning and improve the user experience.' : 'Ce site utilise des cookies pour assurer le bon fonctionnement du site et améliorer l’expérience utilisateur.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">1. Essential cookies</h2>
            <p>
                {{ $en ? 'These cookies are necessary for navigation, session management and basic security. They are activated without consent because they are essential to the functioning of the site.' : 'Ces cookies sont nécessaires à la navigation, à la gestion de session et à la sécurité de base. Ils sont activés sans consentement car ils sont essentiels au fonctionnement du site.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">2. Analytics cookies</h2>
            <p>
                {{ $en ? 'Analytics cookies are used to understand how the site is used and improve content and performance. They are activated only after the user has accepted them.' : 'Les cookies analytiques servent à comprendre comment le site est utilisé et améliorer le contenu et les performances. Ils sont activés uniquement après l’acceptation de l’utilisateur.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">3. Consent management</h2>
            <p>
                {{ $en ? 'You can accept, refuse or modify your choice at any time from the cookies banner displayed on the site or from the dedicated policy page.' : 'Vous pouvez accepter, refuser ou modifier votre choix à tout moment depuis la bannière de cookies affichée sur le site ou depuis la page dédiée.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">4. Duration</h2>
            <p>
                {{ $en ? 'The lifetime of cookies depends on the purpose for which they are used and the chosen configuration.' : 'La durée de vie des cookies dépend de la finalité pour laquelle ils sont utilisés et de la configuration retenue.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">5. Contact</h2>
            <p>
                {{ $en ? 'For any question related to cookies, you can contact us via the contact form or the contact details shown in the footer.' : 'Pour toute question relative aux cookies, vous pouvez nous contacter via le formulaire de contact ou les coordonnées affichées dans le pied de page.' }}
            </p>
        </div>
    </div>
</section>
@endsection
