<section>
    <p class="lead">{{ __('site.gallery_lead') }}</p>
    
    {{-- Albums --}}
    @if(isset($albums) && $albums->isNotEmpty())
        <h2 style="margin-bottom:24px;font-size:24px;">{{ $en ? 'Photo Albums' : 'Albums Photo' }}</h2>
        <div class="albums-grid" id="albums-grid">
            @foreach($albums as $album)
                <article class="album-card" data-album-id="{{ $album->id }}">
                    <a href="{{ $en ? route('english.gallery.album', $album) : route('gallery.album', $album) }}" class="album-link">
                        <div class="album-carousel">
                            @php
                                $previewImages = $album->preview_images;
                            @endphp
                            @if($previewImages->isNotEmpty())
                                @foreach($previewImages as $index => $media)
                                    <div class="album-carousel-slide {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $media->url }}" alt="{{ $media->title }}" loading="lazy">
                                    </div>
                                @endforeach
                                @if($previewImages->count() > 1)
                                    <div class="album-carousel-dots">
                                        @foreach($previewImages as $index => $media)
                                            <span class="dot {{ $index === 0 ? 'active' : '' }}"></span>
                                        @endforeach
                                    </div>
                                @endif
                            @else
                                <div class="album-carousel-slide active">
                                    <div class="album-placeholder">
                                        <span>📷</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="album-info">
                            <h3 class="album-title">{{ $album->title }}</h3>
                            @if($album->description)
                                <p class="album-description">{{ Str::limit($album->description, 100) }}</p>
                            @endif
                            <div class="album-meta">
                                <span class="album-count">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <path d="M21 15l-5-5L5 21"/>
                                    </svg>
                                    {{ $album->photo_count }} {{ $album->photo_count > 1 ? ($en ? 'photos' : 'photos') : ($en ? 'photo' : 'photo') }}
                                </span>
                                <span class="album-view-link">{{ $en ? 'View album' : 'Voir l\'album' }} →</span>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    @endif

    {{-- Individual Images (legacy) --}}
    <h2 style="margin:48px 0 24px;font-size:24px;">{{ $en ? 'Individual Photos' : 'Photos Individuelles' }}</h2>
    <div class="gallery-grid" id="gallery-grid">
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/image-8-min-scaled.jpg" data-lightbox-src="/images/gallery/image-8-min-scaled.jpg">
                <img src="/images/gallery/image-8-min-scaled.jpg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/img1.jpeg" data-lightbox-src="/images/gallery/img1.jpeg">
                <img src="/images/gallery/img1.jpeg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/img2.jpeg" data-lightbox-src="/images/gallery/img2.jpeg">
                <img src="/images/gallery/img2.jpeg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/img3.jpeg" data-lightbox-src="/images/gallery/img3.jpeg">
                <img src="/images/gallery/img3.jpeg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/IMG_5184-1.jpg" data-lightbox-src="/images/gallery/IMG_5184-1.jpg">
                <img src="/images/gallery/IMG_5184-1.jpg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/IMG_5187.jpg" data-lightbox-src="/images/gallery/IMG_5187.jpg">
                <img src="/images/gallery/IMG_5187.jpg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/IMG_5188.jpg" data-lightbox-src="/images/gallery/IMG_5188.jpg">
                <img src="/images/gallery/IMG_5188.jpg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/Impact-positif-sur-lenvironnemnet-min-scaled-e1730914496421.webp" data-lightbox-src="/images/gallery/Impact-positif-sur-lenvironnemnet-min-scaled-e1730914496421.webp">
                <img src="/images/gallery/Impact-positif-sur-lenvironnemnet-min-scaled-e1730914496421.webp" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/karma1.jpg" data-lightbox-src="/images/gallery/karma1.jpg">
                <img src="/images/gallery/karma1.jpg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/karma123-min-1.jpg" data-lightbox-src="/images/gallery/karma123-min-1.jpg">
                <img src="/images/gallery/karma123-min-1.jpg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/karma2-min.jpg" data-lightbox-src="/images/gallery/karma2-min.jpg">
                <img src="/images/gallery/karma2-min.jpg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/karmareboi.jpg" data-lightbox-src="/images/gallery/karmareboi.jpg">
                <img src="/images/gallery/karmareboi.jpg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/WhatsApp-Image-2024-07-11-at-04.22.32-2.jpeg" data-lightbox-src="/images/gallery/WhatsApp-Image-2024-07-11-at-04.22.32-2.jpeg">
                <img src="/images/gallery/WhatsApp-Image-2024-07-11-at-04.22.32-2.jpeg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.26.jpeg" data-lightbox-src="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.26.jpeg">
                <img src="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.26.jpeg" alt="Gallery image">
            </a>
        </figure>
        <figure class="gallery-item">
            <a class="gallery-media" href="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.27.jpeg" data-lightbox-src="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.27.jpeg">
                <img src="/images/gallery/WhatsApp-Image-2024-07-12-at-12.51.27.jpeg" alt="Gallery image">
            </a>
        </figure>
    </div>
</section>
