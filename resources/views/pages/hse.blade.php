{{-- Page : Santé et Sécurité --}}
@extends('layouts.app')

@section('content')

{{-- ── 1. Politique HSE ─────────────────────────────────── --}}
<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.sustainability') : route('sustainability') }}">{{ __('site.subnav_overview', [], $loc) }}</a>
        <a href="{{ $en ? route('english.communities')   : route('sustainability.communities') }}">{{ __('site.subnav_communities', [], $loc) }}</a>
        <a href="{{ $en ? route('english.environment')   : route('sustainability.environment') }}">{{ __('site.subnav_environment', [], $loc) }}</a>
        <a href="{{ $en ? route('english.hse')           : route('sustainability.hse') }}" class="active">{{ __('site.subnav_hse', [], $loc) }}</a>
        <a href="{{ $en ? route('english.local-content') : route('sustainability.local-content') }}">{{ __('site.subnav_local_content', [], $loc) }}</a>
    </div>

    <p class="lead">{{ __('site.hse_policy_lead', [], $loc) }}</p>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.hse_policy'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.hse_policy'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.hse_policy'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 2. Safety Performance ──────────────────────────── --}}
<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;">{{ $en ? 'Safety Performance' : 'Performance Sécurité' }}</h2>
        <p style="text-align:center; color:var(--muted); font-size:15px; margin-bottom:40px;">{{ $en ? 'Our commitment to zero harm drives continuous improvement.' : 'Notre engagement zéro accident guide amélioration continue.' }}</p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:24px; margin-bottom:40px;">
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:36px; font-weight:700; color:var(--green); margin-bottom:8px;">0.8</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Lost Time Injury (LTI)' : 'Blessures avec Arrêt (LTI)' }}</div>
                <div style="font-size:12px; color:var(--muted); margin-top:12px;">{{ $en ? 'per 1M hours worked' : 'par 1M heures travaillées' }}</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:36px; font-weight:700; color:var(--green); margin-bottom:8px;">2.1</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Total Recordable Injury (TRIFR)' : 'Blessures Signalables (TRIFR)' }}</div>
                <div style="font-size:12px; color:var(--muted); margin-top:12px;">{{ $en ? 'per 1M hours worked' : 'par 1M heures travaillées' }}</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:36px; font-weight:700; color:var(--green); margin-bottom:8px;">14.2M</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Safety-Free Hours' : 'Heures sans Incident' }}</div>
                <div style="font-size:12px; color:var(--muted); margin-top:12px;">{{ $en ? 'cumulative 2024' : 'cumulatif 2024' }}</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:36px; font-weight:700; color:var(--green); margin-bottom:8px;">98%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;">{{ $en ? 'Safety Training Compliance' : 'Conformité Formation Sécurité' }}</div>
                <div style="font-size:12px; color:var(--muted); margin-top:12px;">{{ $en ? 'among all staff' : 'parmi tout le personnel' }}</div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center;">
            <div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px; font-weight:600;">{{ $en ? 'Safety Culture' : 'Culture Sécurité' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Daily pre-work briefings (DPBs)' : 'Briefings pré-travail quotidiens' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Behavior-based safety programs' : 'Programmes sécurité comportementale' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Near-miss reporting system' : 'Système signalement presque-accidents' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Hazard identification & control' : 'Identification & contrôle dangers' }}</li>
                    <li>✓ {{ $en ? 'Regular safety audits & inspections' : 'Audits & inspections sécurité réguliers' }}</li>
                </ul>
            </div>
            <div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px; font-weight:600;">{{ $en ? 'Occupational Health' : 'Santé Professionnelle' }}</h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Medical surveillance programs' : 'Programmes surveillance médicale' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Occupational hygiene monitoring' : 'Suivi hygiène professionnelle' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Mental health & wellbeing support' : 'Soutien santé mentale & bien-être' }}</li>
                    <li style="margin-bottom:12px;">✓ {{ $en ? 'Emergency medical response' : 'Réponse médicale d\'urgence' }}</li>
                    <li>✓ {{ $en ? 'Employee health clinics' : 'Cliniques santé employés' }}</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ── 2. Chiffres clés sécurité (legacy) ────────────────── --}}
<section>

    <div class="stat-band">
        @foreach(range(1, 4) as $i)
        <div class="stat-item">
            <span class="stat-value">{{ __('site.hse_stat'.$i.'_val', [], $loc) }}</span>
            <span class="stat-label">{{ __('site.hse_stat'.$i.'_label', [], $loc) }}</span>
        </div>
        @endforeach
    </div>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.hse_card'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.hse_card'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.hse_card'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ── 3. Certifications et audits ─────────────────────── --}}
<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;">{{ $en ? 'Certifications & Standards' : 'Certifications & Standards' }}</h2>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:24px;">
            <div class="card">
                <div style="font-size:28px; margin-bottom:12px;">🏅</div>
                <h4 style="color:var(--green); margin-bottom:8px; font-weight:600;">ISO 45001:2018</h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;">{{ $en ? 'Occupational Health & Safety Management System' : 'Système Management Santé & Sécurité' }}</p>
            </div>
            <div class="card">
                <div style="font-size:28px; margin-bottom:12px;">🏅</div>
                <h4 style="color:var(--green); margin-bottom:8px; font-weight:600;">ISO 14001:2015</h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;">{{ $en ? 'Environmental Management System' : 'Système Management Environnemental' }}</p>
            </div>
            <div class="card">
                <div style="font-size:28px; margin-bottom:12px;">🏅</div>
                <h4 style="color:var(--green); margin-bottom:8px; font-weight:600;">ICMM</h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;">{{ $en ? 'International Council on Mining & Metals' : 'Conseil International Mines & Métaux' }}</p>
            </div>
            <div class="card">
                <div style="font-size:28px; margin-bottom:12px;">🏅</div>
                <h4 style="color:var(--green); margin-bottom:8px; font-weight:600;">JORC Code</h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;">{{ $en ? 'Reporting of Exploration Results, Mineral Resources' : 'Rapportage Résultats Exploration & Ressources' }}</p>
            </div>
            <div class="card">
                <div style="font-size:28px; margin-bottom:12px;">🏅</div>
                <h4 style="color:var(--green); margin-bottom:8px; font-weight:600;">RMI</h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;">{{ $en ? 'Responsible Mining Index recognition' : 'Reconnaissance Index Mining Responsable' }}</p>
            </div>
            <div class="card">
                <div style="font-size:28px; margin-bottom:12px;">🏅</div>
                <h4 style="color:var(--green); margin-bottom:8px; font-weight:600;">Annual Audits</h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;">{{ $en ? 'Third-party compliance & safety audits' : 'Audits conformité & sécurité tiers' }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ── 3b. Certifications (legacy) ─────────────────────── --}}
<section>
    <p class="lead">{{ __('site.hse_cert_lead', [], $loc) }}</p>

    <div class="grid-3">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.hse_cert'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.hse_cert'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.hse_cert'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>
</section>

@endsection
