{{--
    Layout partagé pour toutes les pages publiques.

    Variables attendues depuis le contrôleur / route :
      $locale   string   'fr' | 'en'
      $section  string   slug de la section (ex: 'karma', 'company-ceo'…)
      $title    string   (optionnel) titre <title> custom

    Slots Blade :
      @yield('head')          styles/scripts supplémentaires dans <head>
      @yield('masthead')      contenu masthead (fourni par le layout lui-même par défaut)
      @yield('content')       contenu principal de la page
--}}
@php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';

    $isCompany = in_array($section, [
        'company','company-ceo','company-identity',
        'company-history','company-values','company-governance',
    ]);
    $isSustain = in_array($section, [
        'sustainability','communities','environment','hse','local-content',
    ]);
    $isNews = in_array($section, [
        'news','press','gallery','reports','press-contact',
    ]);

    $mastheadSection = str_replace('-', '_', $section);
    $mastheadImages = [
        // Qui Sommes-Nous
        'company' => 'images/headers/usine-traitement-or-illuminee-nuit.jpeg',
        'company_ceo' => 'images/mining/mining-workers-01.jpg',
        'company_identity' => 'images/headers/coulee-or-fusion-creuset-metallurgie.jpeg',
        'company_history' => 'images/mining/karma-03.jpg',
        'company_values' => 'images/headers/equipe-inspection-site-mine-drapeau-securite.jpeg',
        'company_governance' => 'images/mining/mining-site-aerial-01.jpg',
        
        // Mine Karma
        'karma' => 'images/headers/usine-traitement-or-illuminee-nuit.jpeg',
        'karma_exploitation' => 'images/headers/camion-benne-mine-fosse-exploitation.jpeg',
        'karma_organisation' => 'images/headers/soudeurs-reparation-equipement-minier-atelier.jpeg',
        'karma_modele' => 'images/headers/installation-broyage-minerai-crepuscule.jpeg',
        'karma_impact' => 'images/headers/route-bitumee-panneau-signalisation-projet-ebm.jpeg',
        'karma_resources_reserves' => 'images/resources/resources-reserves-2025.jpg',
        'reserves' => 'images/mining/karma-05.jpg',
        
        // Projets
        'projects' => 'images/headers/equipe-inspection-site-mine-drapeau-securite.jpeg',
        'cil_project' => 'images/headers/installation-broyage-minerai-crepuscule.jpeg',
        
        // Développement Durable
        'sustainability' => 'images/headers/techniciens-installation-pipeline-eau-mine.jpeg',
        'communities' => 'images/headers/ceremonie-communaute-locale-terrain-rural.jpeg',
        'environment' => 'images/headers/techniciens-installation-pipeline-eau-mine.jpeg',
        'hse' => 'images/headers/equipe-inspection-site-mine-drapeau-securite.jpeg',
        'local_content' => 'images/headers/soudeurs-reparation-equipement-minier-atelier.jpeg',
        
        // Actualités & Presse
        'news' => 'images/mining/karma-01.jpg',
        'press' => 'images/headers/usine-traitement-or-illuminee-nuit.jpeg',
        'gallery' => 'images/mining/karma-02.jpg',
        'reports' => 'images/mining/karma-05.jpg',
        'press_contact' => 'images/mining/mining-workers-01.jpg',
        
        // Carrières
        'careers' => 'images/headers/soudeurs-reparation-equipement-minier-atelier.jpeg',
    ];
    $mastheadImage = asset($mastheadImages[$mastheadSection] ?? 'images/mining/karma-03.jpg');
@endphp
<!DOCTYPE html>
<html lang="{{ $loc }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? __('site.'.$mastheadSection.'_h1', [], $loc) }} | Néré Mining</title>
    <meta name="description" content="{{ $description ?? '' }}">
    {!! App\Helpers\CanonicalHelper::render($section, $loc) !!}
    {!! App\Helpers\CanonicalHelper::renderHreflang($section, $loc) !!}
    {!! App\Helpers\OpenGraphHelper::render($section, $loc, $description ?? null) !!}
    @if($isSustain)
    <script>document.documentElement.classList.add('sustain-js');</script>
    @endif
    <link rel="stylesheet" href="{{ asset('css/sustainability-animations.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chrome.css') }}?v={{ filemtime(public_path('css/chrome.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}?v={{ filemtime(public_path('css/animations.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/text-fixes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive-global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/text-containers-responsive.css') }}">
    <style>
        /* ══ Variables ══════════════════════════════════════════ */
        :root {
            --ink:#281d18; --green:#4b1716; --red:#d72f2f; --gold:#ffc247;
            --gold2:#e5a72f; --sand:#fff4dc; --muted:#70645c; --line:#eadcc5; --light:#fbfaf7;
        }
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        html { scroll-behavior:smooth; }
        body {
            color:var(--ink);
            background-color:#efe9e1;
            background-image:
                radial-gradient(circle at top left, rgba(255,194,71,.14), transparent 20%),
                radial-gradient(circle at bottom right, rgba(75,23,22,.12), transparent 24%),
                linear-gradient(135deg, rgba(30,22,19,.04) 0, rgba(30,22,19,.04) 1px, transparent 1px, transparent 36px),
                linear-gradient(45deg, rgba(255,194,71,.05) 0, rgba(255,194,71,.05) 1px, transparent 1px, transparent 36px),
                linear-gradient(180deg, #f8f3ee 0%, #ece5dc 100%);
            background-size:100% 100%,100% 100%,36px 36px,36px 36px,100% 100%;
            animation:siteAtmosphere 42s ease-in-out infinite alternate;
            font-family:'Inter',Arial,Helvetica,sans-serif; font-size:17px;
        }
        body::before {
            content:"";
            position:fixed;
            inset:0;
            pointer-events:none;
            background:
                linear-gradient(90deg, rgba(18,14,12,.06), rgba(18,14,12,0) 34%, rgba(18,14,12,.04) 100%),
                repeating-linear-gradient(0deg, transparent 0, transparent 2px, rgba(17,14,12,.03) 2px, rgba(17,14,12,.03) 3px);
            opacity:.9;
        }
        @keyframes siteAtmosphere { from { background-position:0% 0%,0 0,0 0,0 0,0 0; } to { background-position:0% 0%,0 0,18px 18px,18px 18px,0 0; } }
        a { color:inherit; text-decoration:none; }
        img { max-width:100%; }
        .site-icon { display:inline-grid; width:1.15em; height:1.15em; place-items:center; vertical-align:-.18em; color:var(--gold2); }
        .site-icon svg { width:100%; height:100%; fill:none; stroke:currentColor; stroke-linecap:round; stroke-linejoin:round; stroke-width:1.8; }

        /* ── Scroll Reveal ── */
        .sr { opacity:0; transform:translateY(28px); transition:opacity .7s cubic-bezier(.22,1,.36,1), transform .7s cubic-bezier(.22,1,.36,1); }
        .sr.is-visible { opacity:1; transform:translateY(0); }
        .sr-delay-1 { transition-delay:.1s; }
        .sr-delay-2 { transition-delay:.2s; }
        .sr-delay-3 { transition-delay:.3s; }
        .sr-delay-4 { transition-delay:.4s; }
        .sr-delay-5 { transition-delay:.5s; }
        @media (prefers-reduced-motion: reduce) and (min-width: 99999px) { .sr { opacity:1; transform:none; transition:none; } }

        /* ── Topbar ── */
        .topbar { background:var(--red); color:#fff7e8; padding:9px 5vw; display:flex; justify-content:space-between; font:11px Inter,sans-serif; letter-spacing:.06em; text-transform:uppercase; }

        /* Header / footer : styles dans partials._nav et partials._footer */

        /* ── Masthead ── */
        .masthead {
            position:relative;
            padding:100px 5vw 75px;
            color:white;
            background:linear-gradient(100deg,rgba(75,23,22,.97) 40%,rgba(75,23,22,.5)),url('{{ $mastheadImage }}') center/cover;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            text-align:center;
            overflow:hidden;
        }
        .masthead h1 {
            margin-left:auto;
            margin-right:auto;
            text-align:center;
        }
        .masthead::after {
            content:'';
            position:absolute;
            bottom:0; left:0; right:0;
            height:5px;
            background:linear-gradient(90deg, var(--gold), var(--gold2) 60%, transparent 100%);
        }
        .eyebrow { display:none; }
        .masthead h1 {
            display:inline-block;
            max-width:1000px;
            width:fit-content;
            padding:0.22em 0.5em 0.26em;
            background:rgba(34,11,11,.6);
            border:2px solid rgba(255,194,71,.85);
            border-left:8px solid rgba(255,194,71,.85);
            border-right:8px solid rgba(255,194,71,.85);
            border-radius:4px;
            box-shadow:0 0 0 2px rgba(255,255,255,.06), 0 28px 56px rgba(0,0,0,.28);
            font-size:clamp(34px,5vw,64px);
            line-height:.96;
            font-weight:400;
            color:#fff;
            letter-spacing:-.04em;
            text-align:center;
            animation:mastheadTitle .9s cubic-bezier(.22,1,.36,1) both;
        }
        @keyframes mastheadTitle { from { opacity:0; transform:translateY(18px) scale(.98); } to { opacity:1; transform:translateY(0) scale(1); } }
        .breadcrumb {
            margin-top:22px;
            font:500 12px Inter,sans-serif;
            color:rgba(255,255,255,.55);
            display:flex; align-items:center; gap:8px;
            animation:mastheadTitle .9s cubic-bezier(.22,1,.36,1) .15s both;
        }
        .breadcrumb a { color:var(--gold); transition:color .15s; }
        .breadcrumb a:hover { color:#fff; text-decoration:underline; }

        /* ── Contenu ── */
        main { width:100%; max-width:1440px; margin:0 auto; }
        section { padding:clamp(48px,6vw,88px) clamp(24px,5vw,72px); }
        section + section { padding-top:0; }
        .lead { width:100%; max-width:none; color:var(--muted); font:clamp(16px,1.35vw,19px)/1.8 Inter,sans-serif; margin-bottom:clamp(32px,4vw,48px); }
        h2 {
            color:var(--ink);
            font-size:clamp(26px,2.6vw,40px);
            font-weight:600;
            line-height:1.15;
            margin:0 0 18px;
            letter-spacing:-.03em;
            position:relative;
        }
        section > h2 {
            margin-left:auto;
            margin-right:auto;
            text-align:center;
        }
        h3 { color:var(--green); font-size:23px; font-weight:500; margin-bottom:12px; }
        h4 { color:var(--green); font-size:16px; font-weight:600; margin-bottom:8px; letter-spacing:.04em; text-transform:uppercase; }
        p { color:var(--muted); font:19px/1.8 Inter,sans-serif; margin-bottom:12px; text-align:justify; }

        /* ── Grilles & Cards ── */
        .grid-3 { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:clamp(18px,2.2vw,32px); }
        .grid-2 { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:clamp(20px,2.5vw,36px); align-items:start; }
        .card {
            padding:30px;
            border:1px solid var(--line);
            background:rgba(255,255,255,.88);
            backdrop-filter:blur(6px);
            -webkit-backdrop-filter:blur(6px);
            border-radius:14px;
            position:relative;
            overflow:hidden;
            transition:box-shadow .3s cubic-bezier(.22,1,.36,1), transform .3s cubic-bezier(.22,1,.36,1), border-color .3s;
        }
        .card::before {
            content:'';
            position:absolute;
            top:0; left:0; right:0;
            height:3px;
            background:linear-gradient(90deg, var(--gold), var(--gold2));
            transform:scaleX(0);
            transform-origin:left;
            transition:transform .35s cubic-bezier(.22,1,.36,1);
        }
        .card:hover {
            box-shadow:0 12px 32px rgba(75,23,22,.08), 0 4px 12px rgba(0,0,0,.04);
            transform:translateY(-4px);
            border-color:rgba(255,194,71,.3);
        }
        .card:hover::before { transform:scaleX(1); }
        .card-img { width:calc(100% + 60px); height:200px; object-fit:cover; margin:-30px -30px 24px; display:block; border-radius:14px 14px 0 0; transition:transform .4s ease; }
        .card:hover .card-img { transform:scale(1.03); }
        .card-tag {
            display:inline-block;
            font:700 11px Inter,sans-serif;
            letter-spacing:.14em;
            text-transform:uppercase;
            color:var(--gold2);
            margin-bottom:16px;
            padding:4px 10px;
            background:rgba(255,194,71,.1);
            border-radius:4px;
        }

        .company-values-section { padding-top:20px; }
        .values-hero {
            position:relative;
            margin:0 0 28px;
            border:1px solid rgba(255,255,255,.12);
            box-shadow:0 14px 30px rgba(75,23,22,.16);
            overflow:hidden;
            background:#f7f3ee;
            border-radius:18px;
        }
        .values-hero-image {
            display:block;
            width:100%;
            height:360px;
            object-fit:contain;
            object-position:center;
            filter:saturate(1.05) contrast(1.02);
        }
        .values-hero-overlay {
            position:absolute;
            inset:auto 32px 26px 32px;
            max-width:560px;
            padding:22px 24px 18px;
            background:rgba(18,32,26,.58);
            border:1px solid rgba(255,255,255,.14);
            backdrop-filter:blur(4px);
            border-radius:14px;
            color:#fff;
        }
        .values-hero-kicker {
            display:inline-block;
            margin-bottom:10px;
            padding:5px 12px;
            border-radius:999px;
            background:rgba(255,194,71,.18);
            border:1px solid rgba(255,194,71,.32);
            font-size:11px;
            letter-spacing:.18em;
            text-transform:uppercase;
            color:#f7dca0;
            font-weight:700;
        }
        .values-hero-overlay h2 {
            margin:0 0 8px;
            font-size:clamp(26px,2vw,38px);
            line-height:1.1;
            letter-spacing:-.04em;
            color:#fff;
        }
        .values-hero-overlay p {
            margin:0;
            font-size:15px;
            line-height:1.6;
            color:rgba(255,255,255,.88);
        }
        .values-grid {
            display:grid;
            grid-template-columns:repeat(4,minmax(0,1fr));
            gap:18px;
            margin-top:8px;
        }
        .values-card {
            height:430px;
            min-height:430px;
            display:flex;
            flex-direction:column;
            padding:24px 22px 20px;
            background:rgba(247,243,238,.9);
            backdrop-filter:blur(4px);
            border:1px solid rgba(75,23,22,.1);
            border-radius:16px;
            box-shadow:none;
            transition:transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s, border-color .3s;
            position:relative;
            overflow:hidden;
        }
        .values-card::before {
            content:"";
            position:absolute;
            top:0;
            left:0;
            right:0;
            height:4px;
            background:linear-gradient(90deg, var(--gold), rgba(255,194,71,.2));
            transform:scaleX(0);
            transform-origin:left;
            transition:transform .35s cubic-bezier(.22,1,.36,1);
        }
        .values-card:hover::before {
            transform:scaleX(1);
        }
        .values-card .card-tag {
            margin-bottom:0;
            padding:4px 8px;
            background:rgba(255,194,71,.12);
        }
        .values-card h3 {
            font-size:clamp(24px,2vw,32px);
            line-height:1.1;
            letter-spacing:-.04em;
            margin:0 0 12px;
            color:var(--green);
            max-width:100%;
            word-wrap:break-word;
            overflow-wrap:break-word;
            text-align:center;
        }
        .values-card p {
            margin:0;
            font-size:15.2px;
            line-height:1.6;
            color:#3a2d28;
            max-width:100%;
            word-wrap:break-word;
            overflow-wrap:break-word;
            text-align:left;
            text-justify:none;
        }
        .values-card-footer {
            margin-top:auto;
            padding-top:18px;
        }
        .values-card-footer span {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            width:34px;
            height:34px;
            border-radius:50%;
            background:rgba(46,87,59,.08);
            color:var(--green);
            font-weight:800;
            border:1px solid rgba(46,87,59,.12);
        }
        .values-card-icon {
            display:none;
        }

        /* ── Stat band ── */
        .stat-band {
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:1px;
            background:var(--green);
            border:none;
            border-radius:14px;
            overflow:hidden;
            margin:40px 0;
            box-shadow:0 12px 32px rgba(75,23,22,.14);
        }
        .stat-item {
            background:rgba(75,23,22,.92);
            padding:32px 24px;
            text-align:center;
            transition:background .25s;
        }
        .stat-item:hover { background:rgba(75,23,22,1); }
        .stat-value { display:block; font-size:clamp(30px,3.5vw,42px); font-weight:300; color:var(--gold); margin-bottom:10px; line-height:1; }
        .stat-label { font:500 12px Inter,sans-serif; color:rgba(255,255,255,.6); line-height:1.4; }

        /* ── Sand section ── */
        .sand {
            background:linear-gradient(180deg, #fff8e8 0%, #fff4dc 40%, #fef0d2 100%);
            position:relative;
        }
        .sand::before {
            content:'';
            position:absolute; inset:0;
            pointer-events:none;
            background:
                radial-gradient(circle at 85% 15%, rgba(255,194,71,.08) 0%, transparent 40%),
                radial-gradient(circle at 10% 85%, rgba(75,23,22,.04) 0%, transparent 30%);
        }

        /* ── Sub-nav (pills) ── */
        .sub-nav {
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            margin-bottom:44px;
            padding-bottom:26px;
            border-bottom:1px solid var(--line);
        }
        .sub-nav a {
            padding:10px 20px;
            border:1px solid rgba(234,220,197,.7);
            border-radius:24px;
            font:500 12px Inter,sans-serif;
            color:var(--muted);
            background:rgba(255,255,255,.5);
            backdrop-filter:blur(4px);
            transition:all .25s cubic-bezier(.22,1,.36,1);
        }
        .sub-nav a:hover {
            background:rgba(75,23,22,.08);
            color:var(--green);
            border-color:rgba(75,23,22,.2);
            transform:translateY(-1px);
        }
        .sub-nav a.active {
            background:var(--green);
            color:#fff;
            border-color:var(--green);
            box-shadow:0 4px 14px rgba(75,23,22,.2);
        }

        /* ── Carte Google Maps ── */
        .map-wrap { border-radius:14px; overflow:hidden; border:1px solid var(--line); height:440px; box-shadow:0 8px 24px rgba(0,0,0,.06); }
        .map-wrap iframe { width:100%; height:100%; border:0; display:block; }

        /* ── Accordéon ── */
        details {
            border:1px solid var(--line);
            border-radius:12px;
            margin-bottom:12px;
            background:rgba(255,255,255,.9);
            backdrop-filter:blur(4px);
            transition:box-shadow .25s, border-color .25s;
        }
        details:hover { box-shadow:0 4px 16px rgba(0,0,0,.05); }
        details[open] { border-color:rgba(255,194,71,.4); box-shadow:0 6px 20px rgba(0,0,0,.06); }
        summary {
            padding:20px 24px;
            cursor:pointer;
            font:500 15px Inter,sans-serif;
            color:var(--green);
            list-style:none;
            display:flex;
            justify-content:space-between;
            align-items:center;
            transition:color .2s;
        }
        summary:hover { color:var(--ink); }
        summary::after {
            content:'';
            width:10px; height:10px;
            border-right:2px solid var(--gold);
            border-bottom:2px solid var(--gold);
            transform:rotate(45deg);
            transition:transform .3s cubic-bezier(.22,1,.36,1);
            flex-shrink:0;
        }
        details[open] summary::after { transform:rotate(-135deg); }
        details div, details p { padding:0 24px 20px; }

        /* ── Bloc PDG ── */
        .pdg-block {
            display:grid;
            grid-template-columns:280px 1fr;
            gap:52px;
            align-items:start;
            padding:52px 56px;
            background:linear-gradient(135deg, #4b1716 0%, #2d0d10 100%);
            border-radius:18px;
            color:#fff;
            position:relative;
            overflow:hidden;
            box-shadow:0 20px 48px rgba(75,23,22,.22);
        }
        .pdg-block::before {
            content:'';
            position:absolute;
            top:-60px; right:-60px;
            width:200px; height:200px;
            border-radius:50%;
            background:rgba(255,194,71,.06);
            pointer-events:none;
        }
        .pdg-photo {
            width:100%;
            aspect-ratio:3/4;
            object-fit:cover;
            border-radius:12px;
            background:#5a2020;
            display:flex;
            align-items:center;
            justify-content:center;
            color:rgba(255,255,255,.4);
            font:12px Inter,sans-serif;
            border:2px solid rgba(255,194,71,.25);
            box-shadow:0 8px 24px rgba(0,0,0,.2);
        }
        .pdg-quote {
            font:28px/1.5 Inter,sans-serif;
            font-weight:300;
            color:rgba(255,255,255,.92);
            margin-bottom:28px;
            position:relative;
            padding-left:38px;
        }
        .pdg-quote::before {
            content:'\201C';
            position:absolute;
            left:0; top:-8px;
            color:var(--gold);
            font-size:64px;
            line-height:1;
            font-weight:700;
            opacity:.7;
        }
        .pdg-name { font:600 14px Inter,sans-serif; color:var(--gold); letter-spacing:.1em; text-transform:uppercase; }
        .pdg-title { font:12px Inter,sans-serif; color:rgba(255,255,255,.55); margin-top:6px; }

        /* ── Étapes process ── */
        .steps { display:grid; grid-template-columns:repeat(4,1fr); gap:0; }
        .step {
            padding:32px 24px;
            border-right:1px solid var(--line);
            position:relative;
            transition:background .2s;
        }
        .step:hover { background:rgba(255,194,71,.04); }
        .step:last-child { border-right:0; }
        .step-num {
            font:700 40px Inter,sans-serif;
            color:rgba(234,220,197,.5);
            margin-bottom:18px;
            line-height:1;
        }
        .step h4 { margin-bottom:10px; }
        .step::after {
            content:'';
            position:absolute;
            top:50%; right:-1px;
            width:22px; height:22px;
            background:var(--gold);
            clip-path:polygon(0 50%,100% 0,100% 100%);
            transform:translateY(-50%);
            z-index:1;
            filter:drop-shadow(2px 0 4px rgba(255,194,71,.3));
        }
        .step:last-child::after { display:none; }

        /* ── Placeholder carte permis ── */
        .permits-placeholder { background:var(--sand); border:1px dashed var(--gold); border-radius:14px; padding:60px; text-align:center; color:var(--muted); font:14px Inter,sans-serif; }

        /* ── Boutons ── */
        .btn {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:14px 24px;
            font:600 12px Inter,sans-serif;
            text-transform:uppercase;
            letter-spacing:.1em;
            border-radius:8px;
            cursor:pointer;
            transition:all .25s cubic-bezier(.22,1,.36,1);
            white-space:nowrap;
        }
        .btn-gold { background:var(--gold); color:var(--ink); box-shadow:0 4px 14px rgba(255,194,71,.2); }
        .btn-gold:hover { background:var(--gold2); transform:translateY(-2px); box-shadow:0 8px 24px rgba(255,194,71,.3); }
        .btn-dark { background:var(--green); color:#fff; box-shadow:0 4px 14px rgba(75,23,22,.15); }
        .btn-dark:hover { background:#3a100f; transform:translateY(-2px); box-shadow:0 8px 24px rgba(75,23,22,.25); }
        .btn-outline {
            border:1px solid var(--green);
            color:var(--green);
            background:transparent;
        }
        .btn-outline:hover {
            background:var(--green);
            color:#fff;
            transform:translateY(-2px);
            box-shadow:0 6px 20px rgba(75,23,22,.18);
        }
        .btn.disabled { background:#eee5d7; color:var(--muted); pointer-events:none; box-shadow:none; }

        /* ── Grilles contact ── */
        .contact-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; margin-bottom:48px; }
        .contact-card { padding:32px; border:1px solid var(--line); background:rgba(255,255,255,.9); border-radius:14px; transition:box-shadow .3s, transform .3s; }
        .contact-card:hover { box-shadow:0 10px 28px rgba(0,0,0,.07); transform:translateY(-3px); }
        .contact-card .icon { font-size:28px; margin-bottom:16px; }
        .contact-card h3 { margin-bottom:14px; }
        .contact-info { list-style:none; }
        .contact-info li { font:14px/1.7 Inter,sans-serif; color:var(--muted); padding:3px 0; }
        .contact-info strong { color:var(--ink); }

        /* ── Formulaires ── */
        form { max-width:760px; }
        label {
            display:block;
            margin:22px 0 8px;
            color:var(--green);
            font:600 11px Inter,sans-serif;
            text-transform:uppercase;
            letter-spacing:.08em;
        }
        input, select, textarea {
            width:100%;
            border:1px solid var(--line);
            padding:14px 16px;
            color:var(--ink);
            background:rgba(255,255,255,.9);
            font:15px Inter,sans-serif;
            border-radius:10px;
            transition:border-color .2s, box-shadow .2s;
        }
        input:focus, textarea:focus, select:focus {
            outline:none;
            border-color:var(--gold);
            box-shadow:0 0 0 3px rgba(255,194,71,.15);
        }
        textarea { min-height:150px; resize:vertical; }
        button[type=submit] {
            border:0;
            cursor:pointer;
            margin-top:24px;
            padding:16px 32px;
            background:linear-gradient(135deg, var(--red) 0%, #b52525 100%);
            color:#fff;
            font:600 12px Inter,sans-serif;
            text-transform:uppercase;
            letter-spacing:.1em;
            border-radius:10px;
            box-shadow:0 6px 20px rgba(215,47,47,.2);
            transition:all .25s cubic-bezier(.22,1,.36,1);
        }
        button[type=submit]:hover {
            transform:translateY(-2px);
            box-shadow:0 10px 28px rgba(215,47,47,.3);
        }
        .alert-success {
            padding:18px 22px;
            background:linear-gradient(135deg, #e7f0d7 0%, #d8ecc2 100%);
            color:#31501f;
            font:500 14px Inter,sans-serif;
            border-radius:10px;
            margin-bottom:24px;
            border:1px solid rgba(49,80,31,.12);
        }

        /* ── Organigramme ── */
        .org-chart { display:flex; flex-direction:column; align-items:center; padding:20px 0 40px; }
        .org-level { display:flex; justify-content:center; width:100%; }
        .org-level--top { margin-bottom:0; }
        .org-box { width:100%; min-width:0; padding:20px 16px; border-radius:12px; text-align:center; max-width:300px; transition:transform .2s; }
        .org-box:hover { transform:translateY(-2px); }
        .org-box--pdg { background:linear-gradient(135deg, #b94040 0%, #a53535 100%); color:#fff; box-shadow:0 6px 20px rgba(180,40,40,.25); }
        .org-box--dga { background:linear-gradient(135deg, #e88840 0%, #d07030 100%); color:#fff; box-shadow:0 6px 18px rgba(230,130,50,.22); }
        .org-name { font:700 14px/1.3 Inter,sans-serif; margin-bottom:5px; }
        .org-grade { font:600 12px Inter,sans-serif; opacity:.85; margin-bottom:3px; }
        .org-title { font:400 13px/1.35 Inter,sans-serif; opacity:.92; overflow-wrap:anywhere; }
        .org-connector-v { width:2px; height:40px; background:#333; }
        .org-level--dga { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; width:100%; }
        .org-branch { display:flex; flex-direction:column; align-items:center; }
        .org-connector-branch { width:2px; height:36px; background:#333; }
        .org-hbar { width:calc(75% + 8px); height:2px; background:#333; margin:0 auto; }

        /* ── Gouvernance ── */
        .governance-intro { display:grid; grid-template-columns:1.2fr .8fr; gap:32px; align-items:stretch; margin:36px 0 48px; }
        .governance-callout {
            padding:34px;
            background:linear-gradient(135deg, #4b1716 0%, #2d0d10 100%);
            border-left:5px solid var(--gold);
            border-radius:14px;
            box-shadow:0 10px 28px rgba(75,23,22,.15);
        }
        .governance-callout h3 { color:#fff; font-size:26px; margin-bottom:12px; }
        .governance-callout p { color:rgba(255,255,255,.75); margin:0; }
        .governance-principles { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; }
        .governance-principle {
            padding:24px;
            background:rgba(255,255,255,.9);
            border-top:3px solid var(--gold);
            border-radius:12px;
            box-shadow:0 4px 16px rgba(40,29,24,.06);
            transition:transform .25s, box-shadow .25s;
        }
        .governance-principle:hover { transform:translateY(-3px); box-shadow:0 8px 24px rgba(40,29,24,.1); }
        .governance-principle strong { display:block; color:var(--green); font:600 14px/1.3 Inter,sans-serif; margin-bottom:8px; }
        .governance-principle span { color:var(--muted); font:13px/1.55 Inter,sans-serif; }
        .governance-chart-panel { padding:34px 28px 18px; background:var(--sand); border:1px solid var(--line); border-radius:14px; }
        .governance-chart-heading { display:flex; justify-content:space-between; gap:20px; align-items:end; margin-bottom:8px; }
        .governance-chart-heading h3 { margin:0; }
        .governance-legend { display:flex; justify-content:center; gap:22px; flex-wrap:wrap; padding:0 0 18px; color:var(--muted); font:12px Inter,sans-serif; }
        .governance-legend span { display:flex; align-items:center; gap:7px; }
        .governance-legend i { width:11px; height:11px; display:inline-block; border-radius:50%; }
        .governance-legend .legend-pdg { background:#b94040; }
        .governance-legend .legend-dga { background:#e88840; }

        /* ── Projets ── */
        .projects-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:28px; }
        .project-card {
            height:100%;
            display:flex;
            flex-direction:column;
            border-top:4px solid transparent;
            background-image:linear-gradient(#fff,#fff), linear-gradient(90deg, var(--gold), var(--red));
            background-origin:border-box;
            background-clip:padding-box, border-box;
        }
        .project-card h3 { min-height:52px; }
        .project-card p { margin-top:auto; }
        .project-card .card-tag { color:var(--red); background:rgba(215,47,47,.08); }
        .project-map { display:grid; grid-template-columns:1fr 1fr; gap:28px; align-items:center; }
        .project-map-copy { padding:32px; background:rgba(255,255,255,.9); border-left:4px solid var(--gold); border-radius:14px; }
        .project-map-copy h3 { margin-bottom:10px; }
        .project-map-copy p { margin:0; }

        /* ── Qui sommes-nous hub ── */
        .company-overview-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:28px; }
        .company-overview-grid .card { height:100%; display:flex !important; flex-direction:column; }
        .company-overview-grid .card .btn { margin-top:auto !important; align-self:flex-start; }
        .company-overview-grid .card .card-tag {
            font-size:28px;
            font-weight:700;
            color:rgba(234,220,197,.5);
            background:none;
            padding:0;
            margin-bottom:10px;
            letter-spacing:-.02em;
        }

        /* ── Responsive ── */
        @media(max-width:900px) {
            .topbar { display:none; }
            .grid-3, .grid-2, .steps, .team-grid, .contact-grid { grid-template-columns:repeat(2,minmax(0,1fr)); }
            .stat-band { grid-template-columns:repeat(2,1fr); }
            .step::after { display:none; }
            .step { border-right:0; border-bottom:1px solid rgba(255,255,255,.15); }
            .pdg-block { grid-template-columns:1fr; padding:32px; gap:24px; }
            .governance-intro { grid-template-columns:1fr; }
            .governance-principles { grid-template-columns:1fr; }
            .governance-chart-heading { display:block; }
            .governance-chart-heading p { text-align:left; margin-top:8px; }
            .company-overview-grid { grid-template-columns:1fr; }
            .projects-grid, .project-map { grid-template-columns:1fr; }
            .org-level--dga { grid-template-columns:1fr 1fr; }
            .org-hbar { width:calc(50% + 8px); }
            .masthead { padding:80px 5vw 60px; }
            .values-grid { grid-template-columns:repeat(2,1fr); }
            .values-card { height:auto; min-height:auto; }
        }
        @media(max-width:540px) {
            section { padding-left:20px; padding-right:20px; }
            .grid-3, .grid-2, .steps, .team-grid, .contact-grid { grid-template-columns:1fr; }
            .org-level--dga { grid-template-columns:1fr; }
            .org-hbar { display:none; }
            .org-connector-branch { height:16px; }
            .stat-band { grid-template-columns:1fr; }
            .values-grid { grid-template-columns:1fr; }
        }
    </style>
    @yield('head')
    @stack('styles')
</head>
<body class="{{ $isSustain ? 'is-sustain' : '' }}">
    @include('partials._nav', ['locale' => $loc, 'section' => $section])

    {{-- ── Masthead  - h1 centré, sans répétition ── --}}
    @hasSection('masthead')
        @yield('masthead')
    @else
    <div class="masthead">
        <h1>{{ __('site.'.$mastheadSection.'_h1', [], $loc) }}</h1>
        {{-- Fil d'Ariane compact sous le titre --}}
        <div class="breadcrumb">
            <a href="{{ $en ? route('english') : url('/') }}">{{ __('site.home_link', [], $loc) }}</a>
            @if($isCompany && $section !== 'company')
                › <a href="{{ $en ? route('english.company') : route('company') }}">{{ __('site.nav_company', [], $loc) }}</a>
            @endif
            @if($isSustain && !in_array($section, ['sustainability']))
                › <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.nav_sustainability', [], $loc) }}</a>
            @endif
            › {{ __('site.'.$mastheadSection.'_breadcrumb', [], $loc) }}
        </div>
    </div>
    @endif

    <main>
        @if(session('success'))
        <section><div class="alert-success">{{ session('success') }}</div></section>
        @endif

        @yield('content')
    </main>

    @include('partials._footer', ['loc' => $loc, 'en' => $en])
    @include('partials.cookie-banner')

    <script src="{{ asset('js/animations.js') }}"></script>
    <script src="{{ asset('js/page-animations.js') }}?v={{ filemtime(public_path('js/page-animations.js')) }}"></script>
    <script src="{{ asset('js/sustainability-animations.js') }}"></script>
    <script src="{{ asset('js/cookie-consent.js') }}"></script>
    <script>
        // Initialisation supplémentaire si nécessaire
        document.addEventListener('DOMContentLoaded', () => {
            const isSustain = document.body.classList.contains('is-sustain');

            // Ajouter des classes d'animation aux éléments existants
            document.querySelectorAll('.card').forEach((card, index) => {
                card.classList.add('card-3d');
                if (!isSustain) {
                    card.classList.add('sr-fade-up', 'is-visible');
                    card.style.animationDelay = (index * 0.1) + 's';
                }
            });

            // Ajouter l'animation shimmer aux cartes importantes
            document.querySelectorAll('.stat-item').forEach(item => {
                item.classList.add('card-shimmer', 'stat-item-animated');
            });

            // Ajouter l'effet magnétique aux boutons
            document.querySelectorAll('.btn').forEach(btn => {
                btn.classList.add('magnetic', 'btn-animated');
            });

            // Ajouter l'animation de background aux sections importantes
            document.querySelectorAll('section').forEach(section => {
                if (section.querySelector('h2')) {
                    section.classList.add('animated-bg');
                }
            });

            // Ajouter des particules aux sections hero
            const masthead = document.querySelector('.masthead');
            if (masthead) {
                const particles = document.createElement('div');
                particles.className = 'particles';
                masthead.appendChild(particles);
                masthead.classList.add('logo-glow');
            }

            // Animation en cascade pour les grilles
            if (!isSustain) {
                document.querySelectorAll('.grid-3, .grid-2, .projects-grid, .values-grid').forEach(grid => {
                    grid.classList.add('cascade-animation');
                });
            }

            // Ajouter l'effet ripple aux liens et boutons
            document.querySelectorAll('a:not(.site-footer__legal a), button, .btn').forEach(element => {
                element.classList.add('ripple');
            });
        });
    </script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const iconPaths = {
                127970: '<path d="M4 20V8l8-4 8 4v12M2 20h20M8 20v-5h8v5M8 9h.01M12 9h.01M16 9h.01"/>',
                9989: '<path d="m5 12 4 4L19 6"/>',
                128101: '<circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3.5 20c.5-3.5 2.3-5 5.5-5s5 1.5 5.5 5M14 15c3-.7 5.5.7 6 4"/>',
                128188: '<path d="M4 7h16v13H4zM8 7V5h8v2M8 12h8M8 16h5"/>',
                9881: '<path d="M12 3v18M3 12h18"/>',
                128269: '<circle cx="10.5" cy="10.5" r="6.5"/><path d="m16 16 5 5"/>',
                129309: '<path d="m12 3 2.5 5.5L20 11l-5.5 2.5L12 19l-2.5-5.5L4 11l5.5-2.5L12 3Z"/>',
                128221: '<path d="M5 3h14v18H5zM8 7h8M8 11h8M8 15h5"/>',
                128276: '<path d="M6 17h12l-1.5-2V9a4.5 4.5 0 0 0-9 0v6L6 17ZM10 20h4"/>',
                128172: '<path d="M3 5h18v11H8l-5 4V5ZM7 9h10M7 12h6"/>',
                128176: '<path d="M12 3v14M7 8l5-5 5 5M5 21h14"/>',
                128175: '<path d="M12 21V7M7 12l5-5 5 5M5 3h14"/>',
                128230: '<path d="m3 7 9-4 9 4-9 4-9-4ZM3 12l9 4 9-4M3 17l9 4 9-4"/>',
                128203: '<path d="M6 4h12v17H6zM9 2h6v4H9M9 10h6M9 14h6M9 18h4"/>',
                128640: '<path d="m12 3 4 6-1 7H9l-1-7 4-6ZM9 16l-3 5M15 16l3 5M12 9h.01"/>',
                128241: '<path d="M7 3h10v18H7zM10 6h4M11 18h2"/>',
                128737: '<path d="M7 21 10 3M17 21 14 3M12 5v3M12 11v3M12 17v3"/>',
                128167: '<path d="M12 3S5.5 10.2 5.5 14.7a6.5 6.5 0 0 0 13 0C18.5 10.2 12 3 12 3Z"/>',
                127793: '<path d="M5 20c0-7 3.8-11.5 11-13 1.1 5.7-1.6 10.4-8 12.2M5 20c2.6-3.8 5.3-6.2 9-8.4"/>',
                128154: '<path d="M12 20.5S4 15.7 4 9.5A4.5 4.5 0 0 1 12 7a4.5 4.5 0 0 1 8 2.5c0 6.2-8 11-8 11Z"/><path d="M12 8v6M9 11h6"/>',
                127912: '<path d="M12 3v18M3 12h18"/><circle cx="12" cy="12" r="8"/>',
                127757: '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c3 3 3 15 0 18M12 3c-3 3-3 15 0 18"/>',
                128295: '<path d="M14 4 4 14l6 6L20 10l-6-6ZM4 14l-2-2 4-4 2 2M14 4l-2-2 4-4"/>',
                128296: '<path d="M4 20 20 4M5 5l14 14M8 3l13 13M3 8l13 13"/>',
                128222: '<path d="M6 3h4l2 5-2 2c1 3 2 4 5 5l2-2 4 2v4c-7 2-15-6-15-16Z"/>',
                9993: '<path d="M3 5h18v14H3zM3 6l9 7 9-7"/>',
                128196: '<path d="M6 3h9l3 3v15H6zM15 3v4h4M9 12h6M9 16h6"/>',
                127912: '<path d="M12 3v18M3 12h18"/><circle cx="12" cy="12" r="8"/>',
                127922: '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>'
            };
            const emojiPattern = /[\u{1F300}-\u{1FAFF}\u{2600}-\u{27BF}]/gu;
            const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
            const nodes = [];
            let node;
            while ((node = walker.nextNode())) {
                if (node.parentElement && !node.parentElement.closest('script,style,textarea')) nodes.push(node);
            }
            nodes.forEach(textNode => {
                const value = textNode.nodeValue;
                if (!emojiPattern.test(value)) { emojiPattern.lastIndex = 0; return; }
                emojiPattern.lastIndex = 0;
                const fragment = document.createDocumentFragment();
                let lastIndex = 0;
                value.replace(emojiPattern, (emoji, offset) => {
                    fragment.append(value.slice(lastIndex, offset));
                    const codePoint = emoji.codePointAt(0);
                    const icon = document.createElement('span');
                    icon.className = 'site-icon';
                    icon.setAttribute('aria-hidden', 'true');
                    icon.innerHTML = `<svg viewBox="0 0 24 24">${iconPaths[codePoint] || '<circle cx="12" cy="12" r="8"/><path d="M8 12h8"/>'}</svg>`;
                    fragment.append(icon);
                    lastIndex = offset + emoji.length;
                });
                fragment.append(value.slice(lastIndex));
                textNode.parentNode.replaceChild(fragment, textNode);
            });
        });
    </script>
    <script>
        document.querySelectorAll('h1, h2, h3, h4, h5, h6').forEach((heading) => {
            const walker = document.createTreeWalker(heading, NodeFilter.SHOW_TEXT);
            const textNodes = [];
            let node;
            while ((node = walker.nextNode())) textNodes.push(node);
            const lastText = textNodes[textNodes.length - 1];
            if (lastText) lastText.nodeValue = lastText.nodeValue.replace(/\.\s*$/, '');
        });
    </script>
</body>
</html>
