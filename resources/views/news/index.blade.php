@php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';
    use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="{{ $loc }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="canonical" href="{{ $en ? url('/en/news') : url('/actualites') }}">
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
        @media (prefers-reduced-motion: reduce) and (min-width: 99999px){body,.masthead,main>section{animation:none;}}
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
        .news-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:40px;}
        .news-card-link { display:block; color:inherit; text-decoration:none; }
        .news-card {
            display:flex; flex-direction:column;
            background:linear-gradient(180deg, rgba(255,255,255,.9), rgba(248,244,240,1));
            border:1px solid rgba(234,220,197,.7);
            border-radius:16px;
            overflow:hidden;
            transition:all .3s cubic-bezier(0.2, 1, 0.36, 1);
            box-shadow:0 4px 12px rgba(40,29,24,.06);
            position:relative;
        }
        .news-card::before {
            content:'';
            position:absolute;
            top:0; left:0; right:0;
            height:4px;
            background:linear-gradient(90deg, var(--gold), #f4a261);
            transform:scaleX(0);
            transition:transform .3s ease;
            z-index:10;
        }
        .news-card-link:hover .news-card {
            transform:translateY(-6px);
            box-shadow:0 18px 36px rgba(40,29,24,.12);
            border-color:rgba(255,194,71,.4);
        }
        .news-card-link:hover .news-card::before { transform:scaleX(1); }
        .news-img-wrap { overflow:hidden; border-radius:16px 16px 0 0; position:relative; }
        .news-img { width:100%; height:220px; object-fit:cover; transition:transform .5s ease; display:block; }
        .news-card[data-news-id="4"] .news-img { object-position: center 20%; }
        .news-card-link:hover .news-img { transform:scale(1.04); }
        .news-img-placeholder{
            width:100%; height:220px;
            background:linear-gradient(135deg, var(--green) 0%, #7a2a29 100%);
            display:flex; align-items:center; justify-content:center;
            font:700 24px Inter,sans-serif; color:rgba(255,255,255,.3); letter-spacing:.1em;
        }
        .news-body { padding:24px; display:flex; flex-direction:column; flex:1; position:relative; z-index:2; background:#fff; text-align:left; }
        .news-meta {
            font:700 11px Inter,sans-serif; letter-spacing:.14em; text-transform:uppercase;
            color:var(--gold2); margin-bottom:14px; display:inline-block;
            background:rgba(255,194,71,.1); padding:4px 10px; border-radius:4px;
        }
        .news-card h2 {
            font-size:18px; font-weight:600; color:var(--ink); line-height:1.3;
            margin-bottom:14px; letter-spacing:-.01em; transition:color .2s;
        }
        .news-card-link:hover h2 { color:var(--green); }
        .news-card p {
            color:var(--muted); font-size:14px; line-height:1.5;
            margin-bottom:16px; text-align:justify;
        }
        .news-link {
            margin-top:auto; font:700 11px Inter,sans-serif; letter-spacing:.14em;
            text-transform:uppercase; color:var(--red);
            display:flex; align-items:center; gap:8px;
            padding-top:10px;
        }
        .sa-arrow-hover {
            display:inline-block; transition:transform .2s;
            font-size:17px; line-height:1;
        }
        .news-card-link:hover .sa-arrow-hover { transform:translateX(5px); }
        .pagination{display:flex;gap:8px;justify-content:center;margin-top:48px;}
        .pagination a,.pagination span{padding:12px 18px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;color:var(--muted);transition:all .2s;}
        .pagination a:hover{background:var(--green);color:#fff;border-color:var(--green);transform:translateY(-1px);}
        .pagination .active span{background:var(--green);color:#fff;border-color:var(--green);}
        @media(max-width:900px){
            .topbar{display:none;}header{flex-wrap:wrap;gap:12px;}nav{display:none;}.menu-btn{display:block;}
            nav.open{display:flex;flex-direction:column;align-items:flex-start;width:100%;gap:4px;}
            .nav-dropdown .dropdown-menu{position:static;box-shadow:none;border:0;padding:0 0 0 16px;}
            .news-grid{grid-template-columns:repeat(2,1fr);}
            footer{flex-direction:column;gap:12px;text-align:center;}
        }
        @media(max-width:600px){
            .news-grid{grid-template-columns:1fr;}
            .masthead{padding:60px 5vw 40px;}
            h1{font-size:clamp(32px,8vw,48px);}
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/sustainability-animations.css') }}">
    <script src="{{ asset('js/sustainability-animations.js') }}"></script>
</head>
<body>
    @include('partials._nav', ['locale' => $locale ?? 'fr', 'section' => 'news'])

    <div class="masthead">
        <h1>{{ __('site.news_h1') }}</h1>
    </div>

    <main>
        <section class="sa-animated-section">
            <div class="sa-particles-container" data-count="5"></div>

            @if($news->isEmpty())
                <p class="sa-reveal" style="color:var(--muted);font:16px Inter,sans-serif;">{{ __('site.news_empty') }}</p>
            @else
                <div class="news-grid">
                    @foreach($news as $index => $item)
                    <a class="news-card-link sa-reveal sa-delay-{{ $index % 3 + 1 }}" href="{{ isset($item->slug) ? ($en ? url('/en/news/' . $item->slug) : url('/actualites/' . $item->slug)) : ($en ? route('english.news.show', $item) : route('news.show', $item)) }}" aria-label="{{ __('site.read_more') }} : {{ e($item->title) }}">
                        <article class="news-card" data-news-id="{{ $item->id ?? '' }}">
                            <div class="news-img-wrap">
                                @php
                                    $imageUrl = null;
                                    if (isset($item->image_path) && $item->image_path) {
                                        $imageUrl = \App\Helpers\StorageHelper::uploadUrl($item->image_path);
                                    } elseif (isset($item->image) && $item->image) {
                                        $imageUrl = $item->image;
                                    }
                                @endphp
                                @if($imageUrl)
                                    <img class="news-img"
                                         src="{{ $imageUrl }}"
                                         alt="{{ e($item->title) }}"
                                         loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                         decoding="async"
                                         fetchpriority="{{ $index === 0 ? 'high' : 'auto' }}"
                                         width="640"
                                         height="480"
                                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="news-img-placeholder" style="display:none;">
                                        Actualités
                                    </div>
                                @else
                                    <div class="news-img-placeholder">
                                        Actualités
                                    </div>
                                @endif
                            </div>
                            <div class="news-body">
                                <div class="news-meta">{{ $item->category }} · {{ $item->published_at?->translatedFormat('d M Y') }}</div>
                                <h2>{{ $item->title }}</h2>
                                @if(isset($item->excerpt) && $item->excerpt)
                                    <p>{{ Str::limit($item->excerpt, 120) }}</p>
                                @endif
                                <span class="news-link">
                                    {{ __('site.read_more') }} 
                                    <span class="sa-arrow-hover">→</span>
                                </span>
                            </div>
                        </article>
                    </a>
                    @endforeach
                </div>

                <div class="pagination sa-reveal" style="margin-top:60px;">
                    {{ $news->links() }}
                </div>
            @endif
        </section>
    </main>

@include('partials._footer', ['loc' => $loc, 'en' => $en])
</body>
</html>
