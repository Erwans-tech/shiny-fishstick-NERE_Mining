<section>
    <p class="lead"><?php echo e(__('site.gallery_lead')); ?></p>
    
    
    <?php if(isset($albums) && $albums->isNotEmpty()): ?>
        <h2 style="margin-bottom:24px;font-size:24px;"><?php echo e($en ? 'Photo Albums' : 'Albums Photo'); ?></h2>
        <div class="albums-grid" id="albums-grid">
            <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="album-card" data-album-id="<?php echo e($album->id); ?>">
                    <a href="<?php echo e($en ? route('english.gallery.album', $album) : route('gallery.album', $album)); ?>" class="album-link">
                        <div class="album-carousel">
                            <?php
                                $previewImages = $album->preview_images;
                            ?>
                            <?php if($previewImages->isNotEmpty()): ?>
                                <?php $__currentLoopData = $previewImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="album-carousel-slide <?php echo e($index === 0 ? 'active' : ''); ?>">
                                        <img src="<?php echo e($media->url); ?>" alt="<?php echo e($media->title); ?>" loading="lazy">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($previewImages->count() > 1): ?>
                                    <div class="album-carousel-dots">
                                        <?php $__currentLoopData = $previewImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="dot <?php echo e($index === 0 ? 'active' : ''); ?>"></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="album-carousel-slide active">
                                    <div class="album-placeholder">
                                        <span>📷</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="album-info">
                            <h3 class="album-title"><?php echo e($album->title); ?></h3>
                            <?php if($album->description): ?>
                                <p class="album-description"><?php echo e(Str::limit($album->description, 100)); ?></p>
                            <?php endif; ?>
                            <div class="album-meta">
                                <span class="album-count">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <path d="M21 15l-5-5L5 21"/>
                                    </svg>
                                    <?php echo e($album->photo_count); ?> <?php echo e($album->photo_count > 1 ? ($en ? 'photos' : 'photos') : ($en ? 'photo' : 'photo')); ?>

                                </span>
                                <span class="album-view-link"><?php echo e($en ? 'View album' : 'Voir l\'album'); ?> →</span>
                            </div>
                        </div>
                    </a>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    
    <h2 style="margin:48px 0 24px;font-size:24px;"><?php echo e($en ? 'Individual Photos' : 'Photos Individuelles'); ?></h2>
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
<?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/resources/gallery.blade.php ENDPATH**/ ?>