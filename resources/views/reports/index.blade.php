@php $en = ($locale ?? 'fr') === 'en'; @endphp
<!DOCTYPE html>
<html lang="{{ $locale ?? 'fr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.reports_h1') }} | Néré Mining</title>
    <meta name="description" content="{{ __('site.reports_lead') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#281d18;--green:#4b1716;--red:#d72f2f;--gold:#ffc247;--sand:#fff4dc;--muted:#70645c;--line:#eadcc5;--light:#fbfaf7;}
        *{box-sizing:border-box;margin:0;padding:0;}
        body{color:var(--ink);background:var(--light);font-family:'Inter',Arial,Helvetica,sans-serif;line-height:1.6;}
        a{color:inherit;text-decoration:none;}
        .topbar{background:var(--red);color:#fff7e8;padding:9px 5vw;display:flex;justify-content:space-between;font:11px Inter,sans-serif;letter-spacing:.06em;text-transform:uppercase;}
        header{padding:18px 5vw;background:var(--green);display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;box-shadow:0 2px 12px rgba(0,0,0,.25);}
        .logo{width:200px;} .logo img{width:100%;display:block;}
        nav{display:flex;gap:6px;align-items:center;}
        .nav-link{color:rgba(255,255,255,.82);font:500 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.09em;padding:7px 12px;border-radius:4px;transition:background .18s,color .18s;white-space:nowrap;}
        .nav-link:hover,.nav-link.active{background:rgba(255,255,255,.12);color:#fff;}
        .nav-dropdown{position:relative;}
        .nav-dropdown>.nav-link::after{content:'▾';margin-left:5px;font-size:10px;}
        .dropdown-menu{display:none;position:absolute;top:100%;left:0;background:#fff;border:1px solid var(--line);border-radius:6px;min-width:240px;box-shadow:0 8px 28px rgba(0,0,0,.12);z-index:200;padding:6px 0;}
        .nav-dropdown.is-open .dropdown-menu { display:block; opacity:1; transform:translateY(0); pointer-events:auto; }
        .dropdown-menu a{display:block;padding:10px 18px;font:500 12px Inter,sans-serif;color:var(--green);border-radius:4px;transition:background .15s;}
        .dropdown-menu a:hover{background:var(--sand);}
        .nav-lang{margin-left:12px;border:1px solid rgba(255,255,255,.3);border-radius:4px;}
        .menu-btn{display:none;border:1px solid rgba(255,255,255,.4);background:none;color:#fff;padding:8px 14px;font:600 11px Inter,sans-serif;letter-spacing:.08em;cursor:pointer;border-radius:4px;}
        .masthead{padding:100px 5vw 80px;color:white;background:linear-gradient(100deg,rgba(75,23,22,.96) 45%,rgba(75,23,22,.55)),url('{{ asset('images/mining/karma-05.jpg') }}') center/cover;}
        .eyebrow{color:var(--gold);font:600 11px Inter,sans-serif;letter-spacing:.2em;text-transform:uppercase;margin-bottom:14px;}
        h1{max-width:800px;font-size:clamp(40px,6vw,76px);line-height:.97;font-weight:400;color:#fff;}
        .breadcrumb{margin-top:20px;font:12px Inter,sans-serif;color:rgba(255,255,255,.6);}
        .breadcrumb a{color:var(--gold);}
        main{max-width:1240px;margin:auto;}
        section{padding:80px 5vw;}
        .lead{max-width:820px;color:var(--muted);font:18px/1.75 Inter,sans-serif;margin-bottom:48px;}
        h2{color:var(--green);font-size:clamp(28px,3.5vw,48px);font-weight:400;line-height:1.05;margin-bottom:24px;}
        h3{color:var(--green);font-size:20px;font-weight:500;margin-bottom:10px;}
        p{color:var(--muted);font:15px/1.72 Inter,sans-serif;margin-bottom:12px;}
        .sub-nav{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:40px;padding-bottom:24px;border-bottom:1px solid var(--line);}
        .sub-nav a{padding:9px 18px;border:1px solid var(--line);border-radius:20px;font:500 12px Inter,sans-serif;color:var(--muted);transition:all .18s;}
        .sub-nav a:hover,.sub-nav a.active{background:var(--green);color:#fff;border-color:var(--green);}
        .grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;}
        .card{padding:28px;border:1px solid var(--line);background:#fff;border-radius:6px;transition:box-shadow .2s;}
        .card:hover{box-shadow:0 4px 18px rgba(0,0,0,.08);}
        .card-tag{display:inline-block;font:600 10px Inter,sans-serif;letter-spacing:.12em;text-transform:uppercase;color:var(--gold);margin-bottom:10px;}
        .btn{display:inline-block;padding:13px 20px;font:600 12px Inter,sans-serif;text-transform:uppercase;letter-spacing:.1em;border-radius:4px;cursor:pointer;transition:all .18s;margin-top:16px;}
        .btn-gold{background:var(--gold);color:var(--ink);}
        .btn-gold:hover{background:#e5a72f;}
        .btn.disabled{background:#eee5d7;color:var(--muted);pointer-events:none;}
        footer{padding:32px 5vw;background:#351312;color:#eadcca;display:flex;justify-content:space-between;align-items:center;font:12px Inter,sans-serif;}
        .footer-links{display:flex;gap:20px;}
        .footer-links a:hover{color:var(--gold);}
        @media(max-width:900px){
            .topbar{display:none;}header{flex-wrap:wrap;gap:12px;}nav{display:none;}.menu-btn{display:block;}
            nav.open{display:flex;flex-direction:column;align-items:flex-start;width:100%;gap:4px;}
            .nav-dropdown .dropdown-menu{position:static;box-shadow:none;border:0;padding:0 0 0 16px;}
            .grid-3{grid-template-columns:1fr;}
            footer{flex-direction:column;gap:12px;text-align:center;}
        }
    </style>
</head>
<body>
    @include('partials._nav', ['locale' => $locale ?? 'fr', 'section' => 'reports'])

    <div class="masthead">
        <h1>{{ __('site.reports_h1') }}</h1>
        <div class="breadcrumb">
            <a href="{{ $en ? route('english') : url('/') }}">{{ __('site.home_link') }}</a> ›
            <a href="{{ $en ? route('english.news') : route('news.index') }}">{{ __('site.nav_news') }}</a>
            › {{ __('site.reports_breadcrumb') }}
        </div>
    </div>

    <main>
        <section>
            <div class="sub-nav">
                <a href="{{ $en ? route('english.news') : route('news.index') }}">{{ __('site.subnav_news') }}</a>
                <a href="{{ $en ? route('english.press') : route('press') }}">{{ __('site.subnav_press') }}</a>
                <a href="{{ $en ? route('english.gallery') : route('gallery') }}">{{ __('site.subnav_gallery') }}</a>
                <a href="{{ $en ? route('english.reports') : route('reports') }}" class="active">{{ __('site.subnav_reports') }}</a>
                <a href="{{ $en ? route('english.press.contact') : route('press.contact') }}">{{ __('site.subnav_press_contact') }}</a>
            </div>

            <p class="lead">{{ __('site.reports_lead') }}</p>

            <div class="grid-3">
                @forelse($reports as $report)
                <article class="card">
                    <div class="card-tag">{{ $report->category }}</div>
                    <h3>{{ $report->title }}</h3>
                    @if($report->description)<p>{{ $report->description }}</p>@endif
                    @if($report->published_at)
                        <p style="font:600 11px Inter,sans-serif; color:var(--gold); text-transform:uppercase; letter-spacing:.08em; margin-bottom:0;">
                            {{ $report->published_at->translatedFormat('Y') }}
                        </p>
                    @endif
                    <a class="btn {{ $report->file_path ? 'btn-gold' : 'disabled' }}"
                       href="{{ $report->file_path ? asset($report->file_path) : '#' }}"
                       {{ $report->file_path ? 'target=_blank' : '' }}>
                        {{ $report->file_path ? __('site.download_pdf') : __('site.coming_soon') }}
                    </a>
                </article>
                @empty
                <p class="lead" style="grid-column:span 3;">{{ __('site.reports_empty') }}</p>
                @endforelse
            </div>
        </section>
    </main>

@include('partials._footer', ['loc' => $loc, 'en' => $en])
</body>
</html>
