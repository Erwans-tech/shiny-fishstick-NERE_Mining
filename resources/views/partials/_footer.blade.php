@php
    $loc = $loc ?? app()->getLocale();
    $en  = $en  ?? ($loc === 'en');
    $contactUrl = $en ? route('english.contact') : route('contact');

    use App\Models\SiteSetting;
    $companyPhone = SiteSetting::get('company_phone', '+226 25 33 35 69');
    $companyEmail = SiteSetting::get('company_email', 'contact@nere-mining.bf');
    $copyright = SiteSetting::get('footer_copyright', '© '.date('Y').' Néré Mining. Tous droits réservés.');
    $footerDescription = SiteSetting::get('footer_description', 'Groupe aurifère burkinabè exploitant la mine de Karma dans le nord du Burkina Faso.');
@endphp

@once
<link rel="stylesheet" href="{{ asset('css/chrome.css') }}">
@endonce

<footer class="site-footer">
    <div class="site-footer__inner">
        <div class="site-footer__top">
            <a class="site-footer__brand" href="{{ $en ? route('english') : url('/') }}">
                <img src="{{ asset('images/logo-nere.png') }}" alt="Néré Mining">
            </a>
            <a class="site-btn site-footer__cta" href="{{ $contactUrl }}">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                {{ $en ? 'Contact us' : 'Nous contacter' }}
            </a>
        </div>

        <div class="site-footer__grid">
            <div>
                <p class="site-footer__lead">{{ $footerDescription }}</p>
                <a class="site-footer__meta" href="tel:{{ preg_replace('/[^0-9+]/', '', $companyPhone) }}">{{ $companyPhone }}</a>
                <a class="site-footer__meta" href="mailto:{{ $companyEmail }}">{{ $companyEmail }}</a>
            </div>
            <div>
                <div class="site-footer__label">{{ $en ? 'Company' : 'Entreprise' }}</div>
                <a href="{{ $en ? route('english.company') : route('company') }}">{{ __('site.nav_company', [], $loc) }}</a>
                <a href="{{ $en ? route('english.karma') : route('karma') }}">{{ __('site.nav_karma', [], $loc) }}</a>
                <a href="{{ $en ? route('english.projects') : route('projects') }}">{{ __('site.nav_projects', [], $loc) }}</a>
                <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.nav_sustainability', [], $loc) }}</a>
            </div>
            <div>
                <div class="site-footer__label">{{ $en ? 'Resources' : 'Ressources' }}</div>
                <a href="{{ $en ? route('english.news') : route('news.index') }}">{{ __('site.nav_news', [], $loc) }}</a>
                <a href="{{ $en ? route('english.reports') : route('reports') }}">{{ __('site.nav_reports', [], $loc) }}</a>
                <a href="{{ $en ? route('english.gallery') : route('gallery') }}">{{ __('site.nav_gallery', [], $loc) }}</a>
                <a href="{{ $en ? route('english.careers') : route('careers') }}">{{ __('site.nav_careers', [], $loc) }}</a>
            </div>
            <div>
                <div class="site-footer__label">IPRE</div>
                <span>{{ $en ? 'Integrity' : 'Intégrité' }}</span>
                <span>{{ $en ? 'Professionalism' : 'Professionnalisme' }}</span>
                <span>Respect</span>
                <span>{{ $en ? 'Teamwork' : "Esprit d'équipe" }}</span>
            </div>
        </div>

        <div class="site-footer__bottom">
            <span>{{ $copyright }}</span>
            <span>Ouagadougou, Burkina Faso</span>
        </div>
    </div>
</footer>
