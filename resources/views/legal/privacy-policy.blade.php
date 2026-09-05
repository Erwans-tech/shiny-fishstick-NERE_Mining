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
                {{ $en ? 'Privacy policy' : 'Politique de confidentialité' }}
            </h1>
        </div>

        <div style="background:rgba(255,255,255,.82); border:1px solid rgba(234,220,197,.8); border-radius:18px; padding:28px 24px; box-shadow:0 10px 24px rgba(0,0,0,.04);">
            <p>
                {{ $en ? 'This privacy policy explains how Néré Mining collects, uses and protects information on this website.' : 'Cette politique de confidentialité explique comment Néré Mining collecte, utilise et protège les informations sur ce site web.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">1. Information collected</h2>
            <p>
                {{ $en ? 'We may collect information such as your email address, the content of your contact or application forms, technical information such as your browser and IP address, and navigation data for site operation and statistics.' : 'Nous pouvons collecter des informations telles que votre adresse e-mail, le contenu de vos formulaires de contact ou de candidature, des informations techniques telles que votre navigateur et votre adresse IP, ainsi que des données de navigation pour le fonctionnement du site et les statistiques.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">2. Use of information</h2>
            <p>
                {{ $en ? 'The information is used to manage requests, respond to applications, improve the user experience, and ensure the proper functioning of the site.' : 'Les informations sont utilisées pour gérer les demandes, répondre aux candidatures, améliorer l’expérience utilisateur et assurer le bon fonctionnement du site.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">3. Cookies</h2>
            <p>
                {{ $en ? 'The site may use technical cookies necessary for its operation and analytics cookies when the user has explicitly accepted them. You can refuse or withdraw your consent at any time.' : 'Le site peut utiliser des cookies techniques nécessaires à son fonctionnement et des cookies analytiques lorsque l’utilisateur les a explicitement acceptés. Vous pouvez refuser ou retirer votre consentement à tout moment.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">4. Data retention</h2>
            <p>
                {{ $en ? 'The retention period of personal data varies according to the purpose of the collection and legal obligations.' : 'La durée de conservation des données personnelles varie selon la finalité de la collecte et les obligations légales.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">5. Your rights</h2>
            <p>
                {{ $en ? 'You may request access, correction or deletion of your personal data, as well as object to certain processing operations, in accordance with applicable law.' : 'Vous pouvez demander l’accès, la correction ou la suppression de vos données personnelles, ainsi que vous opposer à certaines opérations de traitement, conformément à la loi applicable.' }}
            </p>

            <h2 style="font-size:1.4rem; color:#4b1716; margin:26px 0 12px;">6. Contact</h2>
            <p>
                {{ $en ? 'For any request related to this privacy policy, please contact us using the contact form on the site or the contact details shown in the footer.' : 'Pour toute demande liée à cette politique de confidentialité, veuillez nous contacter via le formulaire de contact du site ou les coordonnées affichées dans le pied de page.' }}
            </p>
        </div>
    </div>
</section>
@endsection
