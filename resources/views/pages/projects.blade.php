{{-- Page : Nos projets en développement --}}
@extends('layouts.app')

@section('content')

<style>
    .project-card {
        background: linear-gradient(180deg, #ffffff 0%, #f4eee6 100%);
        border: 1px solid rgba(75,23,22,0.1);
        border-radius: 16px;
        transition: transform 0.3s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.3s, border-color 0.3s;
    }
    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(40,29,24,0.08);
        border-color: rgba(255,194,71,0.5);
    }
    .exploration-card { overflow:hidden; }
    .exploration-card__image { display:block; width:100%; padding:0; border:0; background:none; cursor:zoom-in; }
    .exploration-card__image { position:relative; z-index:1; }
    .exploration-card__image:focus-visible, .exploration-evidence button:focus-visible { outline:3px solid var(--gold); outline-offset:-3px; }
    .exploration-card img { display:block; width:100%; height:220px; object-fit:cover; transition:transform .25s, opacity .25s; }
    .exploration-card__image:hover img, .exploration-card__image:focus-visible img { transform:scale(1.03); opacity:.88; }
    .exploration-card__body { padding:24px; }
    .exploration-card__body h3 { margin:14px 0 10px; color:var(--green); }
    .exploration-card__meta { display:flex; flex-wrap:wrap; gap:8px 16px; margin-top:16px; color:var(--muted); font-size:12px; line-height:1.5; }
    .exploration-card__meta strong { color:var(--ink); }
    .exploration-card--map img { object-position:center; }
    .exploration-evidence { display:grid; grid-template-columns:1.4fr 1fr 1fr; gap:18px; margin-top:28px; }
    .exploration-evidence figure { margin:0; overflow:hidden; background:var(--sand); border:1px solid var(--line); border-radius:12px; }
    .exploration-evidence img { display:block; width:100%; height:190px; object-fit:cover; }
    .exploration-evidence button { display:block; width:100%; padding:0; border:0; background:none; cursor:zoom-in; }
    .exploration-evidence button:hover img, .exploration-evidence button:focus-visible img { transform:scale(1.03); opacity:.88; }
    .exploration-evidence figure:first-child img { object-position:center; }
    .exploration-evidence figcaption { padding:13px 15px; color:var(--muted); font-size:12px; line-height:1.5; }
    @media (max-width:900px) { .exploration-evidence { grid-template-columns:1fr 1fr; } .exploration-evidence figure:first-child { grid-column:1 / -1; } }
    @media (max-width:700px) { .exploration-card img { height:200px; } }
    .exploration-lightbox { position:fixed; inset:0; z-index:500; display:none; align-items:center; justify-content:center; padding:28px; background:rgba(20,8,6,.9); }
    .exploration-lightbox.is-open { display:flex; }
    .exploration-lightbox__dialog { position:relative; max-width:min(1500px,96vw); max-height:92vh; margin:0; }
    .exploration-lightbox img { display:block; max-width:100%; max-height:82vh; object-fit:contain; background:#fff; border-radius:8px; }
    .exploration-lightbox figcaption { margin-top:12px; color:#fff; text-align:center; font-size:14px; line-height:1.5; }
    .exploration-lightbox__close { position:absolute; top:-42px; right:0; border:1px solid rgba(255,255,255,.55); background:var(--green); color:#fff; padding:8px 14px; border-radius:4px; cursor:pointer; font:600 11px Inter,sans-serif; text-transform:uppercase; }
</style>
{{-- Projets d'exploration --}}
<section id="exploration">
    <h2>{{ __('site.projects_expl_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.projects_expl_lead', [], $loc) }}</p>

    <div class="projects-grid">
        <article class="card project-card exploration-card sr">
            <button class="exploration-card__image" type="button" data-exploration-image="{{ asset('images/exploration/geologie-dassoui.png') }}" data-exploration-alt="{{ $en ? 'Dassoui exploration permit and regional geology map' : 'Carte géologique régionale du permis d’exploration de Dassoui' }}" data-exploration-caption="{{ $en ? 'Regional geology and Dassoui exploration permit.' : 'Géologie régionale et permis d’exploration de Dassoui.' }}"><img src="{{ asset('images/exploration/geologie-dassoui.png') }}" alt="{{ $en ? 'Dassoui exploration permit and regional geology map' : 'Carte géologique régionale du permis d’exploration de Dassoui' }}" loading="lazy"></button>
            <div class="exploration-card__body">
                <div class="card-tag">{{ $en ? 'Dassoui permit' : 'Permis de Dassoui' }}</div>
                <h3>{{ $en ? 'Regional geological exploration' : 'Exploration géologique régionale' }}</h3>
                <p>{{ $en ? 'The Dassoui permit is positioned in a regional geological corridor near Boulsa, Zorgho, Koupela and Tenkodogo. The map highlights the licence perimeter, major structures and the surrounding geological context used to guide target generation.' : 'Le permis de Dassoui s’inscrit dans un corridor géologique régional proche de Boulsa, Zorgho, Koupela et Tenkodogo. La carte met en évidence le périmètre du titre, les grandes structures et le contexte géologique utilisé pour définir les cibles.' }}</p>
                <div class="exploration-card__meta"><span><strong>{{ $en ? 'Focus:' : 'Objectif :' }}</strong> {{ $en ? 'regional targets and structures' : 'cibles et structures régionales' }}</span><span><strong>{{ $en ? 'Method:' : 'Méthode :' }}</strong> {{ $en ? 'geological mapping' : 'cartographie géologique' }}</span></div>
            </div>
        </article>

        <article class="card project-card exploration-card sr">
            <button class="exploration-card__image" type="button" data-exploration-image="{{ asset('images/exploration/forage.jpg') }}" data-exploration-alt="{{ $en ? 'Reverse circulation drilling rig' : 'Foreuse de reconnaissance minière' }}" data-exploration-caption="{{ $en ? 'Drilling and sampling campaign in the field.' : 'Campagne de forage et d’échantillonnage sur le terrain.' }}"><img src="{{ asset('images/exploration/forage.jpg') }}" alt="{{ $en ? 'Reverse circulation drilling rig' : 'Foreuse de reconnaissance minière' }}" loading="lazy"></button>
            <div class="exploration-card__body">
                <div class="card-tag">{{ $en ? 'Field program' : 'Programme terrain' }}</div>
                <h3>{{ $en ? 'Drilling and target verification' : 'Forage et vérification des cibles' }}</h3>
                <p>{{ $en ? 'Exploration moves from the map to the field through drilling, sampling and geological logging. These activities test the continuity, geometry and grade potential of anomalies before any resource estimate is considered.' : 'L’exploration passe de la carte au terrain par le forage, l’échantillonnage et la description géologique. Ces travaux testent la continuité, la géométrie et le potentiel des anomalies avant toute estimation de ressources.' }}</p>
                <div class="exploration-card__meta"><span><strong>{{ $en ? 'Focus:' : 'Objectif :' }}</strong> {{ $en ? 'subsurface confirmation' : 'confirmation en profondeur' }}</span><span><strong>{{ $en ? 'Work:' : 'Travaux :' }}</strong> {{ $en ? 'drilling and sampling' : 'forage et échantillonnage' }}</span></div>
            </div>
        </article>

        <article class="card project-card exploration-card exploration-card--map sr">
            <button class="exploration-card__image" type="button" data-exploration-image="{{ asset('images/exploration/permis-carte.jpg') }}" data-exploration-alt="{{ $en ? 'Exploration permits and mineral targets map' : 'Carte des permis d’exploration et des cibles minérales' }}" data-exploration-caption="{{ $en ? 'Exploration permits, targets and licence coverage.' : 'Permis d’exploration, cibles et couverture des titres.' }}"><img src="{{ asset('images/exploration/permis-carte.jpg') }}" alt="{{ $en ? 'Exploration permits and mineral targets map' : 'Carte des permis d’exploration et des cibles minérales' }}" loading="lazy"></button>
            <div class="exploration-card__body">
                <div class="card-tag">{{ $en ? 'Portfolio' : 'Portefeuille' }}</div>
                <h3>{{ $en ? 'A connected exploration portfolio' : 'Un portefeuille d’exploration connecté' }}</h3>
                <p>{{ $en ? 'The permit map shows the broader exploration footprint across Tibtenga, Ronga, Sodin, Basnere, Boulonga, Rambi, Rigui and Yake. It connects individual targets to a structured portfolio of licences and future work areas.' : 'La carte des permis montre l’empreinte d’exploration élargie autour de Tibtenga, Ronga, Sodin, Basnere, Boulonga, Rambi, Rigui et Yake. Elle relie les cibles individuelles à un portefeuille structuré de titres et de zones de travaux futurs.' }}</p>
                <div class="exploration-card__meta"><span><strong>{{ $en ? 'Focus:' : 'Objectif :' }}</strong> {{ $en ? 'licence and target coverage' : 'couverture des titres et cibles' }}</span><span><strong>{{ $en ? 'Tool:' : 'Support :' }}</strong> {{ $en ? 'permit mapping' : 'cartographie des permis' }}</span></div>
            </div>
        </article>
    </div>

    <div class="exploration-evidence" aria-label="{{ $en ? 'Exploration field evidence' : 'Documents visuels de l’exploration' }}">
        <figure>
            <button type="button" data-exploration-image="{{ asset('images/exploration/panorama-goulagou.png') }}" data-exploration-alt="{{ $en ? 'Annotated 180 degree view from Goulagou Hill' : 'Vue panoramique annotée depuis la colline de Goulagou' }}" data-exploration-caption="{{ $en ? 'Annotated Goulagou Hill panorama.' : 'Panorama annoté depuis la colline de Goulagou.' }}"><img src="{{ asset('images/exploration/panorama-goulagou.png') }}" alt="{{ $en ? 'Annotated 180 degree view from Goulagou Hill' : 'Vue panoramique annotée depuis la colline de Goulagou' }}" loading="lazy"></button>
            <figcaption>{{ $en ? 'Goulagou Hill panorama: the annotated horizon places GG1, Nami, Rambo, GG2 and Kao within the exploration landscape.' : 'Panorama de la colline de Goulagou : l’horizon annoté situe GG1, Nami, Rambo, GG2 et Kao dans le paysage d’exploration.' }}</figcaption>
        </figure>
        <figure>
            <button type="button" data-exploration-image="{{ asset('images/exploration/equipe-instrumentation.jpg') }}" data-exploration-alt="{{ $en ? 'Exploration team working with technical equipment' : 'Équipe d’exploration travaillant avec un équipement technique' }}" data-exploration-caption="{{ $en ? 'Field team and technical instrumentation.' : 'Équipe terrain et instrumentation technique.' }}"><img src="{{ asset('images/exploration/equipe-instrumentation.jpg') }}" alt="{{ $en ? 'Exploration team working with technical equipment' : 'Équipe d’exploration travaillant avec un équipement technique' }}" loading="lazy"></button>
            <figcaption>{{ $en ? 'Field teams and technical instrumentation support data collection and target assessment.' : 'Les équipes et l’instrumentation terrain soutiennent la collecte des données et l’évaluation des cibles.' }}</figcaption>
        </figure>
        <figure>
            <button type="button" data-exploration-image="{{ asset('images/exploration/permis-tableau.png') }}" data-exploration-alt="{{ $en ? 'Exploration permits validity table' : 'Tableau de validité des permis d’exploration' }}" data-exploration-caption="{{ $en ? 'Exploration permit register and validity dates.' : 'Registre des permis d’exploration et dates de validité.' }}"><img src="{{ asset('images/exploration/permis-tableau.png') }}" alt="{{ $en ? 'Exploration permits validity table' : 'Tableau de validité des permis d’exploration' }}" loading="lazy"></button>
            <figcaption>{{ $en ? 'Permit register: Dassoui, Basnere Est and Ouest, Lougouri, Ronga, Rigui and Zanna are shown with their holders and validity years.' : 'Registre des permis : Dassoui, Basnere Est et Ouest, Lougouri, Ronga, Rigui et Zanna sont présentés avec leurs détenteurs et années de validité.' }}</figcaption>
        </figure>
    </div>
</section>

<section class="sand sr" style="margin-top: 24px;">
    <div class="card" style="padding: 28px;">
        <div class="card-tag">{{ $en ? 'Priority' : 'Priorité' }}</div>
        <h3>{{ $en ? 'A disciplined exploration strategy' : 'Une stratégie d’exploration disciplinée' }}</h3>
        <p style="margin:0; text-align:justify;">
            {{ $en
                ? 'Each project is evaluated through geological analysis, resource potential and a realistic development timeline. The objective is to identify deposits that can create value while staying aligned with responsible mining standards and local expectations.'
                : 'Chaque projet est évalué selon son potentiel géologique, sa valeur économique et un calendrier de développement réaliste. L’objectif est d’identifier des gisements capables de créer de la valeur tout en restant alignés avec les normes minières responsables et les attentes locales.' }}
        </p>
    </div>
    </section>

    <div class="exploration-lightbox" data-exploration-lightbox aria-hidden="true">
        <figure class="exploration-lightbox__dialog">
            <button class="exploration-lightbox__close" type="button" data-exploration-close>{{ $en ? 'Close' : 'Fermer' }}</button>
            <img data-exploration-preview src="" alt="">
            <figcaption data-exploration-caption></figcaption>
        </figure>
    </div>

    <script>
        (() => {
            const lightbox = document.querySelector('[data-exploration-lightbox]');
            const preview = lightbox?.querySelector('[data-exploration-preview]');
            const caption = lightbox?.querySelector('[data-exploration-caption]');
            const close = () => {
                lightbox?.classList.remove('is-open');
                lightbox?.setAttribute('aria-hidden', 'true');
                if (preview) preview.removeAttribute('src');
            };
            document.querySelectorAll('[data-exploration-image]').forEach((button) => button.addEventListener('click', () => {
                if (!lightbox || !preview || !caption) return;
                preview.src = button.dataset.explorationImage;
                preview.alt = button.dataset.explorationAlt || '';
                caption.textContent = button.dataset.explorationCaption || '';
                lightbox.classList.add('is-open');
                lightbox.setAttribute('aria-hidden', 'false');
                lightbox.querySelector('[data-exploration-close]')?.focus();
            }));
            lightbox?.querySelector('[data-exploration-close]')?.addEventListener('click', close);
            lightbox?.addEventListener('click', (event) => { if (event.target === lightbox) close(); });
            document.addEventListener('keydown', (event) => { if (event.key === 'Escape') close(); });
        })();
    </script>
</section>



@endsection
