@php
    $en = ($locale ?? 'fr') === 'en';
    $sec = $section ?? '';
    $isNews    = in_array($sec, ['news','press','gallery','reports','press-contact']);
    $isSustain = in_array($sec, ['sustainability','communities','environment','hse','local-content']);
    $isCompany = in_array($sec, ['company','company-ceo','company-identity','company-history','company-values','company-governance']);
    $contactUrl = $en ? route('english.contact') : route('contact');
@endphp

@once
<link rel="stylesheet" href="{{ asset('css/chrome.css') }}?v={{ filemtime(public_path('css/chrome.css')) }}">
@endonce

<header class="site-header">
    <div class="site-header__bar">
        <a class="site-logo" href="{{ $en ? route('english') : url('/') }}">
            <img src="{{ asset('images/logo-nere.png') }}" alt="Néré Mining">
        </a>

        <button class="site-menu-btn" type="button" aria-label="{{ $en ? 'Open menu' : 'Ouvrir le menu' }}" aria-expanded="false" data-site-menu>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
            </svg>
            Menu
        </button>

        <nav class="site-nav" data-site-nav>
            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link {{ $isCompany ? 'is-active' : '' }}"
                   href="{{ $en ? route('english.company') : route('company') }}">
                    {{ __('site.nav_company') }}
                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                    <a href="{{ $en ? route('english.company.ceo') : route('company.ceo') }}"
                       class="{{ $sec === 'company-ceo' ? 'is-current' : '' }}">{{ __('site.nav_company_ceo') }}</a>
                    <a href="{{ $en ? route('english.company.identity') : route('company.identity') }}"
                       class="{{ $sec === 'company-identity' ? 'is-current' : '' }}">{{ __('site.nav_company_identity') }}</a>
                    <a href="{{ $en ? route('english.company.history') : route('company.history') }}"
                       class="{{ $sec === 'company-history' ? 'is-current' : '' }}">{{ __('site.nav_company_history') }}</a>
                    <a href="{{ $en ? route('english.company.values') : route('company.values') }}"
                       class="{{ $sec === 'company-values' ? 'is-current' : '' }}">{{ __('site.nav_company_values') }}</a>
                    <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}"
                       class="{{ $sec === 'company-governance' ? 'is-current' : '' }}">{{ __('site.nav_company_governance') }}</a>
                </div>
            </span>

            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link {{ in_array($sec, ['karma','karma-exploitation','karma-organisation','karma-modele','karma-impact','resources','reserves']) ? 'is-active' : '' }}"
                   href="{{ $en ? route('english.karma') : route('karma') }}">
                    {{ __('site.nav_karma') }}
                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                          <a href="{{ $en ? route('english.karma') : route('karma') }}"
                              class="{{ $sec === 'karma' ? 'is-current' : '' }}">{{ $en ? 'Overview' : 'Présentation' }}</a>
                          <a href="{{ $en ? route('english.karma.exploitation') : route('karma.exploitation') }}"
                              class="{{ $sec === 'karma-exploitation' ? 'is-current' : '' }}">{{ $en ? 'Operations' : 'Exploitation' }}</a>
                          <a href="{{ $en ? route('english.karma.organisation') : route('karma.organisation') }}"
                              class="{{ $sec === 'karma-organisation' ? 'is-current' : '' }}">{{ $en ? 'Organisation' : 'Organisation' }}</a>
                          <a href="{{ $en ? route('english.karma.modele') : route('karma.modele') }}"
                              class="{{ $sec === 'karma-modele' ? 'is-current' : '' }}">{{ $en ? 'Operating model' : 'Modèle opérationnel' }}</a>
                          <a href="{{ $en ? route('english.karma.impact') : route('karma.impact') }}"
                              class="{{ $sec === 'karma-impact' ? 'is-current' : '' }}">{{ $en ? 'Impact' : 'Impact' }}</a>
                    <a href="{{ $en ? route('english.resources') : route('resources') }}"
                       class="{{ $sec === 'resources' ? 'is-current' : '' }}">{{ __('site.nav_karma_resources') }}</a>
                    <a href="{{ $en ? route('english.reserves') : route('reserves') }}"
                       class="{{ $sec === 'reserves' ? 'is-current' : '' }}">{{ __('site.nav_karma_reserves') }}</a>
                </div>
            </span>

            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link {{ in_array($sec, ['projects','cil-project']) ? 'is-active' : '' }}"
                   href="{{ $en ? route('english.projects') : route('projects') }}">
                    {{ __('site.nav_projects') }}
                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                    <a href="{{ $en ? route('english.projects.cil') : route('projects.cil') }}"
                       class="{{ $sec === 'cil-project' ? 'is-current' : '' }}">{{ __('site.nav_projects_cil') }}</a>
                    <a href="{{ ($en ? route('english.projects') : route('projects')) . '#exploration' }}">{{ __('site.nav_projects_exploration') }}</a>
                </div>
            </span>

            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link {{ $isSustain ? 'is-active' : '' }}"
                   href="{{ $en ? route('english.sustainability') : route('sustainability') }}">
                    {{ __('site.nav_sustainability') }}
                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                    <a href="{{ $en ? route('english.communities') : route('sustainability.communities') }}"
                       class="{{ $sec === 'communities' ? 'is-current' : '' }}">{{ __('site.nav_communities') }}</a>
                    <a href="{{ $en ? route('english.environment') : route('sustainability.environment') }}"
                       class="{{ $sec === 'environment' ? 'is-current' : '' }}">{{ __('site.nav_environment') }}</a>
                    <a href="{{ $en ? route('english.hse') : route('sustainability.hse') }}"
                       class="{{ $sec === 'hse' ? 'is-current' : '' }}">{{ __('site.nav_hse') }}</a>
                    <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}"
                       class="{{ $sec === 'local-content' ? 'is-current' : '' }}">{{ __('site.nav_local_content') }}</a>
                </div>
            </span>

            <span class="site-nav__item" data-dropdown>
                <a class="site-nav__link {{ $isNews ? 'is-active' : '' }}"
                   href="{{ $en ? route('english.news') : route('news.index') }}">
                    {{ __('site.nav_news') }}
                    <span class="site-nav__caret" aria-hidden="true"></span>
                </a>
                <div class="site-nav__menu" role="menu">
                    <a href="{{ $en ? route('english.news') : route('news.index') }}"
                       class="{{ $sec === 'news' ? 'is-current' : '' }}">{{ __('site.nav_news_list') }}</a>
                    <a href="{{ $en ? route('english.press') : route('press') }}"
                       class="{{ $sec === 'press' ? 'is-current' : '' }}">{{ __('site.nav_press') }}</a>
                    <a href="{{ $en ? route('english.gallery') : route('gallery') }}"
                       class="{{ $sec === 'gallery' ? 'is-current' : '' }}">{{ __('site.nav_gallery') }}</a>
                    <a href="{{ $en ? route('english.reports') : route('reports') }}"
                       class="{{ $sec === 'reports' ? 'is-current' : '' }}">{{ __('site.nav_reports') }}</a>
                    <a href="{{ $en ? route('english.press.contact') : route('press.contact') }}"
                       class="{{ $sec === 'press-contact' ? 'is-current' : '' }}">{{ __('site.nav_press_contact') }}</a>
                </div>
            </span>

            <a class="site-nav__link {{ $sec === 'careers' ? 'is-active' : '' }}"
               href="{{ $en ? route('english.careers') : route('careers') }}">
                {{ __('site.nav_careers') }}
            </a>

            <div class="site-nav__actions">
                <a class="site-nav__lang" href="{{ $en ? url('/') : route('english') }}">
                    {{ __('site.lang_switch') }}
                </a>
                <a class="site-btn" href="{{ $contactUrl }}">
                    {{ $en ? 'Contact us' : 'Nous contacter' }}
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
                e.preventDefault();
                if (window.matchMedia('(max-width: 1080px)').matches) {
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
