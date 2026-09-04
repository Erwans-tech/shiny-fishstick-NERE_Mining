{{-- Page : Notre histoire - Enhanced Unique Design --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<style>
    /* ══════════════════════════════════════════════════════════════
       ENHANCED MINING TIMELINE - Unique & Impressive
       Base IAM Gold + Améliorations visuelles uniques
       ══════════════════════════════════════════════════════════════ */
    
    .history-page {
        background: 
            linear-gradient(135deg, #0a0908 0%, #1a1612 50%, #0a0908 100%),
            radial-gradient(circle at 20% 30%, rgba(255,194,71,.03), transparent 50%);
        padding: 100px 0 120px;
        position: relative;
        overflow: hidden;
    }
    
    /* Animated gold particles background */
    .history-page::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: 
            radial-gradient(circle at 15% 20%, rgba(255,194,71,.08) 1px, transparent 1px),
            radial-gradient(circle at 85% 60%, rgba(255,194,71,.06) 2px, transparent 2px),
            radial-gradient(circle at 40% 80%, rgba(255,194,71,.05) 1px, transparent 1px);
        background-size: 400px 400px;
        animation: shimmer 20s ease-in-out infinite;
        pointer-events: none;
    }
    
    @keyframes shimmer {
        0%, 100% { opacity: 0.3; transform: translateY(0); }
        50% { opacity: 0.6; transform: translateY(-20px); }
    }
    
    /* ── Header ──────────────────────────────────────────────── */
    .history-header {
        max-width: 1200px;
        margin: 0 auto 80px;
        padding: 0 40px;
        position: relative;
        z-index: 2;
    }
    
    .history-header h1 {
        font: 300 52px/1.1 'Playfair Display', Georgia, serif;
        color: #fff;
        margin-bottom: 32px;
        text-shadow: 0 2px 20px rgba(255,194,71,.3);
        letter-spacing: -.01em;
    }
    
    .history-header h1::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--gold), var(--gold2), transparent);
        margin-top: 20px;
        animation: expandLine 1s ease-out;
    }
    
    @keyframes expandLine {
        from { width: 0; opacity: 0; }
        to { width: 80px; opacity: 1; }
    }
    
    /* ── Timeline Container ──────────────────────────────────── */
    .timeline-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
        position: relative;
        z-index: 2;
    }
    
    /* Animated ore vein line (gradient + glow) */
    .timeline-wrapper::before {
        content: '';
        position: absolute;
        left: 220px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(180deg,
            transparent 0%,
            var(--gold) 10%,
            var(--gold2) 30%,
            var(--gold) 50%,
            var(--gold2) 70%,
            var(--gold) 90%,
            transparent 100%
        );
        box-shadow: 
            0 0 10px rgba(255,194,71,.4),
            0 0 20px rgba(255,194,71,.2);
        animation: pulseLine 3s ease-in-out infinite;
    }
    
    @keyframes pulseLine {
        0%, 100% { opacity: 0.6; }
        50% { opacity: 1; }
    }
    
    /* ── Timeline Item ───────────────────────────────────────── */
    .timeline-event {
        display: grid;
        grid-template-columns: 160px 60px 1fr;
        gap: 0;
        margin-bottom: 50px;
        position: relative;
        opacity: 0;
        animation: revealEvent 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }
    
    .timeline-event:nth-child(1) { animation-delay: 0.2s; }
    .timeline-event:nth-child(2) { animation-delay: 0.4s; }
    .timeline-event:nth-child(3) { animation-delay: 0.6s; }
    .timeline-event:nth-child(4) { animation-delay: 0.8s; }
    
    @keyframes revealEvent {
        from {
            opacity: 0;
            transform: translateX(-50px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }
    
    /* Year badge (left) - Enhanced with gradient */
    .event-year {
        text-align: right;
        padding-right: 20px;
        padding-top: 36px;
        position: relative;
    }
    
    .year-badge {
        display: inline-block;
        position: relative;
    }
    
    .year-text {
        font: 700 36px/1 Inter, sans-serif;
        background: linear-gradient(135deg, var(--gold), var(--gold2), #fff);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: block;
        white-space: nowrap;
        letter-spacing: -.03em;
        filter: drop-shadow(0 2px 8px rgba(255,194,71,.3));
        transition: all 0.4s ease;
    }

    .timeline-event:last-child .year-text {
        font-size: 22px;
    }
    
    .timeline-event:hover .year-text {
        transform: scale(1.1);
        filter: drop-shadow(0 4px 16px rgba(255,194,71,.6));
    }
    
    .year-label {
        font: 600 10px/1 Inter, sans-serif;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: rgba(255,194,71,.6);
        display: block;
        margin-top: 8px;
    }
    
    /* Dot marker (center) - Enhanced with rings */
    .event-marker {
        position: relative;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-top: 44px;
    }
    
    .marker-dot {
        width: 18px;
        height: 18px;
        background: radial-gradient(circle, var(--gold-bright), var(--gold));
        border: 3px solid rgba(0,0,0,.8);
        border-radius: 50%;
        box-shadow: 
            0 0 0 4px rgba(255,194,71,.2),
            0 0 20px rgba(255,194,71,.6),
            inset 0 2px 4px rgba(255,255,255,.4);
        position: relative;
        z-index: 3;
        transition: all 0.4s ease;
    }
    
    .timeline-event:hover .marker-dot {
        transform: scale(1.3);
        box-shadow: 
            0 0 0 8px rgba(255,194,71,.3),
            0 0 30px rgba(255,194,71,.8),
            inset 0 2px 4px rgba(255,255,255,.6);
    }
    
    /* Orbital ring animation */
    .marker-dot::before {
        content: '';
        position: absolute;
        inset: -12px;
        border: 1px solid rgba(255,194,71,.3);
        border-radius: 50%;
        animation: rotate 8s linear infinite;
    }
    
    .marker-dot::after {
        content: '';
        position: absolute;
        inset: -20px;
        border: 1px solid rgba(255,194,71,.15);
        border-radius: 50%;
        animation: rotate 12s linear infinite reverse;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Content card (right) - Enhanced glassmorphism */
    .event-content {
        background: linear-gradient(135deg, 
            rgba(255,255,255,.12) 0%,
            rgba(255,255,255,.08) 100%
        );
        backdrop-filter: blur(10px);
        padding: 36px 40px;
        border-radius: 12px;
        box-shadow: 
            0 8px 32px rgba(0,0,0,.3),
            inset 0 1px 0 rgba(255,255,255,.1);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        overflow: hidden;
    }
    
    /* Animated corner accent */
    .event-content::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle at top right, 
            rgba(255,194,71,.15), 
            transparent 60%
        );
        pointer-events: none;
        transition: all 0.4s ease;
    }
    
    .event-content:hover::before {
        width: 150px;
        height: 150px;
        background: radial-gradient(circle at top right, 
            rgba(255,194,71,.25), 
            transparent 60%
        );
    }
    
    .event-content:hover {
        transform: translateX(8px) translateY(-4px);
        box-shadow: 
            0 12px 48px rgba(0,0,0,.4),
            inset 0 1px 0 rgba(255,255,255,.2);
    }
    
    .event-title {
        font: 600 24px/1.3 Inter, sans-serif;
        color: #fff;
        margin-bottom: 18px;
        text-shadow: 0 2px 8px rgba(0,0,0,.3);
        position: relative;
        z-index: 1;
    }
    
    /* Animated underline on hover */
    .event-title::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--gold), transparent);
        transition: width 0.5s ease;
    }
    
    .event-content:hover .event-title::after {
        width: 100%;
    }
    
    .event-text {
        font: 400 16px/1.8 Inter, sans-serif;
        color: rgba(255,255,255,.8);
        position: relative;
        z-index: 1;
    }
    
    /* ── Responsive ──────────────────────────────────────────── */
    @media (max-width: 768px) {
        .history-page {
            padding: 70px 0 80px;
        }
        
        .history-header,
        .timeline-wrapper {
            padding: 0 20px;
        }
        
        .history-header h1 {
            font-size: 36px;
        }
        
        .timeline-wrapper::before {
            left: 50px;
        }
        
        .timeline-event {
            grid-template-columns: 90px 1fr;
            gap: 0;
            margin-bottom: 40px;
        }
        
        .event-year {
            padding-right: 20px;
            padding-top: 32px;
        }

        .year-badge {
            transform: translateX(-50px);
        }
        
        .year-text {
            font-size: 26px;
        }

        .event-marker {
            position: absolute;
            left: 50px;
            top: 40px;
            padding: 0;
        }
        
        .marker-dot {
            width: 14px;
            height: 14px;
        }
        
        .event-content {
            grid-column: span 2;
            padding: 28px;
            margin-top: 70px;
        }
        
        .event-title {
            font-size: 20px;
        }
        
        .event-text {
            font-size: 15px;
        }
        
    }
</style>

<section class="history-page">
    
    <div class="history-header">
        <h1>{{ $en ? 'Our History' : 'Notre Histoire' }}</h1>
    </div>

    @php
        $historyYears = $en
            ? ['2003', '2016', '2022', 'Today']
            : ['2003', '2016', '2022', "Aujourd'hui"];
    @endphp

    <div class="timeline-wrapper">
        @foreach(range(1, 4) as $i)
        <article class="timeline-event">
            <div class="event-year">
                <div class="year-badge">
                    <span class="year-text">{{ $historyYears[$i - 1] }}</span>
                    <span class="year-label">{{ $en ? 'Year' : 'Année' }}</span>
                </div>
            </div>
            
            <div class="event-marker">
                <div class="marker-dot"></div>
            </div>
            
            <div class="event-content">
                <h3 class="event-title">{{ __('site.company_hist'.$i.'_title', [], $loc) }}</h3>
                <p class="event-text">{{ __('site.company_hist'.$i.'_p', [], $loc) }}</p>
            </div>
        </article>
        @endforeach
    </div>
    
</section>

<script>
// Parallax effect on scroll
window.addEventListener('scroll', function() {
    const events = document.querySelectorAll('.timeline-event');
    const scrolled = window.pageYOffset;
    
    events.forEach((event, index) => {
        const speed = 0.5 + (index * 0.1);
        const yPos = -(scrolled * speed * 0.05);
        
        if (window.innerWidth > 768) {
            event.style.transform = `translateY(${yPos}px)`;
        }
    });
}, { passive: true });

// Interactive hover effect on year badges
document.querySelectorAll('.year-badge').forEach(badge => {
    badge.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1) rotate(-2deg)';
    });
    
    badge.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1) rotate(0deg)';
    });
});
</script>

@endsection
