{{-- Page : Publications & Documents --}}
@extends('layouts.app')

@section('content')

<style>
    .report-category-badge { display:inline-block; padding:6px 12px; border-radius:4px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.06em; margin-bottom:12px; }
    .report-cat-sustainability { background:rgba(75,23,22,.1); color:var(--green); }
    .report-cat-financial { background:rgba(255,194,71,.15); color:var(--gold2); }
    .report-cat-technical { background:rgba(128,90,78,.1); color:#674c41; }
    .report-cat-governance { background:rgba(75,23,22,.08); color:var(--ink); }
</style>

<section>
    <h2 style="color:var(--green); margin:0 0 18px; font-size:28px; font-weight:600;">{{ $en ? 'All Reports & Documents' : 'Tous les Rapports & Documents' }}</h2>
    <p class="lead">{{ __('site.reports_lead', [], $loc) }}</p>

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
