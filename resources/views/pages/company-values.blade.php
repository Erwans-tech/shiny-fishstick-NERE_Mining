{{-- Page : Vision & Valeurs --}}
@extends('layouts.app')

@section('content')
@php
    $companyBase = $en ? route('english.company') : route('company');
    $values = [1, 2, 3, 4];
    $valueLetters = ['I', 'P', 'R', 'E'];
@endphp

<section class="company-values-section">

    <div class="values-hero" aria-label="IPRE">
        <img src="{{ asset('images/ipre-banner.jpg') }}" alt="IPRE" class="values-hero-image">
    </div>

    <div class="grid-2 values-grid">
        @foreach($values as $i)
        <div class="card values-card values-card--{{ $i }}">
            <h3>{{ __('site.company_v'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.company_v'.$i.'_p', [], $loc) }}</p>
            <div class="values-card-footer">
                <span>{{ $valueLetters[$i - 1] }}</span>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
