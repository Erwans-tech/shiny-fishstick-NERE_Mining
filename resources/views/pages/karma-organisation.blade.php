{{-- Page : Organisation de Karma --}}
@extends('layouts.app')
@section('content')
<div class="karma-page">
<section id="organisation">
    <h2>{{ __('site.karma_org_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_org_lead', [], $loc) }}</p>
    <div class="grid-3">
        @forelse($karmaDepartments ?? collect() as $dept)
        @php $deptTag = trim((string) $dept->localizedTag($loc)); $deptTitle = trim((string) $dept->localizedTitle($loc)); $deptBody = trim((string) $dept->localizedBody($loc)); @endphp
        <div class="card"><div class="card-tag">{{ $deptTag !== '' ? $deptTag : __('site.karma_dept'.$loop->iteration.'_tag', [], $loc) }}</div><h3>{{ $deptTitle !== '' ? $deptTitle : __('site.karma_dept'.$loop->iteration.'_h3', [], $loc) }}</h3><p>{{ $deptBody !== '' ? $deptBody : __('site.karma_dept'.$loop->iteration.'_p', [], $loc) }}</p></div>
        @empty
        @foreach(range(1, 9) as $i)<div class="card"><div class="card-tag">{{ __('site.karma_dept'.$i.'_tag', [], $loc) }}</div><h3>{{ __('site.karma_dept'.$i.'_h3', [], $loc) }}</h3><p>{{ __('site.karma_dept'.$i.'_p', [], $loc) }}</p></div>@endforeach
        @endforelse
    </div>
</section>
</div>
@endsection
