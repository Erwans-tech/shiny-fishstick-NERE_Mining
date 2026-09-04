<?php
    $loc = $locale ?? 'fr';
    $en = $loc === 'en';
?>
<!DOCTYPE html>
<html lang="<?php echo e($loc); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($news->title); ?> | Néré Mining</title>
    <meta name="description" content="<?php echo e($news->excerpt ?? $news->title); ?>">
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
        .masthead{padding:100px 5vw 80px;color:white;background:linear-gradient(100deg,rgba(75,23,22,.96) 45%,rgba(75,23,22,.55)),url('<?php echo e($news->image_path ? \App\Helpers\StorageHelper::uploadUrl($news->image_path) : asset('images/mining/karma-01.jpg')); ?>') center/cover;}
        .eyebrow{color:var(--gold);font:600 11px Inter,sans-serif;letter-spacing:.2em;text-transform:uppercase;margin-bottom:14px;}
        h1{max-width:860px;font-size:clamp(32px,5vw,64px);line-height:1.05;font-weight:400;color:#fff;}
        .breadcrumb{margin-top:20px;font:12px Inter,sans-serif;color:rgba(255,255,255,.6);}
        .breadcrumb a{color:var(--gold);}
        .article-wrap{max-width:820px;margin:0 auto;padding:80px 5vw;}
        .article-meta{color:var(--gold);font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.1em;margin-bottom:28px;display:flex;gap:16px;flex-wrap:wrap;}
        .article-meta span{color:var(--muted);font-weight:400;}
        .article-body{font:17px/1.85 Inter,sans-serif;color:var(--ink);}
        .article-body p{margin-bottom:20px;}
        .article-body h2{color:var(--green);font-size:26px;font-weight:500;margin:36px 0 14px;}
        .article-body h3{color:var(--green);font-size:20px;font-weight:500;margin:28px 0 10px;}
        .article-body img{max-width:100%;border-radius:6px;margin:24px 0;}
        .article-cover{width:100%;max-height:480px;object-fit:cover;border-radius:8px;margin-bottom:40px;}
        .back-link{display:inline-flex;align-items:center;gap:8px;color:var(--red);font:600 12px Inter,sans-serif;text-transform:uppercase;letter-spacing:.08em;margin-bottom:32px;}
        .back-link:hover{color:var(--green);}
        .back-link:hover .sa-arrow-hover-left { transform: translateX(-4px); }
        footer{padding:32px 5vw;background:#351312;color:#eadcca;display:flex;justify-content:space-between;align-items:center;font:12px Inter,sans-serif;}
        .footer-links{display:flex;gap:20px;}
        .footer-links a:hover{color:var(--gold);}
        @media(max-width:900px){
            .topbar{display:none;}header{flex-wrap:wrap;gap:12px;}nav{display:none;}.menu-btn{display:block;}
            nav.open{display:flex;flex-direction:column;align-items:flex-start;width:100%;gap:4px;}
            .nav-dropdown .dropdown-menu{position:static;box-shadow:none;border:0;padding:0 0 0 16px;}
            footer{flex-direction:column;gap:12px;text-align:center;}
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('css/sustainability-animations.css')); ?>">
    <script src="<?php echo e(asset('js/sustainability-animations.js')); ?>"></script>
</head>
<body>
    <?php echo $__env->make('partials._nav', ['locale' => $locale ?? 'fr', 'section' => 'news'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="masthead">
        <h1><?php echo e($news->title); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo e($en ? route('english') : url('/')); ?>"><?php echo e(__('site.home_link')); ?></a> ›
            <a href="<?php echo e($en ? route('english.news') : route('news.index')); ?>"><?php echo e(__('site.nav_news')); ?></a> ›
            <a href="<?php echo e($en ? route('english.news') : route('news.index')); ?>"><?php echo e(__('site.subnav_news')); ?></a> ›
            <?php echo e(Str::limit($news->title, 40)); ?>

        </div>
    </div>

    <div class="article-wrap sa-animated-section">
        <div class="sa-particles-container" data-count="2"></div>
        <a class="back-link sa-reveal" href="<?php echo e($en ? route('english.news') : route('news.index')); ?>"><span style="display:inline-block; transition:transform .2s; font-size:14px; margin-right:4px;" class="sa-arrow-hover-left">←</span> <?php echo e(__('site.back_to_news')); ?></a>

        <div class="article-meta sa-reveal sa-delay-1">
            <span><?php echo e($news->published_at?->translatedFormat('d M Y')); ?></span>
            <span><?php echo e($news->category); ?></span>
        </div>

        <?php if($news->image_path): ?>
            <img class="article-cover sa-reveal sa-delay-1" src="<?php echo e(\App\Helpers\StorageHelper::uploadUrl($news->image_path)); ?>" alt="<?php echo e($news->title); ?>">
        <?php endif; ?>

        <div class="article-body sa-reveal sa-delay-2">
            <?php if($news->content): ?>
                <?php echo nl2br(e($news->content)); ?>

            <?php elseif($news->excerpt): ?>
                <p><?php echo e($news->excerpt); ?></p>
            <?php else: ?>
                <p><?php echo e($en ? 'Article content coming soon.' : 'Contenu de l\'article à venir.'); ?></p>
            <?php endif; ?>
        </div>
    </div>

<?php echo $__env->make('partials._footer', ['loc' => $loc, 'en' => $en], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\news\show.blade.php ENDPATH**/ ?>