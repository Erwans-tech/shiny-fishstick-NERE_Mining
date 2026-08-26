@php
    $en = ($locale ?? 'fr') === 'en';
    $sec = $section ?? '';
    $isNews    = in_array($sec, ['news','press','gallery','reports','press-contact']);
    $isSustain = in_array($sec, ['sustainability','communities','environment','hse','local-content']);
    $isCompany = in_array($sec, ['company','company-ceo','company-identity','company-history','company-values','company-governance']);
@endphp
<style>
/* ── Header public ── */
.site-header {
    background: var(--green, #4b1716) !important;
    border-bottom: 3px solid var(--gold, #ffc247);
    box-shadow: 0 4px 18px rgba(40,29,24,.24) !important;
    min-height: 84px;
}
.site-header .logo {
    width: 230px;
    background: #fff;
    padding: 4px 10px;
}
.site-header .nav-link {
    color: rgba(255,255,255,.92) !important;
    font-weight: 700;
    padding: 12px 13px;
}
.site-header .nav-link:hover,
.site-header .nav-link.active {
    background: rgba(255,194,71,.16) !important;
    color: var(--gold, #ffc247) !important;
}
.site-header .nav-link.active { box-shadow: inset 0 -3px 0 var(--gold, #ffc247); }
.site-header .nav-lang { border-color: rgba(255,194,71,.7); color: var(--gold, #ffc247) !important; }
.site-header .menu-btn {
    border-color: rgba(255,194,71,.7);
    color: var(--gold, #ffc247);
}

/* ── Dropdown nav — robuste sans gap ── */
.nav-dropdown { position: relative; }

/* Le lien parent + le menu forment un seul bloc continu grâce au padding-bottom */
.nav-dropdown > .nav-link {
    padding-bottom: 18px !important; /* étend la zone de hover vers le bas */
}

/* Positionnement sans gap */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;          /* collé sous le lien, pas de gap */
    left: 0;
    background: #fff;
    border: 1px solid var(--line, #eadcc5);
    border-radius: 0 0 8px 8px;
    min-width: 240px;
    box-shadow: 0 8px 28px rgba(0,0,0,.14);
    z-index: 300;
    padding: 8px 0;
    /* Animation */
    opacity: 0;
    transform: translateY(-4px);
    transition: opacity .15s ease, transform .15s ease;
    pointer-events: none;
}

/* Pont invisible : le menu lui-même prolonge la zone de survol vers le haut */
.dropdown-menu::before {
    content: '';
    position: absolute;
    top: -12px;
    left: 0;
    right: 0;
    height: 12px;
}

.nav-dropdown.is-open .dropdown-menu {
    display: block;
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

.dropdown-menu a {
    display: block;
    padding: 10px 18px;
    font: 500 12px 'Inter', sans-serif;
    color: var(--green, #4b1716);
    white-space: nowrap;
    transition: background .12s, padding-left .12s;
    border-left: 2px solid transparent;
}
.dropdown-menu a:hover {
    background: var(--sand, #fff4dc);
    border-left-color: var(--gold, #ffc247);
    padding-left: 22px;
}
.dropdown-menu a.current {
    background: var(--sand, #fff4dc);
    border-left-color: var(--gold, #ffc247);
    font-weight: 600;
}
</style>

<header class="site-header">
    <a class="logo" href="{{ $en ? route('english') : url('/') }}">
        <img src="{{ asset('images/logo-nere.png') }}" alt="Néré Mining">
    </a>
    <button class="menu-btn"
            aria-label="Menu"
            aria-expanded="false"
            onclick="this.setAttribute('aria-expanded', this.closest('header').querySelector('nav').classList.toggle('open')); return false;">
        MENU
    </button>
    <nav>
        {{-- Qui sommes-nous --}}
        <span class="nav-dropdown" data-dropdown>
            <a class="nav-link {{ $isCompany ? 'active' : '' }}"
               href="{{ $en ? route('english.company') : route('company') }}">
                {{ __('site.nav_company') }}
            </a>
            <div class="dropdown-menu" role="menu">
                <a href="{{ $en ? route('english.company.ceo')        : route('company.ceo') }}"
                   class="{{ $sec === 'company-ceo' ? 'current' : '' }}">{{ __('site.nav_company_ceo') }}</a>
                <a href="{{ $en ? route('english.company.identity')   : route('company.identity') }}"
                   class="{{ $sec === 'company-identity' ? 'current' : '' }}">{{ __('site.nav_company_identity') }}</a>
                <a href="{{ $en ? route('english.company.history')    : route('company.history') }}"
                   class="{{ $sec === 'company-history' ? 'current' : '' }}">{{ __('site.nav_company_history') }}</a>
                <a href="{{ $en ? route('english.company.values')     : route('company.values') }}"
                   class="{{ $sec === 'company-values' ? 'current' : '' }}">{{ __('site.nav_company_values') }}</a>
                <a href="{{ $en ? route('english.company.governance') : route('company.governance') }}"
                   class="{{ $sec === 'company-governance' ? 'current' : '' }}">{{ __('site.nav_company_governance') }}</a>
            </div>
        </span>

        <span class="nav-dropdown" data-dropdown>
            <a class="nav-link {{ $sec === 'karma' ? 'active' : '' }}"
               href="{{ $en ? route('english.karma') : route('karma') }}">
                {{ __('site.nav_karma') }}
            </a>
            <div class="dropdown-menu" role="menu">
                <a href="{{ ($en ? route('english.karma') : route('karma')) . '#presentation' }}">{{ __('site.nav_karma_presentation') }}</a>
                <a href="{{ ($en ? route('english.karma') : route('karma')) . '#exploitation' }}">{{ __('site.nav_karma_operations') }}</a>
                <a href="{{ ($en ? route('english.karma') : route('karma')) . '#organisation' }}">{{ __('site.nav_karma_organisation') }}</a>
                <a href="{{ ($en ? route('english.karma') : route('karma')) . '#modele-operationnel' }}">{{ __('site.nav_karma_model') }}</a>
                <a href="{{ ($en ? route('english.karma') : route('karma')) . '#impact' }}">{{ __('site.nav_karma_impact') }}</a>
            </div>
        </span>

        <span class="nav-dropdown" data-dropdown>
            <a class="nav-link {{ $sec === 'projects' ? 'active' : '' }}"
               href="{{ $en ? route('english.projects') : route('projects') }}">
                {{ __('site.nav_projects') }}
            </a>
            <div class="dropdown-menu" role="menu">
                <a href="{{ ($en ? route('english.projects') : route('projects')) . '#exploration' }}">{{ __('site.nav_projects_exploration') }}</a>
                <a href="{{ ($en ? route('english.projects') : route('projects')) . '#permits' }}">{{ __('site.nav_projects_permits') }}</a>
                <a href="{{ ($en ? route('english.projects') : route('projects')) . '#partnerships' }}">{{ __('site.nav_projects_join') }}</a>
            </div>
        </span>

        {{-- Développement durable --}}
        <span class="nav-dropdown" data-dropdown>
            <a class="nav-link {{ $isSustain ? 'active' : '' }}"
               href="{{ $en ? route('english.sustainability') : route('sustainability') }}">
                {{ __('site.nav_sustainability') }}
            </a>
            <div class="dropdown-menu" role="menu">
                <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}"
                   class="{{ $sec === 'communities' ? 'current' : '' }}">{{ __('site.nav_communities') }}</a>
                <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}"
                   class="{{ $sec === 'environment' ? 'current' : '' }}">{{ __('site.nav_environment') }}</a>
                <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}"
                   class="{{ $sec === 'hse' ? 'current' : '' }}">{{ __('site.nav_hse') }}</a>
                <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}"
                   class="{{ $sec === 'local-content' ? 'current' : '' }}">{{ __('site.nav_local_content') }}</a>
            </div>
        </span>

        {{-- Actualités & Médias --}}
        <span class="nav-dropdown" data-dropdown>
            <a class="nav-link {{ $isNews ? 'active' : '' }}"
               href="{{ $en ? route('english.news') : route('news.index') }}">
                {{ __('site.nav_news') }}
            </a>
            <div class="dropdown-menu" role="menu">
                <a href="{{ $en ? route('english.news')          : route('news.index') }}"
                   class="{{ $sec === 'news' ? 'current' : '' }}">{{ __('site.nav_news_list') }}</a>
                <a href="{{ $en ? route('english.press')         : route('press') }}"
                   class="{{ $sec === 'press' ? 'current' : '' }}">{{ __('site.nav_press') }}</a>
                <a href="{{ $en ? route('english.gallery')       : route('gallery') }}"
                   class="{{ $sec === 'gallery' ? 'current' : '' }}">{{ __('site.nav_gallery') }}</a>
                <a href="{{ $en ? route('english.reports')       : route('reports') }}"
                   class="{{ $sec === 'reports' ? 'current' : '' }}">{{ __('site.nav_reports') }}</a>
                <a href="{{ $en ? route('english.press.contact') : route('press.contact') }}"
                   class="{{ $sec === 'press-contact' ? 'current' : '' }}">{{ __('site.nav_press_contact') }}</a>
            </div>
        </span>

        <a class="nav-link {{ $sec === 'careers' ? 'active' : '' }}"
           href="{{ $en ? route('english.careers') : route('careers') }}">
            {{ __('site.nav_careers') }}
        </a>

        <a class="nav-link {{ $sec === 'contact' ? 'active' : '' }}"
           href="{{ $en ? route('english.contact') : route('contact') }}">
            {{ __('site.nav_contact') }}
        </a>

        <a class="nav-link nav-lang"
           href="{{ $en ? url('/') : route('english') }}">
            {{ __('site.lang_switch') }}
        </a>
    </nav>
</header>

<script>
(function () {
    'use strict';

    var CLOSE_DELAY = 180; // ms avant fermeture après mouseout
    var dropdowns   = document.querySelectorAll('[data-dropdown]');

    dropdowns.forEach(function (dd) {
        var timer = null;

        function open() {
            clearTimeout(timer);
            // Fermer tous les autres d'abord
            dropdowns.forEach(function (other) {
                if (other !== dd) other.classList.remove('is-open');
            });
            dd.classList.add('is-open');
        }

        function scheduleClose() {
            clearTimeout(timer);
            timer = setTimeout(function () {
                dd.classList.remove('is-open');
            }, CLOSE_DELAY);
        }

        // Ouverture au survol
        dd.addEventListener('mouseenter', open);
        dd.addEventListener('mouseleave', scheduleClose);

        // Focus keyboard : ouvrir au focus d'un enfant
        dd.addEventListener('focusin', open);
        dd.addEventListener('focusout', scheduleClose);
    });

    // Fermer au clic hors dropdown
    document.addEventListener('click', function (e) {
        if (!e.target.closest('[data-dropdown]')) {
            dropdowns.forEach(function (dd) { dd.classList.remove('is-open'); });
        }
    });

    // Fermer avec Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            dropdowns.forEach(function (dd) { dd.classList.remove('is-open'); });
        }
    });
})();
</script>
