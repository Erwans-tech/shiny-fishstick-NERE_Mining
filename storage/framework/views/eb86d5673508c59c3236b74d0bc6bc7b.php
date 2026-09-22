<?php
    // HARDCODED PARTNERS - No database dependency
    $hardcodedPartners = [
        (object) [
            'id' => 1,
            'name' => 'NEEMBA',
            'category' => $en ? 'Institutional Partner' : 'Partenaire Institutionnel',
            'logo_path' => 'images/partners/neemba-logo.jpeg',
            'website_url' => null,
        ],
    ];
    $partners = collect($partners ?? [])->isEmpty() ? collect($hardcodedPartners) : collect($partners);
?>
<section><p class="lead"><?php echo e($en ? 'Our institutional and technical partners contribute to mining development rooted in Burkina Faso priorities.' : 'Nos partenaires institutionnels et techniques contribuent à un développement minier ancré dans les priorités du Burkina Faso.'); ?></p><div class="grid-3"><?php $__empty_1 = true; $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><article class="card"><?php if(isset($partner->logo_path) && $partner->logo_path): ?><img class="card-img" src="<?php echo e(asset($partner->logo_path)); ?>" alt="Logo <?php echo e($partner->name); ?>" loading="lazy" style="object-fit:contain; background:#fff; padding:20px;"><?php endif; ?><div class="card-tag"><?php echo e($partner->category ?? ($en ? 'Partner' : 'Partenaire')); ?></div><h3><?php echo e($partner->name); ?></h3><?php if(isset($partner->website_url) && $partner->website_url): ?><a class="btn btn-gold" href="<?php echo e($partner->website_url); ?>" target="_blank" rel="noopener"><?php echo e($en ? 'Visit website' : 'Voir le site'); ?></a><?php endif; ?></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="lead"><?php echo e($en ? 'Partners will be published shortly.' : 'Les partenaires seront publiés prochainement.'); ?></p><?php endif; ?></div></section><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\resources\partners.blade.php ENDPATH**/ ?>