{{-- Page : Réserves minérales --}}
@extends('layouts.app')

@section('content')
<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.karma') : route('karma') }}">{{ __('site.nav_karma', [], $loc) }}</a>
        <a href="{{ $en ? route('english.resources') : route('resources') }}">{{ __('site.nav_karma_resources', [], $loc) }}</a>
        <a href="{{ $en ? route('english.reserves') : route('reserves') }}" class="active">{{ __('site.nav_karma_reserves', [], $loc) }}</a>
    </div>

    {{-- ══ Introduction ════════════════════════════════════════════ --}}
    <div class="grid-2" style="align-items:center;">
        <img class="card-img" src="{{ asset('images/mining/karma-05.jpg') }}"
             alt="{{ __('site.karma_reserves_image_alt', [], $loc) }}"
             loading="lazy" decoding="async">
        <div>
            <p class="lead">{{ __('site.karma_reserves_lead', [], $loc) }}</p>
            <p>{{ __('site.karma_reserves_detail', [], $loc) }}</p>
        </div>
    </div>

    {{-- ══ Probable Reserves Table ════════════════════════════════ --}}
    <div style="margin-top:60px;">
        <h2 style="text-align:center; margin-bottom:24px; color:var(--green);">
            {{ $en ? 'Probable Reserves' : 'Réserves Probables' }}
        </h2>
        
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; align-items:start; margin-bottom:40px;">
            {{-- Table HTML --}}
            <div class="table-responsive">
                <table style="width:100%; border-collapse:collapse; font-size:13px; line-height:1.6;">
                    <thead>
                        <tr style="background:var(--gold); color:var(--ink);">
                            <th style="padding:12px; text-align:left; font-weight:600;">{{ $en ? 'Deposit' : 'Gisement' }}</th>
                            <th style="padding:12px; text-align:center; font-weight:600;">Oxide (Kt)</th>
                            <th style="padding:12px; text-align:center; font-weight:600;">g/t</th>
                            <th style="padding:12px; text-align:center; font-weight:600;">Koz</th>
                            <th style="padding:12px; text-align:center; font-weight:600;">{{ $en ? 'Total' : 'Total' }} (Kt)</th>
                            <th style="padding:12px; text-align:center; font-weight:600;">g/t</th>
                            <th style="padding:12px; text-align:center; font-weight:600;">Koz</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom:1px solid var(--line);">
                            <td style="padding:12px; font-weight:600;">GG1</td>
                            <td style="padding:12px; text-align:center;">357</td>
                            <td style="padding:12px; text-align:center;">0.60</td>
                            <td style="padding:12px; text-align:center;">7</td>
                            <td style="padding:12px; text-align:center; font-weight:600;">662</td>
                            <td style="padding:12px; text-align:center;">0.70</td>
                            <td style="padding:12px; text-align:center;">15</td>
                        </tr>
                        <tr style="border-bottom:1px solid var(--line);">
                            <td style="padding:12px; font-weight:600;">Kao Nord</td>
                            <td style="padding:12px; text-align:center;">3,700</td>
                            <td style="padding:12px; text-align:center;">1.10</td>
                            <td style="padding:12px; text-align:center;">-134</td>
                            <td style="padding:12px; text-align:center; font-weight:600;">4,031</td>
                            <td style="padding:12px; text-align:center;">1.14</td>
                            <td style="padding:12px; text-align:center;">148</td>
                        </tr>
                        <tr style="border-bottom:1px solid var(--line);">
                            <td style="padding:12px; font-weight:600;">Yabonsgo</td>
                            <td style="padding:12px; text-align:center;">258</td>
                            <td style="padding:12px; text-align:center;">1.50</td>
                            <td style="padding:12px; text-align:center;">13</td>
                            <td style="padding:12px; text-align:center; font-weight:600;">297</td>
                            <td style="padding:12px; text-align:center;">1.57</td>
                            <td style="padding:12px; text-align:center;">15</td>
                        </tr>
                        <tr style="border-bottom:1px solid var(--line);">
                            <td style="padding:12px; font-weight:600;">Nami</td>
                            <td style="padding:12px; text-align:center;">751</td>
                            <td style="padding:12px; text-align:center;">0.70</td>
                            <td style="padding:12px; text-align:center;">18</td>
                            <td style="padding:12px; text-align:center; font-weight:600;">896</td>
                            <td style="padding:12px; text-align:center;">0.76</td>
                            <td style="padding:12px; text-align:center;">22</td>
                        </tr>
                        <tr style="background:var(--light); font-weight:600; border-top:2px solid var(--green);">
                            <td style="padding:12px;">{{ $en ? 'Total' : 'Total' }}</td>
                            <td style="padding:12px; text-align:center;">5,066</td>
                            <td style="padding:12px; text-align:center;">1.06</td>
                            <td style="padding:12px; text-align:center;">172</td>
                            <td style="padding:12px; text-align:center;">5,886</td>
                            <td style="padding:12px; text-align:center;">1.06</td>
                            <td style="padding:12px; text-align:center;">200</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Image --}}
            <figure>
                <img src="{{ asset('images/mining/reserves-table.jpg') }}"
                     alt="{{ $en ? 'Probable Reserves Table' : 'Tableau des Réserves Probables' }}"
                     style="width:100%; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);"
                     loading="lazy" decoding="async">
                <figcaption style="font-size:12px; color:var(--muted); margin-top:8px; text-align:center;">
                    {{ $en ? 'Probable mineral reserves by deposit (Kt = thousand tonnes, g/t = grams per tonne, Koz = thousand ounces)' : 'Réserves minérales probables par gisement (Kt = milliers de tonnes, g/t = grammes par tonne, Koz = milliers d\'onces)' }}
                </figcaption>
            </figure>
        </div>
    </div>

    {{-- ══ Measured & Indicated Resources ══════════════════════════ --}}
    <div style="margin-top:60px;">
        <h2 style="text-align:center; margin-bottom:24px; color:var(--green);">
            {{ $en ? 'Indicated & Measured Mineral Resources' : 'Ressources Minérales Mesurées et Indiquées' }}
        </h2>
        
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; align-items:start; margin-bottom:40px;">
            {{-- Image --}}
            <figure>
                <img src="{{ asset('images/mining/reserves-chart.jpg') }}"
                     alt="{{ $en ? 'Indicated & Measured Resources' : 'Ressources Indiquées et Mesurées' }}"
                     style="width:100%; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);"
                     loading="lazy" decoding="async">
                <figcaption style="font-size:12px; color:var(--muted); margin-top:8px; text-align:center;">
                    {{ $en ? 'Measured and Indicated Mineral Resources across major deposits' : 'Ressources Minérales Mesurées et Indiquées sur les gisements majeurs' }}
                </figcaption>
            </figure>

            {{-- Descriptive Content --}}
            <div style="display:flex; flex-direction:column; gap:16px;">
                <div>
                    <h3 style="color:var(--green); margin-bottom:8px; font-size:16px;">
                        {{ $en ? 'Key Resources' : 'Ressources Clés' }}
                    </h3>
                    <p style="color:var(--muted); font-size:14px; line-height:1.7;">
                        {{ $en 
                            ? 'The Karma mining complex hosts significant measured and indicated mineral resources across multiple deposits. These resources have been classified based on geological confidence and drilling data.'
                            : 'Le complexe minier de Karma dispose de ressources minérales mesurées et indiquées importantes dans plusieurs gisements. Ces ressources ont été classées selon la confiance géologique et les données de forage.' }}
                    </p>
                </div>

                <div style="background:var(--light); padding:16px; border-radius:6px; border-left:4px solid var(--green);">
                    <h4 style="color:var(--green); margin-bottom:8px; font-size:14px;">
                        {{ $en ? 'Major Deposits' : 'Gisements Majeurs' }}
                    </h4>
                    <ul style="list-style:none; padding:0; font-size:13px; line-height:1.8; color:var(--muted);">
                        <li>• <strong>Kao Main:</strong> {{ $en ? '26,901 Kt at 0.84 g/t' : '26 901 Kt à 0,84 g/t' }}</li>
                        <li>• <strong>GG2:</strong> {{ $en ? '14,316 Kt at 1.31 g/t' : '14 316 Kt à 1,31 g/t' }}</li>
                        <li>• <strong>Kao Nord:</strong> {{ $en ? '12,024 Kt at 1.16 g/t' : '12 024 Kt à 1,16 g/t' }}</li>
                        <li>• <strong>GG1:</strong> {{ $en ? '4,971 Kt at 0.72 g/t' : '4 971 Kt à 0,72 g/t' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ Inferred Resources ═════════════════════════════════════ --}}
    <div style="margin-top:60px; margin-bottom:60px;">
        <h2 style="text-align:center; margin-bottom:24px; color:var(--green);">
            {{ $en ? 'Inferred Mineral Resources' : 'Ressources Minérales Inférées' }}
        </h2>
        
        <div style="background:var(--light); padding:32px; border-radius:8px; border-top:4px solid var(--gold);">
            <p style="font-size:14px; line-height:1.8; color:var(--muted); margin-bottom:16px;">
                {{ $en 
                    ? 'Inferred mineral resources are estimated based on limited geological evidence and sampling. They represent mineralization that is beyond the limits of reasonable assumption but may become included in reserves as exploration and development activities continue.'
                    : 'Les ressources minérales inférées sont estimées sur la base de données géologiques et d\'échantillonnage limités. Elles représentent une minéralisation au-delà des limites d\'une hypothèse raisonnable mais peuvent devenir incluses dans les réserves à mesure que les activités d\'exploration et de développement se poursuivent.' }}
            </p>
            
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:12px;">
                <div style="background:#fff; padding:12px; border-radius:4px; border:1px solid var(--line);">
                    <p style="font-size:12px; color:var(--muted); margin-bottom:4px;">{{ $en ? 'Total Inferred Resources' : 'Total Ressources Inférées' }}</p>
                    <p style="font-size:18px; font-weight:600; color:var(--green);">18,103 Kt</p>
                    <p style="font-size:12px; color:var(--muted);">{{ $en ? 'at 1.25 g/t' : 'à 1,25 g/t' }}</p>
                </div>
                <div style="background:#fff; padding:12px; border-radius:4px; border:1px solid var(--line);">
                    <p style="font-size:12px; color:var(--muted); margin-bottom:4px;">{{ $en ? 'Total Gold Content' : 'Teneur Totale en Or' }}</p>
                    <p style="font-size:18px; font-weight:600; color:var(--gold);">725 Koz</p>
                    <p style="font-size:12px; color:var(--muted);">{{ $en ? 'thousand ounces' : 'milliers d\'onces' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ══ Summary & Definitions ═════════════════════════════════ --}}
    <div style="background:var(--sand); padding:32px; border-radius:8px; margin-bottom:40px;">
        <h3 style="color:var(--green); margin-bottom:16px; font-size:16px;">
            {{ $en ? 'Classification Definitions' : 'Définitions de Classification' }}
        </h3>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:16px; font-size:13px; line-height:1.7;">
            <div>
                <h4 style="color:var(--green); margin-bottom:6px;">{{ $en ? 'Reserves' : 'Réserves' }}</h4>
                <p style="color:var(--muted);">
                    {{ $en 
                        ? 'Mineralization that is economically extractable, based on reasonable mining assumptions and detailed resource/reserve estimates.'
                        : 'Minéralisation économiquement exploitable, basée sur des hypothèses minières raisonnables et des estimations détaillées des ressources/réserves.' }}
                </p>
            </div>
            
            <div>
                <h4 style="color:var(--green); margin-bottom:6px;">{{ $en ? 'Measured Resources' : 'Ressources Mesurées' }}</h4>
                <p style="color:var(--muted);">
                    {{ $en 
                        ? 'Estimates where confidence in geological and grade continuity is high, based on detailed sampling and geological mapping.'
                        : 'Estimations avec confiance élevée en la continuité géologique et de la teneur, basées sur l\'échantillonnage et le levé géologique détaillés.' }}
                </p>
            </div>
            
            <div>
                <h4 style="color:var(--green); margin-bottom:6px;">{{ $en ? 'Indicated Resources' : 'Ressources Indiquées' }}</h4>
                <p style="color:var(--muted);">
                    {{ $en 
                        ? 'Estimates of reasonable geological and grade confidence, based on exploration and sampling at appropriate locations.'
                        : 'Estimations avec confiance géologique et de teneur raisonnable, basées sur l\'exploration et l\'échantillonnage aux emplacements appropriés.' }}
                </p>
            </div>
            
            <div>
                <h4 style="color:var(--green); margin-bottom:6px;">{{ $en ? 'Inferred Resources' : 'Ressources Inférées' }}</h4>
                <p style="color:var(--muted);">
                    {{ $en 
                        ? 'Estimates based on limited geological evidence, where confidence in continuity is reasonable but not sufficient for conversion to reserves.'
                        : 'Estimations basées sur des preuves géologiques limitées, où la confiance en la continuité est raisonnable mais insuffisante pour la conversion en réserves.' }}
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    .table-responsive {
        overflow-x:auto;
        border:1px solid var(--line);
        border-radius:6px;
    }
    
    @media (max-width:768px) {
        .table-responsive table {
            font-size:11px;
        }
        .table-responsive table th,
        .table-responsive table td {
            padding:8px !important;
        }
    }
</style>
@endsection
