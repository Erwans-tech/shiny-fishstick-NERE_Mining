{{-- Page : Ressources minérales --}}
@extends('layouts.app')

@section('content')
<style>
    .resources-hero { display:grid; grid-template-columns:1.1fr .9fr; gap:30px; align-items:center; }
    .resources-hero img { width:100%; height:450px; object-fit:cover; border-radius:6px; }
    .resources-note { color:var(--muted); font:13px/1.6 Inter,sans-serif; margin-top:20px; }
    .resources-gallery { display:grid; grid-template-columns:repeat(3,1fr); gap:22px; }
    .resources-gallery figure { margin:0; padding:0; overflow:hidden; }
    .resources-gallery button { display:block; width:100%; padding:0; border:0; background:none; cursor:zoom-in; }
    .resources-gallery img { display:block; width:100%; height:320px; object-fit:cover; transition:transform .25s, opacity .25s; }
    .resources-gallery button:hover img, .resources-gallery button:focus-visible img { transform:scale(1.03); opacity:.88; }
    .resources-gallery figcaption { padding:14px 18px 18px; color:var(--muted); font:500 13px/1.5 Inter,sans-serif; }
    .resources-lightbox { position:fixed; inset:0; z-index:500; display:none; align-items:center; justify-content:center; padding:28px; background:rgba(20,8,6,.88); }
    .resources-lightbox.is-open { display:flex; }
    .resources-lightbox-dialog { position:relative; max-width:min(1400px,96vw); max-height:92vh; margin:0; }
    .resources-lightbox img { display:block; max-width:100%; max-height:82vh; object-fit:contain; background:#fff; }
    .resources-lightbox figcaption { margin-top:12px; color:#fff; text-align:center; font:500 14px/1.5 Inter,sans-serif; }
    .resources-lightbox-close { position:absolute; top:-42px; right:0; border:1px solid rgba(255,255,255,.55); background:var(--green); color:#fff; padding:8px 14px; border-radius:4px; cursor:pointer; font:600 11px Inter,sans-serif; text-transform:uppercase; }
    @media (max-width:760px) { .resources-hero, .resources-gallery { grid-template-columns:1fr; } .resources-hero img { height:240px; } }
</style>

<section>

    <div class="resources-hero">
        <div>
            <p class="lead">{{ __('site.karma_resources_lead', [], $loc) }}</p>
            <p>{{ __('site.karma_resources_detail', [], $loc) }}</p>
            <p class="resources-note">{{ __('site.resources_reference_note', [], $loc) }}</p>
        </div>
        <img src="{{ asset('images/resources/resources-map.jpg') }}"
             alt="{{ __('site.resources_image_1_alt', [], $loc) }}">
    </div>
</section>

<section class="sand">
    <h2>{{ __('site.resources_figures_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.resources_figures_lead', [], $loc) }}</p>
    <div class="stat-band">
        <div class="stat-item"><span class="stat-value">6 638</span><span class="stat-label">{{ __('site.resources_pp_label', [], $loc) }}</span></div>
        <div class="stat-item"><span class="stat-value">87 528</span><span class="stat-label">{{ __('site.resources_mi_label', [], $loc) }}</span></div>
        <div class="stat-item"><span class="stat-value">18 103</span><span class="stat-label">{{ __('site.resources_inferred_label', [], $loc) }}</span></div>
        <div class="stat-item"><span class="stat-value">25/04/2025</span><span class="stat-label">{{ __('site.resources_date_label', [], $loc) }}</span></div>
    </div>
    <p class="resources-note">{{ __('site.resources_grade_note', [], $loc) }}</p>
</section>

{{-- Resource Breakdown by Deposit --}}
<section style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;">{{ $en ? 'Resource Classification (JORC)' : 'Classification Ressource (JORC)' }}</h2>
        <p style="color:var(--muted); font-size:15px; line-height:1.8; margin-bottom:32px;">{{ $en ? 'Mineral resources classified according to international JORC Code standards.' : 'Ressources minérales classifiées selon standards JORC internationaux.' }}</p>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; font-size:14px;">
                <thead>
                    <tr style="background:var(--green); color:#fff;">
                        <th style="padding:16px; text-align:left; font-weight:600;">{{ $en ? 'Deposit' : 'Gisement' }}</th>
                        <th style="padding:16px; text-align:center; font-weight:600;">{{ $en ? 'Type' : 'Type' }}</th>
                        <th style="padding:16px; text-align:right; font-weight:600;">{{ $en ? 'Tonnage (Kt)' : 'Tonnage (Kt)' }}</th>
                        <th style="padding:16px; text-align:right; font-weight:600;">{{ $en ? 'Grade (g/t)' : 'Teneur (g/t)' }}</th>
                        <th style="padding:16px; text-align:right; font-weight:600;">{{ $en ? 'Gold (Koz)' : 'Or (Koz)' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $deposits = [
                        ['name' => 'Nami', 'type' => $en ? 'Oxide' : 'Oxydé', 'tonnage' => '1,633', 'grade' => '0.82', 'gold' => '15.2'],
                        ['name' => 'GG1', 'type' => $en ? 'Mixed' : 'Mixte', 'tonnage' => '5,888', 'grade' => '1.00', 'gold' => '36.3'],
                        ['name' => 'GG2', 'type' => $en ? 'Sulfide' : 'Sulfuré', 'tonnage' => '5,320', 'grade' => '1.65', 'gold' => '59.8'],
                        ['name' => 'Kao', 'type' => $en ? 'Mixed' : 'Mixte', 'tonnage' => '3,156', 'grade' => '0.95', 'gold' => '27.1'],
                        ['name' => 'Goulagou', 'type' => $en ? 'Oxide' : 'Oxydé', 'tonnage' => '1,641', 'grade' => '0.78', 'gold' => '11.2'],
                    ];
                    @endphp
                    @foreach($deposits as $dep)
                    <tr style="border-bottom:1px solid var(--line);">
                        <td style="padding:16px; text-align:left; font-weight:600; color:var(--green);">{{ $dep['name'] }}</td>
                        <td style="padding:16px; text-align:center;">{{ $dep['type'] }}</td>
                        <td style="padding:16px; text-align:right;">{{ $dep['tonnage'] }}</td>
                        <td style="padding:16px; text-align:right;">{{ $dep['grade'] }}</td>
                        <td style="padding:16px; text-align:right; font-weight:600; color:var(--gold2);">{{ $dep['gold'] }}</td>
                    </tr>
                    @endforeach
                    <tr style="background:var(--sand); font-weight:600;">
                        <td colspan="2" style="padding:16px; text-align:left;">{{ $en ? 'TOTAL' : 'TOTAL' }}</td>
                        <td style="padding:16px; text-align:right;">17,638</td>
                        <td style="padding:16px; text-align:right;">1.16</td>
                        <td style="padding:16px; text-align:right; color:var(--green);">149.6</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p style="color:var(--muted); font-size:13px; margin-top:16px; line-height:1.6;">
            {{ $en ? '* Resources are reported at a 0.4 g/t Au cut-off grade. JORC Code Compliant reporting; data as of 25 April 2025.' : '* Ressources rapportées à une teneur de coupure 0,4 g/t Au. Rapport conforme à la Norme JORC ; données du 25 avril 2025.' }}
        </p>
    </div>
</section>

<section>
    <h2>{{ __('site.resources_maps_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.resources_maps_lead', [], $loc) }}</p>
    <div class="resources-gallery">
        @foreach([
            ['resources-map.jpg', 'resources_image_1_alt', 'resources_image_1_caption'],
            ['resources-reserves-2025.jpg', 'resources_image_2_alt', 'resources_image_2_caption'],
            ['licenses-map.jpg', 'resources_image_3_alt', 'resources_image_3_caption'],
        ] as [$image, $alt, $caption])
        <figure class="card">
            <button type="button" data-resource-image="{{ asset('images/resources/'.$image) }}"
                    data-resource-alt="{{ __('site.'.$alt, [], $loc) }}"
                    data-resource-caption="{{ __('site.'.$caption, [], $loc) }}">
                <img src="{{ asset('images/resources/'.$image) }}" alt="{{ __('site.'.$alt, [], $loc) }}">
            </button>
            <figcaption>{{ __('site.'.$caption, [], $loc) }}</figcaption>
        </figure>
        @endforeach
    </div>
</section>

<div class="resources-lightbox" data-resource-lightbox aria-hidden="true">
    <figure class="resources-lightbox-dialog">
        <button type="button" class="resources-lightbox-close" data-resource-close>{{ $en ? 'Close' : 'Fermer' }}</button>
        <img data-resource-preview src="" alt="">
        <figcaption data-resource-caption></figcaption>
    </figure>
</div>

<script>
    (() => {
        const box = document.querySelector('[data-resource-lightbox]');
        const preview = box?.querySelector('[data-resource-preview]');
        const caption = box?.querySelector('[data-resource-caption]');
        const close = () => { box?.classList.remove('is-open'); box?.setAttribute('aria-hidden', 'true'); if (preview) preview.removeAttribute('src'); };
        document.querySelectorAll('[data-resource-image]').forEach((button) => button.addEventListener('click', () => {
            preview.src = button.dataset.resourceImage;
            preview.alt = button.dataset.resourceAlt;
            caption.textContent = button.dataset.resourceCaption;
            box.classList.add('is-open');
            box.setAttribute('aria-hidden', 'false');
            box.querySelector('[data-resource-close]').focus();
        }));
        box?.querySelector('[data-resource-close]')?.addEventListener('click', close);
        box?.addEventListener('click', (event) => { if (event.target === box) close(); });
        document.addEventListener('keydown', (event) => { if (event.key === 'Escape') close(); });
    })();
</script>
@endsection