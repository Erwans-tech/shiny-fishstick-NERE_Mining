{{-- Page : Notre histoire - Timeline Futuriste --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<style>
    /* ══════════════════════════════════════════════════════════════
       TIMELINE FUTURISTE CHRONOLOGIQUE
       ══════════════════════════════════════════════════════════════ */
    
    .history-page {
        position: relative;
        overflow: hidden;
        background: linear-gradient(180deg, #f8f5f0 0%, #fff 100%);
        padding: 80px 0 120px;
    }
    
    /* Background Tech Grid */
    .history-page::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 400px;
        background: 
            linear-gradient(90deg, transparent 49%, rgba(255,194,71,.04) 50%, transparent 51%),
            linear-gradient(0deg, transparent 49%, rgba(255,194,71,.04) 50%, transparent 51%);
        background-size: 80px 80px;
        opacity: 0.3;
        pointer-events: none;
    }
    
    /* Floating Particles */
    .history-page::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 30%, rgba(255,194,71,.08) 0%, transparent 50%),
                    radial-gradient(circle at 80% 60%, rgba(75,23,22,.05) 0%, transparent 50%);
        pointer-events: none;
        animation: floatParticles 20s ease-in-out infinite;
    }
    
    @keyframes floatParticles {
        0%, 100% { transform: translateY(0); opacity: 0.5; }
        50% { transform: translateY(-20px); opacity: 0.8; }
    }
    
    /* ── Introduction ─────────────────────────────────────────── */
    .history-intro {
        position: relative;
        max-width: 900px;
        margin: 0 auto 80px;
        text-align: center;
        z-index: 1;
    }
    
    .history-intro-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: linear-gradient(135deg, rgba(255,194,71,.1), rgba(255,194,71,.2));
        border: 1px solid rgba(255,194,71,.3);
        border-radius: 50px;
        color: var(--gold2);
        font: 700 10px Inter, sans-serif;
        letter-spacing: .24em;
        text-transform: uppercase;
        margin-bottom: 24px;
        animation: pulseBadge 3s ease-in-out infinite;
    }
    
    @keyframes pulseBadge {
        0%, 100% { box-shadow: 0 0 0 0 rgba(255,194,71,.4); }
        50% { box-shadow: 0 0 0 8px rgba(255,194,71,0); }
    }
    
    .history-intro-badge::before {
        content: '◆';
        color: var(--gold);
        animation: rotateDiamond 4s linear infinite;
        display: inline-block;
    }
    
    @keyframes rotateDiamond {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .history-intro .lead {
        margin: 0 auto;
        text-align: center;
        font-size: 18px;
        line-height: 1.8;
        color: var(--muted);
    }
    
    /* ── Timeline Container ──────────────────────────────────── */
    .history-timeline {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 0;
    }
    
    /* Central Spine (Animated) */
    .history-timeline::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        width: 3px;
        background: linear-gradient(
            180deg,
            transparent 0%,
            var(--gold) 5%,
            var(--gold2) 50%,
            var(--gold) 95%,
            transparent 100%
        );
        transform: translateX(-50%);
        box-shadow: 
            0 0 20px rgba(255,194,71,.6),
            0 0 40px rgba(255,194,71,.3);
        animation: pulseSpine 3s ease-in-out infinite;
    }
    
    @keyframes pulseSpine {
        0%, 100% { opacity: 0.8; }
        50% { opacity: 1; box-shadow: 0 0 30px rgba(255,194,71,.8), 0 0 60px rgba(255,194,71,.4); }
    }
    
    /* Progress Indicator */
    .timeline-progress {
        position: absolute;
        top: 0;
        left: 50%;
        width: 3px;
        height: 0;
        background: linear-gradient(180deg, var(--gold), var(--green));
        transform: translateX(-50%);
        transition: height 0.3s ease-out;
        z-index: 1;
    }
    
    /* ── Timeline Events ─────────────────────────────────────── */
    .history-event {
        position: relative;
        display: grid;
        grid-template-columns: 1fr 120px 1fr;
        align-items: center;
        gap: 40px;
        margin-bottom: 100px;
        opacity: 0;
        transform: translateY(50px);
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .history-event:nth-child(1) { animation-delay: 0.1s; }
    .history-event:nth-child(2) { animation-delay: 0.2s; }
    .history-event:nth-child(3) { animation-delay: 0.3s; }
    .history-event:nth-child(4) { animation-delay: 0.4s; }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Alternating Layout */
    .history-event:nth-child(odd) .history-card {
        grid-column: 1;
        text-align: right;
    }
    
    .history-event:nth-child(even) .history-card {
        grid-column: 3;
        text-align: left;
    }
    
    /* ── Timeline Marker (Central Node) ─────────────────────── */
    .history-marker {
        grid-column: 2;
        grid-row: 1;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 90px;
        height: 90px;
        margin: 0 auto;
        z-index: 2;
    }
    
    .history-marker-circle {
        position: relative;
        width: 100%;
        height: 100%;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--green), var(--green2));
        border: 3px solid var(--gold);
        box-shadow: 
            0 0 0 8px rgba(255,194,71,.15),
            0 0 20px rgba(255,194,71,.4),
            0 8px 24px rgba(40,29,24,.25);
        animation: rotateMarker 10s linear infinite;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    
    .history-event:hover .history-marker-circle {
        transform: scale(1.15) rotate(0deg);
        box-shadow: 
            0 0 0 12px rgba(255,194,71,.2),
            0 0 30px rgba(255,194,71,.6),
            0 12px 32px rgba(40,29,24,.3);
        animation-play-state: paused;
    }
    
    @keyframes rotateMarker {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .history-marker-number {
        font: 700 24px Inter, sans-serif;
        color: var(--gold);
        text-shadow: 0 2px 8px rgba(0,0,0,.3);
        letter-spacing: .05em;
    }
    
    /* Orbital Rings */
    .history-marker::before,
    .history-marker::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        border: 1px solid rgba(255,194,71,.2);
        animation: orbit 8s linear infinite;
    }
    
    .history-marker::before {
        width: 110%;
        height: 110%;
    }
    
    .history-marker::after {
        width: 130%;
        height: 130%;
        animation-duration: 12s;
        animation-direction: reverse;
    }
    
    @keyframes orbit {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* ── Timeline Card (Content) ────────────────────────────── */
    .history-card {
        position: relative;
        padding: 32px 36px;
        background: linear-gradient(135deg, #fff 0%, #fffbf0 100%);
        border: 1px solid rgba(255,194,71,.2);
        border-radius: 16px;
        box-shadow: 
            0 8px 24px rgba(40,29,24,.08),
            inset 0 1px 0 rgba(255,255,255,.8);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
        cursor: pointer;
    }
    
    /* Animated Border Glow */
    .history-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, 
            transparent,
            var(--gold),
            var(--gold2),
            var(--gold),
            transparent
        );
        background-size: 200% 100%;
        animation: borderFlow 3s linear infinite;
        opacity: 0;
        transition: opacity 0.4s;
    }
    
    .history-card:hover::before {
        opacity: 1;
    }
    
    @keyframes borderFlow {
        from { background-position: 200% 0; }
        to { background-position: -200% 0; }
    }
    
    .history-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 
            0 20px 40px rgba(40,29,24,.15),
            0 0 0 1px rgba(255,194,71,.3),
            inset 0 1px 0 rgba(255,255,255,1);
        border-color: var(--gold);
    }
    
    /* Card Corner Accents */
    .history-card::after {
        content: '';
        position: absolute;
        top: -1px;
        right: -1px;
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, transparent 50%, rgba(255,194,71,.08) 50%);
        pointer-events: none;
    }
    
    .history-card summary {
        position: relative;
        list-style: none;
        cursor: pointer;
        color: var(--green);
        font: 600 22px/1.3 Inter, sans-serif;
        padding-right: 40px;
        transition: color 0.3s;
    }
    
    .history-card summary::-webkit-details-marker {
        display: none;
    }
    
    .history-card:hover summary {
        color: var(--green2);
    }
    
    /* Expand Icon */
    .history-card summary::after {
        content: '+';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        display: grid;
        place-items: center;
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--gold), var(--gold2));
        color: var(--green);
        font: 700 24px/1 Inter, sans-serif;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(255,194,71,.3);
        transition: all 0.3s ease;
    }
    
    .history-event:nth-child(odd) .history-card summary::after {
        right: auto;
        left: 0;
    }
    
    .history-card[open] summary::after {
        content: '−';
        transform: translateY(-50%) rotate(180deg);
        background: linear-gradient(135deg, var(--green), var(--green2));
        color: var(--gold);
    }
    
    .history-card summary:hover::after {
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 16px rgba(255,194,71,.5);
    }
    
    .history-card p {
        margin: 20px 0 0;
        padding-top: 20px;
        border-top: 1px solid rgba(255,194,71,.15);
        color: var(--muted);
        font-size: 15px;
        line-height: 1.8;
        animation: fadeIn 0.5s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Connection Lines */
    .history-event::before {
        content: '';
        position: absolute;
        top: 50%;
        width: 40px;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--gold));
        z-index: 1;
    }
    
    .history-event:nth-child(odd)::before {
        right: calc(50% + 60px);
        background: linear-gradient(90deg, var(--gold), transparent);
    }
    
    .history-event:nth-child(even)::before {
        left: calc(50% + 60px);
    }
    
    /* ── Responsive ──────────────────────────────────────────── */
    @media (max-width: 900px) {
        .history-page {
            padding: 60px 0 80px;
        }
        
        .history-intro {
            margin-bottom: 60px;
            padding: 0 20px;
        }
        
        .history-timeline {
            padding: 40px 0 40px 60px;
        }
        
        .history-timeline::before {
            left: 30px;
        }
        
        .timeline-progress {
            left: 30px;
        }
        
        .history-event {
            display: block;
            margin-bottom: 60px;
            padding-left: 0;
        }
        
        .history-event::before {
            display: none;
        }
        
        .history-marker {
            position: absolute;
            left: -15px;
            top: 30px;
            width: 60px;
            height: 60px;
        }
        
        .history-marker-number {
            font-size: 18px;
        }
        
        .history-marker::before,
        .history-marker::after {
            display: none;
        }
        
        .history-event:nth-child(odd) .history-card,
        .history-event:nth-child(even) .history-card {
            text-align: left;
            margin-left: 0;
        }
        
        .history-event:nth-child(odd) .history-card summary::after {
            left: auto;
            right: 0;
        }
        
        .history-card {
            padding: 24px 28px;
        }
        
        .history-card summary {
            font-size: 18px;
            padding-right: 40px;
        }
    }
</style>

<section class="history-page">

    <div class="history-intro">
        <div class="history-intro-badge">
            <span>{{ $en ? 'Timeline' : 'Chronologie' }}</span>
            <span>•</span>
            <span>{{ $en ? 'Our Journey' : 'Notre Parcours' }}</span>
        </div>
        <p class="lead">{{ __('site.company_history_lead', [], $loc) }}</p>
    </div>

    <div class="history-timeline" aria-label="{{ $en ? 'Néré Mining timeline' : 'Chronologie de Néré Mining' }}">
        <div class="timeline-progress" id="timelineProgress"></div>
        
        @foreach(range(1, 4) as $i)
        <article class="history-event" data-event="{{ $i }}">
            <div class="history-marker">
                <div class="history-marker-circle">
                    <span class="history-marker-number">0{{ $i }}</span>
                </div>
            </div>
            <details class="history-card" {{ $i === 1 ? 'open' : '' }}>
                <summary>{{ __('site.company_hist'.$i.'_title', [], $loc) }}</summary>
                <p>{{ __('site.company_hist'.$i.'_p', [], $loc) }}</p>
            </details>
        </article>
        @endforeach
    </div>
</section>

<script>
// Timeline Scroll Progress Indicator
(function() {
    const timeline = document.querySelector('.history-timeline');
    const progress = document.getElementById('timelineProgress');
    const events = document.querySelectorAll('.history-event');
    
    if (!timeline || !progress || events.length === 0) return;
    
    function updateProgress() {
        const timelineRect = timeline.getBoundingClientRect();
        const windowHeight = window.innerHeight;
        const timelineTop = timelineRect.top;
        const timelineHeight = timelineRect.height;
        
        // Calculate scroll progress
        let scrolled = 0;
        if (timelineTop < windowHeight * 0.5) {
            scrolled = Math.min((windowHeight * 0.5 - timelineTop) / timelineHeight, 1);
        }
        
        progress.style.height = (scrolled * 100) + '%';
        
        // Add visible class to events as they come into view
        events.forEach((event, index) => {
            const eventRect = event.getBoundingClientRect();
            if (eventRect.top < windowHeight * 0.8) {
                event.style.opacity = '1';
                event.style.transform = 'translateY(0)';
            }
        });
    }
    
    // Throttle scroll event
    let ticking = false;
    function onScroll() {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                updateProgress();
                ticking = false;
            });
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', onScroll, { passive: true });
    updateProgress(); // Initial call
})();

// Interactive Card Effects
document.querySelectorAll('.history-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        const marker = this.closest('.history-event').querySelector('.history-marker-circle');
        if (marker) {
            marker.style.transform = 'scale(1.15)';
        }
    });
    
    card.addEventListener('mouseleave', function() {
        const marker = this.closest('.history-event').querySelector('.history-marker-circle');
        if (marker) {
            marker.style.transform = 'scale(1)';
        }
    });
});
</script>
@endsection
