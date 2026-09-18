@php
    $loc = $locale ?? 'fr';
    $en = $loc === 'en';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale ?? 'fr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album->title }} | Néré Mining</title>
    <meta name="description" content="{{ Str::limit($album->description, 155) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/image-optimization.css') }}">
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
        .nav-lang { margin-left:12px; border:1px solid rgba(255,255,255,.3); border-radius:4px; }

        /* ── Masthead ── */
        .masthead { padding:80px 5vw 60px; color:white; background:linear-gradient(100deg,rgba(75,23,22,.96) 45%,rgba(75,23,22,.55)),url('{{ $album->cover_url ?? asset('images/mining/karma-02.jpg') }}') center/cover; }
        .eyebrow { color:var(--gold); font:600 11px Inter,sans-serif; letter-spacing:.2em; text-transform:uppercase; margin-bottom:14px; }
        h1 { font-size:clamp(32px,5vw,56px); font-weight:700; line-height:1.15; margin-bottom:18px; }
        .lead { font-size:17px; max-width:680px; opacity:.92; line-height:1.7; }

        /* ── Main ── */
        main { padding:70px 5vw; }
        .breadcrumb { margin-bottom:32px; font-size:13px; color:var(--muted); }
        .breadcrumb a { color:var(--green); text-decoration:underline; }
        .breadcrumb a:hover { color:var(--red); }

        /* ── Album Info ── */
        .album-header { margin-bottom:48px; }
        .album-meta-info { display:flex; gap:24px; align-items:center; flex-wrap:wrap; margin-top:16px; font-size:14px; color:var(--muted); }
        .album-meta-info span { display:flex; align-items:center; gap:6px; }
        .album-meta-info svg { width:18px; height:18px; }

        /* ── Photo Grid ── */
        .photo-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:24px; }
        .photo-item { cursor:pointer; border-radius:12px; overflow:hidden; background:white; border:1px solid var(--line); box-shadow:0 2px 8px rgba(0,0,0,.06); transition:transform .3s ease,box-shadow .3s ease; }
        .photo-item:hover { transform:translateY(-4px); box-shadow:0 8px 24px rgba(0,0,0,.12); }
        .photo-img { width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
        .photo-caption { padding:12px 16px; font-size:13px; color:var(--muted); }

        /* ── Lightbox ── */
        .lightbox { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,.95); z-index:9999; align-items:center; justify-content:center; }
        .lightbox.active { display:flex; }
        .lightbox-content { position:relative; max-width:90vw; max-height:90vh; }
        .lightbox-img { max-width:100%; max-height:90vh; display:block; border-radius:8px; }
        .lightbox-close { position:absolute; top:20px; right:20px; background:rgba(255,255,255,.9); border:none; width:48px; height:48px; border-radius:50%; cursor:pointer; font-size:24px; color:var(--ink); display:flex; align-items:center; justify-content:center; transition:transform .2s; }
        .lightbox-close:hover { transform:scale(1.1); background:white; }
        .lightbox-prev, .lightbox-next { position:absolute; top:50%; transform:translateY(-50%); background:rgba(255,255,255,.9); border:none; width:48px; height:48px; border-radius:50%; cursor:pointer; font-size:20px; color:var(--ink); display:flex; align-items:center; justify-content:center; transition:transform .2s; }
        .lightbox-prev:hover, .lightbox-next:hover { transform:translateY(-50%) scale(1.1); background:white; }
        .lightbox-prev { left:20px; }
        .lightbox-next { right:20px; }
        .lightbox-counter { position:absolute; bottom:20px; left:50%; transform:translateX(-50%); background:rgba(255,255,255,.95); padding:8px 20px; border-radius:20px; font-size:13px; font-weight:600; color:var(--ink); }
        .lightbox-caption { position:absolute; bottom:80px; left:50%; transform:translateX(-50%); background:rgba(0,0,0,.8); color:white; padding:12px 24px; border-radius:8px; max-width:80%; text-align:center; font-size:14px; }

        /* ── Footer ── */
        footer { padding:60px 5vw 40px; background:var(--green); color:#fff; text-align:center; }
        footer a { color:var(--gold); text-decoration:underline; }
        footer a:hover { color:#fff; }

        @media (max-width:768px) {
            .photo-grid { grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:16px; }
            .lightbox-prev { left:10px; }
            .lightbox-next { right:10px; }
        }

        @media (prefers-reduced-motion: reduce) {
            body, .masthead, main > section, .photo-item { animation:none !important; transition:none !important; }
        }
    </style>
</head>
<body>

@include('partials._nav', ['section' => 'gallery'])

<div class="masthead">
    <div class="eyebrow">{{ $en ? 'Photo Album' : 'Album Photo' }}</div>
    <h1>{{ $album->title }}</h1>
    @if($album->description)
        <p class="lead">{{ $album->description }}</p>
    @endif
</div>

<main>
    <div class="breadcrumb">
        <a href="{{ $en ? route('english') : route('home') }}">{{ $en ? 'Home' : 'Accueil' }}</a> / 
        <a href="{{ $en ? route('english.gallery') : route('gallery') }}">{{ $en ? 'Media' : 'Médiathèque' }}</a> / 
        <span>{{ $album->title }}</span>
    </div>

    <div class="album-header">
        <div class="album-meta-info">
            <span>
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <path d="M21 15l-5-5L5 21"/>
                </svg>
                {{ $album->publishedMedia->count() }} {{ $album->publishedMedia->count() > 1 ? ($en ? 'photos' : 'photos') : ($en ? 'photo' : 'photo') }}
            </span>
            <span>
                <svg fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                {{ $album->created_at->isoFormat('D MMMM YYYY') }}
            </span>
        </div>
    </div>

    @if($album->publishedMedia->isEmpty())
        <div style="text-align:center;padding:80px 20px;color:var(--muted);">
            <div style="font-size:64px;margin-bottom:16px;">📸</div>
            <h2 style="font-size:24px;margin-bottom:12px;">{{ $en ? 'No photos yet' : 'Aucune photo pour le moment' }}</h2>
            <p>{{ $en ? 'This album is empty.' : 'Cet album est vide.' }}</p>
        </div>
    @else
        <div class="photo-grid">
            @foreach($album->publishedMedia as $media)
                <div class="photo-item" data-lightbox-trigger data-img-src="{{ $media->url }}" data-img-caption="{{ $media->caption ?? $media->title }}">
                    <img src="{{ $media->url }}" alt="{{ $media->title }}" class="photo-img" loading="lazy">
                    @if($media->caption)
                        <div class="photo-caption">{{ $media->caption }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</main>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <div class="lightbox-content">
        <img src="" alt="" class="lightbox-img" id="lightbox-img">
        <button class="lightbox-close" id="lightbox-close" aria-label="Close">×</button>
        <button class="lightbox-prev" id="lightbox-prev" aria-label="Previous">‹</button>
        <button class="lightbox-next" id="lightbox-next" aria-label="Next">›</button>
        <div class="lightbox-counter" id="lightbox-counter"></div>
        <div class="lightbox-caption" id="lightbox-caption" style="display:none;"></div>
    </div>
</div>

@include('partials._footer', ['locale' => $locale])

<script src="{{ asset('js/image-optimization.js') }}"></script>
<script>
(function() {
    'use strict';

    // Lightbox functionality
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    const lightboxCounter = document.getElementById('lightbox-counter');
    const lightboxCaption = document.getElementById('lightbox-caption');
    
    const photos = Array.from(document.querySelectorAll('[data-lightbox-trigger]'));
    let currentIndex = 0;

    function showLightbox(index) {
        if (index < 0 || index >= photos.length) return;
        
        currentIndex = index;
        const photo = photos[index];
        const imgSrc = photo.dataset.imgSrc;
        const caption = photo.dataset.imgCaption;

        lightboxImg.src = imgSrc;
        lightboxImg.alt = caption || '';
        lightboxCounter.textContent = `${index + 1} / ${photos.length}`;
        
        if (caption) {
            lightboxCaption.textContent = caption;
            lightboxCaption.style.display = 'block';
        } else {
            lightboxCaption.style.display = 'none';
        }

        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function showNext() {
        showLightbox((currentIndex + 1) % photos.length);
    }

    function showPrev() {
        showLightbox((currentIndex - 1 + photos.length) % photos.length);
    }

    // Event listeners
    photos.forEach((photo, index) => {
        photo.addEventListener('click', () => showLightbox(index));
    });

    lightboxClose.addEventListener('click', closeLightbox);
    lightboxNext.addEventListener('click', showNext);
    lightboxPrev.addEventListener('click', showPrev);

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('active')) return;
        
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') showNext();
        if (e.key === 'ArrowLeft') showPrev();
    });

    // Nav dropdown toggle
    document.querySelectorAll('.nav-dropdown > .nav-link').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const parent = this.parentElement;
            const wasOpen = parent.classList.contains('is-open');
            document.querySelectorAll('.nav-dropdown').forEach(d => d.classList.remove('is-open'));
            if (!wasOpen) parent.classList.add('is-open');
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.nav-dropdown')) {
            document.querySelectorAll('.nav-dropdown').forEach(d => d.classList.remove('is-open'));
        }
    });

    console.log('✓ Album lightbox loaded with', photos.length, 'photos');
})();
</script>
</body>
</html>
