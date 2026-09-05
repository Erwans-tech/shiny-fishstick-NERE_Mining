{{-- Page : Organisation de Karma --}}
@extends('layouts.app')
@section('content')
<style>
    .karma-page > section > .lead {
        width: 100%;
        max-width: none;
        text-align: center;
    }

    .organisation-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:22px; align-items:start; }
    .organisation-card { padding:0; opacity:0; transform:translateY(24px); transition:opacity .95s cubic-bezier(.22,1,.36,1), transform .95s cubic-bezier(.22,1,.36,1), box-shadow .3s, border-color .3s; }
    .organisation-card.is-in-view { opacity:1; transform:translateY(0); }
    .organisation-card summary { position:relative; display:flex; min-height:158px; flex-direction:column; align-items:center; justify-content:center; padding:28px 24px; cursor:pointer; list-style:none; text-align:center; }
    .organisation-card summary::marker { content:""; }
    .organisation-card summary::-webkit-details-marker { display:none; }
    .organisation-card summary::after { content:""; position:relative; width:10px; height:10px; margin-top:14px; border-right:2px solid var(--gold2); border-bottom:2px solid var(--gold2); transform:rotate(45deg) translateY(-3px); transition:transform .25s, border-color .25s; }
    .organisation-card[open] summary::after { border-color:var(--green); transform:rotate(225deg) translateY(-3px); }
    .organisation-card .card-tag { margin-bottom:12px; }
    .organisation-card h3 { margin-bottom:0; font-size:20px; text-align:center; }
    .organisation-card__body { padding:0 24px 26px; border-top:1px solid rgba(234,220,197,.8); }
    .organisation-card__body p { margin:18px 0 0; font-size:16px; line-height:1.65; text-align:left; }
    @media (max-width:900px) { .organisation-grid { grid-template-columns:repeat(2,minmax(0,1fr)); } }
    @media (max-width:520px) { .organisation-grid { grid-template-columns:1fr; } }
    @media (prefers-reduced-motion: reduce) and (min-width: 99999px) { .organisation-card summary::after { transition:none; } }

    @media (max-width: 600px) {
        .karma-page > section > .lead {
            text-align: left;
        }
    }
</style>
<div class="karma-page">
<section id="organisation">
    <h2>{{ __('site.karma_org_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.karma_org_lead', [], $loc) }}</p>
    <div class="organisation-grid">
        @forelse($karmaDepartments ?? collect() as $dept)
        @php $deptTag = trim((string) $dept->localizedTag($loc)); $deptTitle = trim((string) $dept->localizedTitle($loc)); $deptBody = trim((string) $dept->localizedBody($loc)); @endphp
        <details class="card organisation-card">
            <summary><div class="card-tag">{{ $deptTag !== '' ? $deptTag : __('site.karma_dept'.$loop->iteration.'_tag', [], $loc) }}</div><h3>{{ $deptTitle !== '' ? $deptTitle : __('site.karma_dept'.$loop->iteration.'_h3', [], $loc) }}</h3></summary>
            <div class="organisation-card__body"><p>{{ $deptBody !== '' ? $deptBody : __('site.karma_dept'.$loop->iteration.'_p', [], $loc) }}</p></div>
        </details>
        @empty
        @foreach(range(1, 9) as $i)
        <details class="card organisation-card">
            <summary><div class="card-tag">{{ __('site.karma_dept'.$i.'_tag', [], $loc) }}</div><h3>{{ __('site.karma_dept'.$i.'_h3', [], $loc) }}</h3></summary>
            <div class="organisation-card__body"><p>{{ __('site.karma_dept'.$i.'_p', [], $loc) }}</p></div>
        </details>
        @endforeach
        @endforelse
    </div>
</section>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.organisation-card');
        if (!cards.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                entry.target.classList.toggle('is-in-view', entry.isIntersecting);
            });
        }, { threshold: 0.18, rootMargin: '0px 0px -8% 0px' });

        cards.forEach(card => observer.observe(card));
    });
</script>
@endpush
@endsection
