{{-- Page : Contenu Local --}}
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/sustainability-animations.css') }}">
@endpush

@section('content')

{{-- ── 1. Politique de contenu local ──────────────────── --}}
<section class="sa-animated-section" style="padding-top:40px;">
    <div class="sa-particles-container" data-count="5"></div>

    <div class="sa-section-heading sa-reveal" style="margin:0 auto 24px; text-align:center;">
        <h2 style="text-align:center;">{{ __('site.local_policy_h2', [], $loc) }}</h2>
    </div>
    <p class="lead sa-reveal sa-delay-1">{{ __('site.local_policy_lead', [], $loc) }}</p>

    <div class="grid-2" style="margin-top:24px;">
        {{-- Recrutement local --}}
        <div class="sa-program-card sa-reveal sa-delay-2">
            <div style="font-size:36px; margin-bottom:14px;">👷</div>
            <div class="card-tag">{{ __('site.local_card1_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_recruit_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_recruit_p', [], $loc) }}</p>
        </div>
        {{-- Achats locaux --}}
        <div class="sa-program-card sa-reveal sa-delay-3">
            <div style="font-size:36px; margin-bottom:14px;">🏪</div>
            <div class="card-tag">{{ __('site.local_card2_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_purchase_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_purchase_p', [], $loc) }}</p>
        </div>
    </div>

    {{-- Stat Band améliorée --}}
    <div class="stat-band sa-reveal" style="margin-top:40px;">
        <div class="stat-item sa-stat-item-enhanced">
            <span class="stat-value" data-count="409" data-original="409">409</span>
            <span class="stat-label">{{ $en ? 'Direct employees' : 'Emplois directs' }}</span>
        </div>
        <div class="stat-item sa-stat-item-enhanced">
            <span class="stat-value" data-count="1500" data-original="1 500">1 500</span>
            <span class="stat-label">{{ $en ? 'Subcontracted workers' : 'Travailleurs sous-traitants' }}</span>
        </div>
        <div class="stat-item sa-stat-item-enhanced">
            <span class="stat-value" data-count="60" data-suffix="%" data-original="60%">60%</span>
            <span class="stat-label">{{ $en ? 'Local & regional employment' : 'Emploi local et régional' }}</span>
        </div>
        <div class="stat-item sa-stat-item-enhanced">
            <span class="stat-value" data-count="99" data-suffix="%" data-original="99%">99%</span>
            <span class="stat-label">{{ $en ? 'Burkinabe workers' : 'Travailleurs burkinabè' }}</span>
        </div>
    </div>
</section>

{{-- ── 2. Impact Dépenses Locales ─────────────────────── --}}
<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">

        <div class="sa-section-heading sa-reveal">
            <h2>{{ $en ? 'Local Spending Impact' : 'Impact Dépenses Locales' }}</h2>
            <div class="sa-divider"></div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:20px; margin-top:48px;">
            @php
                $localMetrics = [
                    ['icon'=>'👥','val'=>'60%','count'=>60,'suffix'=>'%','label'=>$en?'Local & regional employment':'Emploi local et régional','sub'=>$en?'of the workforce':'de la main-d\'œuvre','bar'=>'60%'],
                    ['icon'=>'💰','val'=>'77,8 Md','label'=>$en?'Local purchases':'Achats locaux','sub'=>$en?'CFA francs':'FCFA'],
                    ['icon'=>'🏛️','val'=>'744 M','label'=>$en?'State-owned company payments':'Paiements aux Entreprises d\'État','sub'=>$en?'CFA francs':'FCFA'],
                    ['icon'=>'🇧🇫','val'=>'99%','count'=>99,'suffix'=>'%','label'=>$en?'Burkinabe workers':'Travailleurs burkinabè','sub'=>$en?'of the workforce':'de la main-d\'œuvre','bar'=>'99%'],
                    ['icon'=>'🔧','val'=>'1 500','count'=>1500,'suffix'=>'','label'=>$en?'Subcontracted workers':'Travailleurs sous-traitants','sub'=>$en?'supporting operations':'en appui aux opérations'],
                ];
            @endphp
            @foreach($localMetrics as $k => $m)
            <div class="sa-metric-card sa-reveal sa-delay-{{ $k+1 }}">
                <div style="font-size:28px; margin-bottom:8px;">{{ $m['icon'] }}</div>
                @if(isset($m['count']))
                <div class="sa-metric-value sustain-metric__value"
                     data-count="{{ $m['count'] }}"
                     data-suffix="{{ $m['suffix'] ?? '' }}"
                     data-original="{{ $m['val'] }}">{{ $m['val'] }}</div>
                @else
                <div class="sa-metric-value" style="font-size:clamp(20px,2.5vw,28px);">{{ $m['val'] }}</div>
                @endif
                <div style="font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; margin-top:8px; line-height:1.4;">{{ $m['label'] }}</div>
                <div style="font-size:11px; color:var(--muted); margin-top:4px; opacity:0.8;">{{ $m['sub'] }}</div>
                @if(isset($m['bar']))
                <div class="sa-progress-bar" style="margin-top:12px;">
                    <div class="sa-progress-fill" data-width="{{ $m['bar'] }}"></div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

{{-- ── 3. Programme fournisseurs ────────────────────── --}}
<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal" style="text-align:left; max-width:none;">
            <h2 style="text-align:left;">{{ __('site.local_supplier_h2', [], $loc) }}</h2>
        </div>
        <p class="lead sa-reveal sa-delay-1">{{ __('site.local_supplier_lead', [], $loc) }}</p>

        <div class="grid-3" style="margin-top:32px;">
            @foreach(range(1, 3) as $i)
            <div class="sa-program-card sa-reveal sa-delay-{{ $i }}">
                <div class="card-tag">{{ __('site.local_supp'.$i.'_tag', [], $loc) }}</div>
                <h3>{{ __('site.local_supp'.$i.'_h3', [], $loc) }}</h3>
                <p>{{ __('site.local_supp'.$i.'_p', [], $loc) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── 4. Catégories d'approvisionnement ──────────── --}}
<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">

        <div class="sa-section-heading sa-reveal">
            <h2>{{ $en ? 'Categories of Local Sourcing' : 'Catégories d\'Approvisionnement Local' }}</h2>
            <div class="sa-divider"></div>
        </div>

        @php
            $categories = [
                ['icon'=>'🏗️','title'=>$en?'Construction & Services':'Construction & Services','items'=>$en?['Civil works & excavation','Equipment rental & leasing','Facility management','Security services']:['Travaux civils & excavation','Location équipements','Gestion installations','Services sécurité']],
                ['icon'=>'⚙️','title'=>$en?'Equipment & Parts':'Équipements & Pièces','items'=>$en?['Spare parts & components','Maintenance & repairs','Industrial machinery','Fuel & lubricants']:['Pièces de rechange','Maintenance & réparations','Machinerie industrielle','Carburants & lubrifiants']],
                ['icon'=>'🥗','title'=>$en?'Food & Provisions':'Alimentation & Provisions','items'=>$en?['Fresh produce & staples','Meat & dairy','Beverages & catering','Restaurant services']:['Produits frais & base','Viande & produits laitiers','Boissons & catering','Services restaurants']],
                ['icon'=>'💼','title'=>$en?'Professional Services':'Services Professionnels','items'=>$en?['Consulting & engineering','Training & HR','Legal & accounting','Transportation & logistics']:['Conseil & ingénierie','Formation & RH','Légal & comptabilité','Transport & logistique']],
            ];
        @endphp

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:24px; margin-top:48px;">
            @foreach($categories as $k => $cat)
            <div class="sa-achievement-card sa-reveal sa-delay-{{ $k+1 }}">
                <div class="sa-category-icon">{{ $cat['icon'] }}</div>
                <h3 style="color:var(--green); margin-bottom:14px; font-size:16px; text-align:center;">{{ $cat['title'] }}</h3>
                <ul class="sa-animated-list">
                    @foreach($cat['items'] as $item)
                    <li>
                        <span class="sa-list-bullet" style="font-size:11px;">•</span>
                        <span style="font-size:13px; color:var(--muted); line-height:1.6;">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>

        {{-- Banner engagement local --}}
        <div class="sa-total-banner sa-reveal" style="margin-top:48px;">
            <div class="sa-particles-container" data-count="4"></div>
            <div class="sa-total-label">{{ $en ? 'Our Local Commitment' : 'Notre Engagement Local' }}</div>
            <div class="sa-total-value" style="font-size:clamp(28px,4vw,48px);">
                {{ $en ? '99% Burkinabe Workforce' : '99% Main d\'œuvre burkinabè' }}
            </div>
            <p style="color:rgba(255,255,255,0.7); font-size:14px; margin:12px 0 0; position:relative; z-index:1; text-align:center;">
                {{ $en ? 'A concrete commitment to local economic development' : 'Un engagement concret pour le développement économique local' }}
            </p>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

@push('scripts')
<script src="{{ asset('js/sustainability-animations.js') }}"></script>
@endpush

@endsection
