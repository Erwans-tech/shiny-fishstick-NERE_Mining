<?php $en = isset($en) && $en === true; ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/sustainability-animations.css')); ?>">
<style>
    /* Modern Gallery Styles */
    .gallery-container {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 5vw;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-top: 40px;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        aspect-ratio: 4/3;
        cursor: pointer;
        background: var(--sand);
        box-shadow: 0 8px 24px rgba(40, 29, 24, 0.1);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        group: hover;
    }

    .gallery-item:hover {
        transform: translateY(-12px) scale(1.03);
        box-shadow: 0 20px 48px rgba(40, 29, 24, 0.2);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.08);
    }

    /* Overlay on hover */
    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(75, 23, 22, 0.7), rgba(45, 13, 16, 0.7));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s ease;
        backdrop-filter: blur(4px);
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay-icon {
        font-size: 48px;
        color: var(--gold);
        animation: pulse-zoom 0.6s ease;
    }

    @keyframes pulse-zoom {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Lightbox Modal */
    .lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        z-index: 1000;
        animation: fadeIn 0.3s ease;
    }

    .lightbox.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .lightbox-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        animation: zoomIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.8);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .lightbox-close {
        position: absolute;
        top: 30px;
        right: 40px;
        font-size: 48px;
        color: var(--gold);
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(255, 194, 71, 0.1);
        border: 2px solid var(--gold);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    .lightbox-close:hover {
        background: rgba(255, 194, 71, 0.2);
        transform: rotate(90deg);
    }

    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 48px;
        color: var(--gold);
        cursor: pointer;
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 194, 71, 0.1);
        border: 2px solid var(--gold);
        transition: all 0.3s ease;
    }

    .lightbox-nav:hover {
        background: rgba(255, 194, 71, 0.2);
        transform: translateY(-50%) scale(1.1);
    }

    .lightbox-prev {
        left: 30px;
    }

    .lightbox-next {
        right: 30px;
    }

    .lightbox-counter {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        color: var(--gold);
        font-size: 16px;
        background: rgba(255, 194, 71, 0.1);
        padding: 12px 24px;
        border-radius: 50px;
        border: 1px solid var(--gold);
    }

    /* Gallery Categories */
    .gallery-section {
        margin-bottom: 80px;
    }

    .gallery-section h2 {
        font-size: clamp(24px, 5vw, 42px);
        color: var(--green);
        margin-bottom: 10px;
        font-weight: 700;
    }

    .gallery-divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--gold), var(--gold2));
        border-radius: 2px;
        margin-bottom: 40px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .lightbox-close {
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 32px;
        }

        .lightbox-nav {
            width: 50px;
            height: 50px;
            font-size: 32px;
        }

        .lightbox-prev {
            left: 10px;
        }

        .lightbox-next {
            right: 10px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<section class="gallery-container">
    
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: clamp(32px, 6vw, 56px); color: var(--green); margin-bottom: 16px; font-weight: 700;">
            <?php echo e($en ? 'Media Gallery' : 'Médiathèque'); ?>

        </h1>
        <p style="font-size: 18px; color: var(--muted); max-width: 600px; margin: 0 auto; line-height: 1.6;">
            <?php echo e($en 
                ? 'Explore our collection of high-quality images from operations, events, and community engagement.'
                : 'Découvrez notre collection d\'images de haute qualité issues de nos opérations, événements et engagements communautaires.'); ?>

        </p>
    </div>

    
    <div class="gallery-section sa-reveal">
        <h2><?php echo e($en ? 'Operations & Mining' : 'Opérations & Exploitation'); ?></h2>
        <div class="gallery-divider"></div>
        <div class="gallery-grid" data-gallery="hero">
            <?php
                $heroImages = [
                    'public/uploads/hero/7I0F6l1lmLkgswXMdTDm4ayucFaHUgcMJcnzn0im.jpg',
                    'public/uploads/hero/Aqlk75ywPYBXsQWFa0Z7pRFKAdLsajbcqDPSY3FV.jpg',
                    'public/uploads/hero/FNY4nVuUiKDio6MhyaZfvTBLiDGFQP53tHLKMNR3.jpg',
                    'public/uploads/hero/H7eEolBtJlKwU8I1VCj8iU4g6G0cNthAfc55kopr.jpg',
                    'public/uploads/hero/mdFX47ibl2LUh0b7PJQ7OZ4ONKC3Mnm6m2pFWg7A.jpg',
                    'public/uploads/hero/t2brc4J0xp78HSR95EtBfPZ75xl8oCYwE1EnPF80.jpg',
                    'public/uploads/hero/UCrXfKr1OeYXovqWbAyM48WdKySdWoGQgpc99SGs.jpg',
                ];
            ?>
            <?php $__currentLoopData = $heroImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="gallery-item sa-reveal sa-delay-<?php echo e(($idx % 5) + 1); ?>" data-lightbox="<?php echo e($idx); ?>" style="cursor: pointer;">
                <img src="<?php echo e(asset($image)); ?>" alt="Gallery image <?php echo e($idx + 1); ?>" loading="lazy">
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="gallery-section sa-reveal">
        <h2><?php echo e($en ? 'Media & Events' : 'Média & Événements'); ?></h2>
        <div class="gallery-divider"></div>
        <div class="gallery-grid" data-gallery="media">
            <?php
                $mediaImages = [
                    'public/uploads/media/IH41oOb8InWHUDjwKBQEKsijzwieo3gzSATTvGuK.jpg',
                    'public/uploads/media/jV9YBaiB6lxmIAVMVjwDIUhTUIIVFfeTGNqlyDBT.jpg',
                    'public/uploads/media/sj51N7nxYCGidpKPYeiUXZlKAnyNLbbSgT5rI8l5.jpg',
                    'public/uploads/media/SRnFG9j33f5fYOMNNJULC55nGIWFQ6lwYQUj2eW4.png',
                    'public/uploads/media/t7ZK3S0LTLdtxxZa9F7QBAuyKRrV21suggrPHS2g.jpg',
                    'public/uploads/media/ZnZ8l0qhpBmOUKE8jpJs0JHP9hhBaOAAhBHibiU5.jpg',
                ];
            ?>
            <?php $__currentLoopData = $mediaImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="gallery-item sa-reveal sa-delay-<?php echo e(($idx % 5) + 1); ?>" data-lightbox="media-<?php echo e($idx); ?>" style="cursor: pointer;">
                <img src="<?php echo e(asset($image)); ?>" alt="Media gallery image <?php echo e($idx + 1); ?>" loading="lazy">
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="gallery-section sa-reveal">
        <h2><?php echo e($en ? 'News & Press' : 'Actualités & Presse'); ?></h2>
        <div class="gallery-divider"></div>
        <div class="gallery-grid" data-gallery="news">
            <?php
                $newsImages = [
                    'public/uploads/news/27V1hxnByTwelX9LjOyZipRBylcrDT6lyALvKrfF.jpg',
                    'public/uploads/news/5rAOdVw8Zd25PK1OzwedjBubqskMwkb0mCt22qor.jpg',
                    'public/uploads/news/72IP8rXFnYq0ZUerrs1pQlEP8weEL3jsser8HVEs.jpg',
                    'public/uploads/news/FygENNJr36vgw9vcHOKKRXXjCM3R2t5pFsWppYO8.jpg',
                    'public/uploads/news/G4gObCAU1v2dxNxP8wVzLAELPCL95l2RdxSkxHY7.jpg',
                    'public/uploads/news/gOJSCdIXI2QxxKoi0H6oG2XtS7ESyMrponCYJC8t.jpg',
                    'public/uploads/news/iP2pjuq2Udoxm4l1Ykjf9GQudgvV9HF3RytKCthO.jpg',
                    'public/uploads/news/mvzw1diuPLujJHanS6FiAc8vYYpylTwChiUMv9aH.jpg',
                    'public/uploads/news/NdoDYuSomm4IUuU4jjHNTsFN9RC7wi2OwfpoH4nU.jpg',
                    'public/uploads/news/nqMGQxXF6WivCvIrGEXI5nCQ1iMBv2DDIZky3vpH.jpg',
                    'public/uploads/news/pDTlaknBtZgxngwzxdKOZUyr5LN4sPCnkX3vcaYv.jpg',
                    'public/uploads/news/rDjxevwUmoU4FSfpJbdrtbTSjEJTAVGyoTKEkRkP.jpg',
                ];
            ?>
            <?php $__currentLoopData = $newsImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="gallery-item sa-reveal sa-delay-<?php echo e(($idx % 5) + 1); ?>" data-lightbox="news-<?php echo e($idx); ?>" style="cursor: pointer;">
                <img src="<?php echo e(asset($image)); ?>" alt="News gallery image <?php echo e($idx + 1); ?>" loading="lazy">
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="gallery-section sa-reveal">
        <h2><?php echo e($en ? 'Reports & Documents' : 'Rapports & Documents'); ?></h2>
        <div class="gallery-divider"></div>
        <div class="gallery-grid" data-gallery="reports">
            <?php
                $reportImages = [
                    'public/uploads/reports/covers/1fHJskNQoHzNbUSn0uh0w6gxuEPpEPX7jaDbyd2j.jpg',
                    'public/uploads/reports/covers/Cw9hmeo0KfYU06fIZG8eByVHlsIxgIEMgyo3ZjRV.jpg',
                    'public/uploads/reports/covers/owzNq5duZI6REyI2peT501kd0OJxtTZYK48gd5kw.jpg',
                ];
            ?>
            <?php $__currentLoopData = $reportImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="gallery-item sa-reveal sa-delay-<?php echo e(($idx % 5) + 1); ?>" data-lightbox="reports-<?php echo e($idx); ?>" style="cursor: pointer;">
                <img src="<?php echo e(asset($image)); ?>" alt="Report cover image <?php echo e($idx + 1); ?>" loading="lazy">
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="gallery-section sa-reveal">
        <h2><?php echo e($en ? 'Partnerships' : 'Partenariats'); ?></h2>
        <div class="gallery-divider"></div>
        <div class="gallery-grid" data-gallery="partners">
            <?php
                $partnerImages = [
                    'public/uploads/partners/0tllx8ExuiXu1nE3dTSBmVfIhk2wU1zzvevKR7UO.jpg',
                    'public/uploads/partners/74282_mNU2VlUloslMFVgSdQ7YSeVXr3md965pKR9jY6y5.jpg',
                    'public/uploads/partners/VTXZ8SWJKp2VSO6Hkpntz7zHlbltLDOV1xMaOHU.jpg',
                ];
            ?>
            <?php $__currentLoopData = $partnerImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="gallery-item sa-reveal sa-delay-<?php echo e(($idx % 5) + 1); ?>" data-lightbox="partners-<?php echo e($idx); ?>" style="cursor: pointer;">
                <img src="<?php echo e(asset($image)); ?>" alt="Partner image <?php echo e($idx + 1); ?>" loading="lazy">
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<div class="lightbox" id="lightbox">
    <div class="lightbox-content">
        <img class="lightbox-image" id="lightboxImage" src="" alt="">
        <span class="lightbox-close" id="lightboxClose">&times;</span>
        <span class="lightbox-nav lightbox-prev" id="lightboxPrev">&#8249;</span>
        <span class="lightbox-nav lightbox-next" id="lightboxNext">&#8250;</span>
        <div class="lightbox-counter">
            <span id="lightboxCurrent">1</span> / <span id="lightboxTotal">1</span>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/sustainability-animations.js')); ?>"></script>
<script>
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');
    const lightboxCurrent = document.getElementById('lightboxCurrent');
    const lightboxTotal = document.getElementById('lightboxTotal');

    let currentImageIndex = 0;
    let allImages = [];

    // Collect all gallery images
    document.querySelectorAll('.gallery-item').forEach((item, index) => {
        const img = item.querySelector('img');
        allImages.push(img.src);

        item.addEventListener('click', () => {
            currentImageIndex = index;
            openLightbox();
        });
    });

    function openLightbox() {
        lightboxImage.src = allImages[currentImageIndex];
        lightboxCurrent.textContent = currentImageIndex + 1;
        lightboxTotal.textContent = allImages.length;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % allImages.length;
        openLightbox();
    }

    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + allImages.length) % allImages.length;
        openLightbox();
    }

    lightboxClose.addEventListener('click', closeLightbox);
    lightboxNext.addEventListener('click', nextImage);
    lightboxPrev.addEventListener('click', prevImage);

    // Close on background click
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
        if (e.key === 'Escape') closeLightbox();
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/pages/media-gallery.blade.php ENDPATH**/ ?>