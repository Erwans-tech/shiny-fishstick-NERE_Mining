{{-- Page : Mine de Karma --}}
@extends('layouts.app')

@section('content')

<style>
    .karma-page h2,
    .karma-page h3,
    .karma-page h4 { text-align: center; }
    .karma-page > section > .lead,
    .karma-page .card p { text-align: justify; }

    /* Premium touches */
    .karma-production-card { border-left: 4px solid var(--gold); }
    .karma-production-card .card-img { object-position: center; }
    .karma-production-card--open-pit .card-img { object-position: 52% center; }
    .karma-production-card--processing .card-img { object-position: center 58%; }
    .karma-production-card--team .card-img { object-position: center 32%; }
    .karma-impact-card { background: linear-gradient(135deg, rgba(255,255,255,1) 0%, rgba(247,243,238,1) 100%); }
    .karma-step-connector { display: flex; align-items: center; justify-content: center; }
</style>

<div class="karma-page">
{{-- Présentation & localisation --}}
<section id="presentation">
    <h2>{{ __('site.karma_pres_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_pres_lead', [], $loc) }}</p>

    <div class="grid-2" style="margin-bottom:40px;">
        <div>
            <div class="card" style="margin-bottom:20px;">
                <h4>{{ __('site.karma_history_h4', [], $loc) }}</h4>
                <p>{{ __('site.karma_history_p', [], $loc) }}</p>
            </div>
            <div class="card" style="margin-bottom:20px;">
                <h4>{{ __('site.karma_loc_h4', [], $loc) }}</h4>
                <p>{!! nl2br(e(__('site.karma_loc_p', [], $loc))) !!}</p>
            </div>
            <div class="card">
                <h4>{{ __('site.karma_area_h4', [], $loc) }}</h4>
                <p>{{ __('site.karma_area_p', [], $loc) }}</p>
            </div>
        </div>
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125836.0!2d-2.2!3d13.63!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMine+de+Karma!5e0!3m2!1s{{ $loc }}!2sbf!4v1"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="{{ $en ? 'Location of the Karma mine' : 'Localisation de la mine de Karma' }}">
            </iframe>
        </div>
    </div>
</section>

{{-- Chiffres de production --}}
<section id="exploitation" class="sand">
    <h2>{{ __('site.karma_prod_h2', [], $loc) }}</h2>
    <div class="stat-band">
        <div class="stat-item"><span class="stat-value">97 koz</span><span class="stat-label">{{ $en ? 'Annual average (2019-2021)' : "Production annuelle moyenne (2019-2021)" }}</span></div>
        <div class="stat-item"><span class="stat-value">949 koz</span><span class="stat-label">{{ $en ? 'Total gold reserves' : 'Réserves or totales' }}</span></div>
        <div class="stat-item"><span class="stat-value">33.2 Mt</span><span class="stat-label">{{ $en ? 'Ore reserves' : 'Réserves minerai' }}</span></div>
        <div class="stat-item"><span class="stat-value">11 yrs</span><span class="stat-label">{{ $en ? 'Extended mine life' : 'Durée mine étendue' }}</span></div>
    </div>
    <div class="grid-3">
        <div class="card karma-production-card karma-production-card--open-pit">
            <img class="card-img" src="{{ asset('images/mining/karma-05.jpg') }}" alt="{{ $en ? 'Open-pit mining' : 'Extraction à ciel ouvert' }}">
            <h3>{{ __('site.karma_card1_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_card1_p', [], $loc) }}</p>
        </div>
        <div class="card karma-production-card karma-production-card--processing">
            <img class="card-img" src="{{ asset('images/mining/karma-04.jpg') }}" alt="{{ $en ? 'Gold processing plant' : "Usine de traitement de l'or" }}">
            <h3>{{ __('site.karma_card2_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_card2_p', [], $loc) }}</p>
        </div>
        <div class="card karma-production-card karma-production-card--team">
            <img class="card-img" src="{{ asset('images/mining/karma-01.jpg') }}" alt="{{ $en ? 'Burkinabe mining team' : 'Équipe minière burkinabè' }}">
            <h3>{{ __('site.karma_card3_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_card3_p', [], $loc) }}</p>
        </div>
    </div>
</section>

@if(false)
{{-- Production Timeline --}}
<section id="production-timeline">
    <h2>{{ $en ? 'Production & Development Timeline' : 'Timeline de Production & Développement' }}</h2>
    <p class="lead" style="text-align:center; margin-bottom:32px;">{{ $en ? 'Karma mine history from 2007 to present' : 'Historique de la mine de Karma de 2007 à nos jours' }}</p>
    
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px; margin-bottom:40px;">
        <div style="background:var(--light); padding:20px; border-radius:8px; border-left:4px solid var(--gold); text-align:center;">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2007</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;">{{ $en ? 'Acquisition by True Gold Mining' : 'Acquisition par True Gold Mining' }}</div>
        </div>
        <div style="background:var(--light); padding:20px; border-radius:8px; border-left:4px solid var(--gold); text-align:center;">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2012-2016</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;">{{ $en ? 'Exploration & development' : 'Exploration & développement' }}</div>
        </div>
        <div style="background:var(--light); padding:20px; border-radius:8px; border-left:4px solid var(--gold); text-align:center;">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2017-2018</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;">{{ $en ? 'Construction phase' : 'Phase de construction' }}</div>
        </div>
        <div style="background:var(--light); padding:20px; border-radius:8px; border-left:4px solid var(--gold); text-align:center;">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2019</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;">{{ $en ? 'First production' : 'Première production' }}</div>
        </div>
        <div style="background:var(--light); padding:20px; border-radius:8px; border-left:4px solid var(--gold); text-align:center;">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2024</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;">{{ $en ? 'Néré Mining transition' : 'Transition Néré Mining' }}</div>
        </div>
        <div style="background:var(--light); padding:20px; border-radius:8px; border-left:4px solid var(--gold); text-align:center;">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2026+</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;">{{ $en ? 'CIL plant & expansion' : 'Usine CIL & expansion' }}</div>
        </div>
    </div>

    <div style="background:#fff; padding:24px; border:1px solid var(--line); border-radius:8px;">
        <h3 style="color:var(--green); margin:0 0 12px 0; font-size:16px; font-weight:600;">{{ $en ? 'Key Milestones' : 'Jalons Clés' }}</h3>
        <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
            <li style="margin-bottom:12px;">✓ {{ $en ? '2007: Acquired Goulagou and Rounga properties (487 km²)' : '2007: Acquisition des propriétés Goulagou et Rounga (487 km²)' }}</li>
            <li style="margin-bottom:12px;">✓ {{ $en ? '2019: Commenced gold production at 80 Koz annually' : '2019: Démarrage production or à 80 Koz annuels' }}</li>
            <li style="margin-bottom:12px;">✓ {{ $en ? '2024: Transition to Burkinabè-majority ownership (Néré Mining)' : '2024: Transition vers majorité actionnaire burkinabè (Néré Mining)' }}</li>
            <li>✓ {{ $en ? '2026+: CIL plant commissioning for refractory ore processing' : '2026+: Mise en service usine CIL pour traitement minerai réfractaire' }}</li>
        </ul>
    </div>
</section>

{{-- Ressources & Réserves --}}
<section id="ressources" class="sand">
    <h2>{{ $en ? 'Mineral Resources & Reserves' : 'Ressources & Réserves Minérales' }}</h2>
    <p class="lead" style="text-align:center; margin-bottom:32px;">{{ $en ? 'JORC-classified mineral resources across five major deposits at Karma' : 'Ressources minérales classifiées JORC dans cinq gisements majeurs' }}</p>
    
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:28px; align-items:start; margin-bottom:48px;">
        {{-- Table Gisements --}}
        <div style="border:1px solid var(--line); border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,.06);">
            <table style="width:100%; border-collapse:collapse; font-size:13px; line-height:1.6;">
                <thead>
                    <tr style="background:linear-gradient(135deg, var(--green), var(--gold)); color:#fff;">
                        <th style="padding:14px; text-align:left; font-weight:600;">{{ $en ? 'Deposit' : 'Gisement' }}</th>
                        <th style="padding:14px; text-align:center; font-weight:600;">Tonnage (Kt)</th>
                        <th style="padding:14px; text-align:center; font-weight:600;">Grade (g/t)</th>
                        <th style="padding:14px; text-align:center; font-weight:600;">Gold (Koz)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom:1px solid var(--line); background:#fff;">
                        <td style="padding:12px 14px; font-weight:600;">Nami</td>
                        <td style="padding:12px 14px; text-align:center;">1,634</td>
                        <td style="padding:12px 14px; text-align:center;">0.82</td>
                        <td style="padding:12px 14px; text-align:center;">43</td>
                    </tr>
                    <tr style="border-bottom:1px solid var(--line); background:#fff;">
                        <td style="padding:12px 14px; font-weight:600;">GG1</td>
                        <td style="padding:12px 14px; text-align:center;">5,888</td>
                        <td style="padding:12px 14px; text-align:center;">1.00</td>
                        <td style="padding:12px 14px; text-align:center;">189</td>
                    </tr>
                    <tr style="border-bottom:1px solid var(--line); background:#fff;">
                        <td style="padding:12px 14px; font-weight:600;">GG2</td>
                        <td style="padding:12px 14px; text-align:center;">5,320</td>
                        <td style="padding:12px 14px; text-align:center;">1.65</td>
                        <td style="padding:12px 14px; text-align:center;">281</td>
                    </tr>
                    <tr style="border-bottom:1px solid var(--line); background:#fff;">
                        <td style="padding:12px 14px; font-weight:600;">Kao</td>
                        <td style="padding:12px 14px; text-align:center;">3,200</td>
                        <td style="padding:12px 14px; text-align:center;">1.42</td>
                        <td style="padding:12px 14px; text-align:center;">146</td>
                    </tr>
                    <tr style="border-bottom:1px solid var(--line); background:#fff;">
                        <td style="padding:12px 14px; font-weight:600;">Goulagou</td>
                        <td style="padding:12px 14px; text-align:center;">1,950</td>
                        <td style="padding:12px 14px; text-align:center;">1.28</td>
                        <td style="padding:12px 14px; text-align:center;">80</td>
                    </tr>
                    <tr style="background:var(--light); font-weight:600; border-top:2px solid var(--green);">
                        <td style="padding:12px 14px;">{{ $en ? 'Total' : 'Total' }}</td>
                        <td style="padding:12px 14px; text-align:center;">17,992</td>
                        <td style="padding:12px 14px; text-align:center;">1.24</td>
                        <td style="padding:12px 14px; text-align:center;">739</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Info & Description --}}
        <div>
            <div style="background:#fff; padding:20px; border-radius:8px; border:1px solid var(--line); margin-bottom:16px;">
                <h3 style="color:var(--green); margin-bottom:12px; font-size:16px; font-weight:600;">{{ $en ? 'Resource Overview' : 'Vue d\'Ensemble des Ressources' }}</h3>
                <p style="color:var(--muted); font-size:14px; line-height:1.7; margin:0;">{{ $en ? 'The Karma mine contains JORC-compliant mineral resources across five major deposits. Total measured, indicated and inferred resources amount to approximately 18 Mt with an average grade of 1.24 g/t Au.' : 'La mine de Karma contient des ressources minérales conformes JORC réparties sur cinq gisements majeurs. Les ressources mesurées, indiquées et inférées totalisent environ 18 Mt avec une teneur moyenne de 1,24 g/t Au.' }}</p>
            </div>

            <div style="background:var(--light); padding:16px; border-radius:6px; border-left:4px solid var(--green);">
                <h4 style="color:var(--green); margin:0 0 12px 0; font-size:14px; font-weight:600;">{{ $en ? 'Classification' : 'Classification' }}</h4>
                <ul style="list-style:none; padding:0; margin:0; font-size:13px; line-height:1.8; color:var(--muted);">
                    <li>• {{ $en ? 'Measured Resources: High confidence deposits' : 'Ressources Mesurées: Gisements haute confiance' }}</li>
                    <li>• {{ $en ? 'Indicated Resources: Established geological continuity' : 'Ressources Indiquées: Continuité géologique établie' }}</li>
                    <li>• {{ $en ? 'Inferred Resources: Limited geological evidence' : 'Ressources Inférées: Preuves géologiques limitées' }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Organisation --}}
@endif
<section id="organisation">
    <h2>{{ __('site.karma_org_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_org_lead', [], $loc) }}</p>
    <div class="grid-3">
        @forelse($karmaDepartments ?? collect() as $dept)
        @php
            $deptTag = trim((string) $dept->localizedTag($loc));
            $deptTitle = trim((string) $dept->localizedTitle($loc));
            $deptBody = trim((string) $dept->localizedBody($loc));
        @endphp
        <div class="card">
            <div class="card-tag">{{ $deptTag !== '' ? $deptTag : __('site.karma_dept'.$loop->iteration.'_tag', [], $loc) }}</div>
            <h3>{{ $deptTitle !== '' ? $deptTitle : __('site.karma_dept'.$loop->iteration.'_h3', [], $loc) }}</h3>
            <p>{{ $deptBody !== '' ? $deptBody : __('site.karma_dept'.$loop->iteration.'_p', [], $loc) }}</p>
        </div>
        @empty
        @foreach(range(1, 9) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.karma_dept'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.karma_dept'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_dept'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
        @endforelse
    </div>
</section>

{{-- Modèle opérationnel --}}
<section id="modele-operationnel" class="sand">
    <h2>{{ __('site.karma_model_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_model_lead', [], $loc) }}</p>
    <div class="steps" style="border:1px solid var(--line); border-radius:8px; overflow:hidden; background:#fff; margin-bottom:40px;">
        @foreach(range(1, 4) as $i)
        <div class="step">
            <div class="step-num">0{{ $i }}</div>
            <h4>{{ __('site.karma_step'.$i.'_h4', [], $loc) }}</h4>
            <p>{{ __('site.karma_step'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- Impact --}}
<section id="impact">
    <h2>{{ __('site.karma_impact_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_impact_lead', [], $loc) }}</p>
    <div class="grid-2">
        <div>
            <h3>{{ __('site.karma_imp_jobs_h3', [], $loc) }}</h3>
            @foreach(range(1, 3) as $i)
            <div class="card karma-impact-card" style="margin-bottom:18px;">
                <div class="card-tag">{{ __('site.karma_imp_job'.$i.'_tag', [], $loc) }}</div>
                <p>{{ __('site.karma_imp_job'.$i.'_p', [], $loc) }}</p>
            </div>
            @endforeach
        </div>
        <div>
            <h3>{{ __('site.karma_imp_eco_h3', [], $loc) }}</h3>
            @foreach(range(1, 3) as $i)
            <div class="card karma-impact-card" style="margin-bottom:18px;">
                <div class="card-tag">{{ __('site.karma_imp_eco'.$i.'_tag', [], $loc) }}</div>
                <p>{{ __('site.karma_imp_eco'.$i.'_p', [], $loc) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

</div>
@endsection
