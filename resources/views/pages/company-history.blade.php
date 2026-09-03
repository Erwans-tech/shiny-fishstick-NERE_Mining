{{-- Page : Notre histoire - Style IAM Gold Essakane --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<style>
    /* ══════════════════════════════════════════════════════════════
       TIMELINE STYLE IAM GOLD - Layout horizontal avec années
       ══════════════════════════════════════════════════════════════ */
    
    .history-page {
        background: #f8f8f8;
        padding: 80px 0 100px;
    }
    
    /* ── Header ──────────────────────────────────────────────── */
    .history-header {
        max-width: 1200px;
        margin: 0 auto 60px;
        padding: 0 40px;
    }
    
    .history-header h1 {
        font: 600 42px/1.2 Inter, sans-serif;
        color: var(--green);
        margin-bottom: 24px;
    }
    
    .history-intro {
        font: 400 16px/1.8 Inter, sans-serif;
        color: #666;
        max-width: 900px;
        background: #fff;
        padding: 32px;
        border-radius: 8px;
        border-left: 4px solid var(--gold);
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
    }
    
    /* ── Timeline Container ──────────────────────────────────── */
    .timeline-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
        position: relative;
    }
    
    /* Vertical line */
    .timeline-wrapper::before {
        content: '';
        position: absolute;
        left: 220px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #ddd;
    }
    
    /* ── Timeline Item ───────────────────────────────────────── */
    .timeline-event {
        display: grid;
        grid-template-columns: 160px 60px 1fr;
        gap: 0;
        margin-bottom: 40px;
        position: relative;
        opacity: 0;
        animation: fadeIn 0.6s ease-out forwards;
    }
    
    .timeline-event:nth-child(1) { animation-delay: 0.1s; }
    .timeline-event:nth-child(2) { animation-delay: 0.2s; }
    .timeline-event:nth-child(3) { animation-delay: 0.3s; }
    .timeline-event:nth-child(4) { animation-delay: 0.4s; }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Year badge (left) */
    .event-year {
        text-align: right;
        padding-right: 20px;
        padding-top: 32px;
    }
    
    .year-text {
        font: 700 28px/1.2 Inter, sans-serif;
        color: var(--gold2);
        display: block;
        letter-spacing: -.02em;
    }
    
    /* Dot marker (center) */
    .event-marker {
        position: relative;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding-top: 38px;
    }
    
    .marker-dot {
        width: 14px;
        height: 14px;
        background: var(--gold);
        border: 3px solid #fff;
        border-radius: 50%;
        box-shadow: 0 0 0 2px var(--gold);
        position: relative;
        z-index: 2;
    }
    
    /* Content card (right) */
    .event-content {
        background: #fff;
        padding: 32px 36px;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
        border-left: 4px solid var(--gold);
        transition: all 0.3s ease;
    }
    
    .event-content:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,.1);
        transform: translateY(-2px);
    }
    
    .event-title {
        font: 600 22px/1.3 Inter, sans-serif;
        color: var(--green);
        margin-bottom: 16px;
    }
    
    .event-text {
        font: 400 15px/1.7 Inter, sans-serif;
        color: #666;
    }
    
    /* ── Footer ──────────────────────────────────────────────── */
    .timeline-footer {
        max-width: 1200px;
        margin: 60px auto 0;
        padding: 0 40px;
        text-align: center;
    }
    
    .timeline-footer-icon {
        font-size: 36px;
        opacity: 0.2;
        margin-bottom: 12px;
    }
    
    .timeline-footer-text {
        font: 600 14px/1.6 Inter, sans-serif;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--gold2);
    }
    
    /* ── Responsive ──────────────────────────────────────────── */
    @media (max-width: 768px) {
        .history-page {
            padding: 60px 0 80px;
        }
        
        .history-header,
        .timeline-wrapper,
        .timeline-footer {
            padding: 0 20px;
        }
        
        .history-header h1 {
            font-size: 32px;
        }
        
        .history-intro {
            padding: 24px;
        }
        
        .timeline-wrapper::before {
            left: 40px;
        }
        
        .timeline-event {
            grid-template-columns: 80px 1fr;
            gap: 0;
            margin-bottom: 30px;
        }
        
        .event-year {
            padding-right: 16px;
            padding-top: 28px;
        }
        
        .year-text {
            font-size: 20px;
        }
        
        .event-marker {
            position: absolute;
            left: 40px;
            top: 36px;
            padding: 0;
        }
        
        .marker-dot {
            width: 12px;
            height: 12px;
        }
        
        .event-content {
            grid-column: span 2;
            padding: 24px;
            margin-top: 60px;
        }
        
        .event-title {
            font-size: 19px;
        }
        
        .event-text {
            font-size: 14px;
        }
    }
</style>

<section class="history-page">
    
    <div class="history-header">
        <h1>{{ $en ? 'Our History' : 'Notre Histoire' }}</h1>
        <div class="history-intro">
            {{ __('site.company_history_lead', [], $loc) }}
        </div>
    </div>

    <div class="timeline-wrapper">
        @foreach(range(1, 4) as $i)
        <article class="timeline-event">
            <div class="event-year">
                <span class="year-text">{{ 2000 + ($i * 5) }}</span>
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
    
    <div class="timeline-footer">
        <div class="timeline-footer-icon">⛏️</div>
        <p class="timeline-footer-text">{{ $en ? 'Néré Mining - Building the Future' : 'Néré Mining - Construire l\'Avenir' }}</p>
    </div>
    
</section>

@endsection
