{{-- Page : Gouvernance & Direction --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<section>

    <p class="lead">{{ __('site.company_gov_lead', [], $loc) }}</p>

    {{-- Callout + principes --}}
    <div class="governance-intro">
        <div class="governance-callout">
            <h3>{{ __('site.company_gov_callout_h3', [], $loc) }}</h3>
            <p>{{ __('site.company_gov_callout_p', [], $loc) }}</p>
        </div>
        <div class="governance-principles">
            @foreach(range(1, 3) as $i)
            <div class="governance-principle">
                <strong>{{ __('site.company_gov_principle'.$i.'_title', [], $loc) }}</strong>
                <span>{{ __('site.company_gov_principle'.$i.'_p', [], $loc) }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Organigramme --}}
    <div class="governance-chart-panel">
        <div class="governance-chart-heading">
            <h3>{{ __('site.company_gov_chart_h3', [], $loc) }}</h3>
        </div>
        <div class="governance-legend">
            <span><i class="legend-pdg"></i>{{ __('site.company_gov_legend_pdg', [], $loc) }}</span>
            <span><i class="legend-dga"></i>{{ __('site.company_gov_legend_dga', [], $loc) }}</span>
        </div>

        <div class="org-chart">
            {{-- PDG --}}
            <div class="org-level org-level--top">
                <div class="org-box org-box--pdg">
                    <div class="org-name">Dr. Justin Elie OUEDRAOGO</div>
                    <div class="org-title">{{ $en ? 'Chief Executive Officer' : 'Président Directeur Général' }}</div>
                </div>
            </div>
            <div class="org-connector-v"></div>
            <div class="org-hbar"></div>

            {{-- 4 DGA --}}
            <div class="org-level org-level--dga">
                @php
                    $dgas = [
                        ['name' => 'Justin SAVADOGO',       'grade' => 'DGA', 'title_fr' => 'Administration & Finance',          'title_en' => 'Administration & Finance'],
                        ['name' => 'Pascal Y. OUEDRAOGO',   'grade' => 'DGA', 'title_fr' => 'Approvisionnements',                 'title_en' => 'Supply & Procurement'],
                        ['name' => 'Laurent Michel DABIRE', 'grade' => 'DGA', 'title_fr' => 'Affaires Corporatives & Juridiques', 'title_en' => 'Corporate & Legal Affairs'],
                        ['name' => 'Augustine OBENG-FORI',  'grade' => $en ? 'Deputy CEO (interim)' : 'DGA par intérim', 'title_fr' => 'Opérations', 'title_en' => 'Operations'],
                    ];
                @endphp
                @foreach($dgas as $dga)
                <div class="org-branch">
                    <div class="org-connector-branch"></div>
                    <div class="org-box org-box--dga">
                        <div class="org-name">{{ $dga['name'] }}</div>
                        <div class="org-grade">{{ $dga['grade'] }}</div>
                        <div class="org-title">{{ $en ? $dga['title_en'] : $dga['title_fr'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
