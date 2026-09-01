<?php
    $en = ($locale ?? 'fr') === 'en';
    $sec = $section ?? '';
    $isNews    = in_array($sec, ['news','press','gallery','reports','press-contact']);
    $isSustain = in_array($sec, ['sustainability','communities','environment','hse','local-content']);
    $isCompany = in_array($sec, ['company','company-ceo','company-identity','company-history','company-values','company-governance']);
    $contactUrl = $en ? route('english.contact') : route('contact');
?>

<?php if (! $__env->hasRenderedOnce('afe38be5-a8fb-4c24-87ad-d5344060e140')): $__env->markAsRenderedOnce('afe38be5-a8fb-4c24-87ad-d5344060e140'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/chrome.css')); ?>">
<?php endif; ?>

<header class="site-header">
    <div class="site-header__bar">
        <a class="site-logo" href="<?php echo e($en ? route('english') : url('/')); ?>">
            <img src="<?php echo e(asset('images/logo-nere.png')); ?>" alt="Néré Mining">
        </a>

        <button class="site-menu-btn" type="button" aria-label="<?php echo e($en ? 'Open menu' : 'Ouvrir le menu'); ?>" aria-expanded="false" data-site-menu>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
            </svg>
            Menu
        </button>

        <nav class="site-nav" data-site-nav>
            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link <?php echo e($isCompany ? 'is-active' : ''); ?>"
                   href="<?php echo e($en ? route('english.company') : route('company')); ?>">
                    <?php echo e(__('site.nav_company')); ?>

                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                    <a href="<?php echo e($en ? route('english.company.ceo') : route('company.ceo')); ?>"
                       class="<?php echo e($sec === 'company-ceo' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_company_ceo')); ?></a>
                    <a href="<?php echo e($en ? route('english.company.identity') : route('company.identity')); ?>"
                       class="<?php echo e($sec === 'company-identity' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_company_identity')); ?></a>
                    <a href="<?php echo e($en ? route('english.company.history') : route('company.history')); ?>"
                       class="<?php echo e($sec === 'company-history' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_company_history')); ?></a>
                    <a href="<?php echo e($en ? route('english.company.values') : route('company.values')); ?>"
                       class="<?php echo e($sec === 'company-values' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_company_values')); ?></a>
                    <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>"
                       class="<?php echo e($sec === 'company-governance' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_company_governance')); ?></a>
                </div>
            </span>

            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link <?php echo e(in_array($sec, ['karma','resources','reserves']) ? 'is-active' : ''); ?>"
                   href="<?php echo e($en ? route('english.karma') : route('karma')); ?>">
                    <?php echo e(__('site.nav_karma')); ?>

                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                    <a href="<?php echo e($en ? route('english.resources') : route('resources')); ?>"
                       class="<?php echo e($sec === 'resources' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_karma_resources')); ?></a>
                    <a href="<?php echo e($en ? route('english.reserves') : route('reserves')); ?>"
                       class="<?php echo e($sec === 'reserves' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_karma_reserves')); ?></a>
                </div>
            </span>

            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link <?php echo e(in_array($sec, ['projects','cil-project']) ? 'is-active' : ''); ?>"
                   href="<?php echo e($en ? route('english.projects') : route('projects')); ?>">
                    <?php echo e(__('site.nav_projects')); ?>

                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                    <a href="<?php echo e($en ? route('english.projects.cil') : route('projects.cil')); ?>"
                       class="<?php echo e($sec === 'cil-project' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_projects_cil')); ?></a>
                    <a href="<?php echo e(($en ? route('english.projects') : route('projects')) . '#exploration'); ?>"><?php echo e(__('site.nav_projects_exploration')); ?></a>
                </div>
            </span>

            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link <?php echo e($isSustain ? 'is-active' : ''); ?>"
                   href="<?php echo e($en ? route('english.sustainability') : route('sustainability')); ?>">
                    <?php echo e(__('site.nav_sustainability')); ?>

                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                    <a href="<?php echo e($en ? route('english.communities') : route('sustainability.communities')); ?>"
                       class="<?php echo e($sec === 'communities' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_communities')); ?></a>
                    <a href="<?php echo e($en ? route('english.environment') : route('sustainability.environment')); ?>"
                       class="<?php echo e($sec === 'environment' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_environment')); ?></a>
                    <a href="<?php echo e($en ? route('english.hse') : route('sustainability.hse')); ?>"
                       class="<?php echo e($sec === 'hse' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_hse')); ?></a>
                    <a href="<?php echo e($en ? route('english.local-content') : route('sustainability.local-content')); ?>"
                       class="<?php echo e($sec === 'local-content' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_local_content')); ?></a>
                </div>
            </span>

            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link <?php echo e($isNews ? 'is-active' : ''); ?>"
                   href="<?php echo e($en ? route('english.news') : route('news.index')); ?>">
                    <?php echo e(__('site.nav_news')); ?>

                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                    <a href="<?php echo e($en ? route('english.news') : route('news.index')); ?>"
                       class="<?php echo e($sec === 'news' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_news_list')); ?></a>
                    <a href="<?php echo e($en ? route('english.press') : route('press')); ?>"
                       class="<?php echo e($sec === 'press' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_press')); ?></a>
                    <a href="<?php echo e($en ? route('english.gallery') : route('gallery')); ?>"
                       class="<?php echo e($sec === 'gallery' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_gallery')); ?></a>
                    <a href="<?php echo e($en ? route('english.reports') : route('reports')); ?>"
                       class="<?php echo e($sec === 'reports' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_reports')); ?></a>
                    <a href="<?php echo e($en ? route('english.press.contact') : route('press.contact')); ?>"
                       class="<?php echo e($sec === 'press-contact' ? 'is-current' : ''); ?>"><?php echo e(__('site.nav_press_contact')); ?></a>
                </div>
            </span>

            <a class="site-nav__link <?php echo e($sec === 'careers' ? 'is-active' : ''); ?>"
               href="<?php echo e($en ? route('english.careers') : route('careers')); ?>">
                <?php echo e(__('site.nav_careers')); ?>

            </a>

            <div class="site-nav__actions">
                <a class="site-nav__lang" href="<?php echo e($en ? url('/') : route('english')); ?>">
                    <?php echo e(__('site.lang_switch')); ?>

                </a>
                <a class="site-btn" href="<?php echo e($contactUrl); ?>">
                    <?php echo e($en ? 'Contact us' : 'Nous contacter'); ?>

                </a>
            </div>
        </nav>
    </div>
</header>

<script>
(function () {
    var header = document.querySelector('.site-header');
    if (!header || header.dataset.bound === '1') return;
    header.dataset.bound = '1';

    var nav = header.querySelector('[data-site-nav]');
    var btn = header.querySelector('[data-site-menu]');
    var dropdowns = header.querySelectorAll('[data-dropdown]');
    var CLOSE_DELAY = 160;

    dropdowns.forEach(function (dd) {
        var timer = null;
        function open() {
            clearTimeout(timer);
            dropdowns.forEach(function (other) {
                if (other !== dd) other.classList.remove('is-open');
            });
            dd.classList.add('is-open');
        }
        function scheduleClose() {
            clearTimeout(timer);
            timer = setTimeout(function () { dd.classList.remove('is-open'); }, CLOSE_DELAY);
        }
        dd.addEventListener('mouseenter', open);
        dd.addEventListener('mouseleave', scheduleClose);
        dd.addEventListener('focusin', open);
        dd.addEventListener('focusout', scheduleClose);
        var parentLink = dd.querySelector('.site-nav__link');
        if (parentLink) {
            parentLink.addEventListener('click', function (e) {
                if (window.matchMedia('(max-width: 1080px)').matches) {
                    e.preventDefault();
                    dd.classList.toggle('is-open');
                }
            });
        }
    });

    if (btn && nav) {
        btn.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    }

    document.addEventListener('click', function (e) {
        if (!header.contains(e.target)) {
            dropdowns.forEach(function (dd) { dd.classList.remove('is-open'); });
            if (nav) nav.classList.remove('is-open');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            dropdowns.forEach(function (dd) { dd.classList.remove('is-open'); });
            if (nav) nav.classList.remove('is-open');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        }
    });
})();
</script>
<?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/partials/_nav.blade.php ENDPATH**/ ?>