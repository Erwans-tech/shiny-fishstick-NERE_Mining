{{-- Page : Notre histoire --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<section>

    <p class="lead">{{ __('site.company_history_lead', [], $loc) }}</p>

    <div>
        {{-- Accordéon chronologique --}}
        <div>
            @foreach(range(1, 4) as $i)
            <details {{ $i === 1 ? 'open' : '' }}>
                <summary>{{ __('site.company_hist'.$i.'_title', [], $loc) }}</summary>
                <p>{{ __('site.company_hist'.$i.'_p', [], $loc) }}</p>
            </details>
            @endforeach
        </div>

    </div>
</section>
@endsection
