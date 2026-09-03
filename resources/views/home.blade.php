@php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';
    $slides = $slides ?? collect();
    $heroImages = $slides->isNotEmpty()
        ? $slides->map(fn($slide) => [
            'type'      => $slide->type ?? 'image',
            'url'       => $slide->url ?? '',
            'embed_url' => $slide->embed_url ?? null,
            'is_local_video' => false,
            'title'     => $slide->title ?? '',
            'caption'   => $slide->caption ?? null,
            'kicker'    => $slide->title ?? 'Néré Mining',
            'copy'      => $slide->caption ?? '',
        ])->filter()->values()->all()
        : collect([
            ['type' => 'image', 'filename' => 'gyathursan-mine-5523376_1920.jpg', 'kicker' => 'Une mine de', 'copy' => 'classe mondiale', 'kicker_en' => 'A mine of', 'copy_en' => 'world-class'],
            ['type' => 'image', 'filename' => 'pexels-gunshe-5125104.jpg', 'kicker' => 'Des opérations', 'copy' => 'responsables', 'kicker_en' => 'Responsible', 'copy_en' => 'operations'],
            ['type' => 'image', 'filename' => 'shibang-mechanical-2653706_1920.jpg', 'kicker' => 'L’excellence', 'copy' => 'industrielle', 'kicker_en' => 'Industrial', 'copy_en' => 'excellence'],
            ['type' => 'image', 'filename' => 'tyna_janoch-excavator-2781676_1920.jpg', 'kicker' => 'Des équipes', 'copy' => 'engagées', 'kicker_en' => 'Committed', 'copy_en' => 'teams'],
            ['type' => 'image', 'filename' => 'tyna_janoch-mine-2781686_1920.jpg', 'kicker' => 'Un territoire', 'copy' => 'en mouvement', 'kicker_en' => 'A region', 'copy_en' => 'in motion'],
            ['type' => 'image', 'filename' => 'upscalemedia-transformed.jpeg', 'kicker' => 'L’or', 'copy' => 'autrement', 'kicker_en' => 'Gold', 'copy_en' => 'done differently'],
            ['type' => 'video', 'filename' => 'Video Project 1.mp4', 'kicker' => 'Karma', 'copy' => 'notre mine d’or', 'kicker_en' => 'Karma', 'copy_en' => 'our gold mine'],
        ])->map(fn($slide) => [
            'type'      => $slide['type'],
            'url'       => asset('images/carousel/'.$slide['filename']),
            'embed_url' => null,
            'is_local_video' => $slide['type'] === 'video',
            'title'     => 'Néré Mining',
            'caption'   => null,
            'kicker'    => $en ? $slide['kicker_en'] : $slide['kicker'],
            'copy'      => $en ? $slide['copy_en'] : $slide['copy'],
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
    <link rel="stylesheet" href="{{ asset('css/chrome.css') }}?v={{ filemtime(public_path('css/chrome.css')) }}">
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
            font-family:'Inter',Arial,sans-serif; line-height:1.6; font-size:1rem;
        }
        @keyframes siteAtmosphere { from { background-position:0% 0%,0 0,0 0,0 0,0 0; } to { background-position:0% 0%,0 0,18px 18px,18px 18px,0 0; } }
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

        /* Header / footer : partials._nav et partials._footer */

        /* ── HERO ────────────────────────────────── */
        .hero {
            position:relative; min-height:64vh;
            display:flex; align-items:flex-end;
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
        .hero-slide:nth-child(even), .hero-slide-video:nth-child(even) { transform-origin:right center; }
        .hero-slide:nth-child(odd), .hero-slide-video:nth-child(odd) { transform-origin:left center; }
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
        .hero-slide-video video {
            position:absolute;
            inset:0;
            width:100%;
            height:100%;
            object-fit:cover;
            pointer-events:none;
        }
        @foreach($heroImages as $index => $heroImage)
        @php $bgUrl = is_array($heroImage) ? ($heroImage['url'] ?? '') : $heroImage; @endphp
        .hero-slide:nth-child({{ $index + 1 }}) { background-image:url('{{ $bgUrl }}'); animation:heroSlide{{ $index }} {{ $heroDuration }}s infinite; }
        .hero-slide-video:nth-child({{ $index + 1 }}) { animation:heroSlide{{ $index }} {{ $heroDuration }}s infinite; }
        @keyframes heroSlide{{ $index }} {
            0%,{{ max(0, $index * $heroSlot - 5) }}% { opacity:0; transform:scale(1.08); }
            {{ max(0, $index * $heroSlot - 1) }}%,{{ min(100, ($index + 1) * $heroSlot - 5) }}% { opacity:1; transform:scale(1.02); }
            {{ min(100, ($index + 1) * $heroSlot - 1) }}%,100% { opacity:0; transform:scale(1); }
        }
        @keyframes heroCopySlide{{ $index }} {
            @if($index % 3 === 0)
            0%,{{ max(0, $index * $heroSlot - 5) }}% { opacity:0; transform:translateY(16px) scale(.98); }
            {{ max(0, $index * $heroSlot - 1) }}%,{{ min(100, ($index + 1) * $heroSlot - 5) }}% { opacity:1; transform:translateY(0); }
            {{ min(100, ($index + 1) * $heroSlot - 1) }}%,100% { opacity:0; transform:translateY(-8px) scale(1.01); }
            @elseif($index % 3 === 1)
            0%,{{ max(0, $index * $heroSlot - 5) }}% { opacity:0; transform:translateX(-24px) rotate(-1deg); }
            {{ max(0, $index * $heroSlot - 1) }}%,{{ min(100, ($index + 1) * $heroSlot - 5) }}% { opacity:1; transform:translateX(0) rotate(0); }
            {{ min(100, ($index + 1) * $heroSlot - 1) }}%,100% { opacity:0; transform:translateX(18px) rotate(1deg); }
            @else
            0%,{{ max(0, $index * $heroSlot - 5) }}% { opacity:0; transform:scale(.9) translateY(8px); }
            {{ max(0, $index * $heroSlot - 1) }}%,{{ min(100, ($index + 1) * $heroSlot - 5) }}% { opacity:1; transform:scale(1) translateY(0); }
            {{ min(100, ($index + 1) * $heroSlot - 1) }}%,100% { opacity:0; transform:scale(1.03) translateY(-6px); }
            @endif
        }
        @endforeach
        /* Overlays */
        .hero-ov {
            position:absolute; inset:0; z-index:1;
            background:
                linear-gradient(to right, rgba(18,4,4,.85) 0%, rgba(18,4,4,.48) 55%, rgba(18,4,4,.18) 100%),
                linear-gradient(to top,   rgba(18,4,4,.72) 0%, transparent 50%);
            background-size:140% 140%,100% 100%;
            background-position:0% 0%,0% 0%;
            animation:heroLightDrift 16s ease-in-out infinite alternate;
        }
        @keyframes heroLightDrift {
            from { background-position:0% 0%,0% 0%; }
            to { background-position:100% 18%,0% 0%; }
        }
        .hero-accent {
            position:absolute; bottom:0; left:0; right:0; height:4px; z-index:3;
            background:linear-gradient(to right, var(--gold), var(--gold2) 60%, transparent 100%);
        }
        .hero-copy {
            position:absolute; z-index:3; left:50%; top:50%;
            width:min(90vw,900px); min-height:140px; transform:translate(-50%,-50%);
            color:#fff; text-align:left;
        }
        .hero-copy-slide {
            position:absolute; inset:0; opacity:0;
        }
        .hero-copy-kicker {
            display:block; margin-bottom:8px;
            font:500 clamp(18px,2vw,28px)/1.1 Inter,sans-serif;
            color:var(--gold); letter-spacing:.02em; text-transform:uppercase;
            text-shadow:0 2px 12px rgba(42,16,16,.8);
        }
        .hero-copy-title {
            display:block; max-width:780px;
            font:700 clamp(48px,7vw,96px)/.92 Inter,sans-serif;
            letter-spacing:-.03em; text-transform:lowercase;
            color:#fff4dc;
            background:linear-gradient(105deg,#fff4dc 0%,#ffc247 52%,#e5a72f 100%);
            -webkit-background-clip:text; background-clip:text;
            -webkit-text-fill-color:transparent;
            text-shadow:0 4px 24px rgba(42,16,16,.55);
        }
        /* Content grid */
        /* Stat tiles below the hero image */
        .hero-stats {
            position:relative; z-index:4;
            width:min(1180px, 90vw); margin:28px auto 56px;
            display:grid; grid-template-columns:repeat(4,1fr); gap:14px;
        }
        .hero-stat {
            background:#2a1010; border:1px solid rgba(255,194,71,.35);
            border-radius:9px; padding:24px 20px;
            backdrop-filter:blur(8px); -webkit-backdrop-filter:blur(8px);
            transition:background .35s ease, border-color .35s ease, transform .35s cubic-bezier(.22,1,.36,1), box-shadow .35s ease;
            animation:heroStatWave 7s ease-in-out infinite;
            cursor:pointer;
            position:relative;
            overflow:hidden;
            will-change:transform;
        }
        .hero-stat:nth-child(2) { animation-delay:-1.375s; }
        .hero-stat:nth-child(3) { animation-delay:-2.75s; }
        .hero-stat:nth-child(4) { animation-delay:-4.125s; }
        @keyframes heroStatWave {
            0%,100% { transform:translateY(0); }
            25% { transform:translateY(-4px); }
            50% { transform:translateY(0); }
            75% { transform:translateY(3px); }
        }
        .hero-stat::before {
            content:'';
            position:absolute;
            inset:0;
            background:linear-gradient(135deg, rgba(255,255,255,.1) 0%, rgba(255,255,255,.05) 100%);
            opacity:0;
            transition:opacity .35s cubic-bezier(.22,1,.36,1);
        }
        .hero-stat:hover {
            background:linear-gradient(135deg,#4b1716 0%,#2a1010 100%);
            border-color:var(--gold);
            transform:translateY(-6px) scale(1.02);
            box-shadow:0 16px 34px rgba(42,16,16,.32), 0 0 0 1px rgba(255,194,71,.18), inset 0 1px 0 rgba(255,255,255,.18);
        }
        .hero-stat:hover::before {
            opacity:.55;
        }
        .hero-stat-val {
            display:block; font-size:34px; font-weight:300;
            color:var(--gold); line-height:1; margin-bottom:8px;
            transition:transform .35s cubic-bezier(.22,1,.36,1), color .35s;
            position:relative;
            z-index:1;
        }
        .hero-stat:hover .hero-stat-val {
            transform:scale(1.08);
            color:#ffe0a0;
        }
        .hero-stat-lbl {
            font:500 12px Inter,sans-serif;
            color:rgba(255,255,255,.65); 
            line-height:1.4;
            transition:color .35s cubic-bezier(.22,1,.36,1);
            position:relative;
            z-index:1;
        }
        .hero-stat:hover .hero-stat-lbl {
            color:#fff;
        }
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
        .sec { padding:56px 5vw; }
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
            background:linear-gradient(180deg, #f6f1ea 0%, #f0ebdf 100%);
            border-top:1px solid var(--line);
            border-bottom:1px solid var(--line);
            padding-top:60px;
            padding-bottom:60px;
            position:relative;
            background-attachment:fixed;
        }
        .intro-inner {
            max-width:1180px; margin:0 auto; display:grid;
            grid-template-columns:1.2fr .8fr; gap:40px; align-items:center;
            position:relative; z-index:2;
        }
        .intro-copy {
            background:rgba(255,255,255,.9); border:1px solid var(--line); border-radius:18px;
            padding:40px 32px; box-shadow:0 12px 32px rgba(40,29,24,.06);
            text-align:center;
            backdrop-filter:blur(8px);
        }
        .intro-copy .sec-h2 {
            margin-bottom:16px;
            font-size:clamp(2.3rem,3.4vw,4rem);
            line-height:1.05;
            letter-spacing:-0.04em;
            text-align:center;
        }
        .intro-points {
            display:grid; gap:16px;
        }
        .intro-point {
            background:rgba(255,255,255,.85); border:1px solid rgba(234,220,197,.7);
            border-radius:14px; min-height:180px; padding:28px 24px; display:flex; align-items:center; gap:16px;
            box-shadow:0 8px 20px rgba(40,29,24,.04);
            transition:transform .3s, box-shadow .3s;
        }
        .intro-point:hover { transform:translateY(-3px); box-shadow:0 12px 28px rgba(40,29,24,.08); }
        .intro-point::before {
            content:''; display:block; width:24px; height:24px; flex-shrink:0;
            background-color:var(--gold);
            mask:url('data:image/svg+xml;utf8,<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>') no-repeat center/contain;
            -webkit-mask:url('data:image/svg+xml;utf8,<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>') no-repeat center/contain;
            margin-top:0;
        }
        .intro-point span {
            color:var(--ink); font-size:1.05rem; line-height:1.65;
            text-align:left; font-weight:500;
        }




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
        .news-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
        .news-sec .btn-dark {
            margin-top:18px;
            align-self:flex-end;
        }
        .news-card-link {
            display:block;
            color:inherit;
            text-decoration:none;
        }
        /* Featured first card */
        .news-grid .news-card:first-child { grid-column:span 2; }
        .news-card {
            display:flex; flex-direction:column;
            background:linear-gradient(180deg, rgba(255,255,255,.9), rgba(248,244,240,1));
            border:1px solid rgba(75,23,22,.1);
            border-radius:16px; overflow:hidden; transition:transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s, border-color .3s;
            height:100%; box-shadow:0 8px 24px rgba(40,29,24,.06);
            position:relative;
        }
        .news-card::before {
            content:'';
            position:absolute;
            inset:0 auto auto 0;
            width:100%; height:4px;
            background:linear-gradient(90deg, var(--gold), var(--gold2));
            transform:scaleX(0); transform-origin:left; transition:transform .3s ease;
            z-index:10;
        }
        .news-card-link:hover .news-card {
            transform:translateY(-6px);
            box-shadow:0 18px 36px rgba(40,29,24,.12);
            border-color:rgba(255,194,71,.4);
        }
        .news-card-link:hover .news-card::before { transform:scaleX(1); }
        .news-img-wrap { overflow:hidden; border-radius:16px 16px 0 0; }
        .news-img { width:100%; height:220px; object-fit:cover; transition:transform .5s ease; display:block; }
        .news-grid .news-card:first-child .news-img { height:300px; }
        .news-card-link:hover .news-img { transform:scale(1.04); }
        .news-img-ph {
            width:100%; height:220px;
            background:linear-gradient(135deg, var(--green) 0%, #7a2a29 100%);
            display:flex; align-items:center; justify-content:center;
            font:700 38px Inter,sans-serif; color:rgba(255,255,255,.2); letter-spacing:.1em;
        }
        .news-grid .news-card:first-child .news-img-ph { height:300px; }
        .news-body { padding:28px 32px; display:flex; flex-direction:column; flex:1; position:relative; z-index:2; background:#fff; }
        .news-meta {
            font:700 11px Inter,sans-serif; letter-spacing:.14em; text-transform:uppercase;
            color:var(--gold2); margin-bottom:14px; display:inline-block;
            background:rgba(255,194,71,.1); padding:4px 10px; border-radius:4px;
        }
        .news-card h3 {
            font-size:22px; font-weight:600; color:var(--ink); line-height:1.3;
            margin-bottom:20px; letter-spacing:-.01em; transition:color .2s;
        }
        .news-grid .news-card:first-child h3 { font-size:32px; }
        .news-card-link:hover h3 { color:var(--green); }
        .news-read {
            margin-top:auto; font:700 11px Inter,sans-serif; letter-spacing:.14em;
            text-transform:uppercase; color:var(--red);
            display:inline-flex; align-items:center; gap:8px;
            padding-top:10px;
        }
        .news-read-arr {
            display:inline-block; transition:transform .2s;
            font-size:17px; line-height:1;
        }
        .news-card-link:hover .news-read-arr { transform:translateX(5px); }
        .news-empty { grid-column:span 3; text-align:center; padding:60px 0; color:var(--muted); font-size:15px; }

        /* ── PARTNERS ────────────────────────────── */
        .partners-sec {
            position:relative; overflow:hidden;
            background:
                linear-gradient(90deg,rgba(75,23,22,.045) 1px,transparent 1px),
                linear-gradient(rgba(75,23,22,.045) 1px,transparent 1px),
                var(--sand);
            background-size:32px 32px;
            border-top:1px solid var(--line); padding:42px 5vw 38px;
        }
        .partners-sec::after {
            content:''; position:absolute; left:5vw; right:5vw; top:0;
            height:4px; background:linear-gradient(90deg,var(--green),var(--gold),transparent);
        }
        .partners-head {
            max-width:1180px; margin:0 auto 24px;
            display:block; text-align:center;
        }
        .partners-head .sec-tag { justify-content:center; margin-bottom:8px; }
        .partners-head .sec-h2 { text-align:center; margin:0 0 10px; font-size:clamp(28px,4vw,44px); }
        .partners-head .sec-lead { width:100%; max-width:900px; margin:0 auto; text-align:center; font-size:1rem; line-height:1.5; }
        /* Institutional cards — scroll continuously on narrow screens */
        .partners-strip {
            position:relative; max-width:1180px; margin:0 auto;
            border:0; border-radius:0; background:transparent; overflow:hidden;
        }
        .partners-track {
            display:flex; width:max-content; align-items:stretch; gap:16px;
            animation:partnersMarquee 24s linear infinite;
        }
        @keyframes partnersMarquee {
            from { transform:translateX(0); }
            to { transform:translateX(-50%); }
        }
        .partner-logo-item {
            flex:0 0 clamp(250px,30vw,360px); max-width:none;
            min-height:150px;
            display:flex; flex-direction:column; align-items:center; justify-content:center;
            gap:7px; padding:18px 16px;
            border:1px solid rgba(75,23,22,.14); border-radius:10px;
            background:rgba(255,255,255,.94);
            text-align:center;
            box-shadow:0 12px 26px rgba(75,23,22,.08);
            transition:background .3s, border-color .3s, box-shadow .3s, transform .3s;
        }
        .partner-logo-item:hover {
            background:#fff; border-color:var(--gold2);
            box-shadow:0 18px 34px rgba(75,23,22,.14);
            transform:translateY(-5px);
        }
        .partner-logo-img {
            width:min(170px,80%); height:56px; aspect-ratio:2.3;
            object-fit:contain; display:block; border-radius:4px;
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
            display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:12px;
        }
        .partner-card {
            background:#fff; border:1px solid var(--line); border-radius:10px;
            padding:18px 14px;
            display:flex; flex-direction:column; align-items:center; gap:8px; text-align:center;
            animation:partnerCardReveal .7s var(--ease-smooth, cubic-bezier(.22,1,.36,1)) both;
            transition:border-color .2s, box-shadow .2s, transform .2s;
        }
        @keyframes partnerCardReveal {
            from { opacity:0; transform:translateY(18px); }
            to { opacity:1; transform:translateY(0); }
        }
        .partner-card:hover { border-color:var(--gold); box-shadow:0 8px 24px rgba(75,23,22,.07); transform:translateY(-3px); }
        .partner-card img { width:auto; max-width:100px; height:48px; object-fit:contain; }
        .partner-name { font:600 12px Inter,sans-serif; color:var(--green); line-height:1.35; }
        .partner-cat  { font:500 10px Inter,sans-serif; letter-spacing:.07em; text-transform:uppercase; color:var(--muted); }

        /* ── Responsive ──────────────────────────── */
        @media(max-width:900px) {
            .topbar { display:none; }
            .hero { min-height:100svh; }
            .hero-stats { grid-template-columns:repeat(2,1fr); }
            .news-grid  { grid-template-columns:1fr; }
            .news-grid .news-card:first-child { grid-column:span 1; }
        }
        @media(max-width:600px) {
            .partners-sec { padding:34px 5vw 30px; }
            .partners-head { margin-bottom:26px; }
            .partner-logo-item { flex-basis:78vw; min-height:182px; }
            .ql-grid        { grid-template-columns:1fr; }
            .partners-grid  { grid-template-columns:1fr 1fr; }
            .hero-stats     { grid-template-columns:1fr; }
        }
        @media (prefers-reduced-motion: reduce) {
            .hero-ov { animation:none; }
            .partners-track { animation:none; }
            .partner-card { animation:none; }
            .hero-copy-slide { animation:none; opacity:1; }
            .hero-copy-slide:not(:first-child) { display:none; }
            .hero-stat { animation:none; }
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
                    {{-- Slide vidéo (fichier local, YouTube ou Vimeo) --}}
                    <div class="hero-slide-video" style="background-image:url('{{ $heroImage['url'] ?? '' }}'); background-size:cover; background-position:center;">
                        @if($heroImage['embed_url'])
                        <iframe
                            src="{{ $heroImage['embed_url'] }}"
                            allow="autoplay; encrypted-media"
                            title="{{ $heroImage['title'] ?? 'Hero video' }}"
                            loading="lazy">
                        </iframe>
                        @elseif($heroImage['is_local_video'] ?? false)
                        <video autoplay muted loop playsinline preload="metadata" aria-hidden="true">
                            <source src="{{ $heroImage['url'] }}" type="video/mp4">
                        </video>
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
        <div class="hero-copy">
            @foreach($heroImages as $index => $heroImage)
            <div class="hero-copy-slide" style="animation:heroCopySlide{{ $index }} {{ $heroDuration }}s infinite;">
                <span class="hero-copy-kicker">{{ $heroImage['kicker'] ?? 'Néré Mining' }}</span>
                <span class="hero-copy-title">{{ $heroImage['copy'] ?? '' }}</span>
            </div>
            @endforeach
        </div>
        <div class="hero-accent" aria-hidden="true"></div>

    </section>

    {{-- Chiffres clés sous l'image du hero --}}
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

    {{-- ════════════════════════════════════════
         2 · NÉRÉ MINING
    ════════════════════════════════════════ --}}
    <section class="sec intro-sec" aria-labelledby="intro-nere-h">
        <div class="intro-inner">
            <div class="intro-copy">
                <h2 class="sec-h2" id="intro-nere-h">Une filière aurifère durable, ancrée dans le développement local.</h2>
                <p class="sec-lead">
                    Néré Mining est un groupe aurifère ancré au Burkina Faso, détenu majoritairement par des actionnaires burkinabè. Nous contribuons au développement local et créons de la valeur pour les communautés autour de notre mine d'or de Karma, en menant nos activités avec transparence, responsabilité et respect de l'environnement.
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
         3 · CHIFFRES DÉTAILLÉS (ENRICHISSEMENT)
    ════════════════════════════════════════ --}}

    {{-- ════════════════════════════════════════
         4 · DERNIÈRES ACTUALITÉS
    ════════════════════════════════════════ --}}
    <section class="sec news-sec" id="actualites" aria-labelledby="news-h">
        <div class="news-head">
            <div>
                <h2 class="sec-h2" id="news-h">{{ __('site.home_news_h2', [], $loc) }}</h2>
            </div>
        </div>
        <div class="news-grid">
            @forelse($news as $i => $item)
            <a class="news-card-link" href="{{ $en ? route('english.news.show', ['news' => $item['id'] ?? $item['slug'] ?? $i]) : route('news.show', ['news' => $item['id'] ?? $item['slug'] ?? $i]) }}" aria-label="{{ __('site.read_more', [], $loc) }} : {{ e($item['title']) }}">
                <article class="news-card sr">
                    <div class="news-img-wrap">
                        @if(!empty($item['image']) && !str_contains((string)$item['image'], 'null'))
                            <img class="news-img"
                                 src="{{ $item['image'] }}"
                                 alt="{{ e($item['title']) }}"
                                 loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
                        @else
                            <div class="news-img-ph" aria-hidden="true">NM</div>
                        @endif
                    </div>
                    <div class="news-body">
                        <div class="news-meta">{{ $item['category'] }} · {{ $item['date'] }}</div>
                        <h3>{{ $item['title'] }}</h3>
                        <span class="news-read">
                            {{ __('site.read_more', [], $loc) }}
                            <span class="news-read-arr">→</span>
                        </span>
                    </div>
                </article>
            </a>
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

        @php
            $defaultPartners = [
                [
                    'img'  => asset('images/partners/armoiries-burkina-faso.jpg'),
                    'name' => $en ? 'Government of Burkina Faso' : 'État burkinabè',
                    'cat'  => $en ? 'State · Mining Ministry' : 'Ministère des Mines',
                    'url'  => null,
                ],
                [
                    'img'  => asset('images/partners/logo-itie-bf.jpg'),
                    'name' => $en ? 'EITI Burkina Faso' : 'ITIE Burkina Faso',
                    'cat'  => $en ? 'Transparency Framework' : 'Transparence fiscale',
                    'url'  => 'https://itie.bf',
                ],
                [
                    'img'  => asset('images/partners/chambre-des-mines-burkina.png'),
                    'name' => $en ? 'Burkina Mining Chamber' : 'Chambre des mines du Burkina',
                    'cat'  => $en ? 'Mining industry representative' : 'Représentation du secteur minier',
                    'url'  => 'https://www.chambredesmines.bf',
                ],
            ];
        @endphp
        <div class="partners-strip" role="list">
            <div class="partners-track">
            @foreach([$defaultPartners, $defaultPartners] as $partnerSet)
            @foreach($partnerSet as $p)
            @if($p['url'])
            <a href="{{ $p['url'] }}" target="_blank" rel="noopener noreferrer" class="partner-logo-item" role="listitem">
            @else
            <div class="partner-logo-item" role="listitem">
            @endif
                <img class="partner-logo-img"
                     src="{{ $p['img'] }}"
                     alt="{{ $p['name'] }}"
                     loading="lazy"
                     width="120" height="56">
                <span class="partner-logo-name">{{ $p['name'] }}</span>
                <span class="partner-logo-cat">{{ $p['cat'] }}</span>
            @if($p['url'])
            </a>
            @else
            </div>
            @endif
            @foreach([1, 2] as $copy)
            @foreach($defaultPartners as $p)
            @php $tag = $p['url'] ? 'a' : 'div'; $attrs = $p['url'] ? 'href="'.$p['url'].'" target="_blank" rel="noopener noreferrer"' : ''; @endphp
            <{{ $tag }} {{ $attrs }} class="partner-logo-item" role="listitem">
                <img class="partner-logo-img" src="{{ $p['img'] }}" alt="{{ $p['name'] }}" loading="lazy" width="120" height="56">
                <span class="partner-logo-name">{{ $p['name'] }}</span>
                <span class="partner-logo-cat">{{ $p['cat'] }}</span>
            </{{ $tag }}>
            @endforeach
            @foreach($partners as $p)
            @php
                $tag = $p->website_url ? 'a' : 'div';
                $attrs = $p->website_url ? 'href="'.e($p->website_url).'" target="_blank" rel="noopener noreferrer"' : '';
                $logoUrl = $p->logo_path
                    ? (str_starts_with($p->logo_path, 'images/') ? asset($p->logo_path) : \App\Helpers\StorageHelper::uploadUrl($p->logo_path))
                    : null;
            @endphp
            <{{ $tag }} {{ $attrs }} class="partner-logo-item" role="listitem">
                @if($logoUrl)
                <img class="partner-logo-img" src="{{ $logoUrl }}" alt="{{ $p->name }}" loading="lazy" width="120" height="56">
                @else
                <div style="width:80px;height:40px;background:var(--sand);border-radius:4px;display:flex;align-items:center;justify-content:center;font:700 13px Inter;color:var(--green);">
                    {{ strtoupper(substr($p->name, 0, 3)) }}
                </div>
                @endif
                <span class="partner-logo-name">{{ $p->name }}</span>
                @if($p->category) <span class="partner-logo-cat">{{ $p->category }}</span> @endif
            </{{ $tag }}>
            @endforeach
            var raw    = el.getAttribute('data-target');
            var suffix = el.getAttribute('data-suffix') || '';
            var limit  = parseInt(raw, 10);
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
