{{-- Page : Publications & Documents --}}
@extends('layouts.app')

@section('content')

<section style="padding-bottom:0;">
</section>

<style>
    .report-category-badge { display:inline-block; padding:6px 12px; border-radius:4px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.06em; margin-bottom:12px; }
    .report-cat-sustainability { background:rgba(75,23,22,.1); color:var(--green); }
    .report-cat-financial { background:rgba(255,194,71,.15); color:var(--gold2); }
    .report-cat-technical { background:rgba(128,90,78,.1); color:#674c41; }
    .report-cat-governance { background:rgba(75,23,22,.08); color:var(--ink); }
</style>

<section>
    <p class="lead">{{ __('site.reports_lead', [], $loc) }}</p>

    {{-- Featured / Quick Access --}}
    <div style="margin:40px 0; padding:24px; background:var(--sand); border-radius:12px; border:1px solid var(--line);">
        <h3 style="color:var(--green); margin-bottom:16px; font-size:18px; font-weight:600;">{{ $en ? 'Latest Reports' : 'Derniers Rapports' }}</h3>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:16px;">
            <div style="background:#fff; padding:16px; border-radius:8px; border:1px solid var(--line);">
                <span class="report-category-badge report-cat-sustainability">{{ $en ? 'Sustainability' : 'Durabilité' }}</span>
                <h4 style="font-size:14px; font-weight:600; margin:8px 0;">{{ $en ? 'Annual Sustainability Report' : 'Rapport Durabilité Annuel' }}</h4>
                <p style="font-size:13px; color:var(--muted); margin:0;">{{ $en ? '2024 performance & initiatives' : 'Performance & initiatives 2024' }}</p>
            </div>
            <div style="background:#fff; padding:16px; border-radius:8px; border:1px solid var(--line);">
                <span class="report-category-badge report-cat-financial">{{ $en ? 'Financial' : 'Financier' }}</span>
                <h4 style="font-size:14px; font-weight:600; margin:8px 0;">{{ $en ? 'Annual Financial Report' : 'Rapport Financier Annuel' }}</h4>
                <p style="font-size:13px; color:var(--muted); margin:0;">{{ $en ? '2024 results & contributions' : 'Résultats & contributions 2024' }}</p>
            </div>
            <div style="background:#fff; padding:16px; border-radius:8px; border:1px solid var(--line);">
                <span class="report-category-badge report-cat-technical">{{ $en ? 'Technical' : 'Technique' }}</span>
                <h4 style="font-size:14px; font-weight:600; margin:8px 0;">{{ $en ? 'JORC Resource Statement' : 'Déclaration Ressource JORC' }}</h4>
                <p style="font-size:13px; color:var(--muted); margin:0;">{{ $en ? 'Mineral resources classification' : 'Classification ressources minérales' }}</p>
            </div>
        </div>
    </div>

    <h2 style="color:var(--green); margin:40px 0 24px; font-size:28px; font-weight:600;">{{ $en ? 'All Reports & Documents' : 'Tous les Rapports & Documents' }}</h2>

    <div class="grid-3">
        @forelse($reports as $report)
        <article class="card">
            <span class="report-category-badge" style="
                @if(strtolower($report->category) === 'sustainability' || strtolower($report->category) === 'durabilité')
                    background:rgba(75,23,22,.1); color:var(--green);
                @elseif(strtolower($report->category) === 'financial' || strtolower($report->category) === 'financier')
                    background:rgba(255,194,71,.15); color:var(--gold2);
                @elseif(strtolower($report->category) === 'technical' || strtolower($report->category) === 'technique')
                    background:rgba(128,90,78,.1); color:#674c41;
                @else
                    background:rgba(75,23,22,.08); color:var(--ink);
                @endif
            ">
                {{ $report->category }}
            </span>
            <h3 style="margin-top:12px;">{{ $report->title }}</h3>
            <p>{{ $report->description }}</p>
            <div style="display:flex; gap:8px; margin-top:16px; font-size:12px; color:var(--muted);">
                @if($report->published_at)
                <span>📅 {{ $report->published_at->translatedFormat('d M Y') }}</span>
                @endif
            </div>
            <a class="btn {{ $report->file_path ? 'btn-gold' : 'disabled' }}"
               style="margin-top:16px; display:inline-block;"
               href="{{ $report->file_path ? \App\Helpers\StorageHelper::uploadUrl($report->file_path) : '#' }}">
                {{ $report->file_path
                    ? __('site.download_pdf', [], $loc)
                    : __('site.coming_soon', [], $loc) }}
            </a>
        </article>
        @empty
        <div style="grid-column:span 3; text-align:center; padding:40px 20px;">
            <p class="lead">{{ __('site.reports_empty', [], $loc) }}</p>
            <p style="color:var(--muted); font-size:14px;">{{ $en ? 'New reports will be published regularly.' : 'Les nouveaux rapports seront publiés régulièrement.' }}</p>
        </div>
        @endforelse
    </div>
</section>

@endsection
