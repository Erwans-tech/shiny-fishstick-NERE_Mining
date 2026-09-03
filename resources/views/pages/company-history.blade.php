{{-- Page : Notre histoire --}}
@extends('layouts.app')

@section('content')
@php $companyBase = $en ? route('english.company') : route('company'); @endphp

<style>
    /* ══════════════════════════════════════════════════════════════
       SIMPLE MODERN TIMELINE - Mining Theme
       Design épuré et agréable comme les sites corporatifs modernes
       ══════════════════════════════════════════════════════════════ */
    
    .history-page {
        background: linear-gradient(180deg, #f8f6f3 0%, #fff 100%);
        padding: 80px 0 100px;
    }
    
    /* ── Header Section ──────────────────────────────────────── */
    .history-header {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 80px;
        padding: 0 20px;
    }
    
    .history-subtitle {
        font: 600 13px/1.4 Inter, sans-serif;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: var(--gold2);
        margin-bottom: 16px;
    }
    
    .history-title {
        font: 600 42px/1.2 Inter, sans-serif;
        color: var(--green);
        margin-bottom: 24px;
    }
    
    .history-lead {
        font: 400 18px/1.7 Inter, sans-serif;
        color: var(--muted);
        max-width: 700px;
        margin: 0 auto;
    }
    
    /* ── Timeline Container ──────────────────────────────────── */
    .timeline-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
    }
    
    /* Vertical line */
    .timeline-container::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, 
            transparent,
            var(--gold) 10%,
            var(--gold) 90%,
            transparent
        );
        transform: translateX(-50%);
    }
    
    /* ── Timeline Item ───────────────────────────────────────── */
    .timeline-item {
        display: grid;
        grid-template-columns: 1fr 100px 1fr;
        gap: 40px;
        align-items: center;
        margin-bottom: 80px;
        position: relative;
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .timeline-item:nth-child(1) { animation-delay: 0.1s; }
    .timeline-item:nth-child(2) { animation-delay: 0.2s; }
    .timeline-item:nth-child(3) { animation-delay: 0.3s; }
    .timeline-item:nth-child(4) { animation-delay: 0.4s; }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Left content (odd items) */
    .timeline-item:nth-child(odd) .timeline-content {
        grid-column: 1;
        text-align: right;
    }
    
    /* Right content (even items) */
    .timeline-item:nth-child(even) .timeline-content {
        grid-column: 3;
        text-align: left;
    }
    
    /* ── Timeline Marker ─────────────────────────────────────── */
    .timeline-marker {
        grid-column: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        z-index: 2;
    }
    
    .marker-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--green), var(--green2));
        border: 4px solid #fff;
        border-radius: 50%;
        display: grid;
        place-items: center;
        box-shadow: 0 0 0 4px var(--gold), 0 8px 20px rgba(0,0,0,.15);
        font: 700 20px Inter, sans-serif;
        color: var(--gold);
        transition: transform 0.3s ease;
    }
    
    .timeline-item:hover .marker-icon {
        transform: scale(1.15);
    }
    
    .marker-year {
        font: 600 12px Inter, sans-serif;
        letter-spacing: .1em;
        color: var(--gold2);
        padding: 4px 12px;
        background: rgba(255,194,71,.1);
        border-radius: 12px;
    }
    
    /* ── Timeline Content Card ───────────────────────────────── */
    .timeline-content {
        background: #fff;
        padding: 32px;
        border-radius: 12px;
        border-left: 4px solid var(--gold);
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
        transition: all 0.3s ease;
    }
    
    .timeline-content:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,.12);
        border-left-color: var(--gold2);
    }
    
    .content-title {
        font: 600 24px/1.3 Inter, sans-serif;
        color: var(--green);
        margin-bottom: 16px;
    }
    
    .content-text {
        font: 400 15px/1.7 Inter, sans-serif;
        color: var(--muted);
    }
    
    /* Mining icon decorations */
    .mining-icon {
        display: inline-block;
        width: 24px;
        height: 24px;
        background: var(--gold);
        mask-size: contain;
        mask-position: center;
        margin-bottom: -4px;
        margin-right: 8px;
    }
    
    /* ── Decorative Elements ─────────────────────────────────── */
    .history-decoration {
        position: absolute;
        opacity: 0.05;
        pointer-events: none;
    }
    
    .decoration-top {
        top: -40px;
        right: 5%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, var(--gold), transparent 70%);
    }
    
    .decoration-bottom {
        bottom: -40px;
        left: 5%;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, var(--green), transparent 70%);
    }
    
    /* ── Bottom CTA ──────────────────────────────────────────── */
    .timeline-footer {
        text-align: center;
        margin-top: 60px;
        padding: 40px 20px;
    }
    
    .timeline-footer-text {
        font: 600 16px/1.6 Inter, sans-serif;
        color: var(--green);
        margin-bottom: 16px;
    }
    
    .footer-icon {
        font-size: 32px;
        opacity: 0.3;
    }
    
    /* ── Responsive ──────────────────────────────────────────── */
    @media (max-width: 768px) {
        .history-title {
            font-size: 32px;
        }
        
        .timeline-container {
            padding: 0 20px 0 80px;
        }
        
        .timeline-container::before {
            left: 40px;
        }
        
        .timeline-item {
            grid-template-columns: 1fr;
            gap: 0;
            margin-bottom: 60px;
        }
        
        .timeline-marker {
            position: absolute;
            left: 5px;
            top: 0;
            grid-column: auto;
        }
        
        .marker-icon {
            width: 60px;
            height: 60px;
            font-size: 18px;
        }
        
        .marker-year {
            position: absolute;
            left: 80px;
            top: 18px;
        }
        
        .timeline-item:nth-child(odd) .timeline-content,
        .timeline-item:nth-child(even) .timeline-content {
            grid-column: auto;
            text-align: left;
            margin-top: 60px;
        }
        
        .timeline-content {
            padding: 24px;
        }
        
        .content-title {
            font-size: 20px;
        }
    }
</style>

<section class="history-page">
    <div class="history-decoration decoration-top"></div>
    
    <div class="history-header">
        <p class="history-subtitle">{{ $en ? 'Our Journey' : 'Notre Parcours' }}</p>
        <h1 class="history-title">{{ $en ? 'History' : 'Histoire' }}</h1>
        <p class="history-lead">{{ __('site.company_history_lead', [], $loc) }}</p>
    </div>

    <div class="timeline-container">
        @foreach(range(1, 4) as $i)
        <div class="timeline-item">
            <div class="timeline-marker">
                <div class="marker-icon">0{{ $i }}</div>
                <span class="marker-year">{{ 2000 + ($i * 5) }}</span>
            </div>
            
            <div class="timeline-content">
                <h3 class="content-title">{{ __('site.company_hist'.$i.'_title', [], $loc) }}</h3>
                <p class="content-text">{{ __('site.company_hist'.$i.'_p', [], $loc) }}</p>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="timeline-footer">
        <p class="timeline-footer-text">{{ $en ? 'Building the future together' : 'Construisons l\'avenir ensemble' }}</p>
        <div class="footer-icon">⛏️</div>
    </div>
    
    <div class="history-decoration decoration-bottom"></div>
</section>

@endsection
