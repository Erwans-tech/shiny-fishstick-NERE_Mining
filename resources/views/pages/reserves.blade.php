{{-- Page : Réserves minérales --}}
@extends('layouts.app')
@section('content')
<style>
    /* Stat cards */
    .reserves-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin: 40px 0 0;
    }
    .reserves-stat-card {
        background: linear-gradient(135deg, rgba(75,23,22,0.95) 0%, rgba(75,23,22,0.8) 100%);
        color: #fff;
        border-radius: 16px;
        padding: 28px 24px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .reserves-stat-card::after {
        content: '';
        position: absolute;
        top: -30px;
        right: -30px;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: rgba(255,194,71,0.15);
    }
    .reserves-stat-value {
        font: 700 clamp(1.6rem, 3vw, 2.2rem)/1 'Inter', sans-serif;
        color: var(--gold);
    }
    .reserves-stat-unit {
        font: 500 13px/1 'Inter', sans-serif;
        color: rgba(255,255,255,0.6);
        margin-top: 4px;
        display: block;
    }
    .reserves-stat-label {
        font: 500 12px/1.3 'Inter', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: rgba(255,255,255,0.75);
        margin-top: 10px;
    }

    /* Category cards */
    .reserves-category {
        background: linear-gradient(180deg, #ffffff 0%, #f9f6f0 100%);
        border: 1px solid rgba(75,23,22,0.1);
        border-radius: 16px;
        padding: 28px 28px 24px;
        transition: transform 0.3s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.3s;
    }
    .reserves-category:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(40,29,24,0.08);
    }
    .reserves-category h3 {
        font: 600 clamp(1rem, 2vw, 1.15rem)/1.3 'Inter', sans-serif;
        color: var(--ink);
        margin-bottom: 8px;
    }
    .reserves-category p {
        font: 400 14px/1.6 'Inter', sans-serif;
        color: var(--muted);
        margin-bottom: 16px;
    }
    .reserves-category .cat-stats {
        display: flex;
        gap: 24px;
        padding-top: 16px;
        border-top: 1px solid var(--line);
    }
    .reserves-category .cat-stat {
        display: flex;
        flex-direction: column;
    }
    .reserves-category .cat-stat-value {
        font: 700 clamp(1.1rem, 2vw, 1.4rem)/1 'Inter', sans-serif;
        color: var(--green);
    }
    .reserves-category .cat-stat-label {
        font: 500 11px/1.3 'Inter', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--muted);
        margin-top: 3px;
    }

    /* Tables */
    .reserves-table-wrap {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid var(--line);
        background: #fff;
    }
    .reserves-table {
        width: 100%;
        border-collapse: collapse;
        font: 400 13px/1.5 'Inter', sans-serif;
    }
    .reserves-table thead {
        background: var(--green);
        color: #fff;
    }
    .reserves-table th {
        padding: 12px 14px;
        text-align: left;
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        white-space: nowrap;
    }
    .reserves-table td {
        padding: 10px 14px;
        border-bottom: 1px solid var(--line);
    }
    .reserves-table tbody tr:last-child td {
        border-bottom: none;
    }
    .reserves-table tbody tr:hover {
        background: rgba(255,194,71,0.06);
    }
    .reserves-table tfoot {
        background: rgba(75,23,22,0.04);
        font-weight: 700;
    }
    .reserves-table tfoot td {
        padding: 12px 14px;
        border-top: 2px solid var(--green);
        border-bottom: none;
    }
    .reserves-table .num { text-align: right; font-variant-numeric: tabular-nums; }

    /* Figures */
    .reserves-figure {
        background: linear-gradient(180deg, #ffffff 0%, #f9f6f0 100%);
        border: 1px solid rgba(75,23,22,0.1);
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.3s;
    }
    .reserves-figure:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(40,29,24,0.08);
    }
    .reserves-figure img { width: 100%; height: auto; display: block; }
    .reserves-figure figcaption {
        padding: 14px 20px;
        font: 500 13px/1.5 'Inter', sans-serif;
        color: var(--muted);
        text-align: center;
        border-top: 1px solid var(--line);
    }

    /* Note */
    .reserves-note {
        background: linear-gradient(135deg, rgba(255,194,71,0.08) 0%, rgba(255,255,255,1) 100%);
        border: 1px solid rgba(255,194,71,0.25);
        border-radius: 12px;
        padding: 20px 24px;
        font: 400 14px/1.7 'Inter', sans-serif;
        color: var(--muted);
        margin-top: 40px;
    }
    .reserves-note::before {
        content: 'ℹ️';
        margin-right: 8px;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .reserves-stats { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .reserves-stats { grid-template-columns: 1fr; }
    }
</style>

{{-- Introduction + Chiffres clés --}}
<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.karma') : route('karma') }}">{{ __('site.nav_karma', [], $loc) }}</a>
        <a href="{{ $en ? route('english.resources') : route('resources') }}">{{ __('site.nav_karma_resources', [], $loc) }}</a>
        <a href="{{ $en ? route('english.reserves') : route('reserves') }}" class="active">{{ __('site.nav_karma_reserves', [], $loc) }}</a>
    </div>

    <p class="lead sr">{{ __('site.karma_reserves_lead', [], $loc) }}</p>
    <p class="sr">{{ __('site.karma_reserves_detail', [], $loc) }}</p>

    {{-- Chiffres-clés --}}
    <div class="reserves-stats">
        <div class="reserves-stat-card sr">
            <div class="reserves-stat-value">200</div>
            <span class="reserves-stat-unit">koz Au</span>
            <div class="reserves-stat-label">{{ __('site.karma_reserves_stat_probable', [], $loc) }}</div>
        </div>
        <div class="reserves-stat-card sr">
            <div class="reserves-stat-value">2 841</div>
            <span class="reserves-stat-unit">koz Au</span>
            <div class="reserves-stat-label">{{ __('site.karma_reserves_stat_indicated', [], $loc) }}</div>
        </div>
        <div class="reserves-stat-card sr">
            <div class="reserves-stat-value">725</div>
            <span class="reserves-stat-unit">koz Au</span>
            <div class="reserves-stat-label">{{ __('site.karma_reserves_stat_inferred', [], $loc) }}</div>
        </div>
        <div class="reserves-stat-card sr">
            <div class="reserves-stat-value">13</div>
            <span class="reserves-stat-unit">+</span>
            <div class="reserves-stat-label">{{ __('site.karma_reserves_stat_deposits', [], $loc) }}</div>
        </div>
    </div>
</section>

{{-- Trois catégories --}}
<section class="sand">
    <div class="grid-3">
        {{-- Réserves probables --}}
        <div class="reserves-category sr">
            <div class="card-tag">01</div>
            <h3>{{ __('site.karma_reserves_probable_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_reserves_probable_desc', [], $loc) }}</p>
            <div class="cat-stats">
                <div class="cat-stat">
                    <span class="cat-stat-value">5 886</span>
                    <span class="cat-stat-label">Kt</span>
                </div>
                <div class="cat-stat">
                    <span class="cat-stat-value">1.06</span>
                    <span class="cat-stat-label">g/t Au</span>
                </div>
                <div class="cat-stat">
                    <span class="cat-stat-value">200</span>
                    <span class="cat-stat-label">koz</span>
                </div>
            </div>
        </div>

        {{-- Ressources mesurées & indiquées --}}
        <div class="reserves-category sr">
            <div class="card-tag">02</div>
            <h3>{{ __('site.karma_reserves_indicated_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_reserves_indicated_desc', [], $loc) }}</p>
            <div class="cat-stats">
                <div class="cat-stat">
                    <span class="cat-stat-value">96 320</span>
                    <span class="cat-stat-label">Kt</span>
                </div>
                <div class="cat-stat">
                    <span class="cat-stat-value">0.92</span>
                    <span class="cat-stat-label">g/t Au</span>
                </div>
                <div class="cat-stat">
                    <span class="cat-stat-value">2 841</span>
                    <span class="cat-stat-label">koz</span>
                </div>
            </div>
        </div>

        {{-- Ressources inférées --}}
        <div class="reserves-category sr">
            <div class="card-tag">03</div>
            <h3>{{ __('site.karma_reserves_inferred_h3', [], $loc) }}</h3>
            <p>{{ __('site.karma_reserves_inferred_desc', [], $loc) }}</p>
            <div class="cat-stats">
                <div class="cat-stat">
                    <span class="cat-stat-value">18 103</span>
                    <span class="cat-stat-label">Kt</span>
                </div>
                <div class="cat-stat">
                    <span class="cat-stat-value">1.25</span>
                    <span class="cat-stat-label">g/t Au</span>
                </div>
                <div class="cat-stat">
                    <span class="cat-stat-value">725</span>
                    <span class="cat-stat-label">koz</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Tableau — Réserves probables --}}
<section>
    <h3 class="sr" style="margin-bottom: 20px;">{{ __('site.karma_reserves_probable_h3', [], $loc) }}</h3>
    <div class="reserves-table-wrap sr">
        <table class="reserves-table">
            <thead>
                <tr>
                    <th>{{ __('site.karma_reserves_col_deposit', [], $loc) }}</th>
                    <th class="num">{{ __('site.karma_reserves_col_tonnage', [], $loc) }}</th>
                    <th class="num">{{ __('site.karma_reserves_col_grade', [], $loc) }}</th>
                    <th class="num">{{ __('site.karma_reserves_col_gold', [], $loc) }}</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>GG1</td><td class="num">662</td><td class="num">0.70</td><td class="num">15</td></tr>
                <tr><td>Kao Nord</td><td class="num">4 031</td><td class="num">1.14</td><td class="num">148</td></tr>
                <tr><td>Yabonsgo</td><td class="num">297</td><td class="num">1.57</td><td class="num">15</td></tr>
                <tr><td>Nami</td><td class="num">896</td><td class="num">0.76</td><td class="num">22</td></tr>
            </tbody>
            <tfoot>
                <tr><td>Total</td><td class="num">5 886</td><td class="num">1.06</td><td class="num">200</td></tr>
            </tfoot>
        </table>
    </div>
</section>

{{-- Tableau — Ressources mesurées & indiquées --}}
<section class="sand">
    <h3 class="sr" style="margin-bottom: 20px;">{{ __('site.karma_reserves_indicated_h3', [], $loc) }}</h3>
    <div class="reserves-table-wrap sr">
        <table class="reserves-table">
            <thead>
                <tr>
                    <th>{{ __('site.karma_reserves_col_deposit', [], $loc) }}</th>
                    <th class="num">{{ __('site.karma_reserves_col_tonnage', [], $loc) }}</th>
                    <th class="num">{{ __('site.karma_reserves_col_grade', [], $loc) }}</th>
                    <th class="num">{{ __('site.karma_reserves_col_gold', [], $loc) }}</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>GG1</td><td class="num">4 971</td><td class="num">0.72</td><td class="num">114</td></tr>
                <tr><td>GG2</td><td class="num">14 316</td><td class="num">1.31</td><td class="num">602</td></tr>
                <tr><td>Kao Main</td><td class="num">26 901</td><td class="num">0.84</td><td class="num">729</td></tr>
                <tr><td>Kao Nord</td><td class="num">12 024</td><td class="num">1.16</td><td class="num">449</td></tr>
                <tr><td>Rambo Main</td><td class="num">5 892</td><td class="num">1.10</td><td class="num">208</td></tr>
                <tr><td>Nami</td><td class="num">6 475</td><td class="num">0.65</td><td class="num">136</td></tr>
                <tr><td>Rambo West</td><td class="num">4 622</td><td class="num">0.67</td><td class="num">100</td></tr>
                <tr><td>Yabonsgo</td><td class="num">4 441</td><td class="num">1.04</td><td class="num">149</td></tr>
                <tr><td>Kao Anomalie B</td><td class="num">1 047</td><td class="num">0.51</td><td class="num">17</td></tr>
                <tr><td>Kao Main Nord-Ouest</td><td class="num">5 384</td><td class="num">0.80</td><td class="num">139</td></tr>
                <tr><td>KNSE+KNSE_ext</td><td class="num">8 016</td><td class="num">0.58</td><td class="num">149</td></tr>
                <tr><td>Kao Nord Central</td><td class="num">2 232</td><td class="num">0.66</td><td class="num">47</td></tr>
            </tbody>
            <tfoot>
                <tr><td>Total</td><td class="num">96 320</td><td class="num">0.92</td><td class="num">2 841</td></tr>
            </tfoot>
        </table>
    </div>
</section>

{{-- Tableau — Ressources inférées --}}
<section>
    <h3 class="sr" style="margin-bottom: 20px;">{{ __('site.karma_reserves_inferred_h3', [], $loc) }}</h3>
    <div class="reserves-table-wrap sr">
        <table class="reserves-table">
            <thead>
                <tr>
                    <th>{{ __('site.karma_reserves_col_deposit', [], $loc) }}</th>
                    <th class="num">{{ __('site.karma_reserves_col_tonnage', [], $loc) }}</th>
                    <th class="num">{{ __('site.karma_reserves_col_grade', [], $loc) }}</th>
                    <th class="num">{{ __('site.karma_reserves_col_gold', [], $loc) }}</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>GG1</td><td class="num">2 480</td><td class="num">0.90</td><td class="num">72</td></tr>
                <tr><td>GG2</td><td class="num">989</td><td class="num">1.06</td><td class="num">33</td></tr>
                <tr><td>Kao Main</td><td class="num">8 119</td><td class="num">1.48</td><td class="num">385</td></tr>
                <tr><td>Kao Nord</td><td class="num">2 514</td><td class="num">1.63</td><td class="num">132</td></tr>
                <tr><td>Rambo Main</td><td class="num">604</td><td class="num">0.92</td><td class="num">18</td></tr>
                <tr><td>Nami</td><td class="num">931</td><td class="num">0.74</td><td class="num">22</td></tr>
                <tr><td>Yabonsgo</td><td class="num">777</td><td class="num">1.38</td><td class="num">35</td></tr>
                <tr><td>Kao Main Nord-Ouest</td><td class="num">491</td><td class="num">0.63</td><td class="num">10</td></tr>
                <tr><td>KNSE+KNSE_ext</td><td class="num">867</td><td class="num">0.47</td><td class="num">13</td></tr>
                <tr><td>Kao Nord Central</td><td class="num">331</td><td class="num">0.56</td><td class="num">6</td></tr>
            </tbody>
            <tfoot>
                <tr><td>Total</td><td class="num">18 103</td><td class="num">1.25</td><td class="num">725</td></tr>
            </tfoot>
        </table>
    </div>
</section>

{{-- Images source + Note --}}
<section class="sand">
    <div class="grid-2" style="gap:32px;">
        <figure class="reserves-figure sr">
            <img src="{{ asset('images/mining/reserves-table.jpg') }}"
                 alt="{{ __('site.karma_reserves_table_alt', [], $loc) }}"
                 loading="lazy">
            <figcaption>{{ __('site.karma_reserves_table_caption', [], $loc) }}</figcaption>
        </figure>

        <figure class="reserves-figure sr">
            <img src="{{ asset('images/mining/reserves-chart.jpg') }}"
                 alt="{{ __('site.karma_reserves_chart_alt', [], $loc) }}"
                 loading="lazy">
            <figcaption>{{ __('site.karma_reserves_chart_caption', [], $loc) }}</figcaption>
        </figure>
    </div>

    <div class="reserves-note sr">
        {{ __('site.karma_reserves_note', [], $loc) }}
    </div>
</section>

@endsection