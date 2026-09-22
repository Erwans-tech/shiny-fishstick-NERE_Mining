<?php
    $loc = $locale ?? 'fr';
    $en = $loc === 'en';
?>
<!DOCTYPE html>
<html lang="<?php echo e($locale ?? 'fr'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('site.'.$section.'_h1')); ?> | Néré Mining</title>
    <meta name="description" content="<?php echo e(__('site.'.$section.'_lead')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <?php if($section === 'gallery'): ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/album-carousel.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/image-optimization.css')); ?>">
    <?php endif; ?>
    
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
        @media (prefers-reduced-motion: reduce) and (min-width: 99999px) { body, .masthead, main > section { animation:none; } }
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
        .masthead { padding:100px 5vw 80px; color:white; background:linear-gradient(100deg,rgba(75,23,22,.96) 45%,rgba(75,23,22,.55)),url('<?php echo e(asset('images/mining/karma-02.jpg')); ?>') center/cover; }
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
        .gallery-grid { 
            display: grid; 
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-top: 32px;
        }
        .gallery-item { 
            position: relative;
            border-radius: 8px; 
            overflow: hidden; 
            background: #17110f; 
            border: 1px solid var(--line);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .gallery-item:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 16px 32px rgba(0,0,0,0.18);
            border-color: var(--gold);
            z-index: 10;
        }
        .gallery-media { 
            position: relative; 
            display: block; 
            height: 100%;
            width: 100%;
            overflow: hidden;
            background: #17110f; 
        }
        .gallery-media img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            display: block; 
            transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1), filter 0.3s;
        }
        .gallery-media:hover img { 
            transform: scale(1.08);
            filter: brightness(1.05);
        }
        /* Layout dynamique avec tailles variées */
        .gallery-item:nth-child(1) { 
            grid-column: span 2;
            grid-row: span 2;
        }
        .gallery-item:nth-child(2) { 
            grid-column: span 1;
            grid-row: span 1;
        }
        .gallery-item:nth-child(3) { 
            grid-column: span 1;
            grid-row: span 1;
        }
        .gallery-item:nth-child(4) { 
            grid-column: span 1;
            grid-row: span 2;
        }
        .gallery-item:nth-child(5) { 
            grid-column: span 1;
            grid-row: span 1;
        }
        .gallery-item:nth-child(6) { 
            grid-column: span 2;
            grid-row: span 1;
        }
        .gallery-item:nth-child(7) { 
            grid-column: span 1;
            grid-row: span 1;
        }
        .gallery-item:nth-child(8) { 
            grid-column: span 1;
            grid-row: span 2;
        }
        .gallery-item:nth-child(9) { 
            grid-column: span 1;
            grid-row: span 1;
        }
        .gallery-item:nth-child(10) { 
            grid-column: span 2;
            grid-row: span 1;
        }
        .gallery-item:nth-child(11) { 
            grid-column: span 1;
            grid-row: span 1;
        }
        .gallery-item:nth-child(12) { 
            grid-column: span 1;
            grid-row: span 1;
        }
        .gallery-item:nth-child(13) { 
            grid-column: span 2;
            grid-row: span 2;
        }
        .gallery-item:nth-child(14) { 
            grid-column: span 1;
            grid-row: span 1;
        }
        .gallery-item:nth-child(15) { 
            grid-column: span 1;
            grid-row: span 1;
        }
        .gallery-caption { 
            display: none;
        }

        /* ── Sand ── */
        .sand { background:var(--sand); }

        /* ── Newsletter ── */
        .newsletter-section {
            position:relative; isolation:isolate; overflow:hidden;
            padding:64px 5vw 68px; background:linear-gradient(125deg,#fff4dc 0%,#f8ead0 58%,#f3dfbd 100%);
            border-top:1px solid rgba(229,167,47,.25); border-bottom:1px solid rgba(75,23,22,.08);
        }
        .newsletter-section::before {
            content:''; position:absolute; z-index:-1; width:420px; height:420px; right:-130px; top:-230px;
            border:1px solid rgba(229,167,47,.32); border-radius:50%; box-shadow:0 0 0 24px rgba(229,167,47,.05),0 0 0 48px rgba(229,167,47,.035);
        }
        .newsletter-section::after {
            content:''; position:absolute; z-index:-1; left:5vw; bottom:0; width:110px; height:4px;
            background:linear-gradient(90deg,var(--green),var(--gold),transparent);
        }
        .newsletter-inner { max-width:1120px; margin:0 auto; display:grid; grid-template-columns:minmax(0,1fr) minmax(380px,500px); gap:56px; align-items:center; }
        .newsletter-copy h2 { max-width:660px; color:var(--green); font-size:clamp(28px,4vw,46px); line-height:1.08; font-weight:500; letter-spacing:-.02em; }
        .newsletter-copy .lead { max-width:620px; margin-top:14px; color:var(--muted); font-size:16px; line-height:1.65; }
        .newsletter-form { display:flex; gap:10px; width:100%; max-width:500px; padding:8px; background:rgba(255,255,255,.72); border:1px solid rgba(75,23,22,.12); border-radius:8px; box-shadow:0 14px 30px rgba(75,23,22,.08); }
        .newsletter-form input { min-width:0; flex:1; padding:14px 15px; border:1px solid transparent; border-radius:4px; background:#fff; font:15px Inter,sans-serif; color:var(--ink); outline:none; transition:border-color .2s,box-shadow .2s; }
        .newsletter-form input:focus { border-color:var(--gold2); box-shadow:0 0 0 3px rgba(229,167,47,.16); }
        .newsletter-form button { flex:0 0 auto; border:0; padding:14px 20px; background:var(--red); color:#fff; font:600 12px Inter,sans-serif; text-transform:uppercase; letter-spacing:.08em; border-radius:4px; cursor:pointer; transition:background .2s,transform .2s,box-shadow .2s; }
        .newsletter-form button:hover { background:var(--green); transform:translateY(-2px); box-shadow:0 8px 18px rgba(75,23,22,.18); }

        /* ── Footer ── */
        footer { padding:32px 5vw; background:#351312; color:#eadcca; display:flex; justify-content:space-between; align-items:center; font:12px Inter,sans-serif; }
        .footer-links { display:flex; gap:20px; }
        .footer-links a:hover { color:var(--gold); }
        .lightbox { 
            position:fixed; inset:0; z-index:300; display:grid; place-items:center; padding:30px; 
            background:rgba(20,12,10,.95); backdrop-filter:blur(4px);
            opacity:0; pointer-events:none; transition:opacity .3s ease; 
        }
        .lightbox.is-open { opacity:1; pointer-events:auto; }
        .lightbox img { 
            max-width:min(1200px, 92vw); max-height:84vh; object-fit:contain; 
            box-shadow:0 10px 40px rgba(0,0,0,.4);
            animation: zoomIn 0.3s ease;
        }
        @keyframes zoomIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .lightbox-close { 
            position:absolute; top:20px; right:24px; border:0; background:none; 
            color:#fff; font-size:36px; line-height:1; cursor:pointer;
            transition: all 0.2s;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .lightbox-close:hover { 
            background: rgba(255,255,255,0.1);
            transform: rotate(90deg);
        }
        .lightbox-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-size: 32px;
            padding: 12px 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.2s;
            z-index: 301;
        }
        .lightbox-nav:hover {
            background: rgba(255,255,255,0.25);
            transform: translateY(-50%) scale(1.1);
        }
        .lightbox-prev { left: 20px; }
        .lightbox-next { right: 20px; }
        .lightbox-counter {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255,255,255,0.7);
            font-size: 14px;
            font-weight: 600;
            background: rgba(0,0,0,0.4);
            padding: 8px 16px;
            border-radius: 20px;
        }

        /* ── Responsive ── */
        @media(max-width:900px) {
            .topbar { display:none; }
            header { flex-wrap:wrap; gap:12px; }
            nav { display:none; }
            .menu-btn { display:block; }
            nav.open { display:flex; flex-direction:column; align-items:flex-start; width:100%; gap:4px; }
            .nav-dropdown .dropdown-menu { position:static; box-shadow:none; border:0; padding:0 0 0 16px; }
            .grid-3 { grid-template-columns:1fr; }
            .gallery-grid { 
                grid-template-columns: repeat(2, 1fr); 
                gap:12px; 
            }
            .gallery-item,
            .gallery-item:nth-child(1),
            .gallery-item:nth-child(4),
            .gallery-item:nth-child(6),
            .gallery-item:nth-child(8),
            .gallery-item:nth-child(10),
            .gallery-item:nth-child(13) { 
                grid-column: span 1; 
                grid-row: span 1;
            }
            .gallery-media, .gallery-item:nth-child(1) .gallery-media { height:auto; min-height:200px; }
            .newsletter-inner { grid-template-columns:1fr; gap:28px; }
            .newsletter-form { max-width:none; }
            footer { flex-direction:column; gap:12px; text-align:center; }
        }
        @media(max-width:520px) {
            .gallery-grid { 
                grid-template-columns: 1fr;
            }
            .newsletter-section { padding:48px 5vw 52px; }
            .newsletter-form { flex-direction:column; }
            .newsletter-form button { width:100%; }
        }
    </style>
</head>
<body>
    <?php echo $__env->make('partials._nav', ['locale' => $locale ?? 'fr', 'section' => $section], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="masthead">
        <h1><?php echo e(__('site.'.$section.'_h1')); ?></h1>
    </div>

    <main>
        <?php if(session('success')): ?>
            <section><p class="lead" style="color:#31501f; background:#e7f0d7; padding:16px 20px; border-radius:4px;"><?php echo e(session('success')); ?></p></section>
        <?php endif; ?>

        
        <section style="padding-bottom:0;">
        </section>

        <?php if(view()->exists('resources.' . $section)): ?>
            <?php echo $__env->make('resources.' . $section, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php else: ?>
        <?php if($section === 'partners'): ?>
        <section>
            <p class="lead"><?php echo e($en ? 'Our institutional and technical partners contribute to mining development rooted in Burkina Faso\'s priorities.' : 'Nos partenaires institutionnels et techniques contribuent à un développement minier ancré dans les priorités du Burkina Faso.'); ?></p>
            <div class="grid-3">
                <?php $__empty_1 = true; $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="card">
                    <?php if(isset($partner->logo_path) && $partner->logo_path): ?>
                        <img class="card-img" src="<?php echo e(asset($partner->logo_path)); ?>" alt="Logo <?php echo e($partner->name); ?>" loading="lazy" style="object-fit:contain; background:#fff; padding:20px;">
                    <?php endif; ?>
                    <div class="card-tag"><?php echo e($partner->category ?? ($en ? 'Partner' : 'Partenaire')); ?></div>
                    <h3><?php echo e($partner->name); ?></h3>
                    <p><?php echo e($en ? 'Institutional partner of Néré Mining.' : 'Partenaire institutionnel de Néré Mining.'); ?></p>
                    <?php if(isset($partner->website_url) && $partner->website_url): ?>
                        <a class="btn btn-gold" style="margin-top:16px;" href="<?php echo e($partner->website_url); ?>" target="_blank" rel="noopener"><?php echo e($en ? 'Visit website' : 'Voir le site'); ?></a>
                    <?php endif; ?>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="lead" style="grid-column:span 3;"><?php echo e($en ? 'Partners will be published shortly.' : 'Les partenaires seront publiés prochainement.'); ?></p>
                <?php endif; ?>
            </div>
        </section>

        <?php elseif($section === 'gallery'): ?>
        <section>
            <p class="lead"><?php echo e(__('site.gallery_lead')); ?></p>
            <div class="gallery-grid" id="gallery-grid">
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/image-8-min-scaled.jpg" data-lightbox-src="/images/gallery/image-8-min-scaled.jpg">
                        <img src="/images/gallery/image-8-min-scaled.jpg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/img1.jpeg" data-lightbox-src="/images/gallery/img1.jpeg">
                        <img src="/images/gallery/img1.jpeg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/img2.jpeg" data-lightbox-src="/images/gallery/img2.jpeg">
                        <img src="/images/gallery/img2.jpeg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/img3.jpeg" data-lightbox-src="/images/gallery/img3.jpeg">
                        <img src="/images/gallery/img3.jpeg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/IMG_5184-1.jpg" data-lightbox-src="/images/gallery/IMG_5184-1.jpg">
                        <img src="/images/gallery/IMG_5184-1.jpg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/IMG_5187.jpg" data-lightbox-src="/images/gallery/IMG_5187.jpg">
                        <img src="/images/gallery/IMG_5187.jpg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/IMG_5188.jpg" data-lightbox-src="/images/gallery/IMG_5188.jpg">
                        <img src="/images/gallery/IMG_5188.jpg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/Impact-positif-sur-lenvironnemnet-min-scaled-e1730914496421.webp" data-lightbox-src="/images/gallery/Impact-positif-sur-lenvironnemnet-min-scaled-e1730914496421.webp">
                        <img src="/images/gallery/Impact-positif-sur-lenvironnemnet-min-scaled-e1730914496421.webp" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/karma1.jpg" data-lightbox-src="/images/gallery/karma1.jpg">
                        <img src="/images/gallery/karma1.jpg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/karma123-min-1.jpg" data-lightbox-src="/images/gallery/karma123-min-1.jpg">
                        <img src="/images/gallery/karma123-min-1.jpg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/karma2-min.jpg" data-lightbox-src="/images/gallery/karma2-min.jpg">
                        <img src="/images/gallery/karma2-min.jpg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/karmareboi.jpg" data-lightbox-src="/images/gallery/karmareboi.jpg">
                        <img src="/images/gallery/karmareboi.jpg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/WhatsApp-Image-2024-07-11-at-04.22.32-2.jpeg" data-lightbox-src="/images/gallery/WhatsApp-Image-2024-07-11-at-04.22.32-2.jpeg">
                        <img src="/images/gallery/WhatsApp-Image-2024-07-11-at-04.22.32-2.jpeg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.26.jpeg" data-lightbox-src="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.26.jpeg">
                        <img src="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.26.jpeg" alt="Gallery image">
                    </a>
                </figure>
                <figure class="gallery-item">
                    <a class="gallery-media" href="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.27.jpeg" data-lightbox-src="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.27.jpeg">
                        <img src="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.27.jpeg" alt="Gallery image">
                    </a>
                </figure>
            </div>
        </section>

        <?php elseif($section === 'press'): ?>
        <section>
            <p class="lead"><?php echo e(__('site.press_lead')); ?></p>
            <div class="grid-3">
                <?php $__empty_1 = true; $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="card">
                    <div class="card-tag"><?php echo e($document->document_type); ?></div>
                    <h3><?php echo e($document->title); ?></h3>
                    <?php if($document->description): ?><p><?php echo e($document->description); ?></p><?php endif; ?>
                    <?php if($document->file_path): ?>
                        <a class="btn btn-gold" style="margin-top:16px; display:inline-block;" href="<?php echo e(asset($document->file_path)); ?>"><?php echo e(__('site.download_pdf')); ?></a>
                    <?php endif; ?>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="lead" style="grid-column:span 3;"><?php echo e(__('site.press_empty')); ?></p>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>
        <?php endif; ?>

        
        <section class="newsletter-section">
            <div class="newsletter-inner">
                <div class="newsletter-copy">
                    
                    <p class="lead"><?php echo e(__('site.newsletter_lead')); ?></p>
                </div>
                <form class="newsletter-form" method="POST" action="<?php echo e($en ? route('english.newsletter.store') : route('newsletter.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" placeholder="<?php echo e(__('site.newsletter_email')); ?>" required>
                    <button type="submit"><?php echo e(__('site.subscribe')); ?></button>
                </form>
            </div>
        </section>
    </main>

<?php echo $__env->make('partials._footer', ['loc' => $loc, 'en' => $en], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Image agrandie">
        <button class="lightbox-close" type="button" aria-label="<?php echo e($en ? 'Close' : 'Fermer'); ?>">&times;</button>
        <button class="lightbox-nav lightbox-prev" type="button" aria-label="<?php echo e($en ? 'Previous' : 'Précédent'); ?>">&#8249;</button>
        <img src="" alt="">
        <button class="lightbox-nav lightbox-next" type="button" aria-label="<?php echo e($en ? 'Next' : 'Suivant'); ?>">&#8250;</button>
        <div class="lightbox-counter">
            <span id="lightbox-current">1</span> / <span id="lightbox-total">1</span>
        </div>
    </div>

    <script>
        document.querySelector('.menu-btn')?.addEventListener('click', function() {
            this.closest('header').querySelector('nav').classList.toggle('open');
        });

        const lightbox = document.getElementById('lightbox');
        const lightboxImage = lightbox?.querySelector('img');
        const lightboxClose = lightbox?.querySelector('.lightbox-close');
        const lightboxPrev = lightbox?.querySelector('.lightbox-prev');
        const lightboxNext = lightbox?.querySelector('.lightbox-next');
        const lightboxCurrent = document.getElementById('lightbox-current');
        const lightboxTotal = document.getElementById('lightbox-total');
        
        let allImages = [];
        let currentImageIndex = 0;

        const closeLightbox = () => {
            lightbox?.classList.remove('is-open');
            if (lightboxImage) lightboxImage.src = '';
            document.body.style.overflow = '';
        };

        const openLightbox = () => {
            if (!lightbox || !lightboxImage) return;
            lightboxImage.src = allImages[currentImageIndex];
            lightboxCurrent.textContent = currentImageIndex + 1;
            lightboxTotal.textContent = allImages.length;
            lightbox.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        };

        const nextImage = () => {
            currentImageIndex = (currentImageIndex + 1) % allImages.length;
            openLightbox();
        };

        const prevImage = () => {
            currentImageIndex = (currentImageIndex - 1 + allImages.length) % allImages.length;
            openLightbox();
        };

        // Collect all gallery images
        document.querySelectorAll('[data-lightbox-src]').forEach((trigger, index) => {
            allImages.push(trigger.dataset.lightboxSrc);
            
            trigger.addEventListener('click', function (event) {
                event.preventDefault();
                currentImageIndex = index;
                openLightbox();
            });
        });

        lightboxCurrent.textContent = allImages.length > 0 ? 1 : 0;
        lightboxTotal.textContent = allImages.length;

        lightboxClose?.addEventListener('click', closeLightbox);
        lightboxPrev?.addEventListener('click', prevImage);
        lightboxNext?.addEventListener('click', nextImage);
        
        lightbox?.addEventListener('click', function (event) {
            if (event.target === lightbox) closeLightbox();
        });

        document.addEventListener('keydown', function (event) {
            if (!lightbox?.classList.contains('is-open')) return;
            if (event.key === 'Escape') closeLightbox();
            if (event.key === 'ArrowRight') nextImage();
            if (event.key === 'ArrowLeft') prevImage();
        });
    </script>
    
    <?php if($section === 'gallery'): ?>
    <script src="<?php echo e(asset('js/album-carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('js/image-optimization.js')); ?>"></script>
    <?php endif; ?>
</body>
</html>
<?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\resources.blade.php ENDPATH**/ ?>