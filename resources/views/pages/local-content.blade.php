{{-- Page : Contenu Local --}}
@extends('layouts.app')

@section('content')

{{-- ── 1. Politique de contenu local ──────────────────── --}}
<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
        <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
        <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}">{{ __('site.subnav_hse', [], $loc) }}</a>
        <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}" class="active">{{ __('site.subnav_local_content', [], $loc) }}</a>
    </div>

    <h2>{{ __('site.local_policy_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.local_policy_lead', [], $loc) }}</p>

    <div class="grid-2">
        {{-- Recrutement local --}}
        <div class="card">
            <div class="card-tag">{{ __('site.local_card1_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_recruit_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_recruit_p', [], $loc) }}</p>
        </div>
        {{-- Achats locaux --}}
        <div class="card">
            <div class="card-tag">{{ __('site.local_card2_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_purchase_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_purchase_p', [], $loc) }}</p>
        </div>
    </div>

    {{-- Résultats chiffrés --}}
    <div class="stat-band" style="margin-top:32px;">
        <div class="stat-item">
            <span class="stat-value">80%</span>
            <span class="stat-label">{{ $en ? 'Burkinabe workforce' : "Main-d'œuvre burkinabè" }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-value">1 200+</span>
            <span class="stat-label">{{ $en ? 'Direct & indirect jobs' : 'Emplois directs et indirects' }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-value">{{ $en ? 'Local' : 'Local' }}</span>
            <span class="stat-label">{{ $en ? 'Recruitment priority' : 'Recrutement prioritaire' }}</span>
        </div>
        <div class="stat-item">
            <span class="stat-value">0</span>
            <span class="stat-label">{{ $en ? 'Application fee' : 'Coût de candidature' }}</span>
        </div>
    </div>
</section>

{{-- ── 1b. Local Content Metrics ───────────────────────── --}}
<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;">{{ $en ? 'Local Spending Impact' : 'Impact Dépenses Locales' }}</h2>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px; margin-bottom:40px;">
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">65%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Local Procurement' : 'Approvisionnement Local' }}</div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;">{{ $en ? 'of total spending' : 'du total dépenses' }}</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">320+</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Local Suppliers' : 'Fournisseurs Locaux' }}</div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;">{{ $en ? 'active partnerships' : 'partenariats actifs' }}</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">18 Mrd</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Annual Spending' : 'Dépenses Annuelles' }}</div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;">{{ $en ? 'CFA direct impact' : 'impact direct CFA' }}</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">15</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Years of Ops' : 'Ans d\'Opérations' }}</div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;">{{ $en ? 'economic anchoring' : 'ancrage économique' }}</div>
            </div>
        </div>
    </div>
</section>

{{-- ── 2. Programme de développement des fournisseurs ─── --}}
<section>
    <h2>{{ __('site.local_supplier_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.local_supplier_lead', [], $loc) }}</p>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.local_supp'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.local_supp'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.local_supp'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 3. Supplier Categories ────────────────────────── --}}
<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:40px; font-size:36px; font-weight:600;">{{ $en ? 'Categories of Local Sourcing' : 'Catégories d\'Approvisionnement Local' }}</h2>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:24px;">
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">🏗️ {{ $en ? 'Construction & Services' : 'Construction & Services' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• {{ $en ? 'Civil works & excavation' : 'Travaux civils & excavation' }}</li>
                    <li>• {{ $en ? 'Equipment rental & leasing' : 'Location équipements' }}</li>
                    <li>• {{ $en ? 'Facility management' : 'Gestion installations' }}</li>
                    <li>• {{ $en ? 'Security services' : 'Services sécurité' }}</li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">⚙️ {{ $en ? 'Equipment & Parts' : 'Équipements & Pièces' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• {{ $en ? 'Spare parts & components' : 'Pièces de rechange' }}</li>
                    <li>• {{ $en ? 'Maintenance & repairs' : 'Maintenance & réparations' }}</li>
                    <li>• {{ $en ? 'Industrial machinery' : 'Machinerie industrielle' }}</li>
                    <li>• {{ $en ? 'Fuel & lubricants' : 'Carburants & lubrifiants' }}</li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">🍽️ {{ $en ? 'Food & Provisions' : 'Alimentation & Provisions' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• {{ $en ? 'Fresh produce & staples' : 'Produits frais & base' }}</li>
                    <li>• {{ $en ? 'Meat & dairy' : 'Viande & produits laitiers' }}</li>
                    <li>• {{ $en ? 'Beverages & catering' : 'Boissons & catering' }}</li>
                    <li>• {{ $en ? 'Restaurant services' : 'Services restaurants' }}</li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">📚 {{ $en ? 'Professional Services' : 'Services Professionnels' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• {{ $en ? 'Consulting & engineering' : 'Conseil & ingénierie' }}</li>
                    <li>• {{ $en ? 'Training & HR' : 'Formation & RH' }}</li>
                    <li>• {{ $en ? 'Legal & accounting' : 'Légal & comptabilité' }}</li>
                    <li>• {{ $en ? 'Transportation & logistics' : 'Transport & logistique' }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection
