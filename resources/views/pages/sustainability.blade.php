{{-- Page : Développement durable (hub) --}}
@extends('layouts.app')

@section('content')

<section>
    <style>
        .pillar-card {
            background: linear-gradient(180deg, #ffffff 0%, #f9f6f0 100%);
            border: 1px solid rgba(75,23,22,0.1);
            transition: transform 0.3s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.3s, border-color 0.3s;
        }
        .pillar-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 32px rgba(40,29,24,0.08);
            border-color: rgba(255,194,71,0.4);
        }
    </style>
    <p class="lead">{{ __('site.sustain_lead', [], $loc) }}</p>

    @php
        $pillarLinks = [
            1 => $en ? route('english.communities')   : route('sustainability.communities'),
            2 => $en ? route('english.environment')   : route('sustainability.environment'),
            3 => $en ? route('english.hse')           : route('sustainability.hse'),
            4 => $en ? route('english.local-content') : route('sustainability.local-content'),
        ];
    @endphp

    <div class="grid-2">
        @foreach(range(1, 4) as $i)
        <a href="{{ $pillarLinks[$i] }}" class="card pillar-card sr" style="display:block;">
            <div class="card-tag">{{ __('site.sustain_pillar'.$i.'_num', [], $loc) }}</div>
            <h3>{{ __('site.sustain_pillar'.$i.'_h3', [], $loc) }}</h3>
            <p>{{ __('site.sustain_pillar'.$i.'_p', [], $loc) }}</p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">
                {{ __('site.sustain_discover', [], $loc) }}
            </span>
        </a>
        @endforeach
    </div>
</section>

@endsection
