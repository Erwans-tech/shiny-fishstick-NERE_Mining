{{-- Page : Réserves minérales --}}
@extends('layouts.app')

@section('content')
<style>
    /* ══ Hero Section ════════════════════════════════════════════ */
    .reserves-hero { display:grid; grid-template-columns:1.1fr .9fr; gap:30px; align-items:center; }
    .reserves-hero img { width:100%; height:450px; object-fit:cover; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,.12); }
    
    /* ══ Section Headers ════════════════════════════════════════ */
    .reserves-header { text-align:center; margin-bottom:32px; }
    .reserves-header h2 { font-size:28px; font-weight:600; color:var(--green); margin-bottom:12px; }
    .reserves-header p { color:var(--muted); font-size:14px; line-height:1.7; }
    
    /* ══ Table Section ════════════════════════════════════════════ */
    .reserves-table-wrapper { display:grid; grid-template-columns:1fr 1fr; gap:28px; align-items:start; margin-bottom:48px; }
    .reserves-table-container { border:1px solid var(--line); border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.06); }
    .reserves-table { width:100%; border-collapse:collapse; font-size:13px; line-height:1.6; }
    .reserves-table thead tr { background:linear-gradient(135deg, var(--green), var(--gold)); color:#fff; }
    .reserves-table th { padding:14px; text-align:left; font-weight:600; }
    .reserves-table th:not(:first-child) { text-align:center; }
    .reserves-table td { padding:12px 14px; border-bottom:1px solid var(--line); }
    .reserves-table td:not(:first-child) { text-align:center; font-variant-numeric:tabular-nums; }
    .reserves-table tbody tr:hover { background:var(--light); }
    .reserves-table tbody tr:last-child { background:var(--sand); font-weight:600; border-top:2px solid var(--green); }
    
    /* ══ Figure with Caption ════════════════════════════════════ */
    .reserves-figure { margin:0; }
    .reserves-figure img { width:100%; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,.12); display:block; }
    .reserves-figure figcaption { font-size:12px; color:var(--muted); margin-top:12px; text-align:center; line-height:1.6; }
    
    /* ══ Content Grid ════════════════════════════════════════════ */
    .reserves-content-grid { display:grid; grid-template-columns:1fr 1fr; gap:28px; align-items:start; }
    .reserves-content-card { background:#fff; padding:20px; border-radius:8px; border:1px solid var(--line); }
    .reserves-content-card h3 { color:var(--green); margin-bottom:12px; font-size:16px; font-weight:600; }
    .reserves-content-card p { color:var(--muted); font-size:14px; line-height:1.7; }
    .reserves-highlight { background:var(--light); padding:16px; border-radius:6px; border-left:4px solid var(--green); margin-top:12px; }
    .reserves-highlight ul { list-style:none; padding:0; margin:0; font-size:13px; line-height:1.8; }
    .reserves-highlight li { color:var(--muted); }
    .reserves-highlight strong { color:var(--ink); }
    
    /* ══ KPI Band ════════════════════════════════════════════════ */
    .reserves-kpi-band { display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:14px; }
    .reserves-kpi-item { background:#fff; padding:18px; border-radius:6px; border:1px solid var(--line); text-align:center; transition:all .25s; }
    .reserves-kpi-item:hover { box-shadow:0 4px 12px rgba(0,0,0,.08); transform:translateY(-2px); }
    .reserves-kpi-value { font-size:22px; font-weight:700; color:var(--green); margin-bottom:6px; font-variant-numeric:tabular-nums; }
    .reserves-kpi-label { font-size:11px; color:var(--muted); font-weight:500; text-transform:uppercase; letter-spacing:.5px; }
    .reserves-kpi-item.gold .reserves-kpi-value { color:var(--gold); }
    
    /* ══ Classification Grid ════════════════════════════════════ */
    .reserves-definitions { display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:20px; }
    .reserves-definition { padding:16px; background:#fff; border-radius:6px; border:1px solid var(--line); }
    .reserves-definition h4 { color:var(--green); margin-bottom:8px; font-size:14px; font-weight:600; }
    .reserves-definition p { color:var(--muted); font-size:13px; line-height:1.7; margin:0; }
    
    /* ══ Responsive ═════════════════════════════════════════════ */
    @media (max-width:960px) {
        .reserves-hero, .reserves-table-wrapper, .reserves-content-grid { grid-template-columns:1fr; }
        .reserves-hero img { height:300px; }
    }
    
    @media (max-width:768px) {
        .reserves-header h2 { font-size:22px; }
        .reserves-table { font-size:11px; }
        .reserves-table th, .reserves-table td { padding:10px; }
        .reserves-kpi-band { grid-template-columns:repeat(2, 1fr); }
    }
    
    @media (max-width:480px) {
        .reserves-table { font-size:10px; }
        .reserves-table th, .reserves-table td { padding:8px; }
        .reserves-kpi-band { grid-template-columns:1fr; }
    }
</style>

<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.karma') : route('karma') }}">{{ __('site.nav_karma', [], $loc) }}</a>
        <a href="{{ $en ? route('english.resources') : route('resources') }}">{{ __('site.nav_karma_resources', [], $loc) }}</a>
        <a href="{{ $en ? route('english.reserves') : route('reserves') }}" class="active">{{ __('site.nav_karma_reserves', [], $loc) }}</a>
    </div>

    {{-- ══ Hero Section ════════════════════════════════════════════ --}}
    <div class="reserves-hero">
        <div>
            <p class="lead">{{ __('site.karma_reserves_lead', [], $loc) }}</p>
            <p>{{ __('site.karma_reserves_detail', [], $loc) }}</p>
        </div>
        <img src="{{ asset('images/mining/karma-05.jpg') }}"
             alt="{{ __('site.karma_reserves_image_alt', [], $loc) }}"
             loading="lazy" decoding="async">
    </div>
</section>


<section class="sand">
    {{-- ══ Probable Reserves Section ═════════════════════════════ --}}
    <div class="reserves-header">
        <h2>{{ $en ? 'Probable Reserves' : 'Réserves Probables' }}</h2>
        <p>{{ $en ? 'Economically extractable mineral reserves with proven mining viability' : 'Réserves minérales économiquement exploitables avec viabilité minière prouvée' }}</p>
    </div>
    
    <div class="reserves-table-wrapper">
        {{-- Table HTML --}}
        <div class="reserves-table-container">
            <table class="reserves-table">
                <thead>
                    <tr>
                        <th>{{ $en ? 'Deposit' : 'Gisement' }}</th>
                        <th>Oxide (Kt)</th>
                        <th>g/t</th>
                        <th>Koz</th>
                        <th>{{ $en ? 'Total' : 'Total' }} (Kt)</th>
                        <th>g/t</th>
                        <th>Koz</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>GG1</td>
                        <td>357</td>
                        <td>0.60</td>
                        <td>7</td>
                        <td>662</td>
                        <td>0.70</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>Kao Nord</td>
                        <td>3,700</td>
                        <td>1.10</td>
                        <td>134</td>
                        <td>4,031</td>
                        <td>1.14</td>
                        <td>148</td>
                    </tr>
                    <tr>
                        <td>Yabonsgo</td>
                        <td>258</td>
                        <td>1.50</td>
                        <td>13</td>
                        <td>297</td>
                        <td>1.57</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>Nami</td>
                        <td>751</td>
                        <td>0.70</td>
                        <td>18</td>
                        <td>896</td>
                        <td>0.76</td>
                        <td>22</td>
                    </tr>
                    <tr>
                        <td>{{ $en ? 'Total' : 'Total' }}</td>
                        <td>5,066</td>
                        <td>1.06</td>
                        <td>172</td>
                        <td>5,886</td>
                        <td>1.06</td>
                        <td>200</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Image --}}
        <figure class="reserves-figure">
            <img src="{{ asset('images/mining/reserves-table.jpg') }}"
                 alt="{{ $en ? 'Probable Reserves Table' : 'Tableau des Réserves Probables' }}"
                 loading="lazy" decoding="async">
            <figcaption>
                {{ $en ? 'Probable mineral reserves by deposit (Kt = thousand tonnes, g/t = grams per tonne, Koz = thousand ounces)' : 'Réserves minérales probables par gisement (Kt = milliers de tonnes, g/t = grammes par tonne, Koz = milliers d\'onces)' }}
            </figcaption>
        </figure>
    </div>
</section>

<section>
    {{-- ══ Measured & Indicated Resources ═════════════════════════ --}}
    <div class="reserves-header">
        <h2>{{ $en ? 'Indicated & Measured Mineral Resources' : 'Ressources Minérales Mesurées et Indiquées' }}</h2>
        <p>{{ $en ? 'Mineral resources with established geological confidence and drilling data' : 'Ressources minérales avec confiance géologique établie et données de forage' }}</p>
    </div>
    
    <div class="reserves-table-wrapper">
        {{-- Image --}}
        <figure class="reserves-figure">
            <img src="{{ asset('images/mining/reserves-chart.jpg') }}"
                 alt="{{ $en ? 'Indicated & Measured Resources' : 'Ressources Indiquées et Mesurées' }}"
                 loading="lazy" decoding="async">
            <figcaption>
                {{ $en ? 'Measured and Indicated Mineral Resources across major deposits' : 'Ressources Minérales Mesurées et Indiquées sur les gisements majeurs' }}
            </figcaption>
        </figure>

        {{-- Descriptive Content --}}
        <div>
            <div class="reserves-content-card">
                <h3>{{ $en ? 'Key Resources' : 'Ressources Clés' }}</h3>
                <p>
                    {{ $en 
                        ? 'The Karma mining complex hosts significant measured and indicated mineral resources across multiple deposits. These resources have been classified based on geological confidence and drilling data.'
                        : 'Le complexe minier de Karma dispose de ressources minérales mesurées et indiquées importantes dans plusieurs gisements. Ces ressources ont été classées selon la confiance géologique et les données de forage.' }}
                </p>
            </div>

            <div class="reserves-highlight">
                <h4 style="color:var(--green); margin:0 0 12px 0; font-size:14px; font-weight:600;">
                    {{ $en ? 'Major Deposits' : 'Gisements Majeurs' }}
                </h4>
                <ul>
                    <li>• <strong>Kao Main:</strong> {{ $en ? '26,901 Kt at 0.84 g/t' : '26 901 Kt à 0,84 g/t' }}</li>
                    <li>• <strong>GG2:</strong> {{ $en ? '14,316 Kt at 1.31 g/t' : '14 316 Kt à 1,31 g/t' }}</li>
                    <li>• <strong>Kao Nord:</strong> {{ $en ? '12,024 Kt at 1.16 g/t' : '12 024 Kt à 1,16 g/t' }}</li>
                    <li>• <strong>GG1:</strong> {{ $en ? '4,971 Kt at 0.72 g/t' : '4 971 Kt à 0,72 g/t' }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="sand">
    {{-- ══ Inferred Resources ════════════════════════════════════ --}}
    <div class="reserves-header">
        <h2>{{ $en ? 'Inferred Mineral Resources' : 'Ressources Minérales Inférées' }}</h2>
        <p>{{ $en ? 'Mineral resources estimated with limited geological evidence' : 'Ressources minérales estimées avec preuves géologiques limitées' }}</p>
    </div>
    
    <p style="color:var(--muted); font-size:14px; line-height:1.8; margin-bottom:24px; text-align:center;">
        {{ $en 
            ? 'Inferred mineral resources are estimated based on limited geological evidence and sampling. They represent mineralization that is beyond the limits of reasonable assumption but may become included in reserves as exploration and development activities continue.'
            : 'Les ressources minérales inférées sont estimées sur la base de données géologiques et d\'échantillonnage limités. Elles représentent une minéralisation au-delà des limites d\'une hypothèse raisonnable mais peuvent devenir incluses dans les réserves à mesure que les activités d\'exploration et de développement se poursuivent.' }}
    </p>
    
    <div class="reserves-kpi-band">
        <div class="reserves-kpi-item">
            <div class="reserves-kpi-value">18,103</div>
            <div class="reserves-kpi-label">{{ $en ? 'Total Inferred' : 'Total Inféré' }} (Kt)</div>
        </div>
        <div class="reserves-kpi-item">
            <div class="reserves-kpi-value">1.25</div>
            <div class="reserves-kpi-label">{{ $en ? 'Average Grade' : 'Teneur Moyenne' }} (g/t)</div>
        </div>
        <div class="reserves-kpi-item gold">
            <div class="reserves-kpi-value">725</div>
            <div class="reserves-kpi-label">{{ $en ? 'Gold Content' : 'Contenu Or' }} (Koz)</div>
        </div>
    </div>
</section>

<section>
    {{-- ══ Classification Definitions ════════════════════════════ --}}
    <div class="reserves-header">
        <h2>{{ $en ? 'Classification Definitions' : 'Définitions de Classification' }}</h2>
        <p>{{ $en ? 'JORC (Australasian Code for Reporting of Exploration Results, Mineral Resources and Ore Reserves) standard definitions' : 'Définitions selon le code JORC (Australian Code for Reporting of Exploration Results, Mineral Resources and Ore Reserves)' }}</p>
    </div>
    
    <div class="reserves-definitions">
        <div class="reserves-definition">
            <h4>{{ $en ? 'Ore Reserves' : 'Réserves de Minerai' }}</h4>
            <p>
                {{ $en 
                    ? 'Mineralization that is economically extractable, based on reasonable mining assumptions and detailed resource/reserve estimates.'
                    : 'Minéralisation économiquement exploitable, basée sur des hypothèses minières raisonnables et des estimations détaillées des ressources/réserves.' }}
            </p>
        </div>
        
        <div class="reserves-definition">
            <h4>{{ $en ? 'Measured Resources' : 'Ressources Mesurées' }}</h4>
            <p>
                {{ $en 
                    ? 'Estimates where confidence in geological and grade continuity is high, based on detailed sampling and geological mapping.'
                    : 'Estimations avec confiance élevée en la continuité géologique et de la teneur, basées sur l\'échantillonnage et le levé géologique détaillés.' }}
            </p>
        </div>
        
        <div class="reserves-definition">
            <h4>{{ $en ? 'Indicated Resources' : 'Ressources Indiquées' }}</h4>
            <p>
                {{ $en 
                    ? 'Estimates of reasonable geological and grade confidence, based on exploration and sampling at appropriate locations.'
                    : 'Estimations avec confiance géologique et de teneur raisonnable, basées sur l\'exploration et l\'échantillonnage aux emplacements appropriés.' }}
            </p>
        </div>
        
        <div class="reserves-definition">
            <h4>{{ $en ? 'Inferred Resources' : 'Ressources Inférées' }}</h4>
            <p>
                {{ $en 
                    ? 'Estimates based on limited geological evidence, where confidence in continuity is reasonable but not sufficient for conversion to reserves.'
                    : 'Estimations basées sur des preuves géologiques limitées, où la confiance en la continuité est raisonnable mais insuffisante pour la conversion en réserves.' }}
            </p>
        </div>
    </div>
</section>
        </div>
    </div>
</section>
@endsection
