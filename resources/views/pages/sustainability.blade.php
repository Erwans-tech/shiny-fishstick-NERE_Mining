{{-- Page : Développement durable (hub) --}}
@extends('layouts.app')

@section('content')

<section>
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
        <a href="{{ $pillarLinks[$i] }}" class="card" style="display:block;">
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
