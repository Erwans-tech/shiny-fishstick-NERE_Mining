{{-- Page : Ressources et réserves minérales de Karma --}}
@extends('layouts.app')

@section('content')
@push('styles')
<style>
    .rr-page { padding-top:0; }
    .rr-intro { display:grid; grid-template-columns:1.1fr .9fr; gap:28px; align-items:center; margin-bottom:42px; }
    .rr-intro img { width:100%; height:300px; object-fit:cover; border-radius:14px; box-shadow:0 14px 30px rgba(75,23,22,.14); }
    .rr-intro h2 { margin-bottom:14px; }
    .rr-note { margin-top:18px; color:var(--muted); font-size:13px; line-height:1.7; }
    .rr-section { padding:46px 0; }
    .rr-section + .rr-section { border-top:1px solid var(--line); }
    .rr-section--sand { margin-left:calc(50% - 50vw); margin-right:calc(50% - 50vw); padding-left:clamp(24px,5vw,88px); padding-right:clamp(24px,5vw,88px); background:linear-gradient(180deg,#fff8e8,#fff4dc); }
    .rr-heading { max-width:760px; margin:0 auto 26px; text-align:center; }
    .rr-heading h2 { margin-bottom:10px; }
    .rr-heading p { margin:0; text-align:center; font-size:15px; }
    .rr-kpis { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; }
    .rr-kpi { padding:22px 16px; text-align:center; background:#fff; border:1px solid var(--line); border-top:3px solid var(--gold); border-radius:10px; box-shadow:0 8px 20px rgba(75,23,22,.06); }
    .rr-kpi strong { display:block; color:var(--green); font-size:28px; line-height:1.1; }
    .rr-kpi span { display:block; margin-top:8px; color:var(--muted); font-size:11px; line-height:1.4; text-transform:uppercase; letter-spacing:.06em; }
    .rr-table-wrap { overflow-x:auto; border:1px solid var(--line); border-radius:12px; box-shadow:0 10px 24px rgba(75,23,22,.08); }
    .rr-table { width:100%; min-width:680px; border-collapse:collapse; background:#fff; font-size:13px; }
    .rr-table th { padding:14px 16px; color:#fff; background:linear-gradient(110deg,var(--green),#8f5b28); text-align:right; white-space:nowrap; }
    .rr-table th:first-child,.rr-table td:first-child { text-align:left; }
    .rr-table td { padding:13px 16px; border-bottom:1px solid var(--line); text-align:right; }
    .rr-table tbody tr:last-child { background:var(--sand); font-weight:700; border-top:2px solid var(--green); }
    .rr-table tbody tr:hover { background:#fff8e8; }
    .rr-columns { display:grid; grid-template-columns:1fr 1fr; gap:22px; }
    .rr-card { padding:24px; background:#fff; border:1px solid var(--line); border-radius:12px; box-shadow:0 8px 20px rgba(40,29,24,.06); }
    .rr-card h3 { margin-bottom:10px; color:var(--green); font-size:20px; }
    .rr-card p { margin:0; font-size:14px; line-height:1.7; }
    .rr-card ul { margin:12px 0 0; padding-left:18px; color:var(--muted); font-size:14px; line-height:1.8; }
    .rr-gallery { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; }
    .rr-gallery figure { margin:0; overflow:hidden; background:#fff; border:1px solid var(--line); border-radius:12px; }
    .rr-zoom-button { display:block; width:100%; padding:0; border:0; background:none; cursor:zoom-in; }
    .rr-zoom-button:focus-visible { outline:3px solid var(--gold); outline-offset:-3px; }
    .rr-gallery img { display:block; width:100%; height:210px; object-fit:cover; }
    .rr-gallery figcaption { padding:14px 16px; color:var(--muted); font-size:13px; line-height:1.5; }
    .rr-lightbox { position:fixed; inset:0; z-index:500; display:none; align-items:center; justify-content:center; padding:28px; background:rgba(20,8,6,.9); }
    .rr-lightbox.is-open { display:flex; }
    .rr-lightbox-dialog { position:relative; max-width:min(1500px,96vw); max-height:92vh; margin:0; }
    .rr-lightbox img { display:block; max-width:100%; max-height:82vh; object-fit:contain; background:#fff; border-radius:8px; }
    .rr-lightbox figcaption { margin-top:12px; color:#fff; text-align:center; font-size:14px; line-height:1.5; }
    .rr-lightbox-close { position:absolute; top:-42px; right:0; border:1px solid rgba(255,255,255,.55); background:var(--green); color:#fff; padding:8px 14px; border-radius:4px; cursor:pointer; font:600 11px Inter,sans-serif; text-transform:uppercase; }
    @media(max-width:900px) { .rr-intro,.rr-columns { grid-template-columns:1fr; } .rr-kpis { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:560px) { .rr-kpis,.rr-gallery { grid-template-columns:1fr; } .rr-gallery img { height:220px; } .rr-lightbox { padding:16px; } }
</style>
@endpush

<div class="rr-page">
    <section class="rr-intro">
        <div>
            <h2>{{ $en ? 'Karma mineral resources and reserves' : 'Ressources et réserves minérales de Karma' }}</h2>
            <p class="lead">{{ $en ? 'A consolidated view of the deposits, resources and reserves that support the development of the Karma mining complex.' : 'Une vue consolidée des gisements, ressources et réserves qui soutiennent le développement du complexe minier de Karma.' }}</p>
            <p class="rr-note">{{ $en ? 'The figures presented follow the available project documentation and the JORC reporting framework. They are provided for information and remain subject to technical updates.' : 'Les chiffres présentés suivent la documentation disponible du projet et le référentiel de déclaration JORC. Ils sont communiqués à titre informatif et restent susceptibles d’être actualisés selon les études techniques.' }}</p>
        </div>
        <button class="rr-zoom-button" type="button" data-rr-image="{{ asset('images/resources/resources-map.jpg') }}" data-rr-alt="{{ $en ? 'Karma mineral resources map' : 'Carte des ressources minérales de Karma' }}" data-rr-caption="{{ $en ? 'Geological map locating the Karma deposits, exploration targets, lithologies and distance rings around the processing area.' : 'Carte géologique localisant les gisements de Karma, les cibles d’exploration, les lithologies et les couronnes de distance autour de l’usine.' }}">
            <img src="{{ asset('images/resources/resources-map.jpg') }}" alt="{{ $en ? 'Karma mineral resources map' : 'Carte des ressources minérales de Karma' }}" loading="lazy">
        </button>
    </section>

    <section class="rr-section rr-section--sand">
        <div class="rr-heading"><h2>{{ $en ? 'Key figures' : 'Chiffres clés' }}</h2><p>{{ $en ? 'Main resource and reserve indicators for the Karma project.' : 'Principaux indicateurs de ressources et de réserves du projet Karma.' }}</p></div>
        <div class="rr-kpis">
            <div class="rr-kpi"><strong>6 638 Koz</strong><span>{{ $en ? 'P&P resources · 0.97 g/t Au' : 'Ressources P&P · 0,97 g/t Au' }}</span></div>
            <div class="rr-kpi"><strong>87 528 Koz</strong><span>{{ $en ? 'M&I resources · 0.93 g/t Au' : 'Ressources M&I · 0,93 g/t Au' }}</span></div>
            <div class="rr-kpi"><strong>18 103 Kt</strong><span>{{ $en ? 'Inferred resources · 1.25 g/t Au · 725 Koz' : 'Ressources inférées · 1,25 g/t Au · 725 Koz' }}</span></div>
            <div class="rr-kpi"><strong>25/04/2025</strong><span>{{ $en ? 'Reference date' : 'Date de référence' }}</span></div>
        </div>
    </section>

    <section class="rr-section">
        <div class="rr-heading"><h2>{{ $en ? 'Resources by deposit' : 'Ressources par gisement' }}</h2><p>{{ $en ? 'Classification according to the JORC reporting framework.' : 'Classification selon le référentiel de déclaration JORC.' }}</p></div>
        <div class="rr-table-wrap"><table class="rr-table"><thead><tr><th>{{ $en ? 'Deposit' : 'Gisement' }}</th><th>{{ $en ? 'Type' : 'Type' }}</th><th>{{ $en ? 'Tonnage (Kt)' : 'Tonnage (Kt)' }}</th><th>{{ $en ? 'Grade (g/t)' : 'Teneur (g/t)' }}</th><th>{{ $en ? 'Gold (Koz)' : 'Or (Koz)' }}</th></tr></thead><tbody>
            @foreach([
                ['Nami',$en?'Oxide':'Oxydé','1,633','0.82','15.2'],['GG1',$en?'Mixed':'Mixte','5,888','1.00','36.3'],['GG2',$en?'Sulfide':'Sulfuré','5,320','1.65','59.8'],['Kao',$en?'Mixed':'Mixte','3,156','0.95','27.1'],['Goulagou',$en?'Oxide':'Oxydé','1,641','0.78','11.2']
            ] as $deposit)
            <tr><td>{{ $deposit[0] }}</td><td>{{ $deposit[1] }}</td><td>{{ $deposit[2] }}</td><td>{{ $deposit[3] }}</td><td>{{ $deposit[4] }}</td></tr>
            @endforeach
            <tr><td colspan="2">TOTAL</td><td>17,638</td><td>1.16</td><td>149.6</td></tr>
        </tbody></table></div>
        <p class="rr-note">{{ $en ? '* Resources reported at a 0.4 g/t Au cut-off grade. JORC-compliant reporting; data as of 25 April 2025.' : '* Ressources rapportées à une teneur de coupure de 0,4 g/t Au. Rapport conforme à la norme JORC ; données du 25 avril 2025.' }}</p>
    </section>

    <section class="rr-section rr-section--sand">
        <div class="rr-heading"><h2>{{ $en ? 'Probable reserves' : 'Réserves probables' }}</h2><p>{{ $en ? 'Economically extractable reserves with proven mining viability.' : 'Réserves économiquement exploitables avec une viabilité minière établie.' }}</p></div>
        <div class="rr-columns">
            <div class="rr-card"><h3>{{ $en ? 'By deposit' : 'Par gisement' }}</h3><ul><li>GG1 : 662 Kt, 0.70 g/t, 15 Koz</li><li>Kao Nord : 4 031 Kt, 1.14 g/t, 148 Koz</li><li>Yabonsgo : 297 Kt, 1.57 g/t, 15 Koz</li><li>Nami : 896 Kt, 0.76 g/t, 22 Koz</li><li><strong>Total : 5 886 Kt, 1.06 g/t, 200 Koz</strong></li></ul></div>
            <figure class="rr-card"><button class="rr-zoom-button" type="button" data-rr-image="{{ asset('images/mining/reserves-table.jpg') }}" data-rr-alt="{{ $en ? 'Probable reserves table' : 'Tableau des réserves probables' }}" data-rr-caption="{{ $en ? 'Probable reserves by deposit, split by oxide, transition and sulphide material.' : 'Réserves probables par gisement, ventilées entre minerai oxydé, de transition et sulfuré.' }}"><img src="{{ asset('images/mining/reserves-table.jpg') }}" alt="{{ $en ? 'Probable reserves table' : 'Tableau des réserves probables' }}" loading="lazy" style="display:block;width:100%;max-height:300px;object-fit:contain;"></button><p style="margin-top:12px;text-align:center;">{{ $en ? 'Probable reserves by deposit.' : 'Réserves probables par gisement.' }}</p></figure>
        </div>
    </section>

    <section class="rr-section">
        <div class="rr-heading"><h2>{{ $en ? 'Measured, indicated and inferred resources' : 'Ressources mesurées, indiquées et inférées' }}</h2><p>{{ $en ? 'The geological confidence level guides how each resource category is interpreted and developed.' : 'Le niveau de confiance géologique guide l’interprétation et le développement de chaque catégorie de ressources.' }}</p></div>
        <div class="rr-columns">
            <div class="rr-card"><h3>{{ $en ? 'Measured and indicated' : 'Mesurées et indiquées' }}</h3><p>{{ $en ? 'These resources benefit from established geological continuity and drilling data across the principal deposits.' : 'Ces ressources bénéficient d’une continuité géologique établie et de données de forage sur les principaux gisements.' }}</p><ul><li>Kao Main : 26 901 Kt à 0,84 g/t</li><li>GG2 : 14 316 Kt à 1,31 g/t</li><li>Kao Nord : 12 024 Kt à 1,16 g/t</li><li>GG1 : 4 971 Kt à 0,72 g/t</li></ul></div>
            <div class="rr-card"><h3>{{ $en ? 'Inferred resources' : 'Ressources inférées' }}</h3><p>{{ $en ? 'Estimated from more limited geological evidence, these resources may evolve as exploration and development continue.' : 'Estimées à partir de données géologiques plus limitées, ces ressources peuvent évoluer avec la poursuite de l’exploration et du développement.' }}</p><div class="rr-kpis" style="margin-top:18px;grid-template-columns:repeat(3,1fr);"><div class="rr-kpi"><strong>18 103</strong><span>Kt</span></div><div class="rr-kpi"><strong>1.25</strong><span>g/t</span></div><div class="rr-kpi"><strong>725</strong><span>Koz</span></div></div></div>
        </div>
    </section>

    <section class="rr-section rr-section--sand">
        <div class="rr-heading"><h2>{{ $en ? 'Technical overview' : 'Aperçu technique' }}</h2><p>{{ $en ? 'Maps and reference documents supporting the resource and reserve overview.' : 'Cartes et documents de référence qui accompagnent la synthèse des ressources et réserves.' }}</p></div>
        <div class="rr-gallery"><figure><button class="rr-zoom-button" type="button" data-rr-image="{{ asset('images/resources/resources-reserves-2025.jpg') }}" data-rr-alt="{{ $en ? 'Karma resources and reserves' : 'Ressources et réserves de Karma' }}" data-rr-caption="{{ $en ? 'Consolidated resources and reserves map dated 25 April 2025, with deposit-level P&P, M&I and inferred figures.' : 'Carte consolidée des ressources et réserves datée du 25 avril 2025, avec les chiffres P&P, M&I et inférés par gisement.' }}"><img src="{{ asset('images/resources/resources-reserves-2025.jpg') }}" alt="{{ $en ? 'Karma resources and reserves' : 'Ressources et réserves de Karma' }}" loading="lazy"></button><figcaption>{{ $en ? 'Resources and reserves overview' : 'Vue d’ensemble des ressources et réserves' }}</figcaption></figure><figure><button class="rr-zoom-button" type="button" data-rr-image="{{ asset('images/mining/reserves-chart.jpg') }}" data-rr-alt="{{ $en ? 'Measured and indicated resources' : 'Ressources mesurées et indiquées' }}" data-rr-caption="{{ $en ? 'The table totals 96,320 Kt at 0.92 g/t Au and 2,841 Koz for measured and indicated resources.' : 'Le tableau totalise 96 320 Kt à 0,92 g/t Au et 2 841 Koz pour les ressources mesurées et indiquées.' }}"><img src="{{ asset('images/mining/reserves-chart.jpg') }}" alt="{{ $en ? 'Measured and indicated resources' : 'Ressources mesurées et indiquées' }}" loading="lazy"></button><figcaption>{{ $en ? 'Measured and indicated resources' : 'Ressources mesurées et indiquées' }}</figcaption></figure><figure><button class="rr-zoom-button" type="button" data-rr-image="{{ asset('images/resources/licenses-map.jpg') }}" data-rr-alt="{{ $en ? 'Karma licenses map' : 'Carte des permis de Karma' }}" data-rr-caption="{{ $en ? 'License map showing the Karma exploitation permit and surrounding exploration holdings and deposits.' : 'Carte des permis montrant le permis d’exploitation de Karma, les titres d’exploration voisins et les gisements.' }}"><img src="{{ asset('images/resources/licenses-map.jpg') }}" alt="{{ $en ? 'Karma licenses map' : 'Carte des permis de Karma' }}" loading="lazy"></button><figcaption>{{ $en ? 'Licenses and exploration area' : 'Permis et zone d’exploration' }}</figcaption></figure></div>
    </section>

</div>

<div class="rr-lightbox" data-rr-lightbox aria-hidden="true">
    <figure class="rr-lightbox-dialog">
        <button class="rr-lightbox-close" type="button" data-rr-close>{{ $en ? 'Close' : 'Fermer' }}</button>
        <img data-rr-preview src="" alt="">
        <figcaption data-rr-caption></figcaption>
    </figure>
</div>

<script>
    (() => {
        const lightbox = document.querySelector('[data-rr-lightbox]');
        const preview = lightbox?.querySelector('[data-rr-preview]');
        const caption = lightbox?.querySelector('[data-rr-caption]');
        const close = () => {
            lightbox?.classList.remove('is-open');
            lightbox?.setAttribute('aria-hidden', 'true');
            if (preview) preview.removeAttribute('src');
        };
        document.querySelectorAll('[data-rr-image]').forEach((button) => button.addEventListener('click', () => {
            if (!lightbox || !preview || !caption) return;
            preview.src = button.dataset.rrImage;
            preview.alt = button.dataset.rrAlt || '';
            caption.textContent = button.dataset.rrCaption || '';
            lightbox.classList.add('is-open');
            lightbox.setAttribute('aria-hidden', 'false');
            lightbox.querySelector('[data-rr-close]')?.focus();
        }));
        lightbox?.querySelector('[data-rr-close]')?.addEventListener('click', close);
        lightbox?.addEventListener('click', (event) => { if (event.target === lightbox) close(); });
        document.addEventListener('keydown', (event) => { if (event.key === 'Escape') close(); });
    })();
</script>
@endsection
