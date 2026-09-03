{{-- Page : Projet CIL --}}
@extends('layouts.app')

@section('content')
<style>
    /* ══ Section Headers ════════════════════════════════════════ */
    .cil-header { text-align:center; margin-bottom:32px; }
    .cil-header h2 { font-size:28px; font-weight:600; color:var(--green); margin-bottom:12px; }
    .cil-header p { color:var(--muted); font-size:14px; line-height:1.7; }
    
    /* ══ Gallery Items ════════════════════════════════════════════ */
    .cil-gallery-item { padding:0; overflow:hidden; }
    .cil-gallery-trigger { display:block; width:100%; padding:0; border:0; background:none; cursor:zoom-in; }
    .cil-gallery-trigger img { transition:transform .25s ease, opacity .25s ease; }
    .cil-gallery-trigger:hover img, .cil-gallery-trigger:focus-visible img { transform:scale(1.03); opacity:.88; }
    .cil-gallery-caption { padding:14px 18px 18px; color:var(--muted); font:500 13px/1.5 Inter,sans-serif; text-align:left; }
    
    /* ══ Content Card ════════════════════════════════════════════ */
    .cil-content-card { background:#fff; padding:20px; border-radius:8px; border:1px solid var(--line); }
    .cil-content-card h3 { color:var(--green); margin:0 0 12px 0; font-size:16px; font-weight:600; }
    .cil-content-card p { color:var(--muted); font-size:14px; line-height:1.7; margin:0; }
    
    /* ══ Info Grid ══════════════════════════════════════════════ */
    .cil-info-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:16px; margin-top:16px; }
    .cil-info-item { background:var(--light); padding:12px; border-radius:6px; border-left:4px solid var(--green); }
    .cil-info-label { font-size:11px; color:var(--muted); font-weight:600; text-transform:uppercase; letter-spacing:.5px; }
    .cil-info-value { font-size:16px; font-weight:700; color:var(--green); margin-top:4px; font-variant-numeric:tabular-nums; }
    
    /* ══ Lightbox ════════════════════════════════════════════════ */
    .cil-lightbox { position:fixed; inset:0; z-index:500; display:none; align-items:center; justify-content:center; padding:28px; background:rgba(20,8,6,.88); }
    .cil-lightbox.is-open { display:flex; }
    .cil-lightbox-dialog { position:relative; max-width:min(1400px,96vw); max-height:92vh; margin:0; }
    .cil-lightbox-image { display:block; max-width:100%; max-height:82vh; object-fit:contain; border:1px solid rgba(255,255,255,.25); background:#fff; border-radius:8px; }
    .cil-lightbox-caption { margin-top:12px; color:#fff; text-align:center; font:500 14px/1.5 Inter,sans-serif; }
    .cil-lightbox-close { position:absolute; top:-42px; right:0; border:1px solid rgba(255,255,255,.55); background:var(--green); color:#fff; padding:8px 14px; border-radius:4px; cursor:pointer; font:600 11px Inter,sans-serif; text-transform:uppercase; letter-spacing:.08em; }
    
    /* ══ Page Styles ════════════════════════════════════════════ */
    .cil-page p, .cil-page .lead { font-size:1.25rem; text-align:justify; line-height:1.8; }
    .cil-page h2, .cil-page h3 { text-align:center; font-size:1.5rem; }
    .cil-page .lead, .cil-page p, .cil-page .card p { text-align:justify; }
    .cil-page .lead { max-width:100%; width:100%; }
    
    /* ══ Section Layout ════════════════════════════════════════ */
    .cil-section-grid { display:grid; grid-template-columns:1fr 1fr; gap:28px; align-items:start; margin-bottom:48px; }
    .cil-section-figure { margin:0; }
    .cil-section-figure button { display:block; width:100%; padding:0; border:0; background:none; cursor:zoom-in; }
    .cil-section-figure img { width:100%; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,.12); display:block; transition:transform .25s, opacity .25s; }
    .cil-section-figure button:hover img { transform:scale(1.02); opacity:.9; }
    .cil-section-figure figcaption { font-size:12px; color:var(--muted); margin-top:12px; text-align:center; line-height:1.6; }
    
    /* ══ Responsive ═════════════════════════════════════════════ */
    @media (max-width:960px) {
        .cil-section-grid { grid-template-columns:1fr; }
    }
</style>

<section class="cil-page">

    <p class="lead">{{ __('site.cil_project_lead', [], $loc) }}</p>

    <div class="grid-2" style="margin-top:36px;">
        <div class="card">
            <div class="card-tag">{{ __('site.cil_project_location_tag', [], $loc) }}</div>
            <h3>{{ __('site.cil_project_location_h3', [], $loc) }}</h3>
            <p>{{ __('site.cil_project_location_p', [], $loc) }}</p>
        </div>
        <div class="card">
            <div class="card-tag">{{ __('site.cil_project_assets_tag', [], $loc) }}</div>
            <h3>{{ __('site.cil_project_assets_h3', [], $loc) }}</h3>
            <p>{{ __('site.cil_project_assets_p', [], $loc) }}</p>
        </div>
    </div>
</section>

<section class="sand">
    {{-- ══ Resources Location ════════════════════════════════════ --}}
    <div class="cil-header">
        <h2>{{ $en ? 'Resource Placement' : 'Emplacement des Ressources' }}</h2>
        <p>{{ $en ? 'Location of ore deposits for the CIL project' : 'Localisation des gisements de minerai pour le projet CIL' }}</p>
    </div>

    <div class="cil-section-grid">
        <figure class="cil-section-figure">
            <button type="button" data-cil-lightbox-image="{{ asset('images/cil/cil-resources-map.png') }}"
                    data-cil-lightbox-alt="{{ $en ? 'Resource Placement Map' : 'Carte d\'Emplacement des Ressources' }}"
                    data-cil-lightbox-caption="{{ $en ? 'Resource placement for the CIL project showing Nami, GG2, GG1, Kao, and Goulagou deposits' : 'Emplacement des ressources du projet CIL montrant les gisements de Nami, GG2, GG1, Kao et Goulagou' }}">
                <img src="{{ asset('images/cil/cil-resources-map.png') }}"
                     alt="{{ $en ? 'Resource Placement Map' : 'Carte d\'Emplacement des Ressources' }}"
                     loading="lazy" decoding="async">
            </button>
            <figcaption>{{ $en ? 'Resource placement for the CIL project' : 'Emplacement des ressources du projet CIL' }}</figcaption>
        </figure>

        <div>
            <div class="cil-content-card">
                <h3>{{ $en ? 'Key Deposits' : 'Gisements Clés' }}</h3>
                <p>{{ $en ? 'The CIL project will process ore from multiple deposits across the Karma complex, including Nami (oxide ore), GG2, GG1, Kao, and Goulagou deposits.' : 'Le projet CIL traitera le minerai de plusieurs gisements du complexe de Karma, notamment les gisements de Nami (minerai oxydé), GG2, GG1, Kao et Goulagou.' }}</p>
            </div>

            <div class="cil-info-grid">
                <div class="cil-info-item">
                    <div class="cil-info-label">{{ $en ? 'Primary Deposit' : 'Gisement Principal' }}</div>
                    <div class="cil-info-value">{{ $en ? 'Nami' : 'Nami' }}</div>
                </div>
                <div class="cil-info-item">
                    <div class="cil-info-label">{{ $en ? 'Initial Grade' : 'Teneur Initiale' }}</div>
                    <div class="cil-info-value">0.82 g/t</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    {{-- ══ Mill Feed Plan ═════════════════════════════════════ --}}
    <div class="cil-header">
        <h2>{{ $en ? 'Mill Feed Plan' : 'Plan d\'Alimentation de l\'Usine' }}</h2>
        <p>{{ $en ? '12-year production schedule with three main ore sources' : 'Programme de production de 12 ans avec trois sources de minerai principales' }}</p>
    </div>

    <div class="cil-section-grid">
        <figure class="cil-section-figure">
            <button type="button" data-cil-lightbox-image="{{ asset('images/cil/cil-mill-feed.jpg') }}"
                    data-cil-lightbox-alt="{{ $en ? 'Mill Feed Plan' : 'Plan d\'Alimentation de l\'Usine' }}"
                    data-cil-lightbox-caption="{{ $en ? 'Mill feed plan showing ore tonnage, grades, and processing capacity over 12 years' : 'Plan d\'alimentation montrant le tonnage de minerai, les teneurs et la capacité de traitement sur 12 ans' }}">
                <img src="{{ asset('images/cil/cil-mill-feed.jpg') }}"
                     alt="{{ $en ? 'Mill Feed Plan' : 'Plan d\'Alimentation de l\'Usine' }}"
                     loading="lazy" decoding="async">
            </button>
            <figcaption>{{ $en ? 'Mill feed plan for 12-year project life' : 'Plan d\'alimentation pour la durée de vie du projet de 12 ans' }}</figcaption>
        </figure>

        <div>
            <div class="cil-content-card">
                <h3>{{ $en ? 'Key Metrics' : 'Métriques Clés' }}</h3>
                <p>{{ $en ? 'The project will process ore from Nami (3 years), GG2 (4 years), and GG1 (5 years) with varying grades and capacities.' : 'Le projet traitera le minerai de Nami (3 ans), GG2 (4 ans) et GG1 (5 ans) avec des teneurs et des capacités variables.' }}</p>
            </div>

            <div class="cil-info-grid">
                <div class="cil-info-item">
                    <div class="cil-info-label">{{ $en ? 'Total Ore' : 'Minerai Total' }}</div>
                    <div class="cil-info-value">12.8 Mt</div>
                </div>
                <div class="cil-info-item">
                    <div class="cil-info-label">{{ $en ? 'Avg Grade' : 'Teneur Moy.' }}</div>
                    <div class="cil-info-value">1.25 g/t</div>
                </div>
                <div class="cil-info-item">
                    <div class="cil-info-label">{{ $en ? 'Annual Production' : 'Production Annuelle' }}</div>
                    <div class="cil-info-value">485 Koz</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sand">
    {{-- ══ Leaching Process ══════════════════════════════════════ --}}
    <div class="cil-header">
        <h2>{{ $en ? 'Leaching Process' : 'Processus de Lixiviation' }}</h2>
        <p>{{ $en ? 'Technical design of the CIL heap leaching operation' : 'Conception technique du processus de lixiviation en tas' }}</p>
    </div>

    <div class="cil-section-grid">
        <figure class="cil-section-figure">
            <button type="button" data-cil-lightbox-image="{{ asset('images/cil/cil-lexiviation.jpg') }}"
                    data-cil-lightbox-alt="{{ $en ? 'CIL Leaching Process' : 'Processus de Lixiviation CIL' }}"
                    data-cil-lightbox-caption="{{ $en ? 'General diagram of the CIL heap leaching project showing key processing stages' : 'Schéma général du projet de lixiviation en tas CIL montrant les étapes de traitement clés' }}">
                <img src="{{ asset('images/cil/cil-lexiviation.jpg') }}"
                     alt="{{ $en ? 'CIL Leaching Process' : 'Processus de Lixiviation CIL' }}"
                     loading="lazy" decoding="async">
            </button>
            <figcaption>{{ $en ? 'CIL heap leaching process diagram' : 'Diagramme du processus de lixiviation en tas CIL' }}</figcaption>
        </figure>

        <div>
            <div class="cil-content-card">
                <h3>{{ $en ? 'Key Features' : 'Caractéristiques Clés' }}</h3>
                <p>{{ $en ? 'The CIL process includes oxide ore extraction from Nami, grinding and concentration, followed by heap leaching and gold recovery.' : 'Le processus CIL comprend l\'extraction de minerai oxydé de Nami, le broyage et la concentration, suivis de la lixiviation en tas et la récupération de l\'or.' }}</p>
            </div>

            <div class="cil-info-grid">
                <div class="cil-info-item">
                    <div class="cil-info-label">{{ $en ? 'Nami Capacity' : 'Capacité Nami' }}</div>
                    <div class="cil-info-value">0.60 Mt/an</div>
                </div>
                <div class="cil-info-item">
                    <div class="cil-info-label">{{ $en ? 'Plant Capacity' : 'Capacité Usine' }}</div>
                    <div class="cil-info-value">0.60-1.20 Mt/an</div>
                </div>
                <div class="cil-info-item">
                    <div class="cil-info-label">{{ $en ? 'Recovery Rate' : 'Taux de Récupération' }}</div>
                    <div class="cil-info-value">94%</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    {{-- ══ Project Schedule ═══════════════════════════════════ --}}
    <div class="cil-header">
        <h2>{{ $en ? 'Project Schedule' : 'Calendrier du Projet' }}</h2>
        <p>{{ $en ? '14-month execution timeline with critical milestones' : 'Calendrier d\'exécution de 14 mois avec jalons critiques' }}</p>
    </div>

    <figure class="cil-section-figure" style="margin-bottom:24px;">
        <button type="button" data-cil-lightbox-image="{{ asset('images/cil/cil-schedule.png') }}"
                data-cil-lightbox-alt="{{ $en ? 'Project Schedule' : 'Calendrier du Projet' }}"
                data-cil-lightbox-caption="{{ $en ? 'Project execution timeline over 14-16 months with key phases and milestones' : 'Calendrier d\'exécution du projet sur 14-16 mois avec phases clés et jalons' }}">
            <img src="{{ asset('images/cil/cil-schedule.png') }}"
                 alt="{{ $en ? 'Project Schedule' : 'Calendrier du Projet' }}"
                 loading="lazy" decoding="async">
        </button>
        <figcaption>{{ $en ? 'Executable project with 14-month timeline' : 'Projet exécutable avec calendrier de 14 mois' }}</figcaption>
    </figure>

    <div class="cil-info-grid" style="max-width:100%;">
        <div class="cil-info-item">
            <div class="cil-info-label">{{ $en ? 'Technical Design' : 'Conception Technique' }}</div>
            <div class="cil-info-value">{{ $en ? 'Months 1-4' : 'Mois 1-4' }}</div>
        </div>
        <div class="cil-info-item">
            <div class="cil-info-label">{{ $en ? 'Equipment Fabrication' : 'Fabrication Équipements' }}</div>
            <div class="cil-info-value">{{ $en ? 'Months 1-5' : 'Mois 1-5' }}</div>
        </div>
        <div class="cil-info-item">
            <div class="cil-info-label">{{ $en ? 'Transportation & Installation' : 'Transport & Installation' }}</div>
            <div class="cil-info-value">{{ $en ? 'Months 5-12' : 'Mois 5-12' }}</div>
        </div>
        <div class="cil-info-item">
            <div class="cil-info-label">{{ $en ? 'Commissioning' : 'Mise en Service' }}</div>
            <div class="cil-info-value">{{ $en ? 'Months 12-14' : 'Mois 12-14' }}</div>
        </div>
    </div>
</section>

<section class="sand">
    {{-- ══ Site Layout ════════════════════════════════════════ --}}
    <div class="cil-header">
        <h2>{{ $en ? 'Site Layout & Arrangement' : 'Aménagement et Disposition du Site' }}</h2>
        <p>{{ $en ? 'Aerial view of CIL plant infrastructure and integration with existing facilities' : 'Vue aérienne de l\'infrastructure de l\'usine CIL et intégration aux installations existantes' }}</p>
    </div>

    <figure class="cil-section-figure" style="margin-bottom:24px;">
        <button type="button" data-cil-lightbox-image="{{ asset('images/cil/cil-site-layout.png') }}"
                data-cil-lightbox-alt="{{ $en ? 'Site Layout' : 'Aménagement du Site' }}"
                data-cil-lightbox-caption="{{ $en ? 'Aerial view showing CIL plant placement and integration with existing mining operations' : 'Vue aérienne montrant le placement de l\'usine CIL et l\'intégration aux opérations minières existantes' }}">
            <img src="{{ asset('images/cil/cil-site-layout.png') }}"
                 alt="{{ $en ? 'Site Layout' : 'Aménagement du Site' }}"
                 loading="lazy" decoding="async">
        </button>
        <figcaption>{{ $en ? 'CIL plant site layout and arrangement at Karma' : 'Aménagement du site de l\'usine CIL à Karma' }}</figcaption>
    </figure>

    <div class="grid-2" style="margin-top:28px;">
        <div class="cil-content-card">
            <h3>{{ $en ? 'Processing Infrastructure' : 'Infrastructure de Traitement' }}</h3>
            <p>{{ $en ? 'CIL tanks, ball mills, thickeners, and carbon screen facilities integrated with existing heap leach operations.' : 'Réservoirs CIL, broyeurs à boulets, épaississeurs et installations de criblage du carbone intégrés aux opérations de lixiviation existantes.' }}</p>
        </div>

        <div class="cil-content-card">
            <h3>{{ $en ? 'Existing Integration' : 'Intégration Existante' }}</h3>
            <p>{{ $en ? 'Leverages existing heap leach infrastructure, tailings areas, and mining operations for seamless project integration.' : 'Utilise l\'infrastructure de lixiviation existante, les zones de résidus et les opérations minières pour une intégration transparente du projet.' }}</p>
        </div>
    </div>
</section>

<section>
    {{-- ══ Project Gallery ════════════════════════════════════ --}}
    <div class="cil-header">
        <h2>{{ __('site.cil_project_gallery_h2', [], $loc) }}</h2>
        <p>{{ $en ? 'Project documentation and technical materials' : 'Documentation du projet et matériaux techniques' }}</p>
    </div>

    <div class="grid-3">
        @foreach([
            ['cil-resources-map.png', 'Resource placement', 'Emplacement des ressources'],
            ['cil-mill-feed.jpg', 'Mill feed plan', 'Plan d\'alimentation'],
            ['cil-lexiviation.jpg', 'Leaching process', 'Processus de lixiviation'],
            ['cil-schedule.png', 'Project schedule', 'Calendrier du projet'],
            ['cil-site-layout.png', 'Site layout', 'Aménagement du site'],
            ['cil-01.png', 'Project overview', 'Aperçu du projet'],
        ] as [$image, $alt_en, $alt_fr])
        <figure class="card cil-gallery-item">
            <button class="cil-gallery-trigger" type="button"
                    data-cil-lightbox-image="{{ asset('images/cil/'.$image) }}"
                    data-cil-lightbox-alt="{{ $en ? $alt_en : $alt_fr }}"
                    data-cil-lightbox-caption="{{ $en ? $alt_en : $alt_fr }}">
                <img src="{{ asset('images/cil/'.$image) }}"
                     alt="{{ $en ? $alt_en : $alt_fr }}"
                     style="width:100%; height:220px; object-fit:cover;"
                     loading="lazy" decoding="async">
            </button>
            <figcaption class="cil-gallery-caption">{{ $en ? $alt_en : $alt_fr }}</figcaption>
        </figure>
        @endforeach
    </div>
</section>

{{-- ══ Lightbox Modal ═════════════════════════════════════════════ --}}
<div class="cil-lightbox" data-cil-lightbox aria-hidden="true">
    <figure class="cil-lightbox-dialog">
        <button class="cil-lightbox-close" type="button" data-cil-lightbox-close>{{ $en ? 'Close' : 'Fermer' }}</button>
        <img class="cil-lightbox-image" data-cil-lightbox-preview src="" alt="">
        <figcaption class="cil-lightbox-caption" data-cil-lightbox-caption></figcaption>
    </figure>
</div>

<script>
(() => {
    const lightbox = document.querySelector('[data-cil-lightbox]');
    const preview = lightbox?.querySelector('[data-cil-lightbox-preview]');
    const caption = lightbox?.querySelector('[data-cil-lightbox-caption]');
    const close = () => {
        if (!lightbox) return;
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden', 'true');
        preview.removeAttribute('src');
    };
    document.querySelectorAll('[data-cil-lightbox-image]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            preview.src = trigger.dataset.cilLightboxImage;
            preview.alt = trigger.dataset.cilLightboxAlt;
            caption.textContent = trigger.dataset.cilLightboxCaption;
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
            lightbox.querySelector('[data-cil-lightbox-close]').focus();
        });
    });
    lightbox?.querySelector('[data-cil-lightbox-close]')?.addEventListener('click', close);
    lightbox?.addEventListener('click', (event) => {
        if (event.target === lightbox) close();
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') close();
    });
})();
</script>
@endsection