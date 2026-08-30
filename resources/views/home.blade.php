@php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';
    $slides = $slides ?? collect();
    $heroImages = $slides->isNotEmpty()
        ? $slides->map(fn($slide) => [
            'type'      => $slide->type ?? 'image',
            'url'       => $slide->url ?? '',
            'embed_url' => $slide->embed_url ?? null,
            'title'     => $slide->title ?? '',
            'caption'   => $slide->caption ?? null,
        ])->filter()->values()->all()
        : collect(range(1, 5))->map(fn($i) => [
            'type'      => 'image',
            'url'       => asset('images/mining/karma-0'.$i.'.jpg'),
            'embed_url' => null,
            'title'     => "Karma 0{$i}",
            'caption'   => null,
        ])->all();
    $heroDuration = count($heroImages) * 5;
    $heroSlot = 100 / max(count($heroImages), 1);
@endphp
<!DOCTYPE html>
<html lang="{{ $loc }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Néré Mining — {{ $en ? 'Gold with lasting value' : "L'or d'une valeur durable" }}</title>
    <meta name="description" content="{{ $en
        ? 'Néré Mining, Burkinabe gold mining group committed to responsible mining at Karma.'
        : 'Néré Mining, groupe aurifère burkinabè engagé pour une mine responsable à Karma.' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink:   #281d18;
            --green: #4b1716;
            --red:   #d72f2f;
            --gold:  #ffc247;
            --gold2: #e5a72f;
            --sand:  #fff4dc;
            --muted: #70645c;
            --line:  #eadcc5;
            --light: #fbfaf7;
        }
        *,*::before,*::after { box-sizing:border-box; margin:0; padding:0; }
        html { scroll-behavior:smooth; font-size: 17px; }
        body { color:var(--ink); background-color:var(--light); background-image:linear-gradient(115deg,rgba(255,194,71,.045),transparent 38%,rgba(75,23,22,.03)),repeating-linear-gradient(135deg,rgba(75,23,22,.025) 0,rgba(75,23,22,.025) 1px,transparent 1px,transparent 46px); background-size:180% 180%,46px 46px; animation:siteAtmosphere 42s ease-in-out infinite alternate; font-family:'Inter',Arial,sans-serif; line-height:1.6; font-size:1rem; }
        @keyframes siteAtmosphere { from { background-position:0% 0%,0 0; } to { background-position:100% 100%,23px 23px; } }
        .sec:not(.hero) { animation:contentRise .8s ease-out both; }
        @keyframes contentRise { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        @media (prefers-reduced-motion: reduce) { body, .sec:not(.hero) { animation:none; } }
        a { color:inherit; text-decoration:none; }
        img { display:block; max-width:100%; }

        /* ── Topbar ─────────────────────────────── */
        .topbar {
            background:var(--red); color:#fff7e8;
            padding:9px 5vw; display:flex; justify-content:space-between;
            font:500 11px Inter,sans-serif; letter-spacing:.06em; text-transform:uppercase;
        }

        /* ── Header / nav ────────────────────────── */
        header {
            position:absolute; z-index:200;
            left:0; right:0; top:0;
            padding:40px 5vw 38px;
            display:flex; align-items:center; justify-content:space-between;
            transition:background .28s, padding .28s, box-shadow .28s;
        }
        header.stuck {
            position:fixed;
            background:var(--green);
            padding:28px 5vw;
            box-shadow:0 2px 14px rgba(0,0,0,.28);
        }
        .logo { display:block; width:450px; max-width:45vw; }
        .logo img { width:100%; height:auto; display:block; }
        nav { display:flex; gap:8px; align-items:center; }
        .nav-link {
            color:rgba(255,255,255,.88);
            font:500 13px Inter,sans-serif; text-transform:uppercase; letter-spacing:.07em;
            padding:12px 16px; border-radius:4px;
            transition:background .18s, color .18s; white-space:nowrap;
        }
        .nav-link:hover { background:rgba(255,255,255,.14); color:#fff; }
        .nav-dropdown { position:relative; }
        .nav-dropdown > .nav-link::after { content:' ▾'; font-size:10px; }
        .dropdown-menu {
            display:none; position:absolute; top:100%; left:0;
            background:#fff; border:1px solid var(--line); border-radius:6px;
            min-width:240px; box-shadow:0 8px 28px rgba(0,0,0,.14); z-index:300; padding:6px 0;
        }
        .nav-dropdown.is-open .dropdown-menu { display:block; opacity:1; transform:translateY(0); pointer-events:auto; }
        .dropdown-menu a {
            display:block; padding:10px 18px;
            font:500 12px Inter,sans-serif; color:var(--green); transition:background .15s;
        }
        .dropdown-menu a:hover { background:var(--sand); }
        .nav-lang { margin-left:10px; border:1px solid rgba(255,255,255,.3); border-radius:4px; }
        .menu-btn {
            display:none; background:none; border:1px solid rgba(255,255,255,.4); color:#fff;
            padding:8px 14px; font:600 11px Inter,sans-serif; letter-spacing:.08em;
            border-radius:4px; cursor:pointer; position:relative; z-index:260;
        }

        /* ── HERO ────────────────────────────────── */
        .hero {
            position:relative; min-height:62vh;
            display:flex; align-items:flex-end;
            padding-top:120px;
            overflow:hidden; color:#fff;
        }
        /* Slideshow */
        .hero-bg { position:absolute; inset:0; z-index:0; background:#1a0505; }
        .hero-slide {
            position:absolute; inset:0;
            background-size:cover; background-position:center;
            opacity:0; transform:scale(1.07);
            will-change:opacity,transform;
        }
        /* Slide vidéo — iframe en fond plein écran */
        .hero-slide-video {
            position:absolute; inset:0;
            opacity:0;
            pointer-events:none;
            will-change:opacity;
        }
        .hero-slide-video iframe {
            position:absolute;
            top:50%; left:50%;
            width:177.78vh; /* 16:9 ratio */
            height:100vh;
            min-width:100%;
            min-height:56.25vw;
            transform:translate(-50%,-50%);
            border:0;
            pointer-events:none;
        }
        @foreach($heroImages as $index => $heroImage)
        @php $bgUrl = is_array($heroImage) ? ($heroImage['url'] ?? '') : $heroImage; @endphp
        .hero-slide:nth-child({{ $index + 1 }}) { background-image:url('{{ $bgUrl }}'); animation:heroSlide{{ $index }} {{ $heroDuration }}s infinite; }
        .hero-slide-video:nth-child({{ $index + 1 }}) { animation:heroSlide{{ $index }} {{ $heroDuration }}s infinite; }
        @keyframes heroSlide{{ $index }} {
            0%,{{ max(0, $index * $heroSlot - 2) }}% { opacity:0; transform:scale(1.07); }
            {{ min(100, $index * $heroSlot + 2) }}%,{{ min(100, ($index + 1) * $heroSlot - 2) }}% { opacity:1; transform:scale(1.01); }
            {{ min(100, ($index + 1) * $heroSlot) }}%,100% { opacity:0; transform:scale(1); }
        }
        @endforeach
        /* Overlays */
        .hero-ov {
            position:absolute; inset:0; z-index:1;
            background:
                linear-gradient(to right, rgba(18,4,4,.85) 0%, rgba(18,4,4,.48) 55%, rgba(18,4,4,.18) 100%),
                linear-gradient(to top,   rgba(18,4,4,.72) 0%, transparent 50%);
        }
        .hero-accent {
            position:absolute; bottom:0; left:0; right:0; height:4px; z-index:3;
            background:linear-gradient(to right, var(--gold), var(--gold2) 60%, transparent 100%);
        }
        /* Content grid */
        .hero-body {
            position:relative; z-index:2; width:100%;
            padding:0 5vw 96px;
            display:grid; grid-template-columns:1fr 1fr; gap:7vw; align-items:end;
        }
        /* Left */
        .hero-eyebrow {
            display:inline-flex; align-items:center; gap:10px;
            color:var(--gold); font:700 11px Inter,sans-serif; letter-spacing:.26em;
            text-transform:uppercase; margin-bottom:22px;
        }
        .hero-eyebrow::before {
            content:''; display:block; width:30px; height:2px;
            background:var(--gold); flex-shrink:0;
        }
        .hero-h1 {
            font-size:clamp(42px,5vw,76px); font-weight:300;
            line-height:.96; letter-spacing:-.03em;
            color:#fff; margin-bottom:20px;
        }
        .hero-h1 strong { font-weight:600; }
        .hero-intro {
            color:rgba(255,255,255,.82); font-size:19px; line-height:1.7;
            max-width:560px; margin-bottom:40px;
        }
        .hero-ctas { display:flex; gap:14px; flex-wrap:wrap; }
        /* Right — stat tiles */
        .hero-stats {
            display:grid; grid-template-columns:1fr 1fr; gap:14px; align-self:end;
        }
        .hero-stat {
            background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.14);
            border-radius:9px; padding:24px 20px;
            backdrop-filter:blur(8px); -webkit-backdrop-filter:blur(8px);
        }
        .hero-stat-val {
            display:block; font-size:34px; font-weight:300;
            color:var(--gold); line-height:1; margin-bottom:8px;
        }
        .hero-stat-lbl { font:500 12px Inter,sans-serif; color:rgba(255,255,255,.65); line-height:1.4; }
        /* Scroll hint */
        .hero-scroll {
            position:absolute; bottom:26px; left:50%; transform:translateX(-50%); z-index:3;
            display:flex; flex-direction:column; align-items:center; gap:7px;
            color:rgba(255,255,255,.4); font:500 10px Inter,sans-serif; letter-spacing:.15em; text-transform:uppercase;
        }
        .hero-scroll-line {
            width:1px; height:38px;
            background:linear-gradient(to bottom, rgba(255,255,255,.5), transparent);
            animation:scrollPulse 1.9s ease-in-out infinite;
        }
        @keyframes scrollPulse {
            0%,100% { opacity:.5; transform:scaleY(1); }
            50%      { opacity:1;  transform:scaleY(1.5); }
        }

        /* ── Buttons ─────────────────────────────── */
        .btn {
            display:inline-flex; align-items:center; justify-content:center;
            min-height:44px; min-width:44px; padding:14px 26px;
            font:600 11px Inter,sans-serif; text-transform:uppercase; letter-spacing:.12em;
            border-radius:4px; transition:all .2s; cursor:pointer; white-space:nowrap;
        }
        .btn-gold  { background:var(--gold); color:var(--ink); }
        .btn-gold:hover  { background:var(--gold2); transform:translateY(-2px); box-shadow:0 6px 20px rgba(255,194,71,.32); }
        .btn-ghost { border:1px solid rgba(255,255,255,.4); color:#fff; }
        .btn-ghost:hover { background:rgba(255,255,255,.1); border-color:rgba(255,255,255,.7); }
        .btn-dark  { background:var(--green); color:#fff; }
        .btn-dark:hover  { background:#3a100f; transform:translateY(-1px); }
        .btn-outline { border:1px solid var(--gold2); color:var(--gold2); }
        .btn-outline:hover { background:var(--gold2); color:#fff; }

        /* ── Section shared ──────────────────────── */
        .sec { padding:96px 5vw; }
        .sec-tag {
            display:inline-flex; align-items:center; gap:12px;
            color:var(--gold2); font:700 12px Inter,sans-serif;
            letter-spacing:.22em; text-transform:uppercase; margin-bottom:16px;
            font-size:0.78rem;
            line-height:1.2;
        }
        .sec-tag::before { content:''; display:block; width:28px; height:2px; background:var(--gold2); box-shadow:0 0 0 1px rgba(229,167,47,.15); }
        .sec-h2 {
            color:var(--green); font-size:clamp(30px,3.6vw,52px);
            font-weight:400; line-height:1.04; margin-bottom:18px;
        }
        .sec-lead {
            color:var(--muted); font-size:1.2rem; line-height:1.75;
            max-width:660px; margin:0 auto; text-align:center;
        }

        /* ── INTRO COMPANY ──────────────────────── */
        .intro-sec {
            background:linear-gradient(180deg, rgba(255,255,255,0.85), rgba(250,244,234,0.9));
            border-top:1px solid var(--line);
            border-bottom:1px solid var(--line);
        }
        .intro-inner {
            max-width:1180px; margin:0 auto; display:grid;
            grid-template-columns:1.2fr .8fr; gap:34px; align-items:center;
        }
        .intro-copy {
            background:#fff; border:1px solid var(--line); border-radius:16px;
            padding:30px 28px; box-shadow:0 10px 28px rgba(40,29,24,.04);
            text-align:center;
        }
        .intro-brand {
            display:flex; justify-content:center; align-items:center;
            margin-bottom:18px;
        }
        .intro-brand img {
            display:block;
            width:min(240px, 62%);
            height:auto;
            filter: drop-shadow(0 8px 18px rgba(75,23,22,.08));
        }
        .intro-copy .sec-h2 {
            margin-bottom:14px;
            font-size:clamp(2.8rem,4vw,4.7rem);
            line-height:1.02;
            letter-spacing:-0.05em;
            text-align:center;
        }
        .intro-points {
            display:grid; gap:14px;
        }
        .intro-point {
            background:rgba(255,255,255,.72); border:1px solid var(--line);
            border-radius:12px; padding:18px 20px; display:flex; align-items:flex-start; gap:12px;
            box-shadow:0 8px 18px rgba(40,29,24,.03);
        }
        .intro-point::before {
            content:'•'; font-size:24px; line-height:1; color:var(--gold2);
            margin-top:2px;
        }
        .intro-point span {
            color:var(--muted); font-size:1.02rem; line-height:1.7;
            text-align:left;
        }

        /* ── STATS SECTION ───────────────────────── */
        .stats-sec { background:var(--green); position:relative; overflow:hidden; }
        .stats-sec::before {
            content:''; position:absolute; inset:0; pointer-events:none;
            background:
                radial-gradient(circle at 18% 55%, rgba(255,194,71,.07) 0%, transparent 48%),
                radial-gradient(circle at 82% 15%, rgba(255,194,71,.04) 0%, transparent 38%);
        }
        .stats-inner {
            position:relative; z-index:1;
            display:grid; grid-template-columns:1fr 2fr; gap:80px; align-items:center;
        }
        .stats-left .sec-tag  { color:var(--gold); }
        .stats-left .sec-tag::before { background:var(--gold); }
        .stats-left .sec-h2   { color:#fff; }
        .stats-left .sec-lead { color:rgba(255,255,255,.6); max-width:380px; }
        .stats-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:16px; }
        .stat-card {
            background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.1);
            border-radius:10px; padding:36px 28px;
            position:relative; overflow:hidden;
            transition:background .25s, transform .25s;
        }
        .stat-card::before {
            content:''; position:absolute; inset:0 auto 0 0;
            width:3px; background:var(--gold); opacity:0; transition:opacity .25s;
        }
        .stat-card:hover { background:rgba(255,255,255,.09); transform:translateY(-4px); }
        .stat-card:hover::before { opacity:1; }
        .stat-num {
            display:block; font-size:clamp(38px,4vw,56px); font-weight:300;
            color:var(--gold); line-height:1; margin-bottom:12px;
        }
        .stat-lbl { font:500 13px Inter,sans-serif; color:rgba(255,255,255,.62); line-height:1.45; }

        /* ── QUICK LINKS ─────────────────────────── */
        .ql-sec { background:var(--light); }
        .ql-head {
            display:flex; justify-content:space-between; align-items:flex-end;
            margin-bottom:48px; gap:24px; flex-wrap:wrap;
        }
        .ql-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
        .ql-card {
            display:flex; flex-direction:column;
            background:#fff; border:1px solid var(--line); border-radius:10px;
            padding:30px 26px;
            position:relative; overflow:hidden;
            transition:border-color .2s, box-shadow .2s, transform .2s;
        }
        .ql-card::after {
            content:''; position:absolute; inset:0 0 auto 0; height:3px;
            background:linear-gradient(to right, var(--gold), var(--gold2));
            transform:scaleX(0); transform-origin:left; transition:transform .3s;
        }
        .ql-card:hover { border-color:var(--gold); box-shadow:0 12px 36px rgba(75,23,22,.08); transform:translateY(-4px); }
        .ql-card:hover::after { transform:scaleX(1); }
        .ql-num { font:700 11px Inter,sans-serif; letter-spacing:.18em; color:var(--gold2); margin-bottom:16px; }
        .ql-card h3 { font-size:1.2rem; font-weight:600; color:var(--green); margin-bottom:10px; }
        .ql-card p  { font-size:1rem; color:var(--muted); line-height:1.65; flex:1; margin-bottom:24px; }
        .ql-arrow {
            display:inline-flex; align-items:center; gap:7px;
            font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase;
            color:var(--red); margin-top:auto;
        }
        .ql-arr { display:inline-block; transition:transform .2s; }
        .ql-card:hover .ql-arr { transform:translateX(5px); }

        /* ── NEWS ────────────────────────────────── */
        .news-sec { background:#fff; border-top:1px solid var(--line); }
        .news-head {
            display:flex; justify-content:center; align-items:flex-end;
            margin-bottom:44px; gap:24px; flex-wrap:wrap;
            text-align:center;
            position:relative;
        }
        .news-head > div {
            display:flex; flex-direction:column; align-items:center;
            text-align:center;
        }
        .news-head .sec-tag {
            margin-bottom:10px;
        }
        .news-head .sec-h2 {
            margin:0;
            font-weight:500;
            letter-spacing:-.04em;
            position:relative;
            display:inline-block;
            padding-bottom:8px;
        }
        .news-head .sec-h2::after {
            content:'';
            position:absolute;
            left:50%; transform:translateX(-50%);
            bottom:0;
            width:90px; height:3px; border-radius:999px;
            background:linear-gradient(90deg, transparent, var(--gold2), transparent);
        }
        .news-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
        .news-sec .btn-dark {
            margin-top:18px;
            align-self:flex-end;
        }
        /* Featured first card */
        .news-grid .news-card:first-child { grid-column:span 2; }
        .news-card {
            display:flex; flex-direction:column;
            background:var(--light); border:1px solid var(--line); border-radius:10px;
            overflow:hidden; transition:transform .25s, box-shadow .25s;
        }
        .news-card:hover { transform:translateY(-5px); box-shadow:0 14px 32px rgba(0,0,0,.07); }
        .news-img { width:100%; height:210px; object-fit:cover; }
        .news-grid .news-card:first-child .news-img { height:275px; }
        .news-img-ph {
            width:100%; height:210px;
            background:linear-gradient(135deg, var(--green) 0%, #7a2a29 100%);
            display:flex; align-items:center; justify-content:center;
            font:700 38px Inter,sans-serif; color:rgba(255,255,255,.2); letter-spacing:.1em;
        }
        .news-grid .news-card:first-child .news-img-ph { height:275px; }
        .news-body { padding:22px 24px 26px; display:flex; flex-direction:column; flex:1; }
        .news-meta {
            font:600 11px Inter,sans-serif; letter-spacing:.1em; text-transform:uppercase;
            color:var(--gold2); margin-bottom:9px;
        }
        .news-card h3 {
            font-size:18px; font-weight:500; color:var(--green); line-height:1.35;
            margin-bottom:14px;
        }
        .news-grid .news-card:first-child h3 { font-size:21px; }
        .news-read {
            margin-top:auto; font:600 11px Inter,sans-serif; letter-spacing:.1em;
            text-transform:uppercase; color:var(--red);
            display:inline-flex; align-items:center; gap:6px;
        }
        .news-read-arr { display:inline-block; transition:transform .2s; }
        .news-card:hover .news-read-arr { transform:translateX(4px); }
        .news-empty { grid-column:span 3; text-align:center; padding:60px 0; color:var(--muted); font-size:15px; }

        /* ── PARTNERS ────────────────────────────── */
        .partners-sec { background:var(--sand); border-top:1px solid var(--line); }
        .partners-head { text-align:center; margin-bottom:54px; }
        .partners-head .sec-tag { justify-content:center; }
        .partners-head .sec-h2 { text-align:center; }
        .partners-head .sec-lead { margin:14px auto 0; text-align:center; }
        /* Logo strip — scrolls horizontally on mobile */
        .partners-strip {
            display:flex; align-items:center; justify-content:center;
            gap:0; flex-wrap:wrap;
            border:1px solid var(--line); border-radius:12px;
            background:#fff; overflow:hidden;
        }
        .partner-logo-item {
            flex:1 1 160px; max-width:220px;
            display:flex; flex-direction:column; align-items:center; justify-content:center;
            gap:10px; padding:28px 20px;
            border-right:1px solid var(--line);
            text-align:center;
            transition:background .2s;
        }
        .partner-logo-item:last-child { border-right:0; }
        .partner-logo-item:hover { background:var(--sand); }
        .partner-logo-img {
            width:auto; max-width:120px; height:56px;
            object-fit:contain; display:block;
            filter:grayscale(20%); transition:filter .25s;
        }
        .partner-logo-item:hover .partner-logo-img { filter:grayscale(0%); }
        .partner-logo-name {
            font:600 11px Inter,sans-serif; color:var(--green);
            line-height:1.35; letter-spacing:.01em;
        }
        .partner-logo-cat {
            font:500 10px Inter,sans-serif; color:var(--muted);
            text-transform:uppercase; letter-spacing:.06em;
        }
        /* DB-driven grid (when partners exist in database) */
        .partners-grid {
            display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:16px;
        }
        .partner-card {
            background:#fff; border:1px solid var(--line); border-radius:10px;
            padding:24px 18px;
            display:flex; flex-direction:column; align-items:center; gap:10px; text-align:center;
            transition:border-color .2s, box-shadow .2s, transform .2s;
        }
        .partner-card:hover { border-color:var(--gold); box-shadow:0 8px 24px rgba(75,23,22,.07); transform:translateY(-3px); }
        .partner-card img { width:auto; max-width:100px; height:48px; object-fit:contain; }
        .partner-name { font:600 12px Inter,sans-serif; color:var(--green); line-height:1.35; }
        .partner-cat  { font:500 10px Inter,sans-serif; letter-spacing:.07em; text-transform:uppercase; color:var(--muted); }

        /* ── CTA BAND ────────────────────────────── */
        .cta-sec {
            background:var(--green); position:relative; overflow:hidden;
            display:grid; grid-template-columns:1fr auto; gap:60px; align-items:center;
        }
        .cta-sec::after {
            content:''; position:absolute; right:-60px; top:-80px;
            width:350px; height:350px; border-radius:50%;
            background:rgba(255,194,71,.05); pointer-events:none;
        }
        .cta-sec .sec-tag  { color:var(--gold); }
        .cta-sec .sec-tag::before { background:var(--gold); }
        .cta-sec .sec-h2   { color:#fff; margin-bottom:12px; }
        .cta-sec .sec-lead { color:rgba(255,255,255,.62); }

        /* ── Footer ──────────────────────────────── */
        footer {
            padding:32px 5vw; background:#1e0909;
            color:rgba(234,220,202,.6);
            display:flex; justify-content:space-between; align-items:center; gap:16px;
            font:12px Inter,sans-serif;
        }
        .footer-links { display:flex; gap:20px; flex-wrap:wrap; }
        .footer-links a:hover { color:var(--gold); }

        /* ── Responsive ──────────────────────────── */
        @media(max-width:1100px) {
            .hero-body    { grid-template-columns:1fr; }
            .hero-stats   { grid-template-columns:repeat(4,1fr); align-self:auto; }
            .stats-inner  { grid-template-columns:1fr; gap:50px; }
            .stats-grid   { grid-template-columns:repeat(4,1fr); }
        }
        @media(max-width:900px) {
            .topbar { display:none; }
            header  {
                position:fixed; background:var(--green); padding:14px 5vw; box-shadow:0 2px 10px rgba(0,0,0,.25);
                z-index:260; overflow:visible;
            }
            .logo   { width:min(44vw, 260px); }
            nav     { display:none; }
            .menu-btn {
                display:block; min-height:44px; min-width:44px; z-index:300; position:relative;
                pointer-events:auto;
            }
            nav.open {
                display:flex; flex-direction:column; align-items:flex-start;
                position:absolute; top:100%; left:0; right:0;
                background:var(--green); padding:12px 5vw 24px; gap:6px;
                border-top:1px solid rgba(255,255,255,.1);
                max-height:70vh; overflow-y:auto; z-index:290;
            }
            nav.open .nav-link,
            nav.open .nav-lang {
                width:100%; justify-content:flex-start; padding:14px 16px;
            }
            .nav-dropdown .dropdown-menu { position:static; box-shadow:none; border:0; padding:0 0 0 16px; background:none; }
            .nav-dropdown .dropdown-menu a {
                color:rgba(255,255,255,.8);
                min-height:42px; display:flex; align-items:center;
            }
            .hero { min-height:100svh; }
            .hero-body { padding-bottom:64px; }
            .hero-stats { grid-template-columns:repeat(2,1fr); }
            .stats-grid { grid-template-columns:repeat(2,1fr); }
            .ql-grid    { grid-template-columns:1fr 1fr; }
            .news-grid  { grid-template-columns:1fr; }
            .news-grid .news-card:first-child { grid-column:span 1; }
            .cta-sec    { grid-template-columns:1fr; gap:32px; }
            footer      { flex-direction:column; text-align:center; }
        }
        @media(max-width:600px) {
            .logo           { width:min(45vw, 210px); }
            .ql-grid        { grid-template-columns:1fr; }
            .partners-grid  { grid-template-columns:1fr 1fr; }
            .hero-stats     { grid-template-columns:1fr 1fr; }
            .btn            { width:100%; }
            .hero-ctas      { flex-direction:column; }
        }
    </style>
</head>
<body>

    @include('partials._nav', ['locale' => $loc, 'section' => 'home'])

    <main>

    {{-- ════════════════════════════════════════
         1 · SLOGAN — HERO
    ════════════════════════════════════════ --}}
    <section class="hero" aria-label="{{ $en ? 'Homepage hero' : 'Bannière principale' }}">

        {{-- Slideshow — images ET vidéos --}}
        <div class="hero-bg" aria-hidden="true">
            @foreach($heroImages as $index => $heroImage)
                @if(is_array($heroImage) && ($heroImage['type'] ?? 'image') === 'video')
                    {{-- Slide vidéo (YouTube / Vimeo) --}}
                    <div class="hero-slide-video" style="background-image:url('{{ $heroImage['url'] ?? '' }}'); background-size:cover; background-position:center;">
                        @if($heroImage['embed_url'])
                        <iframe
                            src="{{ $heroImage['embed_url'] }}"
                            allow="autoplay; encrypted-media"
                            title="{{ $heroImage['title'] ?? 'Hero video' }}"
                            loading="lazy">
                        </iframe>
                        @endif
                        @if($heroImage['url'])
                        <div style="position:absolute; inset:0; background:url('{{ $heroImage['url'] }}') center/cover; z-index:-1;"></div>
                        @endif
                    </div>
                @else
                    {{-- Slide image classique --}}
                    <div class="hero-slide" style="background-image:url('{{ $heroImage['url'] ?? ($heroImage['image'] ?? '') }}'); background-size:cover; background-position:center;"></div>
                @endif
            @endforeach
        </div>
        <div class="hero-ov" aria-hidden="true"></div>
        <div class="hero-accent" aria-hidden="true"></div>

        <div class="hero-body">

            {{-- Slogan + CTA --}}
            <div>
                <h1 class="hero-h1">{!! nl2br(e(__('site.home_h1', [], $loc))) !!}</h1>
                <p class="hero-intro">{{ __('site.home_intro', [], $loc) }}</p>
                <div class="hero-ctas">
                    <a class="btn btn-gold"
                       href="{{ $en ? route('english.karma') : route('karma') }}">
                        {{ __('site.home_cta_karma', [], $loc) }}
                    </a>
                    <a class="btn btn-ghost"
                       href="{{ $en ? route('english.sustainability') : route('sustainability') }}">
                        {{ __('site.home_cta_rse', [], $loc) }}
                    </a>
                </div>
            </div>

            {{-- Mini chiffres clés dans le hero --}}
            <div class="hero-stats" aria-label="{{ $en ? 'Key figures' : 'Chiffres clés' }}">
                @foreach($stats as $stat)
                <div class="hero-stat">
                    <span class="hero-stat-val"
                          data-target="{{ preg_replace('/[^0-9]/', '', $stat['value']) }}"
                          data-suffix="{{ $stat['suffix'] ?? '' }}">—</span>
                    <span class="hero-stat-lbl">{{ $stat['label'] }}</span>
                </div>
                @endforeach
            </div>

        </div>

    </section>

    {{-- ════════════════════════════════════════
         2 · NÉRÉ MINING
    ════════════════════════════════════════ --}}
    <section class="sec intro-sec" aria-labelledby="intro-nere-h">
        <div class="intro-inner">
            <div class="intro-copy">
                <div class="intro-brand">
                    <img src="{{ asset('images/logo-nere.png') }}" alt="Néré Mining" loading="eager">
                </div>
                <h2 class="sec-h2" id="intro-nere-h">Une filière aurifère durable, ancrée dans le développement local.</h2>
                <p class="sec-lead">
                    Néré Mining conçoit l’extraction de l’or comme une activité créatrice de valeur durable : performance industrielle, respect de l’environnement, sécurité des opérations et inclusion des communautés autour de nos sites.
                </p>
            </div>
            <div class="intro-points">
                <div class="intro-point"><span>Nous développons une mine responsable, avec des standards de sécurité et de qualité élevés.</span></div>
                <div class="intro-point"><span>Nous créons de la valeur pour les populations locales en favorisant l’emploi, les partenariats et la transparence.</span></div>
                <div class="intro-point"><span>Nous accompagnons une croissance minière tournée vers le long terme, la sobriété environnementale et la confiance.</span></div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════
         3 · DERNIÈRES ACTUALITÉS
    ════════════════════════════════════════ --}}
    <section class="sec news-sec" id="actualites" aria-labelledby="news-h">
        <div class="news-head">
            <div>
                <span class="sec-tag">Actualités</span>
                <h2 class="sec-h2" id="news-h">Actualités</h2>
            </div>
        </div>
        <div class="news-grid">
            @forelse($news as $i => $item)
            <article class="news-card">
                @if(!empty($item['image']) && !str_contains((string)$item['image'], 'null'))
                    <img class="news-img"
                         src="{{ $item['image'] }}"
                         alt="{{ e($item['title']) }}"
                         loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
                @else
                    <div class="news-img-ph" aria-hidden="true">NM</div>
                @endif
                <div class="news-body">
                    <div class="news-meta">{{ $item['category'] }} · {{ $item['date'] }}</div>
                    <h3>{{ $item['title'] }}</h3>
                    <span class="news-read">
                        {{ __('site.read_more', [], $loc) }}
                        <span class="news-read-arr">→</span>
                    </span>
                </div>
            </article>
            @empty
            <div class="news-empty">{{ __('site.news_empty', [], $loc) }}</div>
            @endforelse
        </div>
        <div style="display:flex; justify-content:center; margin-top:32px;">
            <a class="btn btn-dark"
               href="{{ $en ? route('english.news') : route('news.index') }}">
                {{ __('site.all_news', [], $loc) }}
            </a>
        </div>
    </section>

    {{-- ════════════════════════════════════════
         5 · PARTENAIRES INSTITUTIONNELS
    ════════════════════════════════════════ --}}
    <section class="sec partners-sec" id="partenaires" aria-labelledby="partners-h">
        <div class="partners-head">
            <span class="sec-tag">{{ __('site.home_partners_label', [], $loc) }}</span>
            <h2 class="sec-h2" id="partners-h">{{ __('site.home_partners_h2', [], $loc) }}</h2>
            <p class="sec-lead">{{ __('site.home_partners_intro', [], $loc) }}</p>
        </div>

        @if($partners->isNotEmpty())
        {{-- Partenaires gérés en base --}}
        <div class="partners-grid">
            @foreach($partners as $p)
            @php $tag = $p->website_url ? 'a' : 'div'; $attrs = $p->website_url ? 'href="'.e($p->website_url).'" target="_blank" rel="noopener noreferrer"' : ''; @endphp
            <{{ $tag }} {{ $attrs }} class="partner-card">
                @if($p->logo_path)
                    @php
                        // Logos statiques dans public/images/ → asset() direct
                        // Logos uploadés via admin → dans public/uploads/
                        $logoUrl = str_starts_with($p->logo_path, 'images/')
                            ? asset($p->logo_path)
                            : \App\Helpers\StorageHelper::uploadUrl($p->logo_path);
                    @endphp
                    <img class="partner-logo-img"
                         src="{{ $logoUrl }}"
                         alt="{{ $p->name }}"
                         loading="lazy"
                         width="120" height="56">
                @else
                    <div style="width:80px;height:40px;background:var(--sand);border-radius:4px;display:flex;align-items:center;justify-content:center;font:700 13px Inter;color:var(--green);">
                        {{ strtoupper(substr($p->name,0,3)) }}
                    </div>
                @endif
                <span class="partner-name">{{ $p->name }}</span>
                @if($p->category) <span class="partner-cat">{{ $p->category }}</span> @endif
            </{{ $tag }}>
            @endforeach
        </div>

        @else
        {{-- ── Partenaires institutionnels par défaut — bande logo ── --}}
        @php
            $defaultPartners = [
                [
                    'img'  => asset('images/partners/burkina-armoiries.svg'),
                    'name' => $en ? 'Government of Burkina Faso' : 'État burkinabè',
                    'cat'  => $en ? 'State · Mining Ministry' : 'Ministère des Mines',
                    'url'  => null,
                ],
                [
                    'img'  => asset('images/partners/itie-bf.svg'),
                    'name' => $en ? 'EITI Burkina Faso' : 'ITIE Burkina Faso',
                    'cat'  => $en ? 'Transparency Framework' : 'Transparence fiscale',
                    'url'  => 'https://itie.bf',
                ],
                [
                    'img'  => asset('images/partners/onaser.svg'),
                    'name' => 'ONASER',
                    'cat'  => $en ? 'Road Safety Office' : 'Office National de la Sécurité Routière',
                    'url'  => null,
                ],
                [
                    'img'  => asset('images/partners/enahm.svg'),
                    'name' => 'ENAHM',
                    'cat'  => $en ? 'Technical School' : 'École Nationale des Hauts Métiers',
                    'url'  => null,
                ],
                [
                    'img'  => asset('images/partners/canada.svg'),
                    'name' => $en ? 'Government of Canada' : 'Canada',
                    'cat'  => $en ? 'Development partner' : 'Partenaire au développement',
                    'url'  => 'https://www.canada.ca',
                ],
                [
                    'img'  => asset('images/partners/cnrst.svg'),
                    'name' => 'CNRST',
                    'cat'  => $en ? 'National Research Centre' : 'Centre National de Recherche',
                    'url'  => null,
                ],
            ];
        @endphp
        <div class="partners-strip" role="list">
            @foreach($defaultPartners as $p)
            @php $tag = $p['url'] ? 'a' : 'div'; $href = $p['url'] ? 'href="'.e($p['url']).'" target="_blank" rel="noopener noreferrer"' : ''; @endphp
            <{{ $tag }} {{ $href }} class="partner-logo-item" role="listitem">
                <img class="partner-logo-img"
                     src="{{ $p['img'] }}"
                     alt="{{ $p['name'] }}"
                     loading="lazy"
                     width="120" height="56">
                <span class="partner-logo-name">{{ $p['name'] }}</span>
                <span class="partner-logo-cat">{{ $p['cat'] }}</span>
            </{{ $tag }}>
            @endforeach
        </div>
        @endif
    </section>

    {{-- ════════════════════════════════════════
         CONTACT CTA
    ════════════════════════════════════════ --}}
    <section class="sec cta-sec">
        <div>
            <span class="sec-tag">{{ $en ? 'Get in touch' : 'Échangeons' }}</span>
            <h2 class="sec-h2">{{ __('site.home_cta_h2', [], $loc) }}</h2>
            <p class="sec-lead">{{ __('site.home_cta_p', [], $loc) }}</p>
        </div>
        <div>
            <a class="btn btn-gold"
               href="{{ $en ? route('english.contact') : route('contact') }}">
                {{ __('site.contact_us', [], $loc) }}
            </a>
        </div>
    </section>

    </main>

    <footer style="padding:0; background:#1e0909;">

        {{-- Bande supérieure : valeurs IPRE --}}
        <div style="padding:32px 5vw 28px; border-bottom:1px solid rgba(255,255,255,.08); display:flex; justify-content:center; gap:48px; flex-wrap:wrap;">
            @foreach([
                ['I', $en ? 'Integrity'   : 'Intégrité',      $en ? 'Honesty & transparency in all our operations.'     : "Honnêteté et transparence dans toutes nos opérations."],
                ['P', $en ? 'Professionalism' : 'Professionnalisme', $en ? 'Continuous improvement & excellence.'       : 'Amélioration continue vers l\'excellence.'],
                ['R', $en ? 'Respect'     : 'Respect',         $en ? 'For colleagues, communities & regulations.'       : 'Des collaborateurs, communautés et réglementations.'],
                ['E', $en ? 'Teamwork'    : 'Esprit d\'équipe', $en ? 'Collective results through individual commitment.' : 'Des résultats collectifs par l\'implication de chacun.'],
            ] as [$letter, $value, $desc])
            <div style="text-align:center; max-width:200px;">
                <div style="width:44px; height:44px; border-radius:50%; background:rgba(255,194,71,.15); border:2px solid var(--gold); color:var(--gold); font:700 18px Inter,sans-serif; display:flex; align-items:center; justify-content:center; margin:0 auto 10px;">{{ $letter }}</div>
                <div style="font:700 13px Inter,sans-serif; color:#fff; margin-bottom:5px; letter-spacing:.06em; text-transform:uppercase;">{{ $value }}</div>
                <div style="font:12px/1.5 Inter,sans-serif; color:rgba(255,255,255,.45);">{{ $desc }}</div>
            </div>
            @endforeach
        </div>

        {{-- Bande principale --}}
        <div style="padding:28px 5vw; display:flex; justify-content:space-between; align-items:center; gap:24px; flex-wrap:wrap;">

            {{-- Logo + copyright --}}
            <div style="display:flex; flex-direction:column; gap:8px;">
                <img src="{{ asset('images/logo-nere.png') }}" alt="Néré Mining" style="height:36px; width:auto; object-fit:contain; filter:brightness(0) invert(.8);">
                <span style="font:12px Inter,sans-serif; color:rgba(255,255,255,.4);">
                    {{ str_replace(':year', date('Y'), __('site.footer_copy', [], $loc)) }}
                </span>
            </div>

            {{-- Liens navigation --}}
            <nav aria-label="Footer" style="display:flex; gap:22px; flex-wrap:wrap; justify-content:center;">
                <a href="{{ $en ? route('english.company')        : route('company') }}"       style="font:500 13px Inter,sans-serif; color:rgba(255,255,255,.65); transition:color .15s;" onmouseover="this.style.color='#ffc247'" onmouseout="this.style.color='rgba(255,255,255,.65)'">{{ __('site.nav_company', [], $loc) }}</a>
                <a href="{{ $en ? route('english.karma')          : route('karma') }}"          style="font:500 13px Inter,sans-serif; color:rgba(255,255,255,.65); transition:color .15s;" onmouseover="this.style.color='#ffc247'" onmouseout="this.style.color='rgba(255,255,255,.65)'">{{ __('site.nav_karma', [], $loc) }}</a>
                <a href="{{ $en ? route('english.sustainability')  : route('sustainability') }}" style="font:500 13px Inter,sans-serif; color:rgba(255,255,255,.65); transition:color .15s;" onmouseover="this.style.color='#ffc247'" onmouseout="this.style.color='rgba(255,255,255,.65)'">{{ $en ? 'ESG' : 'RSE' }}</a>
                <a href="{{ $en ? route('english.news')            : route('news.index') }}"    style="font:500 13px Inter,sans-serif; color:rgba(255,255,255,.65); transition:color .15s;" onmouseover="this.style.color='#ffc247'" onmouseout="this.style.color='rgba(255,255,255,.65)'">{{ __('site.nav_news', [], $loc) }}</a>
                <a href="{{ $en ? route('english.careers')         : route('careers') }}"       style="font:500 13px Inter,sans-serif; color:rgba(255,255,255,.65); transition:color .15s;" onmouseover="this.style.color='#ffc247'" onmouseout="this.style.color='rgba(255,255,255,.65)'">{{ __('site.nav_careers', [], $loc) }}</a>
                <a href="{{ $en ? route('english.contact')         : route('contact') }}"       style="font:500 13px Inter,sans-serif; color:rgba(255,255,255,.65); transition:color .15s;" onmouseover="this.style.color='#ffc247'" onmouseout="this.style.color='rgba(255,255,255,.65)'">{{ __('site.nav_contact', [], $loc) }}</a>
            </nav>

            {{-- Tagline + langue --}}
            <div style="display:flex; flex-direction:column; align-items:flex-end; gap:8px;">
                <span style="font:500 12px Inter,sans-serif; color:rgba(255,255,255,.35); letter-spacing:.1em; text-transform:uppercase;">{{ __('site.footer_tagline', [], $loc) }}</span>
                <a href="{{ $en ? url('/') : route('english') }}" style="font:600 11px Inter,sans-serif; color:var(--gold); letter-spacing:.1em; text-transform:uppercase; border:1px solid rgba(255,194,71,.3); padding:5px 12px; border-radius:4px; transition:background .15s;" onmouseover="this.style.background='rgba(255,194,71,.1)'" onmouseout="this.style.background=''">
                    {{ __('site.lang_switch', [], $loc) }}
                </a>
            </div>
        </div>

        {{-- Bande inférieure : mentions légales --}}
        <div style="padding:14px 5vw; border-top:1px solid rgba(255,255,255,.05); display:flex; justify-content:space-between; align-items:center; gap:16px; flex-wrap:wrap;">
            <span style="font:11px Inter,sans-serif; color:rgba(255,255,255,.25);">
                Néré Mining S.A. · Ouagadougou, Burkina Faso · +226 25 33 35 69 · contact@nere-mining.bf
            </span>
            <span style="font:11px Inter,sans-serif; color:rgba(255,255,255,.25);">
                ISO 9001:2008 · {{ $en ? 'EITI Member' : 'Membre ITIE' }}
            </span>
        </div>
    </footer>

    <script>
    (function(){
        'use strict';

        /* ── Counters ── */
        function easeOutQuad(t){ return t*(2-t); }

        function runCounter(el){
            var raw    = el.getAttribute('data-target');
            var suffix = el.getAttribute('data-suffix') || '';
            var limit  = parseInt(raw, 10);
            if(isNaN(limit)){ el.textContent = raw + suffix; return; }
            var dur = 1700, start = null;
            function step(ts){
                if(!start) start = ts;
                var p = Math.min((ts-start)/dur, 1);
                el.textContent = Math.floor(easeOutQuad(p)*limit).toLocaleString('fr-FR') + suffix;
                if(p < 1) requestAnimationFrame(step);
                else el.textContent = limit.toLocaleString('fr-FR') + suffix;
            }
            requestAnimationFrame(step);
        }

        /* Fire counters when stats section enters viewport */
        var bigCounters = document.querySelectorAll('.stat-num');
        var statsSection = document.getElementById('chiffres');
        if(bigCounters.length && statsSection && 'IntersectionObserver' in window){
            var fired = false;
            var io = new IntersectionObserver(function(entries){
                if(entries[0].isIntersecting && !fired){
                    fired = true;
                    bigCounters.forEach(runCounter);
                    io.disconnect();
                }
            }, {threshold: 0.2});
            io.observe(statsSection);
        } else {
            bigCounters.forEach(function(el){
                var raw = el.getAttribute('data-target');
                var suffix = el.getAttribute('data-suffix') || '';
                var limit = parseInt(raw, 10);
                el.textContent = (isNaN(limit) ? raw : limit.toLocaleString('fr-FR')) + suffix;
            });
        }

        /* Animate hero stat values when the hero enters view */
        function animateHeroValue(el){
            var raw = el.getAttribute('data-target');
            var suffix = el.getAttribute('data-suffix') || '';
            var limit = parseInt(raw, 10);
            if(isNaN(limit)){
                el.textContent = raw + suffix;
                return;
            }

            var start = null;
            var duration = 1600;
            function step(ts){
                if(!start) start = ts;
                var p = Math.min((ts - start) / duration, 1);
                var eased = 1 - Math.pow(1 - p, 3);
                var current = Math.round(limit * eased);
                el.textContent = current.toLocaleString('fr-FR') + suffix;
                if(p < 1) requestAnimationFrame(step);
                else el.textContent = limit.toLocaleString('fr-FR') + suffix;
            }
            requestAnimationFrame(step);
        }

        var heroValues = document.querySelectorAll('.hero-stat-val');
        var heroSection = document.querySelector('.hero');
        if(heroValues.length && heroSection && 'IntersectionObserver' in window){
            var heroAnimated = false;
            var heroObserver = new IntersectionObserver(function(entries){
                if(entries[0].isIntersecting && !heroAnimated){
                    heroAnimated = true;
                    heroValues.forEach(animateHeroValue);
                    heroObserver.disconnect();
                }
            }, { threshold: 0.35 });
            heroObserver.observe(heroSection);
        } else {
            heroValues.forEach(function(el){
                var raw = el.getAttribute('data-target');
                var suffix = el.getAttribute('data-suffix') || '';
                var limit = parseInt(raw, 10);
                el.textContent = (isNaN(limit) ? raw : limit.toLocaleString('fr-FR')) + suffix;
            });
        }

        /* ── Sticky header ── */
        var hdr = document.querySelector('header');
        if(hdr && !hdr.classList.contains('stuck')){
            /* on mobile header is already fixed via CSS, skip JS */
            var mq = window.matchMedia('(min-width:901px)');
            if(mq.matches){
                var stuck = false;
                window.addEventListener('scroll', function(){
                    var need = window.scrollY > 80;
                    if(need !== stuck){
                        stuck = need;
                        hdr.classList.toggle('stuck', need);
                    }
                }, {passive:true});
            }
        }

        /* ── Mobile menu ── */
        var btn = document.querySelector('.menu-btn');
        if(btn){
            btn.addEventListener('click', function(){
                var nav = btn.closest('header').querySelector('nav');
                var open = nav.classList.toggle('open');
                btn.setAttribute('aria-expanded', open);
            });
        }

    })();
    </script>
</body>
</html>
