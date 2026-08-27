{{-- Page : Projet CIL --}}
@extends('layouts.app')

@section('content')
<style>
    .cil-gallery-item { padding:0; overflow:hidden; }
    .cil-gallery-trigger { display:block; width:100%; padding:0; border:0; background:none; cursor:zoom-in; }
    .cil-gallery-trigger img { transition:transform .25s ease, opacity .25s ease; }
    .cil-gallery-trigger:hover img, .cil-gallery-trigger:focus-visible img { transform:scale(1.03); opacity:.88; }
    .cil-gallery-caption { padding:14px 18px 18px; color:var(--muted); font:500 13px/1.5 Inter,sans-serif; text-align:left; }
    .cil-lightbox { position:fixed; inset:0; z-index:500; display:none; align-items:center; justify-content:center; padding:28px; background:rgba(20,8,6,.88); }
    .cil-lightbox.is-open { display:flex; }
    .cil-lightbox-dialog { position:relative; max-width:min(1200px,96vw); max-height:92vh; margin:0; }
    .cil-lightbox-image { display:block; max-width:100%; max-height:82vh; object-fit:contain; border:1px solid rgba(255,255,255,.25); background:#fff; }
    .cil-lightbox-caption { margin-top:12px; color:#fff; text-align:center; font:500 14px/1.5 Inter,sans-serif; }
    .cil-lightbox-close { position:absolute; top:-42px; right:0; border:1px solid rgba(255,255,255,.55); background:var(--green); color:#fff; padding:8px 14px; border-radius:4px; cursor:pointer; font:600 11px Inter,sans-serif; text-transform:uppercase; letter-spacing:.08em; }
</style>

<section>
    <div class="sub-nav">
        <a href="{{ $en ? route('english.projects') : route('projects') }}">{{ __('site.nav_projects', [], $loc) }}</a>
        <a href="{{ $en ? route('english.projects.cil') : route('projects.cil') }}" class="active">{{ __('site.nav_projects_cil', [], $loc) }}</a>
    </div>

    <h2>{{ __('site.cil_project_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.cil_project_lead', [], $loc) }}</p>

    <div class="grid-2" style="margin-top:36px;">
        <div class="card">
            <div class="card-tag">{{ __('site.cil_project_location_tag', [], $loc) }}</div>
            <h3>{{ __('site.cil_project_location_h3', [], $loc) }}</h3>
            <p>{{ __('site.cil_project_location_p', [], $loc) }}</p>
        </div>
        <div class="card">
            <div class="card-tag">{{ __('site.cil_project_assets_tag', [], $loc) }}</div>
            <h3>{{ __('site.cil_project_assets_h3', [], $loc) }}</h3>
            <p>{{ __('site.cil_project_assets_p', [], $loc) }}</p>
        </div>
    </div>
</section>

<section class="sand">
    <h2>{{ __('site.cil_project_gallery_h2', [], $loc) }}</h2>
    <div class="grid-3">
        @foreach([
            ['cil-01.png', 'cil_project_image_1_alt', 'cil_project_image_1_caption'],
            ['cil-02.jpg', 'cil_project_image_2_alt', 'cil_project_image_2_caption'],
            ['cil-lexiviation.jpg', 'cil_project_image_3_alt', 'cil_project_image_3_caption'],
            ['cil-03.png', 'cil_project_image_4_alt', 'cil_project_image_4_caption'],
            ['cil-04.png', 'cil_project_image_5_alt', 'cil_project_image_5_caption'],
        ] as [$image, $alt, $caption])
        <figure class="card cil-gallery-item">
            <button class="cil-gallery-trigger" type="button"
                    data-lightbox-image="{{ asset('images/cil/'.$image) }}"
                    data-lightbox-alt="{{ __('site.'.$alt, [], $loc) }}"
                    data-lightbox-caption="{{ __('site.'.$caption, [], $loc) }}">
                <img src="{{ asset('images/cil/'.$image) }}"
                     alt="{{ __('site.'.$alt, [], $loc) }}"
                     style="width:100%; height:220px; object-fit:cover;">
            </button>
            <figcaption class="cil-gallery-caption">{{ __('site.'.$caption, [], $loc) }}</figcaption>
        </figure>
        @endforeach
    </div>
</section>

<section class="sand">
    <h2>{{ __('site.cil_project_value_h2', [], $loc) }}</h2>
    <p class="lead">{{ __('site.cil_project_value_p', [], $loc) }}</p>
</section>

<div class="cil-lightbox" data-lightbox aria-hidden="true">
    <figure class="cil-lightbox-dialog">
        <button class="cil-lightbox-close" type="button" data-lightbox-close>{{ $en ? 'Close' : 'Fermer' }}</button>
        <img class="cil-lightbox-image" data-lightbox-preview src="" alt="">
        <figcaption class="cil-lightbox-caption" data-lightbox-caption></figcaption>
    </figure>
</div>

<script>
    (() => {
        const lightbox = document.querySelector('[data-lightbox]');
        const preview = lightbox?.querySelector('[data-lightbox-preview]');
        const caption = lightbox?.querySelector('[data-lightbox-caption]');
        const close = () => {
            if (!lightbox) return;
            lightbox.classList.remove('is-open');
            lightbox.setAttribute('aria-hidden', 'true');
            preview.removeAttribute('src');
        };
        document.querySelectorAll('[data-lightbox-image]').forEach((trigger) => {
            trigger.addEventListener('click', () => {
                preview.src = trigger.dataset.lightboxImage;
                preview.alt = trigger.dataset.lightboxAlt;
                caption.textContent = trigger.dataset.lightboxCaption;
                lightbox.classList.add('is-open');
                lightbox.setAttribute('aria-hidden', 'false');
                lightbox.querySelector('[data-lightbox-close]').focus();
            });
        });
        lightbox?.querySelector('[data-lightbox-close]')?.addEventListener('click', close);
        lightbox?.addEventListener('click', (event) => {
            if (event.target === lightbox) close();
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') close();
        });
    })();
</script>
@endsection