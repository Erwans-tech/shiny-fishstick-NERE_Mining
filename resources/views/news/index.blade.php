@php $en = ($locale ?? 'fr') === 'en'; @endphp
<!DOCTYPE html>
<html lang="{{ $locale ?? 'fr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.news_h1') }} | Néré Mining</title>
    <meta name="description" content="{{ $en ? 'Latest news from Néré Mining and the Karma mine.' : 'Toute l\'actualité de Néré Mining et de la mine de Karma.' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#281d18;--green:#4b1716;--red:#d72f2f;--gold:#ffc247;--sand:#fff4dc;--muted:#70645c;--line:#eadcc5;--light:#fbfaf7;}
        *{box-sizing:border-box;margin:0;padding:0;}
        body{color:var(--ink);background-color:var(--light);background-image:linear-gradient(115deg,rgba(255,194,71,.045),transparent 38%,rgba(75,23,22,.03)),repeating-linear-gradient(135deg,rgba(75,23,22,.025) 0,rgba(75,23,22,.025) 1px,transparent 1px,transparent 46px);background-size:180% 180%,46px 46px;animation:siteAtmosphere 42s ease-in-out infinite alternate;font-family:'Inter',Arial,Helvetica,sans-serif;line-height:1.6;}
        @keyframes siteAtmosphere{from{background-position:0% 0%,0 0;}to{background-position:100% 100%,23px 23px;}}
        .masthead{animation:contentRise .8s ease-out both;}
        main>section{animation:contentRise .7s ease-out both;}
        @keyframes contentRise{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
        @media (prefers-reduced-motion: reduce){body,.masthead,main>section{animation:none;}}
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
        .masthead{padding:100px 5vw 80px;color:white;background:linear-gradient(100deg,rgba(75,23,22,.96) 45%,rgba(75,23,22,.55)),url('{{ asset('images/mining/karma-01.jpg') }}') center/cover;}
        .eyebrow{color:var(--gold);font:600 11px Inter,sans-serif;letter-spacing:.2em;text-transform:uppercase;margin-bottom:14px;}
        h1{max-width:800px;font-size:clamp(40px,6vw,76px);line-height:.97;font-weight:400;color:#fff;}
        .breadcrumb{margin-top:20px;font:12px Inter,sans-serif;color:rgba(255,255,255,.6);}
        .breadcrumb a{color:var(--gold);}
        main{max-width:1240px;margin:auto;}
        section{padding:80px 5vw;}
        .sub-nav{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:40px;padding-bottom:24px;border-bottom:1px solid var(--line);}
        .sub-nav a{padding:9px 18px;border:1px solid var(--line);border-radius:20px;font:500 12px Inter,sans-serif;color:var(--muted);transition:all .18s;}
        .sub-nav a:hover,.sub-nav a.active{background:var(--green);color:#fff;border-color:var(--green);}
        .news-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
        .news-card{background:#fff;border:1px solid var(--line);border-radius:8px;overflow:hidden;transition:transform .3s,box-shadow .3s;}
        .news-card:hover{transform:translateY(-4px);box-shadow:0 8px 24px rgba(0,0,0,.06);}
        .news-img{width:100%;height:220px;object-fit:cover;display:block;}
        .news-img-placeholder{width:100%;height:220px;background:var(--sand);display:flex;align-items:center;justify-content:center;color:var(--muted);font:13px Inter,sans-serif;}
        .news-body{padding:24px;}
        .news-meta{color:var(--gold);font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;}
        .news-body h2{color:var(--green);font-size:19px;font-weight:500;line-height:1.3;margin-bottom:10px;}
        .news-body p{color:var(--muted);font:14px/1.6 Inter,sans-serif;margin-bottom:16px;}
        .news-link{font:600 12px Inter,sans-serif;color:var(--red);text-transform:uppercase;letter-spacing:.05em;}
        .pagination{display:flex;gap:8px;justify-content:center;margin-top:48px;}
        .pagination a,.pagination span{padding:10px 16px;border:1px solid var(--line);border-radius:4px;font:500 13px Inter,sans-serif;color:var(--muted);}
        .pagination a:hover{background:var(--green);color:#fff;border-color:var(--green);}
        .pagination .active span{background:var(--green);color:#fff;border-color:var(--green);}
        footer{padding:32px 5vw;background:#351312;color:#eadcca;display:flex;justify-content:space-between;align-items:center;font:12px Inter,sans-serif;}
        .footer-links{display:flex;gap:20px;}
        .footer-links a:hover{color:var(--gold);}
        @media(max-width:900px){
            .topbar{display:none;}header{flex-wrap:wrap;gap:12px;}nav{display:none;}.menu-btn{display:block;}
            nav.open{display:flex;flex-direction:column;align-items:flex-start;width:100%;gap:4px;}
            .nav-dropdown .dropdown-menu{position:static;box-shadow:none;border:0;padding:0 0 0 16px;}
            .news-grid{grid-template-columns:1fr;}
            footer{flex-direction:column;gap:12px;text-align:center;}
        }
    </style>
</head>
<body>
    @include('partials._nav', ['locale' => $locale ?? 'fr', 'section' => 'news'])

    <div class="masthead">
        <div class="eyebrow">{{ __('site.news_eyebrow') }}</div>
        <h1>{{ __('site.news_h1') }}</h1>
        <div class="breadcrumb">
            <a href="{{ $en ? route('english') : url('/') }}">{{ __('site.home_link') }}</a> ›
            <a href="{{ $en ? route('english.news') : route('news.index') }}">{{ __('site.nav_news') }}</a>
            › {{ __('site.news_breadcrumb') }}
        </div>
    </div>

    <main>
        <section>
            <div class="sub-nav">
                <a href="{{ $en ? route('english.news') : route('news.index') }}" class="active">{{ __('site.subnav_news') }}</a>
                <a href="{{ $en ? route('english.press') : route('press') }}">{{ __('site.subnav_press') }}</a>
                <a href="{{ $en ? route('english.gallery') : route('gallery') }}">{{ __('site.subnav_gallery') }}</a>
                <a href="{{ $en ? route('english.reports') : route('reports') }}">{{ __('site.subnav_reports') }}</a>
                <a href="{{ $en ? route('english.press.contact') : route('press.contact') }}">{{ __('site.subnav_press_contact') }}</a>
            </div>

            @if($news->isEmpty())
                <p style="color:var(--muted);font:16px Inter,sans-serif;">{{ __('site.news_empty') }}</p>
            @else
                <div class="news-grid">
                    @foreach($news as $item)
                    <article class="news-card">
                        @if($item->image_path)
                            <img class="news-img" src="{{ asset('uploads/' . $item->image_path) }}" alt="{{ $item->title }}">
                        @else
                            <div class="news-img-placeholder">{{ __('site.news_img_placeholder') }}</div>
                        @endif
                        <div class="news-body">
                            <div class="news-meta">{{ $item->category }} · {{ $item->published_at?->translatedFormat('d M Y') }}</div>
                            <h2>{{ $item->title }}</h2>
                            @if($item->excerpt)<p>{{ $item->excerpt }}</p>@endif
                            <a class="news-link" href="{{ $en ? route('english.news.show', $item) : route('news.show', $item) }}">{{ __('site.read_more') }}</a>
                        </div>
                    </article>
                    @endforeach
                </div>

                <div class="pagination">
                    {{ $news->links() }}
                </div>
            @endif
        </section>
    </main>

    <footer>
        <span>{{ str_replace(':year', date('Y'), __('site.footer_copy')) }}</span>
        <div class="footer-links">
            <a href="{{ $en ? route('english.company') : route('company') }}">{{ __('site.nav_company') }}</a>
            <a href="{{ $en ? route('english.karma') : route('karma') }}">{{ __('site.nav_karma') }}</a>
            <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ $en ? 'ESG' : 'RSE' }}</a>
            <a href="{{ $en ? route('english.careers') : route('careers') }}">{{ __('site.nav_careers') }}</a>
            <a href="{{ $en ? route('english.contact') : route('contact') }}">{{ __('site.nav_contact') }}</a>
        </div>
        <span>{{ __('site.footer_tagline') }}</span>
    </footer>
</body>
</html>
