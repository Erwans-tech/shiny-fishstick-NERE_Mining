@php
    $loc = $locale ?? 'fr';
    $en = $loc === 'en';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale ?? 'fr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('site.'.$section.'_h1') }} | Néré Mining</title>
    <meta name="description" content="{{ __('site.'.$section.'_lead') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink:#281d18; --green:#4b1716; --red:#d72f2f; --gold:#ffc247;
            --sand:#fff4dc; --muted:#70645c; --line:#eadcc5; --light:#fbfaf7;
        }
        * { box-sizing:border-box; margin:0; padding:0; }
        body { color:var(--ink); background-color:var(--light); background-image:linear-gradient(115deg,rgba(255,194,71,.045),transparent 38%,rgba(75,23,22,.03)),repeating-linear-gradient(135deg,rgba(75,23,22,.025) 0,rgba(75,23,22,.025) 1px,transparent 1px,transparent 46px); background-size:180% 180%,46px 46px; animation:siteAtmosphere 42s ease-in-out infinite alternate; font-family:'Inter',Arial,Helvetica,sans-serif; line-height:1.6; }
        @keyframes siteAtmosphere { from { background-position:0% 0%,0 0; } to { background-position:100% 100%,23px 23px; } }
        .masthead { animation:contentRise .8s ease-out both; }
        main > section { animation:contentRise .7s ease-out both; }
        @keyframes contentRise { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
        @media (prefers-reduced-motion: reduce) { body, .masthead, main > section { animation:none; } }
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
        .masthead { padding:100px 5vw 80px; color:white; background:linear-gradient(100deg,rgba(75,23,22,.96) 45%,rgba(75,23,22,.55)),url('{{ asset('images/mining/karma-02.jpg') }}') center/cover; }
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

        /* ── Sub-nav ── */
        .sub-nav { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:40px; padding-bottom:24px; border-bottom:1px solid var(--line); }
        .sub-nav a { padding:9px 18px; border:1px solid var(--line); border-radius:20px; font:500 12px Inter,sans-serif; color:var(--muted); transition:all .18s; }
        .sub-nav a:hover, .sub-nav a.active { background:var(--green); color:#fff; border-color:var(--green); }

        /* ── Grid & Cards ── */
        .grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
        .card { padding:28px; border:1px solid var(--line); background:#fff; border-radius:6px; transition:box-shadow .2s; }
        .card:hover { box-shadow:0 4px 18px rgba(0,0,0,.08); }
        .card-img { width:calc(100%+56px); height:240px; object-fit:cover; margin:-28px -28px 22px; display:block; border-radius:6px 6px 0 0; }
        .card-tag { display:inline-block; font:600 10px Inter,sans-serif; letter-spacing:.12em; text-transform:uppercase; color:var(--gold); margin-bottom:10px; }

        /* ── Download button ── */
        .btn { display:inline-block; padding:13px 20px; font:600 12px Inter,sans-serif; text-transform:uppercase; letter-spacing:.1em; border-radius:4px; cursor:pointer; transition:all .18s; }
        .btn-gold { background:var(--gold); color:var(--ink); }
        .btn-gold:hover { background:#e5a72f; }
        .btn-dark { background:var(--green); color:#fff; }
        .btn-dark:hover { background:#3a100f; }

        /* ── Gallery grid ── */
        .gallery-grid { display:grid; grid-template-columns:repeat(12,1fr); gap:16px; }
        .gallery-item { grid-column:span 4; border-radius:6px; overflow:hidden; background:var(--sand); border:1px solid var(--line); }
        .gallery-item:nth-child(1) { grid-column:span 7; grid-row:span 2; }
        .gallery-item:nth-child(2) { grid-column:span 5; }
        .gallery-item:nth-child(3) { grid-column:span 5; }
        .gallery-media { position:relative; display:block; height:280px; overflow:hidden; background:#17110f; cursor:zoom-in; }
        .gallery-item:nth-child(1) .gallery-media { height:520px; }
        .gallery-media img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .35s ease; }
        .gallery-media:hover img { transform:scale(1.04); }
        .gallery-play { position:absolute; left:50%; top:50%; width:56px; height:56px; transform:translate(-50%,-50%); display:grid; place-items:center; border-radius:50%; background:rgba(255,194,71,.95); color:var(--ink); font-size:22px; padding-left:3px; box-shadow:0 4px 16px rgba(0,0,0,.25); }
        .gallery-caption { padding:14px 16px; }
        .gallery-caption h3 { font:600 15px Inter,sans-serif; color:var(--green); margin-bottom:4px; }
        .gallery-caption p { font:13px Inter,sans-serif; color:var(--muted); margin:0; }

        /* ── Sand ── */
        .sand { background:var(--sand); }

        /* ── Newsletter ── */
        .newsletter-form { display:flex; gap:10px; max-width:500px; }
        .newsletter-form input { flex:1; padding:14px 15px; border:1px solid var(--line); border-radius:4px; font:15px Inter,sans-serif; color:var(--ink); }
        .newsletter-form button { border:0; padding:14px 20px; background:var(--red); color:#fff; font:600 12px Inter,sans-serif; text-transform:uppercase; letter-spacing:.08em; border-radius:4px; cursor:pointer; }

        /* ── Footer ── */
        footer { padding:32px 5vw; background:#351312; color:#eadcca; display:flex; justify-content:space-between; align-items:center; font:12px Inter,sans-serif; }
        .footer-links { display:flex; gap:20px; }
        .footer-links a:hover { color:var(--gold); }
        .lightbox { position:fixed; inset:0; z-index:300; display:grid; place-items:center; padding:30px; background:rgba(20,12,10,.92); opacity:0; pointer-events:none; transition:opacity .2s ease; }
        .lightbox.is-open { opacity:1; pointer-events:auto; }
        .lightbox img { max-width:min(1200px, 92vw); max-height:84vh; object-fit:contain; box-shadow:0 10px 40px rgba(0,0,0,.4); }
        .lightbox-close { position:absolute; top:20px; right:24px; border:0; background:none; color:#fff; font-size:36px; line-height:1; cursor:pointer; }

        /* ── Responsive ── */
        @media(max-width:900px) {
            .topbar { display:none; }
            header { flex-wrap:wrap; gap:12px; }
            nav { display:none; }
            .menu-btn { display:block; }
            nav.open { display:flex; flex-direction:column; align-items:flex-start; width:100%; gap:4px; }
            .nav-dropdown .dropdown-menu { position:static; box-shadow:none; border:0; padding:0 0 0 16px; }
            .grid-3, .gallery-grid { grid-template-columns:1fr; }
            .gallery-item, .gallery-item:nth-child(1), .gallery-item:nth-child(2), .gallery-item:nth-child(3) { grid-column:span 1; grid-row:auto; }
            .gallery-media, .gallery-item:nth-child(1) .gallery-media { height:280px; }
            footer { flex-direction:column; gap:12px; text-align:center; }
        }
    </style>
</head>
<body>
    @include('partials._nav', ['locale' => $locale ?? 'fr', 'section' => $section])

    <div class="masthead">
        <h1>{{ __('site.'.$section.'_h1') }}</h1>
        <div class="breadcrumb">
            <a href="{{ $en ? route('english') : url('/') }}">{{ __('site.home_link') }}</a> ›
            <a href="{{ $en ? route('english.news') : route('news.index') }}">{{ __('site.nav_news') }}</a>
            › {{ __('site.'.$section.'_breadcrumb') }}
        </div>
    </div>

    <main>
        @if(session('success'))
            <section><p class="lead" style="color:#31501f; background:#e7f0d7; padding:16px 20px; border-radius:4px;">{{ session('success') }}</p></section>
        @endif

        {{-- Sub-nav commun à toutes les pages Actualités & Médias --}}
        <section style="padding-bottom:0;">
            <div class="sub-nav">
                <a href="{{ $en ? route('english.news') : route('news.index') }}" {{ $section === 'news' ? 'class=active' : '' }}>{{ __('site.subnav_news') }}</a>
                <a href="{{ $en ? route('english.press') : route('press') }}" {{ $section === 'press' ? 'class=active' : '' }}>{{ __('site.subnav_press') }}</a>
                <a href="{{ $en ? route('english.gallery') : route('gallery') }}" {{ $section === 'gallery' ? 'class=active' : '' }}>{{ __('site.subnav_gallery') }}</a>
                <a href="{{ $en ? route('english.reports') : route('reports') }}" {{ in_array($section, ['reports','publications']) ? 'class=active' : '' }}>{{ __('site.subnav_reports') }}</a>
                <a href="{{ $en ? route('english.press.contact') : route('press.contact') }}">{{ __('site.subnav_press_contact') }}</a>
            </div>
        </section>

        @if(view()->exists('resources.' . $section))
            @include('resources.' . $section)
        @else
        @if($section === 'partners')
        <section>
            <p class="lead">{{ $en ? 'Our institutional and technical partners contribute to mining development rooted in Burkina Faso\'s priorities.' : 'Nos partenaires institutionnels et techniques contribuent à un développement minier ancré dans les priorités du Burkina Faso.' }}</p>
            <div class="grid-3">
                @forelse($partners as $partner)
                <article class="card">
                    <div class="card-tag">{{ $partner->category ?? 'Partenaire' }}</div>
                    <h3>{{ $partner->name }}</h3>
                    <p>Partenaire institutionnel de Néré Mining.</p>
                    @if($partner->website_url)
                        <a class="btn btn-gold" style="margin-top:16px;" href="{{ $partner->website_url }}" target="_blank" rel="noopener">Voir le site</a>
                    @endif
                </article>
                @empty
                <p class="lead" style="grid-column:span 3;">Les partenaires seront publiés prochainement.</p>
                @endforelse
            </div>
        </section>

        @elseif($section === 'gallery')
        <section>
            <p class="lead">{{ __('site.gallery_lead') }}</p>
            @if($media->isEmpty())
                <p class="lead">{{ __('site.gallery_empty') }}</p>
            @else
                <div class="gallery-grid">
                    @foreach($media as $item)
                    <figure class="gallery-item">
                        @if($item->type === 'youtube')
                            <a class="gallery-media" href="{{ $item->external_url }}" target="_blank" rel="noopener" aria-label="Voir {{ $item->title }}"><img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}"><span class="gallery-play" aria-hidden="true">▶</span></a>
                        @elseif($item->type === 'google_drive')
                            <a class="gallery-media" href="{{ $item->external_url }}" target="_blank" rel="noopener" aria-label="Ouvrir {{ $item->title }}"><div style="height:100%;display:grid;place-items:center;color:#fff;font:600 13px Inter,sans-serif;letter-spacing:.08em;text-transform:uppercase;">Google Drive ↗</div></a>
                        @elseif($item->url)
                            <a class="gallery-media" href="{{ $item->url }}" data-lightbox-src="{{ $item->url }}" data-lightbox-alt="{{ $item->title }}" aria-label="Agrandir {{ $item->title }}"><img src="{{ $item->url }}" alt="{{ $item->title }}"></a>
                        @endif
                        <figcaption class="gallery-caption">
                            <h3>{{ $item->title }}</h3>
                            @if($item->caption)<p>{{ $item->caption }}</p>@endif
                        </figcaption>
                    </figure>
                    @endforeach
                </div>
            @endif
        </section>

        @elseif($section === 'press')
        <section>
            <p class="lead">{{ __('site.press_lead') }}</p>
            <div class="grid-3">
                @forelse($documents as $document)
                <article class="card">
                    <div class="card-tag">{{ $document->document_type }}</div>
                    <h3>{{ $document->title }}</h3>
                    @if($document->description)<p>{{ $document->description }}</p>@endif
                    @if($document->file_path)
                        <a class="btn btn-gold" style="margin-top:16px; display:inline-block;" href="{{ asset($document->file_path) }}">{{ __('site.download_pdf') }}</a>
                    @endif
                </article>
                @empty
                <p class="lead" style="grid-column:span 3;">{{ __('site.press_empty') }}</p>
                @endforelse
            </div>
        </section>
        @endif
        @endif

        {{-- Newsletter --}}
        <section class="sand">
            <h2>{{ __('site.newsletter_h2') }}</h2>
            <p class="lead">{{ __('site.newsletter_lead') }}</p>
            <form class="newsletter-form" method="POST" action="{{ $en ? route('english.newsletter.store') : route('newsletter.store') }}">
                @csrf
                <input type="email" name="email" placeholder="{{ __('site.newsletter_email') }}" required>
                <button type="submit">{{ __('site.subscribe') }}</button>
            </form>
        </section>
    </main>

@include('partials._footer', ['loc' => $loc, 'en' => $en])

    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Image agrandie">
        <button class="lightbox-close" type="button" aria-label="Fermer">&times;</button>
        <img src="" alt="">
    </div>

    <script>
        document.querySelector('.menu-btn')?.addEventListener('click', function() {
            this.closest('header').querySelector('nav').classList.toggle('open');
        });

        const lightbox = document.getElementById('lightbox');
        const lightboxImage = lightbox?.querySelector('img');
        const closeLightbox = () => {
            lightbox?.classList.remove('is-open');
            if (lightboxImage) lightboxImage.src = '';
        };

        document.querySelectorAll('[data-lightbox-src]').forEach(function (trigger) {
            trigger.addEventListener('click', function (event) {
                event.preventDefault();
                if (!lightbox || !lightboxImage) return;
                lightboxImage.src = this.dataset.lightboxSrc;
                lightboxImage.alt = this.dataset.lightboxAlt || '';
                lightbox.classList.add('is-open');
            });
        });
        lightbox?.querySelector('.lightbox-close')?.addEventListener('click', closeLightbox);
        lightbox?.addEventListener('click', function (event) {
            if (event.target === lightbox) closeLightbox();
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeLightbox();
        });
    </script>
</body>
</html>
