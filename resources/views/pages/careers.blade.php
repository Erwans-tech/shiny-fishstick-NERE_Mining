{{-- Page : Carrières (vue simplifiée depuis page.blade.php) --}}
{{-- Note : la vue principale carrières est resources/views/careers/index.blade.php --}}
@extends('layouts.app')

@section('content')

<section>
    <h2>{{ __('site.careers_why_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.careers_why_lead', [], $loc) }}</p>

    <div class="grid-3" style="margin-bottom:60px;">
        @foreach(range(1, 3) as $i)
        <div class="card">
            <div class="card-tag">{{ __('site.careers_why'.$i.'_tag', [], $loc) }}</div>
            <h3>{{ __('site.careers_why'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.careers_why'.$i.'_p', [], $loc) }}</p>
        </div>
        @endforeach
    </div>

    <h2>{{ __('site.careers_jobs_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.careers_jobs_lead', [], $loc) }}</p>

    <div class="grid-3">
        @forelse($jobs as $job)
        <article class="card">
            <div class="card-tag">{{ $job->department }}</div>
            <h3>{{ $job->title }}</h3>
            <p>{{ $job->location }} · {{ $job->contract_type }}</p>
            <p>{{ $job->description }}</p>
            @if($job->deadline)
            <p style="font:500 12px Inter,sans-serif; color:var(--muted);">
                {{ __('site.careers_deadline', [], $loc) }} {{ $job->deadline->format('d/m/Y') }}
            </p>
            @endif
            <a class="btn btn-dark"
               style="margin-top:16px; display:inline-block;"
               href="{{ ($en ? route('english.contact') : route('contact')) }}?type=emploi&subject={{ urlencode($job->title) }}">
                {{ __('site.careers_apply', [], $loc) }}
            </a>
        </article>
        @empty
        <div style="grid-column:span 3;">
            <h3>{{ __('site.careers_empty_h3', [], $loc) }}</h3>
            <p>{{ __('site.careers_empty_p', [], $loc) }}</p>
        </div>
        @endforelse
    </div>

    <div style="margin-top:32px;">
        <a class="btn btn-outline"
           href="{{ $en ? route('english.spontaneous') : route('spontaneous') }}">
            {{ __('site.spontaneous', [], $loc) }}
        </a>
    </div>
</section>

@endsection
