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
@endphp
<!DOCTYPE html>
<html lang="{{ $loc }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? __('site.'.$mastheadSection.'_h1', [], $loc) }} | Néré Mining</title>
    <meta name="description" content="{{ $description ?? '' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/chrome.css') }}">
    <style>
        /* ══ Variables ══════════════════════════════════════════ */
        :root {
            --ink:#281d18; --green:#4b1716; --red:#d72f2f; --gold:#ffc247;
            --sand:#fff4dc; --muted:#70645c; --line:#eadcc5; --light:#fbfaf7;
        }
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        body { color:var(--ink); background-color:var(--light); background-image:linear-gradient(115deg,rgba(255,194,71,.045),transparent 38%,rgba(75,23,22,.03)),repeating-linear-gradient(135deg,rgba(75,23,22,.025) 0,rgba(75,23,22,.025) 1px,transparent 1px,transparent 46px); background-size:180% 180%,46px 46px; animation:siteAtmosphere 42s ease-in-out infinite alternate; font-family:'Inter',Arial,Helvetica,sans-serif; font-size:17px; }
        @keyframes siteAtmosphere { from { background-position:0% 0%,0 0; } to { background-position:100% 100%,23px 23px; } }
        .masthead { animation:contentRise .8s ease-out both; }
        main > section { animation:contentRise .7s ease-out both; }
        @keyframes contentRise { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        @media (prefers-reduced-motion: reduce) { body, .masthead, main > section { animation:none; } }
        a { color:inherit; text-decoration:none; }

        /* ── Topbar ── */
        .topbar { background:var(--red); color:#fff7e8; padding:9px 5vw; display:flex; justify-content:space-between; font:11px Inter,sans-serif; letter-spacing:.06em; text-transform:uppercase; }

        /* Header / footer : styles dans partials._nav et partials._footer */

        /* ── Masthead ── */
        .masthead { padding:100px 5vw 80px; color:white; background:linear-gradient(100deg,rgba(75,23,22,.96) 45%,rgba(75,23,22,.55)),url('{{ asset('images/mining/karma-03.jpg') }}') center/cover; }
        .eyebrow { display:none; }
        .masthead {
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            text-align:center;
        }
        .masthead h1 {
            display:inline-block;
            max-width:1000px;
            width:fit-content;
            padding:0.18em 0.38em 0.22em;
            background:rgba(34,11,11,.7);
            border:2px solid rgba(255,194,71,.9);
            border-left:10px solid rgba(255,194,71,.9);
            border-right:10px solid rgba(255,194,71,.9);
            box-shadow:0 0 0 2px rgba(255,255,255,.08), 0 22px 44px rgba(0,0,0,.22);
            font-size:clamp(40px,6vw,76px);
            line-height:.94;
            font-weight:400;
            color:#fff;
            letter-spacing:-.05em;
            text-align:center;
        }
        .breadcrumb { margin-top:20px; font:12px Inter,sans-serif; color:rgba(255,255,255,.6); }
        .breadcrumb a { color:var(--gold); }
        .breadcrumb a:hover { text-decoration:underline; }

        /* ── Contenu ── */
        main { max-width:1240px; margin:auto; }
        section { padding:80px 5vw; }
        section + section { padding-top:0; }
        .lead { max-width:820px; color:var(--muted); font:19px/1.8 Inter,sans-serif; margin-bottom:48px; }
        h2 {
            color:var(--ink);
            font-size:clamp(26px,2.6vw,40px);
            font-weight:600;
            line-height:1.2;
            margin:0 0 18px;
            letter-spacing:-.02em;
        }
        h3 { color:var(--green); font-size:23px; font-weight:500; margin-bottom:12px; }
        h4 { color:var(--green); font-size:16px; font-weight:600; margin-bottom:8px; letter-spacing:.04em; text-transform:uppercase; }
        p { color:var(--muted); font:19px/1.8 Inter,sans-serif; margin-bottom:12px; text-align:justify; }

        /* ── Grilles & Cards ── */
        .grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
        .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:30px; align-items:start; }
        .card { padding:28px; border:1px solid var(--line); background:#fff; border-radius:6px; transition:box-shadow .2s; }
        .card:hover { box-shadow:0 4px 18px rgba(0,0,0,.08); }
        .card-img { width:calc(100%+56px); height:190px; object-fit:cover; margin:-28px -28px 22px; display:block; border-radius:6px 6px 0 0; }
        .card-tag { display:block; font:600 13px Inter,sans-serif; letter-spacing:.12em; text-transform:uppercase; color:var(--gold); margin-bottom:18px; }

        .company-values-section { padding-top:20px; }
        .values-hero {
            margin:0 0 28px;
            border:1px solid rgba(255,255,255,.12);
            box-shadow:0 14px 30px rgba(75,23,22,.16);
            overflow:hidden;
            background:#f7f3ee;
        }
        .values-hero-image {
            display:block;
            width:100%;
            height:auto;
            object-fit:cover;
        }
        .values-grid {
            display:grid;
            grid-template-columns:repeat(4,minmax(0,1fr));
            gap:16px;
            margin-top:8px;
        }
        .values-card {
            min-height:500px;
            height:100%;
            display:flex;
            flex-direction:column;
            padding:18px 18px 18px;
            background:#f7f3ee;
            border:1px solid rgba(75,23,22,.12);
            box-shadow:none;
        }
        .values-card h3 {
            font-size:clamp(20px,1.5vw,30px);
            line-height:1;
            letter-spacing:-.04em;
            margin:0 0 10px;
            color:var(--green);
            max-width:100%;
            word-wrap:break-word;
            overflow-wrap:break-word;
        }
        .values-card p {
            margin-top:0;
            font-size:15.2px;
            line-height:1.46;
            color:#3a2d28;
            max-width:100%;
            word-wrap:break-word;
            overflow-wrap:break-word;
            text-align:justify;
        }

        /* ── Stat band ── */
        .stat-band { display:grid; grid-template-columns:repeat(4,1fr); gap:1px; background:var(--line); border:1px solid var(--line); border-radius:8px; overflow:hidden; margin:40px 0; }
        .stat-item { background:#fff; padding:28px 24px; text-align:center; }
        .stat-value { display:block; font-size:36px; font-weight:300; color:var(--green); margin-bottom:8px; }
        .stat-label { font:500 12px Inter,sans-serif; color:var(--muted); line-height:1.4; }

        /* ── Sand section ── */
        .sand { background:var(--sand); }

        /* ── Sub-nav (pills) ── */
        .sub-nav { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:40px; padding-bottom:24px; border-bottom:1px solid var(--line); }
        .sub-nav a { padding:9px 18px; border:1px solid var(--line); border-radius:20px; font:500 12px Inter,sans-serif; color:var(--muted); transition:all .18s; }
        .sub-nav a:hover, .sub-nav a.active { background:var(--green); color:#fff; border-color:var(--green); }

        /* ── Carte Google Maps ── */
        .map-wrap { border-radius:8px; overflow:hidden; border:1px solid var(--line); height:440px; }
        .map-wrap iframe { width:100%; height:100%; border:0; display:block; }

        /* ── Accordéon ── */
        details { border:1px solid var(--line); border-radius:6px; margin-bottom:10px; background:#fff; }
        summary { padding:18px 22px; cursor:pointer; font:500 15px Inter,sans-serif; color:var(--green); list-style:none; display:flex; justify-content:space-between; }
        summary::after { content:'＋'; font-size:18px; color:var(--gold); }
        details[open] summary::after { content:'－'; }
        details p { padding:0 22px 18px; }

        /* ── Bloc PDG ── */
        .pdg-block { display:grid; grid-template-columns:260px 1fr; gap:48px; align-items:start; padding:60px; background:var(--green); border-radius:8px; color:#fff; }
        .pdg-photo { width:100%; aspect-ratio:3/4; object-fit:cover; border-radius:6px; background:#5a2020; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,.4); font:12px Inter,sans-serif; }
        .pdg-quote { font:28px/1.45 Inter,sans-serif; font-weight:300; color:#fff; margin-bottom:24px; }
        .pdg-quote::before { content:'" '; color:var(--gold); font-size:48px; line-height:0; vertical-align:-14px; }
        .pdg-name { font:600 14px Inter,sans-serif; color:var(--gold); letter-spacing:.1em; text-transform:uppercase; }
        .pdg-title { font:12px Inter,sans-serif; color:rgba(255,255,255,.6); margin-top:4px; }

        /* ── Étapes process ── */
        .steps { display:grid; grid-template-columns:repeat(4,1fr); gap:0; }
        .step { padding:28px 22px; border-right:1px solid var(--line); position:relative; }
        .step:last-child { border-right:0; }
        .step-num { font:700 36px Inter,sans-serif; color:var(--line); margin-bottom:16px; }
        .step h4 { margin-bottom:10px; }
        .step::after { content:''; position:absolute; top:50%; right:-1px; width:22px; height:22px; background:var(--gold); clip-path:polygon(0 50%,100% 0,100% 100%); transform:translateY(-50%); z-index:1; }
        .step:last-child::after { display:none; }

        /* ── Placeholder carte permis ── */
        .permits-placeholder { background:var(--sand); border:1px dashed var(--gold); border-radius:8px; padding:60px; text-align:center; color:var(--muted); font:14px Inter,sans-serif; }

        /* ── Boutons ── */
        .btn { display:inline-block; padding:13px 20px; font:600 12px Inter,sans-serif; text-transform:uppercase; letter-spacing:.1em; border-radius:4px; cursor:pointer; transition:all .18s; }
        .btn-gold { background:var(--gold); color:var(--ink); }
        .btn-gold:hover { background:#e5a72f; }
        .btn-dark { background:var(--green); color:#fff; }
        .btn-dark:hover { background:#3a100f; }
        .btn-outline { border:1px solid var(--green); color:var(--green); }
        .btn-outline:hover { background:var(--green); color:#fff; }
        .btn.disabled { background:#eee5d7; color:var(--muted); pointer-events:none; }

        /* ── Grilles contact ── */
        .contact-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; margin-bottom:48px; }
        .contact-card { padding:32px; border:1px solid var(--line); background:#fff; border-radius:6px; }
        .contact-card .icon { font-size:28px; margin-bottom:16px; }
        .contact-card h3 { margin-bottom:14px; }
        .contact-info { list-style:none; }
        .contact-info li { font:14px/1.7 Inter,sans-serif; color:var(--muted); padding:3px 0; }
        .contact-info strong { color:var(--ink); }

        /* ── Formulaires ── */
        form { max-width:720px; }
        label { display:block; margin:20px 0 7px; color:var(--green); font:600 11px Inter,sans-serif; text-transform:uppercase; letter-spacing:.08em; }
        input, select, textarea { width:100%; border:1px solid var(--line); padding:13px 15px; color:var(--ink); background:#fff; font:15px Inter,sans-serif; border-radius:4px; }
        input:focus, textarea:focus, select:focus { outline:none; border-color:var(--gold); }
        textarea { min-height:150px; resize:vertical; }
        button[type=submit] { border:0; cursor:pointer; margin-top:22px; padding:15px 24px; background:var(--red); color:#fff; font:600 12px Inter,sans-serif; text-transform:uppercase; letter-spacing:.1em; border-radius:4px; }
        .alert-success { padding:16px 20px; background:#e7f0d7; color:#31501f; font:14px Inter,sans-serif; border-radius:4px; margin-bottom:24px; }

        /* ── Organigramme ── */
        .org-chart { display:flex; flex-direction:column; align-items:center; padding:20px 0 40px; }
        .org-level { display:flex; justify-content:center; width:100%; }
        .org-level--top { margin-bottom:0; }
        .org-box { width:100%; min-width:0; padding:18px 14px; border-radius:10px; text-align:center; max-width:300px; }
        .org-box--pdg { background:#b94040; color:#fff; box-shadow:0 4px 16px rgba(180,40,40,.25); }
        .org-box--dga { background:#e88840; color:#fff; box-shadow:0 4px 14px rgba(230,130,50,.22); }
        .org-name { font:700 14px/1.3 Inter,sans-serif; margin-bottom:5px; }
        .org-grade { font:600 12px Inter,sans-serif; opacity:.85; margin-bottom:3px; }
        .org-title { font:400 13px/1.35 Inter,sans-serif; opacity:.92; overflow-wrap:anywhere; }
        .org-connector-v { width:2px; height:40px; background:#333; }
        .org-level--dga { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; width:100%; }
        .org-branch { display:flex; flex-direction:column; align-items:center; }
        .org-connector-branch { width:2px; height:36px; background:#333; }
        .org-hbar { width:calc(75% + 8px); height:2px; background:#333; margin:0 auto; }

        /* ── Gouvernance ── */
        .governance-intro { display:grid; grid-template-columns:1.2fr .8fr; gap:30px; align-items:stretch; margin:36px 0 48px; }
        .governance-callout { padding:32px; background:var(--green); border-left:5px solid var(--gold); border-radius:6px; }
        .governance-callout h3 { color:#fff; font-size:26px; margin-bottom:12px; }
        .governance-callout p { color:rgba(255,255,255,.75); margin:0; }
        .governance-principles { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; }
        .governance-principle { padding:22px; background:#fff; border-top:3px solid var(--gold); border-radius:5px; box-shadow:0 3px 14px rgba(40,29,24,.07); }
        .governance-principle strong { display:block; color:var(--green); font:600 14px/1.3 Inter,sans-serif; margin-bottom:8px; }
        .governance-principle span { color:var(--muted); font:13px/1.55 Inter,sans-serif; }
        .governance-chart-panel { padding:34px 28px 18px; background:var(--sand); border:1px solid var(--line); border-radius:8px; }
        .governance-chart-heading { display:flex; justify-content:space-between; gap:20px; align-items:end; margin-bottom:8px; }
        .governance-chart-heading h3 { margin:0; }
        .governance-legend { display:flex; justify-content:center; gap:22px; flex-wrap:wrap; padding:0 0 18px; color:var(--muted); font:12px Inter,sans-serif; }
        .governance-legend span { display:flex; align-items:center; gap:7px; }
        .governance-legend i { width:11px; height:11px; display:inline-block; border-radius:50%; }
        .governance-legend .legend-pdg { background:#b94040; }
        .governance-legend .legend-dga { background:#e88840; }

        /* ── Projets ── */
        .projects-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
        .project-card { height:100%; display:flex; flex-direction:column; border-top:4px solid var(--gold); }
        .project-card h3 { min-height:52px; }
        .project-card p { margin-top:auto; }
        .project-card .card-tag { color:var(--red); }
        .project-map { display:grid; grid-template-columns:1fr 1fr; gap:28px; align-items:center; }
        .project-map-copy { padding:30px; background:#fff; border-left:4px solid var(--gold); border-radius:6px; }
        .project-map-copy h3 { margin-bottom:10px; }
        .project-map-copy p { margin:0; }

        /* ── Qui sommes-nous hub ── */
        .company-overview-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
        .company-overview-grid .card { height:100%; display:flex !important; flex-direction:column; }
        .company-overview-grid .card .btn { margin-top:auto !important; align-self:flex-start; }

        /* ── Responsive ── */
        @media(max-width:900px) {
            .topbar { display:none; }
            .grid-3, .grid-2, .stat-band, .steps, .team-grid, .contact-grid { grid-template-columns:1fr; }
            .stat-band { gap:0; background:none; }
            .stat-item { border:1px solid var(--line); border-radius:6px; margin-bottom:8px; }
            .step::after { display:none; }
            .step { border-right:0; border-bottom:1px solid var(--line); }
            .pdg-block { grid-template-columns:1fr; padding:32px; gap:24px; }
            .governance-intro { grid-template-columns:1fr; }
            .governance-principles { grid-template-columns:1fr; }
            .governance-chart-heading { display:block; }
            .governance-chart-heading p { text-align:left; margin-top:8px; }
            .company-overview-grid { grid-template-columns:1fr; }
            .projects-grid, .project-map { grid-template-columns:1fr; }
            .org-level--dga { grid-template-columns:1fr 1fr; }
            .org-hbar { width:calc(50% + 8px); }
        }
        @media(max-width:540px) {
            .org-level--dga { grid-template-columns:1fr; }
            .org-hbar { display:none; }
            .org-connector-branch { height:16px; }
        }
    </style>
    @yield('head')
    @stack('styles')
</head>
<body>
    @include('partials._nav', ['locale' => $loc, 'section' => $section])

    {{-- ── Masthead — h1 centré, sans répétition ── --}}
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
</body>
</html>
