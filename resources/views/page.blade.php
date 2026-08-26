@php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';

    $isCompany   = in_array($section, ['company','company-ceo','company-identity','company-history','company-values','company-governance']);
    $isSustain   = in_array($section, ['sustainability','communities','environment','hse','local-content']);
    $isNews      = in_array($section, ['news','press','gallery','reports','press-contact']);

    /* masthead key — sub-pages use their own keys */
    $mastheadSection = $section;
@endphp
<!DOCTYPE html>
<html lang="{{ $loc }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.'.$mastheadSection.'_h1', [], $loc) }} | Néré Mining</title>
    <meta name="description" content="{{ $description ?? '' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink:#281d18; --green:#4b1716; --red:#d72f2f; --gold:#ffc247;
            --sand:#fff4dc; --muted:#70645c; --line:#eadcc5; --light:#fbfaf7;
        }
        * { box-sizing:border-box; margin:0; padding:0; }
        body { color:var(--ink); background:var(--light); font-family:'Inter',Arial,Helvetica,sans-serif; }
        a { color:inherit; text-decoration:none; }

        /* ── Topbar ── */
        .topbar { background:var(--red); color:#fff7e8; padding:9px 5vw; display:flex; justify-content:space-between; font:11px Inter,sans-serif; letter-spacing:.06em; text-transform:uppercase; }

        /* ── Header ── */
        header { padding:18px 5vw; background:var(--green); display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:100; box-shadow:0 2px 12px rgba(0,0,0,.25); }
        .logo { width:200px; }
        .logo img { width:100%; display:block; }
        nav { display:flex; gap:6px; align-items:center; }
        .nav-link { color:rgba(255,255,255,.82); font:500 11px Inter,sans-serif; text-transform:uppercase; letter-spacing:.09em; padding:7px 12px; border-radius:4px; transition:background .18s,color .18s; white-space:nowrap; }
        .nav-link:hover, .nav-link.active { background:rgba(255,255,255,.12); color:#fff; }
        .nav-dropdown { position:relative; }
        .nav-dropdown > .nav-link::after { content:'▾'; margin-left:5px; font-size:10px; }
        .dropdown-menu { display:none; position:absolute; top:100%; left:0; background:#fff; border:1px solid var(--line); border-radius:6px; min-width:240px; box-shadow:0 8px 28px rgba(0,0,0,.12); z-index:200; padding:6px 0; }
        .nav-dropdown.is-open .dropdown-menu { display:block; opacity:1; transform:translateY(0); pointer-events:auto; }
        .dropdown-menu a { display:block; padding:10px 18px; font:500 12px Inter,sans-serif; color:var(--green); border-radius:4px; transition:background .15s; }
        .dropdown-menu a:hover { background:var(--sand); }
        .nav-lang { margin-left:12px; border:1px solid rgba(255,255,255,.3); border-radius:4px; }
        .menu-btn { display:none; border:1px solid rgba(255,255,255,.4); background:none; color:#fff; padding:8px 14px; font:600 11px Inter,sans-serif; letter-spacing:.08em; cursor:pointer; border-radius:4px; }

        /* ── Masthead ── */
        .masthead { padding:100px 5vw 80px; color:white; background:linear-gradient(100deg,rgba(75,23,22,.96) 45%,rgba(75,23,22,.55)),url('{{ asset('images/mining/karma-03.jpg') }}') center/cover; }
        .eyebrow { color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.2em; text-transform:uppercase; margin-bottom:14px; }
        h1 { max-width:800px; font-size:clamp(40px,6vw,76px); line-height:.97; font-weight:400; color:#fff; }
        .breadcrumb { margin-top:20px; font:12px Inter,sans-serif; color:rgba(255,255,255,.6); }
        .breadcrumb a { color:var(--gold); }
        .breadcrumb a:hover { text-decoration:underline; }

        /* ── Content ── */
        main { max-width:1240px; margin:auto; }
        section { padding:80px 5vw; }
        section + section { padding-top:0; }
        .lead { max-width:820px; color:var(--muted); font:18px/1.75 Inter,sans-serif; margin-bottom:48px; }
        h2 { color:var(--green); font-size:clamp(28px,3.5vw,48px); font-weight:400; line-height:1.05; margin-bottom:24px; }
        h3 { color:var(--green); font-size:22px; font-weight:500; margin-bottom:12px; }
        h4 { color:var(--green); font-size:16px; font-weight:600; margin-bottom:8px; letter-spacing:.04em; text-transform:uppercase; }
        p { color:var(--muted); font:15px/1.72 Inter,sans-serif; margin-bottom:12px; }

        /* ── Grid & Cards ── */
        .grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
        .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:30px; align-items:start; }
        .card { padding:28px; border:1px solid var(--line); background:#fff; border-radius:6px; transition:box-shadow .2s; }
        .card:hover { box-shadow:0 4px 18px rgba(0,0,0,.08); }
        .card-img { width:calc(100%+56px); height:190px; object-fit:cover; margin:-28px -28px 22px; display:block; border-radius:6px 6px 0 0; }
        .card-tag { display:inline-block; font:600 10px Inter,sans-serif; letter-spacing:.12em; text-transform:uppercase; color:var(--gold); margin-bottom:10px; }

        /* ── Stat band ── */
        .stat-band { display:grid; grid-template-columns:repeat(4,1fr); gap:1px; background:var(--line); border:1px solid var(--line); border-radius:8px; overflow:hidden; margin:40px 0; }
        .stat-item { background:#fff; padding:28px 24px; text-align:center; }
        .stat-value { display:block; font-size:36px; font-weight:300; color:var(--green); margin-bottom:8px; }
        .stat-label { font:500 12px Inter,sans-serif; color:var(--muted); line-height:1.4; }

        /* ── Section sand ── */
        .sand { background:var(--sand); }

        /* ── Sub-nav ── */
        .sub-nav { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:40px; padding-bottom:24px; border-bottom:1px solid var(--line); }
        .sub-nav a { padding:9px 18px; border:1px solid var(--line); border-radius:20px; font:500 12px Inter,sans-serif; color:var(--muted); transition:all .18s; }
        .sub-nav a:hover, .sub-nav a.active { background:var(--green); color:#fff; border-color:var(--green); }

        /* ── Map ── */
        .map-wrap { border-radius:8px; overflow:hidden; border:1px solid var(--line); height:440px; }
        .map-wrap iframe { width:100%; height:100%; border:0; display:block; }

        /* ── Accordion ── */
        details { border:1px solid var(--line); border-radius:6px; margin-bottom:10px; background:#fff; }
        summary { padding:18px 22px; cursor:pointer; font:500 15px Inter,sans-serif; color:var(--green); list-style:none; display:flex; justify-content:space-between; }
        summary::after { content:'＋'; font-size:18px; color:var(--gold); }
        details[open] summary::after { content:'－'; }
        details p { padding:0 22px 18px; }

        /* ── PDG Quote ── */
        .pdg-block { display:grid; grid-template-columns:260px 1fr; gap:48px; align-items:start; padding:60px; background:var(--green); border-radius:8px; color:#fff; }
        .pdg-photo { width:100%; aspect-ratio:3/4; object-fit:cover; border-radius:6px; background:#5a2020; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,.4); font:12px Inter,sans-serif; }
        .pdg-quote { font:28px/1.45 Inter,sans-serif; font-weight:300; color:#fff; margin-bottom:24px; }
        .pdg-quote::before { content:'" '; color:var(--gold); font-size:48px; line-height:0; vertical-align:-14px; }
        .pdg-name { font:600 14px Inter,sans-serif; color:var(--gold); letter-spacing:.1em; text-transform:uppercase; }
        .pdg-title { font:12px Inter,sans-serif; color:rgba(255,255,255,.6); margin-top:4px; }

        /* ── Team grid ── */
        .team-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; }
        .team-card { text-align:center; }
        .team-avatar { width:100%; aspect-ratio:1; object-fit:cover; border-radius:50%; background:#e8ddd2; margin-bottom:14px; }
        .team-name { font:600 14px Inter,sans-serif; color:var(--green); }
        .team-role { font:12px Inter,sans-serif; color:var(--muted); margin-top:4px; }

        /* ── Process steps ── */
        .steps { display:grid; grid-template-columns:repeat(4,1fr); gap:0; }
        .step { padding:28px 22px; border-right:1px solid var(--line); position:relative; }
        .step:last-child { border-right:0; }
        .step-num { font:700 36px Inter,sans-serif; color:var(--line); margin-bottom:16px; }
        .step h4 { margin-bottom:10px; }
        .step::after { content:''; position:absolute; top:50%; right:-1px; width:22px; height:22px; background:var(--gold); clip-path:polygon(0 50%,100% 0,100% 100%); transform:translateY(-50%); z-index:1; }
        .step:last-child::after { display:none; }

        /* ── Permits map placeholder ── */
        .permits-placeholder { background:var(--sand); border:1px dashed var(--gold); border-radius:8px; padding:60px; text-align:center; color:var(--muted); font:14px Inter,sans-serif; }

        /* ── Buttons ── */
        .btn { display:inline-block; padding:13px 20px; font:600 12px Inter,sans-serif; text-transform:uppercase; letter-spacing:.1em; border-radius:4px; cursor:pointer; transition:all .18s; }
        .btn-gold { background:var(--gold); color:var(--ink); }
        .btn-gold:hover { background:#e5a72f; }
        .btn-dark { background:var(--green); color:#fff; }
        .btn-dark:hover { background:#3a100f; }
        .btn-outline { border:1px solid var(--green); color:var(--green); }
        .btn-outline:hover { background:var(--green); color:#fff; }
        .btn.disabled { background:#eee5d7; color:var(--muted); pointer-events:none; }

        /* ── Contact cards ── */
        .contact-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; margin-bottom:48px; }
        .contact-card { padding:32px; border:1px solid var(--line); background:#fff; border-radius:6px; }
        .contact-card .icon { font-size:28px; margin-bottom:16px; }
        .contact-card h3 { margin-bottom:14px; }
        .contact-info { list-style:none; }
        .contact-info li { font:14px/1.7 Inter,sans-serif; color:var(--muted); padding:3px 0; }
        .contact-info strong { color:var(--ink); }

        /* ── Form ── */
        form { max-width:720px; }
        label { display:block; margin:20px 0 7px; color:var(--green); font:600 11px Inter,sans-serif; text-transform:uppercase; letter-spacing:.08em; }
        input, select, textarea { width:100%; border:1px solid var(--line); padding:13px 15px; color:var(--ink); background:#fff; font:15px Inter,sans-serif; border-radius:4px; }
        input:focus, textarea:focus, select:focus { outline:none; border-color:var(--gold); }
        textarea { min-height:150px; resize:vertical; }
        button[type=submit] { border:0; cursor:pointer; margin-top:22px; padding:15px 24px; background:var(--red); color:#fff; font:600 12px Inter,sans-serif; text-transform:uppercase; letter-spacing:.1em; border-radius:4px; }
        .alert-success { padding:16px 20px; background:#e7f0d7; color:#31501f; font:14px Inter,sans-serif; border-radius:4px; margin-bottom:24px; }

        /* ── Org chart ── */
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
        .org-connector-h-wrap { display:flex; align-items:flex-start; justify-content:center; width:100%; position:relative; }
        .org-level--dga { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; width:100%; }
        .karma-standards { margin-top:28px; padding:24px 28px; border-left:4px solid var(--gold); background:#fff; border-radius:6px; }
        .karma-standards h3 { margin-bottom:8px; }
        .karma-standards p { margin:0; }
        .org-branch { display:flex; flex-direction:column; align-items:center; }
        .org-connector-branch { width:2px; height:36px; background:#333; }
        .org-hbar { width:calc(75% + 8px); height:2px; background:#333; margin:0 auto; }
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
        .governance-chart-heading p { margin:0; text-align:right; font-size:12px; }
        .governance-legend { display:flex; justify-content:center; gap:22px; flex-wrap:wrap; padding:0 0 18px; color:var(--muted); font:12px Inter,sans-serif; }
        .governance-legend span { display:flex; align-items:center; gap:7px; }
        .governance-legend i { width:11px; height:11px; display:inline-block; border-radius:50%; }
        .governance-legend .legend-pdg { background:#b94040; }
        .governance-legend .legend-dga { background:#e88840; }
        .company-overview-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
        .company-overview-grid .card { height:100%; display:flex !important; flex-direction:column; }
        .company-overview-grid .card .btn { margin-top:auto !important; align-self:flex-start; }

        /* ── Footer ── */
        footer { padding:32px 5vw; background:#351312; color:#eadcca; display:flex; justify-content:space-between; align-items:center; font:12px Inter,sans-serif; }
        .footer-links { display:flex; gap:20px; }
        .footer-links a:hover { color:var(--gold); }

        /* ── Responsive ── */
        @media(max-width:900px) {
            .topbar { display:none; }
            header { flex-wrap:wrap; gap:12px; }
            nav { display:none; }
            .menu-btn { display:block; }
            nav.open { display:flex; flex-direction:column; align-items:flex-start; width:100%; gap:4px; }
            .nav-dropdown .dropdown-menu { position:static; box-shadow:none; border:0; padding:0 0 0 16px; }
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
            .org-level--dga { grid-template-columns:1fr 1fr; }
            .org-hbar { width:calc(50% + 8px); }
            footer { flex-direction:column; gap:12px; text-align:center; }
        }
        @media(max-width:540px) {
            .org-level--dga { grid-template-columns:1fr; }
            .org-hbar { display:none; }
            .org-connector-branch { height:16px; }
        }
    </style>
</head>
<body>
    @include('partials._nav', ['locale' => $loc, 'section' => $section])

    {{-- ── Masthead ── --}}
    <div class="masthead">
        <div class="eyebrow">{{ __('site.'.$mastheadSection.'_eyebrow', [], $loc) }}</div>
        <h1>{{ __('site.'.$mastheadSection.'_h1', [], $loc) }}</h1>
        <div class="breadcrumb">
            <a href="{{ $en ? route('english') : url('/') }}">{{ __('site.home_link', [], $loc) }}</a>
            @if($isCompany && $section !== 'company')
                › <a href="{{ $en ? route('english.company') : route('company') }}">{{ __('site.nav_company', [], $loc) }}</a>
            @endif
            › {{ __('site.'.$mastheadSection.'_breadcrumb', [], $loc) }}
        </div>
    </div>

    <main>
        @if(session('success'))
        <section><div class="alert-success">{{ session('success') }}</div></section>
        @endif

        {{-- ════════════════════════════════════════════════════════
             QUI SOMMES-NOUS — PAGE HUB (company)
        ═══════════════════════════════════════════════════════════ --}}
        @if($section === 'company')

        {{-- Sub-nav Qui sommes-nous --}}
        @php
            $companyBase = $en ? route('english.company') : route('company');
        @endphp
        <section>
            <div class="sub-nav">
                <a href="{{ $companyBase }}" class="active">{{ __('site.subnav_overview', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.history')    : route('company.history') }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.values')     : route('company.values') }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
            </div>
            <p class="lead">{{ __('site.company_identity_lead', [], $loc) }}</p>
            <div class="company-overview-grid">
                <a href="{{ $en ? route('english.company.ceo') : route('company.ceo') }}" class="card" style="display:block;">
                    <div class="card-tag">01</div>
                    <h3>{{ __('site.subnav_company_ceo', [], $loc) }}</h3>
                    <p>{{ __('site.company_pdg_quote', [], $loc) }}</p>
                    <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
                </a>
                <a href="{{ $en ? route('english.company.identity') : route('company.identity') }}" class="card" style="display:block;">
                    <div class="card-tag">02</div>
                    <h3>{{ __('site.subnav_company_identity', [], $loc) }}</h3>
                    <p>{{ __('site.company_identity_lead', [], $loc) }}</p>
                    <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
                </a>
                <a href="{{ $en ? route('english.company.history') : route('company.history') }}" class="card" style="display:block;">
                    <div class="card-tag">03</div>
                    <h3>{{ __('site.subnav_company_history', [], $loc) }}</h3>
                    <p>{{ __('site.company_history_lead', [], $loc) }}</p>
                    <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
                </a>
                <a href="{{ $en ? route('english.company.values') : route('company.values') }}" class="card" style="display:block;">
                    <div class="card-tag">04</div>
                    <h3>{{ __('site.subnav_company_values', [], $loc) }}</h3>
                    <p>{{ __('site.company_vision_lead', [], $loc) }}</p>
                    <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
                </a>
                <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}" class="card">
                    <div class="card-tag">05</div>
                    <h3>{{ __('site.subnav_company_governance', [], $loc) }}</h3>
                    <p>{{ __('site.company_gov_lead', [], $loc) }}</p>
                    <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.discover', [], $loc) }}</span>
                </a>
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             SOUS-PAGE : MOT DU PDG
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'company-ceo')
        @php $companyBase = $en ? route('english.company') : route('company'); @endphp
        <section>
            <div class="sub-nav">
                <a href="{{ $companyBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}" class="active">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.history')    : route('company.history') }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.values')     : route('company.values') }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
            </div>
            <h2>{{ __('site.company_pdg_h2', [], $loc) }}</h2>
            <div class="pdg-block">
                <div>
                    <div class="pdg-photo" style="height:320px; border-radius:6px; display:flex; align-items:center; justify-content:center; background:#5a2020;">
                        <span style="color:rgba(255,255,255,.35); font-size:13px; text-align:center;">{{ __('site.company_photo_placeholder', [], $loc) }}</span>
                    </div>
                </div>
                <div>
                    <p class="pdg-quote" style="font-size:24px; line-height:1.5; color:rgba(255,255,255,.9);">
                        {{ __('site.company_pdg_quote', [], $loc) }}
                    </p>
                    <div class="pdg-name">{{ __('site.company_pdg_name', [], $loc) }}</div>
                    <div class="pdg-title">{{ __('site.company_pdg_company', [], $loc) }}</div>
                </div>
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             SOUS-PAGE : NOTRE IDENTITÉ
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'company-identity')
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
            <h2>{{ __('site.company_identity_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.company_identity_lead', [], $loc) }}</p>
            <div class="grid-3">
                <div class="card">
                    <div class="card-tag">{{ __('site.company_id1_tag', [], $loc) }}</div>
                    <h3>{{ __('site.company_id1_h3', [], $loc) }}</h3>
                    <p>{{ __('site.company_id1_p', [], $loc) }}</p>
                </div>
                <div class="card">
                    <div class="card-tag">{{ __('site.company_id2_tag', [], $loc) }}</div>
                    <h3>{{ __('site.company_id2_h3', [], $loc) }}</h3>
                    <p>{{ __('site.company_id2_p', [], $loc) }}</p>
                </div>
                <div class="card">
                    <div class="card-tag">{{ __('site.company_id3_tag', [], $loc) }}</div>
                    <h3>{{ __('site.company_id3_h3', [], $loc) }}</h3>
                    <p>{{ __('site.company_id3_p', [], $loc) }}</p>
                </div>
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             SOUS-PAGE : NOTRE HISTOIRE
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'company-history')
        @php $companyBase = $en ? route('english.company') : route('company'); @endphp
        <section>
            <div class="sub-nav">
                <a href="{{ $companyBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.history')    : route('company.history') }}" class="active">{{ __('site.subnav_company_history', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.values')     : route('company.values') }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
            </div>
            <h2>{{ __('site.company_history_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.company_history_lead', [], $loc) }}</p>
            <div class="grid-2">
                <div>
                    <details open>
                        <summary>{{ __('site.company_hist1_title', [], $loc) }}</summary>
                        <p>{{ __('site.company_hist1_p', [], $loc) }}</p>
                    </details>
                    <details>
                        <summary>{{ __('site.company_hist2_title', [], $loc) }}</summary>
                        <p>{{ __('site.company_hist2_p', [], $loc) }}</p>
                    </details>
                    <details>
                        <summary>{{ __('site.company_hist3_title', [], $loc) }}</summary>
                        <p>{{ __('site.company_hist3_p', [], $loc) }}</p>
                    </details>
                    <details>
                        <summary>{{ __('site.company_hist4_title', [], $loc) }}</summary>
                        <p>{{ __('site.company_hist4_p', [], $loc) }}</p>
                    </details>
                </div>
                <div class="card" style="background:var(--sand); border:0;">
                    <h3>{{ __('site.company_kpi_h3', [], $loc) }}</h3>
                    <div class="stat-band" style="grid-template-columns:1fr 1fr; margin:0;">
                        <div class="stat-item"><span class="stat-value">100%</span><span class="stat-label">{{ $en ? 'Burkinabe ownership' : 'Actionnariat burkinabè' }}</span></div>
                        <div class="stat-item"><span class="stat-value">1 200+</span><span class="stat-label">{{ $en ? 'Direct & indirect jobs' : 'Emplois directs et indirects' }}</span></div>
                        <div class="stat-item"><span class="stat-value">80%</span><span class="stat-label">{{ $en ? 'National workforce' : 'Main-d\'œuvre nationale' }}</span></div>
                        <div class="stat-item"><span class="stat-value">ITIE</span><span class="stat-label">{{ $en ? 'Transparency member' : 'Membre de la transparence' }}</span></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             SOUS-PAGE : VISION & VALEURS
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'company-values')
        @php $companyBase = $en ? route('english.company') : route('company'); @endphp
        <section>
            <div class="sub-nav">
                <a href="{{ $companyBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.history')    : route('company.history') }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.values')     : route('company.values') }}" class="active">{{ __('site.subnav_company_values', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}">{{ __('site.subnav_company_governance', [], $loc) }}</a>
            </div>
            <h2>{{ __('site.company_vision_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.company_vision_lead', [], $loc) }}</p>
            <div class="grid-3">
                @foreach(range(1,6) as $i)
                <div class="card">
                    <div class="card-tag">{{ __('site.company_v'.$i.'_tag', [], $loc) }}</div>
                    <h3>{{ __('site.company_v'.$i.'_h3', [], $loc) }}</h3>
                    <p>{{ __('site.company_v'.$i.'_p', [], $loc) }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             SOUS-PAGE : GOUVERNANCE
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'company-governance')
        @php $companyBase = $en ? route('english.company') : route('company'); @endphp
        <section>
            <div class="sub-nav">
                <a href="{{ $companyBase }}">{{ __('site.subnav_overview', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}">{{ __('site.subnav_company_ceo', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}">{{ __('site.subnav_company_identity', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.history')    : route('company.history') }}">{{ __('site.subnav_company_history', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.values')     : route('company.values') }}">{{ __('site.subnav_company_values', [], $loc) }}</a>
                <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}" class="active">{{ __('site.subnav_company_governance', [], $loc) }}</a>
            </div>
            <h2>{{ __('site.company_gov_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.company_gov_lead', [], $loc) }}</p>

            <div class="governance-intro">
                <div class="governance-callout">
                    <h3>{{ __('site.company_gov_callout_h3', [], $loc) }}</h3>
                    <p>{{ __('site.company_gov_callout_p', [], $loc) }}</p>
                </div>
                <div class="governance-principles">
                    @foreach(range(1,3) as $i)
                    <div class="governance-principle">
                        <strong>{{ __('site.company_gov_principle'.$i.'_title', [], $loc) }}</strong>
                        <span>{{ __('site.company_gov_principle'.$i.'_p', [], $loc) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="governance-chart-panel">
                <div class="governance-chart-heading">
                    <h3>{{ __('site.company_gov_chart_h3', [], $loc) }}</h3>
                </div>
                <div class="governance-legend">
                    <span><i class="legend-pdg"></i>{{ __('site.company_gov_legend_pdg', [], $loc) }}</span>
                    <span><i class="legend-dga"></i>{{ __('site.company_gov_legend_dga', [], $loc) }}</span>
                </div>
                <div class="org-chart">
                {{-- PDG --}}
                <div class="org-level org-level--top">
                    <div class="org-box org-box--pdg">
                        <div class="org-name">Dr. Justin Elie OUEDRAOGO</div>
                        <div class="org-title">{{ $en ? 'Chief Executive Officer' : 'Président Directeur Général' }}</div>
                    </div>
                </div>
                <div class="org-connector-v"></div>
                <div class="org-hbar"></div>
                {{-- 4 DGA --}}
                <div class="org-level org-level--dga">
                    <div class="org-branch">
                        <div class="org-connector-branch"></div>
                        <div class="org-box org-box--dga">
                            <div class="org-name">Justin SAVADOGO</div>
                            <div class="org-grade">{{ $en ? 'Deputy CEO' : 'DGA' }}</div>
                            <div class="org-title">{{ $en ? 'Administration & Finance' : 'Administration & Finance' }}</div>
                        </div>
                    </div>
                    <div class="org-branch">
                        <div class="org-connector-branch"></div>
                        <div class="org-box org-box--dga">
                            <div class="org-name">Pascal Y. OUEDRAOGO</div>
                            <div class="org-grade">{{ $en ? 'Deputy CEO' : 'DGA' }}</div>
                            <div class="org-title">{{ $en ? 'Supply & Procurement' : 'Approvisionnements' }}</div>
                        </div>
                    </div>
                    <div class="org-branch">
                        <div class="org-connector-branch"></div>
                        <div class="org-box org-box--dga">
                            <div class="org-name">Laurent Michel DABIRE</div>
                            <div class="org-grade">{{ $en ? 'Deputy CEO' : 'DGA' }}</div>
                            <div class="org-title">{{ $en ? 'Corporate & Legal Affairs' : 'Affaires Corporatives & Juridiques' }}</div>
                        </div>
                    </div>
                    <div class="org-branch">
                        <div class="org-connector-branch"></div>
                        <div class="org-box org-box--dga">
                            <div class="org-name">Augustine OBENG-FORI</div>
                            <div class="org-grade">{{ $en ? 'Deputy CEO (interim)' : 'DGA par intérim' }}</div>
                            <div class="org-title">{{ $en ? 'Operations' : 'Opérations' }}</div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             KARMA
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'karma')
        <section id="presentation">
            <h2>{{ __('site.karma_pres_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.karma_pres_lead', [], $loc) }}</p>
            <div class="grid-2" style="margin-bottom:40px;">
                <div>
                    <div class="card" style="background:var(--sand); border:0; margin-bottom:20px;">
                        <h4>{{ __('site.karma_loc_h4', [], $loc) }}</h4>
                        <p>{!! nl2br(e(__('site.karma_loc_p', [], $loc))) !!}</p>
                    </div>
                    <div class="card" style="background:var(--sand); border:0; margin-bottom:20px;">
                        <h4>{{ __('site.karma_area_h4', [], $loc) }}</h4>
                        <p>{{ __('site.karma_area_p', [], $loc) }}</p>
                    </div>
                    <div class="card" style="background:var(--sand); border:0;">
                        <h4>{{ __('site.karma_history_h4', [], $loc) }}</h4>
                        <p>{{ __('site.karma_history_p', [], $loc) }}</p>
                    </div>
                </div>
                <div class="map-wrap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125836.0!2d-2.2!3d13.63!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMine+de+Karma%2C+Burkina+Faso!5e0!3m2!1s{{ $loc }}!2sbf!4v1"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="{{ $en ? 'Location of the Karma mine, Burkina Faso' : 'Localisation de la mine de Karma, Burkina Faso' }}">
                    </iframe>
                </div>
            </div>
        </section>

        <section id="exploitation" class="sand">
            <h2>{{ __('site.karma_prod_h2', [], $loc) }}</h2>
            <div class="stat-band">
                <div class="stat-item"><span class="stat-value">80 koz</span><span class="stat-label">{{ $en ? 'Annual gold production (oz)' : "Production annuelle d'or (onces)" }}</span></div>
                <div class="stat-item"><span class="stat-value">1 200+</span><span class="stat-label">{{ $en ? 'Direct and indirect jobs' : 'Emplois directs et indirects' }}</span></div>
                <div class="stat-item"><span class="stat-value">80%</span><span class="stat-label">{{ $en ? 'Burkinabe national staff' : 'Personnel de nationalité burkinabè' }}</span></div>
                <div class="stat-item"><span class="stat-value">{{ $en ? 'EITI' : 'ITIE' }}</span><span class="stat-label">{{ $en ? 'Member — fiscal transparency' : 'Membre — transparence fiscale' }}</span></div>
            </div>
            <div class="grid-3">
                <div class="card">
                    <img class="card-img" src="{{ asset('images/mining/karma-01.jpg') }}" alt="{{ $en ? 'Mining operation at Karma' : 'Opération minière à Karma' }}">
                    <h3>{{ __('site.karma_card1_h3', [], $loc) }}</h3>
                    <p>{{ __('site.karma_card1_p', [], $loc) }}</p>
                </div>
                <div class="card">
                    <img class="card-img" src="{{ asset('images/mining/karma-03.jpg') }}" alt="{{ $en ? 'Processing facilities' : 'Installations de traitement' }}">
                    <h3>{{ __('site.karma_card2_h3', [], $loc) }}</h3>
                    <p>{{ __('site.karma_card2_p', [], $loc) }}</p>
                </div>
                <div class="card">
                    <img class="card-img" src="{{ asset('images/mining/karma-04.jpg') }}" alt="{{ $en ? 'Karma teams' : 'Équipes de Karma' }}">
                    <h3>{{ __('site.karma_card3_h3', [], $loc) }}</h3>
                    <p>{{ __('site.karma_card3_p', [], $loc) }}</p>
                </div>
            </div>
        </section>

        <section id="organisation">
            <h2>{{ __('site.karma_org_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.karma_org_lead', [], $loc) }}</p>
            <div class="grid-3">
                @foreach(range(1,6) as $i)
                <div class="card">
                    <div class="card-tag">{{ __('site.karma_dept'.$i.'_tag', [], $loc) }}</div>
                    <h3>{{ __('site.karma_dept'.$i.'_h3', [], $loc) }}</h3>
                    <p>{{ __('site.karma_dept'.$i.'_p', [], $loc) }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <section id="modele-operationnel" class="sand">
            <h2>{{ __('site.karma_model_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.karma_model_lead', [], $loc) }}</p>
            <div class="steps" style="border:1px solid var(--line); border-radius:8px; overflow:hidden; background:#fff; margin-bottom:40px;">
                @foreach(range(1,4) as $i)
                <div class="step">
                    <div class="step-num">0{{ $i }}</div>
                    <h4>{{ __('site.karma_step'.$i.'_h4', [], $loc) }}</h4>
                    <p>{{ __('site.karma_step'.$i.'_p', [], $loc) }}</p>
                    @if($i === 3)
                    <a class="btn btn-outline" href="https://www.nere-mining.bf/projet-cil/" target="_blank" rel="noopener">
                        {{ __('site.karma_cil_link', [], $loc) }}
                    </a>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="karma-standards">
                <h3>{{ __('site.karma_standards_h3', [], $loc) }}</h3>
                <p>{{ __('site.karma_standards_p', [], $loc) }}</p>
            </div>
        </section>

        <section id="impact">
            <h2>{{ __('site.karma_impact_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.karma_impact_lead', [], $loc) }}</p>
            <div class="grid-2">
                <div>
                    <h3>{{ __('site.karma_imp_jobs_h3', [], $loc) }}</h3>
                    @foreach(range(1,3) as $i)
                    <div class="card" style="margin-bottom:14px;">
                        <div class="card-tag">{{ __('site.karma_imp_job'.$i.'_tag', [], $loc) }}</div>
                        <p>{{ __('site.karma_imp_job'.$i.'_p', [], $loc) }}</p>
                    </div>
                    @endforeach
                </div>
                <div>
                    <h3>{{ __('site.karma_imp_eco_h3', [], $loc) }}</h3>
                    @foreach(range(1,4) as $i)
                    <div class="card" style="margin-bottom:14px;">
                        <div class="card-tag">{{ __('site.karma_imp_eco'.$i.'_tag', [], $loc) }}</div>
                        <p>{{ __('site.karma_imp_eco'.$i.'_p', [], $loc) }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             NOS PROJETS EN DÉVELOPPEMENT
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'projects')
        <section id="exploration">
            <h2>{{ __('site.projects_expl_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.projects_expl_lead', [], $loc) }}</p>
            <div class="grid-3">
                @foreach(range(1,3) as $i)
                <div class="card">
                    <div class="card-tag">{{ __('site.projects_card'.$i.'_tag', [], $loc) }}</div>
                    <h3>{{ __('site.projects_card'.$i.'_h3', [], $loc) }}</h3>
                    <p>{!! __('site.projects_card'.$i.'_p', [], $loc) !!}</p>
                </div>
                @endforeach
            </div>
        </section>

        <section id="permits" class="sand">
            <h2>{{ __('site.projects_map_h2', [], $loc) }}</h2>
            <div class="permits-placeholder">
                <div style="font-size:40px; margin-bottom:16px;">🗺️</div>
                <p style="font-size:16px; font-weight:600; color:var(--green); margin-bottom:8px;">{{ __('site.projects_map_icon_label', [], $loc) }}</p>
                <p>{{ __('site.projects_map_soon', [], $loc) }}</p>
            </div>
        </section>

        <section id="partnerships">
            <h2>{{ __('site.projects_join_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.projects_join_lead', [], $loc) }}</p>
            <div class="grid-2">
                <div class="card">
                    <div class="card-tag">{{ __('site.projects_part1_tag', [], $loc) }}</div>
                    <h3>{{ __('site.projects_part1_h3', [], $loc) }}</h3>
                    <p>{{ __('site.projects_part1_p', [], $loc) }}</p>
                    <a class="btn btn-dark" style="margin-top:16px; display:inline-block;"
                       href="{{ ($en ? route('english.contact') : route('contact')) }}?type=partenariat">
                        {{ __('site.projects_part1_btn', [], $loc) }}
                    </a>
                </div>
                <div class="card">
                    <div class="card-tag">{{ __('site.projects_part2_tag', [], $loc) }}</div>
                    <h3>{{ __('site.projects_part2_h3', [], $loc) }}</h3>
                    <p>{{ __('site.projects_part2_p', [], $loc) }}</p>
                    <a class="btn btn-gold" style="margin-top:16px; display:inline-block;"
                       href="{{ ($en ? route('english.contact') : route('contact')) }}?type=investissement">
                        {{ __('site.projects_part2_btn', [], $loc) }}
                    </a>
                </div>
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             DÉVELOPPEMENT DURABLE — hub
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'sustainability')
        <section>
            <p class="lead">{{ __('site.sustain_lead', [], $loc) }}</p>
            <div class="grid-2">
                @foreach(range(1,4) as $i)
                @php
                    $pillarRoutes = [
                        1 => [$en ? route('english.communities')   : route('sustainability.communities')],
                        2 => [$en ? route('english.environment')   : route('sustainability.environment')],
                        3 => [$en ? route('english.hse')           : route('sustainability.hse')],
                        4 => [$en ? route('english.local-content') : route('sustainability.local-content')],
                    ];
                @endphp
                <a href="{{ $pillarRoutes[$i][0] }}" class="card" style="display:block;">
                    <div class="card-tag">{{ __('site.sustain_pillar'.$i.'_num', [], $loc) }}</div>
                    <h3>{{ __('site.sustain_pillar'.$i.'_h3', [], $loc) }}</h3>
                    <p>{{ __('site.sustain_pillar'.$i.'_p', [], $loc) }}</p>
                    <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">{{ __('site.sustain_discover', [], $loc) }}</span>
                </a>
                @endforeach
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             COMMUNAUTÉS
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'communities')
        <section>
            <div class="sub-nav">
                <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
                <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}" class="active">{{ __('site.subnav_communities', [], $loc) }}</a>
                <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
                <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
                <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
            </div>
            <p class="lead">{{ __('site.communities_lead', [], $loc) }}</p>
            <div class="grid-2">
                <div>
                    <h3>{{ __('site.communities_policy_h3', [], $loc) }}</h3>
                    <p>{{ __('site.communities_policy_p', [], $loc) }}</p>
                    <h3 style="margin-top:28px;">{{ __('site.communities_dialogue_h3', [], $loc) }}</h3>
                    <p>{{ __('site.communities_dialogue_p', [], $loc) }}</p>
                </div>
                <div>
                    <h3>{{ __('site.communities_invest_h3', [], $loc) }}</h3>
                    <p>{{ __('site.communities_invest_p', [], $loc) }}</p>
                    <div class="card" style="background:var(--sand); border:0; margin-top:20px;">
                        <h4>{{ __('site.communities_achiev_h4', [], $loc) }}</h4>
                        <p>{{ __('site.communities_achiev_p', [], $loc) }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="sand">
            <h2>{{ __('site.communities_complaint_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.communities_complaint_lead', [], $loc) }}</p>
            <div class="grid-3">
                @foreach(range(1,3) as $i)
                <div class="card">
                    <div class="card-tag">{{ __('site.communities_step'.$i.'_tag', [], $loc) }}</div>
                    <h3>{{ __('site.communities_step'.$i.'_h3', [], $loc) }}</h3>
                    <p>{{ __('site.communities_step'.$i.'_p', [], $loc) }}</p>
                </div>
                @endforeach
            </div>
        </section>
        <section>
            <h2>{{ __('site.communities_partners_h2', [], $loc) }}</h2>
            <p>{{ __('site.communities_partners_p', [], $loc) }}</p>
        </section>

        {{-- ════════════════════════════════════════════════════════
             ENVIRONNEMENT
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'environment')
        <section>
            <div class="sub-nav">
                <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
                <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
                <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}" class="active">{{ __('site.subnav_environment', [], $loc) }}</a>
                <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
                <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
            </div>
            <p class="lead">{{ __('site.environment_lead', [], $loc) }}</p>
            <div class="grid-3">
                @foreach(range(1,3) as $i)
                <div class="card">
                    <div class="card-tag">{{ __('site.env_card'.$i.'_tag', [], $loc) }}</div>
                    <h3>{{ __('site.env_card'.$i.'_h3', [], $loc) }}</h3>
                    <p>{{ __('site.env_card'.$i.'_p', [], $loc) }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             SANTÉ ET SÉCURITÉ
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'hse')
        <section>
            <div class="sub-nav">
                <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
                <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
                <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
                <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}" class="active">{{ __('site.subnav_hse', [], $loc) }}</a>
                <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
            </div>
            <p class="lead">{{ __('site.hse_lead', [], $loc) }}</p>
            <div class="stat-band">
                @foreach(range(1,4) as $i)
                <div class="stat-item">
                    <span class="stat-value">{{ __('site.hse_stat'.$i.'_val', [], $loc) }}</span>
                    <span class="stat-label">{{ __('site.hse_stat'.$i.'_label', [], $loc) }}</span>
                </div>
                @endforeach
            </div>
            <div class="grid-3">
                @foreach(range(1,3) as $i)
                <div class="card">
                    <div class="card-tag">{{ __('site.hse_card'.$i.'_tag', [], $loc) }}</div>
                    <h3>{{ __('site.hse_card'.$i.'_h3', [], $loc) }}</h3>
                    <p>{{ __('site.hse_card'.$i.'_p', [], $loc) }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             CONTENU LOCAL
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'local-content')
        <section>
            <div class="sub-nav">
                <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
                <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
                <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
                <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
                <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}" class="active">{{ __('site.subnav_local_content', [], $loc) }}</a>
            </div>
            <p class="lead">{{ __('site.local_lead', [], $loc) }}</p>
            <div class="grid-2">
                <div class="card">
                    <div class="card-tag">{{ __('site.local_card1_tag', [], $loc) }}</div>
                    <h3>{{ __('site.local_card1_h3', [], $loc) }}</h3>
                    <p>{{ __('site.local_card1_p', [], $loc) }}</p>
                </div>
                <div class="card">
                    <div class="card-tag">{{ __('site.local_card2_tag', [], $loc) }}</div>
                    <h3>{{ __('site.local_card2_h3', [], $loc) }}</h3>
                    <p>{{ __('site.local_card2_p', [], $loc) }}</p>
                </div>
                <div class="card" style="grid-column:span 2;">
                    <div class="card-tag">{{ __('site.local_card3_tag', [], $loc) }}</div>
                    <h3>{{ __('site.local_card3_h3', [], $loc) }}</h3>
                    <p>{{ __('site.local_card3_p', [], $loc) }}</p>
                    <a class="btn btn-dark" style="margin-top:16px; display:inline-block;"
                       href="{{ ($en ? route('english.contact') : route('contact')) }}?type=fournisseur">
                        {{ __('site.local_card3_btn', [], $loc) }}
                    </a>
                </div>
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             RAPPORTS
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'reports')
        <section>
            <p class="lead">{{ __('site.reports_lead', [], $loc) }}</p>
            <div class="grid-3">
                @forelse($reports as $report)
                <article class="card">
                    <div class="card-tag">{{ $report->category }}</div>
                    <h3>{{ $report->title }}</h3>
                    <p>{{ $report->description }}</p>
                    <a class="btn {{ $report->file_path ? 'btn-gold' : 'disabled' }}" style="margin-top:16px; display:inline-block;"
                       href="{{ $report->file_path ? asset($report->file_path) : '#' }}">
                        {{ $report->file_path ? __('site.download_pdf', [], $loc) : __('site.coming_soon', [], $loc) }}
                    </a>
                </article>
                @empty
                <p class="lead" style="grid-column:span 3;">{{ __('site.reports_empty', [], $loc) }}</p>
                @endforelse
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             CARRIÈRES
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'careers')
        <section>
            <h2>{{ __('site.careers_why_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.careers_why_lead', [], $loc) }}</p>
            <div class="grid-3" style="margin-bottom:60px;">
                @foreach(range(1,3) as $i)
                <div class="card">
                    <div class="card-tag">{{ __('site.careers_why'.$i.'_tag', [], $loc) }}</div>
                    <h3>{{ __('site.careers_why'.$i.'_h3', [], $loc) }}</h3>
                    <p>{{ __('site.careers_why'.$i.'_p', [], $loc) }}</p>
                </div>
                @endforeach
            </div>
            <h2>{{ __('site.careers_jobs_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.careers_jobs_lead', [], $loc) }}</p>
            <div class="grid-3">
                @forelse($jobs as $job)
                <article class="card">
                    <div class="card-tag">{{ $job->department }}</div>
                    <h3>{{ $job->title }}</h3>
                    <p>{{ $job->location }} · {{ $job->contract_type }}</p>
                    <p>{{ $job->description }}</p>
                    @if($job->deadline)
                    <p style="font:500 12px Inter,sans-serif; color:var(--muted);">{{ __('site.careers_deadline', [], $loc) }} {{ $job->deadline->format('d/m/Y') }}</p>
                    @endif
                    <a class="btn btn-dark" style="margin-top:16px; display:inline-block;"
                       href="{{ ($en ? route('english.contact') : route('contact')) }}?type=emploi&subject={{ urlencode($job->title) }}">
                        {{ __('site.careers_apply', [], $loc) }}
                    </a>
                </article>
                @empty
                <div style="grid-column:span 3;">
                    <h3>{{ __('site.careers_empty_h3', [], $loc) }}</h3>
                    <p>{{ __('site.careers_empty_p', [], $loc) }}</p>
                </div>
                @endforelse
            </div>
            <div style="margin-top:32px;">
                <a class="btn btn-outline"
                   href="{{ $en ? route('english.spontaneous') : route('spontaneous') }}">
                    {{ __('site.spontaneous', [], $loc) }}
                </a>
            </div>
        </section>

        {{-- ════════════════════════════════════════════════════════
             CONTACT
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'contact')
        <section>
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="icon">🏢</div>
                    <h3>{{ __('site.contact_hq_h3', [], $loc) }}</h3>
                    <ul class="contact-info">
                        <li><strong>{{ __('site.contact_hq_address', [], $loc) }} :</strong> Ouagadougou, Burkina Faso</li>
                        <li><strong>{{ __('site.contact_hq_phone', [], $loc) }} :</strong> +226 25 33 35 69</li>
                        <li><strong>{{ __('site.contact_hq_email', [], $loc) }} :</strong> contact@nere-mining.bf</li>
                        <li><strong>{{ __('site.contact_hq_hours', [], $loc) }} :</strong> {{ __('site.contact_hq_hours_v', [], $loc) }}</li>
                    </ul>
                </div>
                <div class="contact-card">
                    <div class="icon">⛏️</div>
                    <h3>{{ __('site.contact_mine_h3', [], $loc) }}</h3>
                    <ul class="contact-info">
                        <li><strong>{{ __('site.contact_mine_location', [], $loc) }} :</strong> {{ $en ? 'Zondoma & Yatenga Provinces, Northern Region — 195 km from Ouagadougou' : 'Provinces du Zondoma & Yatenga, Région du Nord — 195 km de Ouagadougou' }}</li>
                        <li><strong>{{ __('site.contact_mine_phone', [], $loc) }} :</strong> +226 25 33 35 69</li>
                        <li><strong>{{ __('site.contact_mine_community', [], $loc) }} :</strong> contact@nere-mining.bf</li>
                    </ul>
                </div>
                <div class="contact-card">
                    <div class="icon">📍</div>
                    <h3>{{ __('site.contact_office_h3', [], $loc) }}</h3>
                    <ul class="contact-info">
                        <li><strong>{{ __('site.contact_office_address', [], $loc) }} :</strong> {{ $en ? 'Ouahigouya, Northern Region' : 'Ouahigouya, Région du Nord' }}</li>
                        <li><strong>{{ __('site.contact_office_phone', [], $loc) }} :</strong> +226 25 33 35 69</li>
                        <li><strong>{{ __('site.contact_office_press', [], $loc) }} :</strong> contact@nere-mining.bf</li>
                    </ul>
                </div>
            </div>
            <h2>{{ __('site.contact_form_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.contact_form_lead', [], $loc) }}</p>
            <form method="POST" action="{{ $en ? route('english.contact.store') : route('contact.store') }}">
                @csrf
                <label for="type">{{ __('site.contact_type_label', [], $loc) }}</label>
                <select id="type" name="type">
                    <option value="general"              {{ request('type','general') === 'general'              ? 'selected' : '' }}>{{ __('site.contact_type_general',    [], $loc) }}</option>
                    <option value="partenariat"          {{ request('type') === 'partenariat'                    ? 'selected' : '' }}>{{ __('site.contact_type_partner',    [], $loc) }}</option>
                    <option value="investissement"       {{ request('type') === 'investissement'                 ? 'selected' : '' }}>{{ __('site.contact_type_invest',     [], $loc) }}</option>
                    <option value="emploi"               {{ request('type') === 'emploi'                         ? 'selected' : '' }}>{{ __('site.contact_type_job',        [], $loc) }}</option>
                    <option value="fournisseur"          {{ request('type') === 'fournisseur'                    ? 'selected' : '' }}>{{ __('site.contact_type_supplier',   [], $loc) }}</option>
                    <option value="presse"               {{ request('type') === 'presse'                         ? 'selected' : '' }}>{{ __('site.contact_type_press',      [], $loc) }}</option>
                    <option value="communaute"           {{ request('type') === 'communaute'                     ? 'selected' : '' }}>{{ __('site.contact_type_community',  [], $loc) }}</option>
                    <option value="candidature-spontanee" {{ request('type') === 'candidature-spontanee'         ? 'selected' : '' }}>{{ __('site.contact_type_spontaneous',[], $loc) }}</option>
                </select>
                <label for="name">{{ __('site.contact_name_label', [], $loc) }}</label>
                <input id="name" name="name" required value="{{ old('name') }}">
                <label for="email">{{ __('site.contact_email_label', [], $loc) }}</label>
                <input id="email" type="email" name="email" required value="{{ old('email') }}">
                <label for="subject">{{ __('site.contact_subject_label', [], $loc) }}</label>
                <input id="subject" name="subject" value="{{ old('subject', request('subject')) }}">
                <label for="message">{{ __('site.contact_message_label', [], $loc) }}</label>
                <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                <button type="submit">{{ __('site.send_message', [], $loc) }}</button>
            </form>
        </section>

        {{-- ════════════════════════════════════════════════════════
             CONTACT PRESSE
        ═══════════════════════════════════════════════════════════ --}}
        @elseif($section === 'press-contact')
        <section>
            <div class="sub-nav">
                <a href="{{ $en ? route('english.news')         : route('news.index') }}">{{ __('site.subnav_news', [], $loc) }}</a>
                <a href="{{ $en ? route('english.press')        : route('press') }}">{{ __('site.subnav_press', [], $loc) }}</a>
                <a href="{{ $en ? route('english.gallery')      : route('gallery') }}">{{ __('site.subnav_gallery', [], $loc) }}</a>
                <a href="{{ $en ? route('english.reports')      : route('reports') }}">{{ __('site.subnav_reports', [], $loc) }}</a>
                <a href="{{ $en ? route('english.press.contact'): route('press.contact') }}" class="active">{{ __('site.subnav_press_contact', [], $loc) }}</a>
            </div>
            <p class="lead">{{ __('site.press_contact_lead', [], $loc) }}</p>
            <div class="pdg-block" style="margin-bottom:48px;">
                <div>
                    <div class="pdg-photo" style="height:280px; border-radius:6px; display:flex; align-items:center; justify-content:center; background:#5a2020;">
                        <span style="color:rgba(255,255,255,.35); font-size:13px; text-align:center;">{{ $en ? 'Photo coming soon' : 'Photo à venir' }}</span>
                    </div>
                </div>
                <div>
                    <div class="card-tag" style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.2em; text-transform:uppercase; margin-bottom:16px;">{{ __('site.press_contact_role_label', [], $loc) }}</div>
                    <h2 style="color:#fff; font-size:clamp(26px,3vw,40px); margin-bottom:8px;">{{ __('site.press_contact_name', [], $loc) }}</h2>
                    <div style="color:rgba(255,255,255,.7); font:13px Inter,sans-serif; margin-bottom:28px;">{{ __('site.press_contact_job', [], $loc) }}</div>
                    <ul style="list-style:none; display:flex; flex-direction:column; gap:14px;">
                        <li style="display:flex; gap:14px; align-items:center;">
                            <span style="font-size:20px;">📞</span>
                            <div>
                                <div style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; margin-bottom:3px;">{{ __('site.press_contact_phone_label', [], $loc) }}</div>
                                <span style="color:#fff; font:15px Inter,sans-serif;">+226 25 33 35 69</span>
                            </div>
                        </li>
                        <li style="display:flex; gap:14px; align-items:center;">
                            <span style="font-size:20px;">✉️</span>
                            <div>
                                <div style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; margin-bottom:3px;">{{ __('site.press_contact_email_label', [], $loc) }}</div>
                                <a href="mailto:presse@nere-mining.bf" style="color:#fff; font:15px Inter,sans-serif; text-decoration:underline;">presse@nere-mining.bf</a>
                            </div>
                        </li>
                        <li style="display:flex; gap:14px; align-items:center;">
                            <span style="font-size:20px;">🕐</span>
                            <div>
                                <div style="color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase; margin-bottom:3px;">{{ __('site.press_contact_hours_label', [], $loc) }}</div>
                                <span style="color:#fff; font:15px Inter,sans-serif;">{{ __('site.press_contact_hours', [], $loc) }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="sand">
            <h2>{{ __('site.press_contact_services_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.press_contact_services_lead', [], $loc) }}</p>
            <div class="grid-3">
                @foreach(range(1,6) as $i)
                <div class="card">
                    <div class="card-tag">{{ __('site.pc_svc'.$i.'_tag', [], $loc) }}</div>
                    <h3>{{ __('site.pc_svc'.$i.'_h3', [], $loc) }}</h3>
                    <p>{{ __('site.pc_svc'.$i.'_p', [], $loc) }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <section>
            <h2>{{ __('site.press_contact_form_h2', [], $loc) }}</h2>
            <p class="lead">{{ __('site.press_contact_form_lead', [], $loc) }}</p>
            <form method="POST" action="{{ $en ? route('english.contact.store') : route('contact.store') }}">
                @csrf
                <input type="hidden" name="type" value="presse">
                <label for="press-name">{{ __('site.contact_name_label', [], $loc) }}</label>
                <input id="press-name" name="name" required value="{{ old('name') }}">
                <label for="press-email">{{ __('site.pc_email_professional', [], $loc) }}</label>
                <input id="press-email" type="email" name="email" required value="{{ old('email') }}">
                <label for="press-subject">{{ __('site.press_contact_field_media', [], $loc) }}</label>
                <input id="press-subject" name="subject" placeholder="{{ __('site.press_contact_media_placeholder', [], $loc) }}" value="{{ old('subject') }}">
                <label for="press-message">{{ __('site.contact_message_label', [], $loc) }}</label>
                <textarea id="press-message" name="message" placeholder="{{ __('site.press_contact_request_placeholder', [], $loc) }}" required>{{ old('message') }}</textarea>
                <button type="submit">{{ __('site.send_request', [], $loc) }}</button>
            </form>
        </section>
        @endif

    </main>

    <footer>
        <span>{{ str_replace(':year', date('Y'), __('site.footer_copy', [], $loc)) }}</span>
        <div class="footer-links">
            <a href="{{ $en ? route('english.company') : route('company') }}">{{ __('site.nav_company', [], $loc) }}</a>
            <a href="{{ $en ? route('english.karma')   : route('karma') }}">{{ __('site.nav_karma', [], $loc) }}</a>
            <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ $en ? 'ESG' : 'RSE' }}</a>
            <a href="{{ $en ? route('english.contact') : route('contact') }}">{{ __('site.nav_contact', [], $loc) }}</a>
            <a href="{{ $en ? url('/') : route('english') }}">{{ __('site.lang_switch', [], $loc) }}</a>
        </div>
        <span>{{ __('site.footer_tagline', [], $loc) }}</span>
    </footer>
</body>
</html>
