{{-- Page : Publications & Documents --}}
@extends('layouts.app')

@section('content')

<section>
    <p class="lead">{{ __('site.reports_lead', [], $loc) }}</p>

    <div class="grid-3">
        @forelse($reports as $report)
        <article class="card">
            <div class="card-tag">{{ $report->category }}</div>
            <h3>{{ $report->title }}</h3>
            <p>{{ $report->description }}</p>
            <a class="btn {{ $report->file_path ? 'btn-gold' : 'disabled' }}"
               style="margin-top:16px; display:inline-block;"
               href="{{ $report->file_path ? asset('uploads/'.$report->file_path) : '#' }}">
                {{ $report->file_path
                    ? __('site.download_pdf', [], $loc)
                    : __('site.coming_soon', [], $loc) }}
            </a>
        </article>
        @empty
        <p class="lead" style="grid-column:span 3;">{{ __('site.reports_empty', [], $loc) }}</p>
        @endforelse
    </div>
</section>

@endsection
