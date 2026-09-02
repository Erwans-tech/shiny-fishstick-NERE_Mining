<?php $__env->startSection('content'); ?>
<?php $companyBase = $en ? route('english.company') : route('company'); ?>

<section>
    <div class="sub-nav">
        <a href="<?php echo e($companyBase); ?>"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.ceo')        : route('company.ceo')); ?>"><?php echo e(__('site.subnav_company_ceo', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.identity')   : route('company.identity')); ?>" class="active"><?php echo e(__('site.subnav_company_identity', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.history')    : route('company.history')); ?>"><?php echo e(__('site.subnav_company_history', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.values')     : route('company.values')); ?>"><?php echo e(__('site.subnav_company_values', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>"><?php echo e(__('site.subnav_company_governance', [], $loc)); ?></a>
    </div>

    <p class="lead"><?php echo e(__('site.company_identity_lead', [], $loc)); ?></p>

    <?php
        $identityImages = [
            asset('images/identite/Image1-qwt443rdtdnnrn7bp8ramn12pvfx6i3sw3tfmpqolc.jpg'),
            asset('images/identite/Image2-qwt43i53g6u0aycarvjmokwh0mk24viuvs9he1z8qo.jpg'),
            asset('images/identite/Image3-qwt444p807oy395yjr5x74sjb9bae77j88gx3zpaf4.png')
        ];
    ?>

    <style>
        .identity-gallery { margin: 36px 0 56px; }
        .identity-gallery figure { margin: 0; aspect-ratio: 16 / 10; overflow: hidden; border-radius: 18px; background: var(--ink); box-shadow: 0 10px 24px rgba(0,0,0,.12); }
        .identity-gallery img { display: block; width: 100%; height: 100%; object-fit: cover; transition: transform .5s cubic-bezier(.2,1,.36,1); }
        .identity-gallery figure:hover img { transform: scale(1.04); }
        .identity-description { max-width: 920px; margin: 0 auto 56px; padding: 34px clamp(22px, 4vw, 48px); border-left: 4px solid var(--gold); background: rgba(255,244,220,.7); }
        .identity-description h2 { margin-bottom: 22px; color: var(--green); }
        .identity-description p + p { margin-top: 16px; }
        .identity-card { min-height: 0; display: flex; flex-direction: column; justify-content: flex-start; border-top: 3px solid var(--gold); transition: transform .3s cubic-bezier(.2,1,.36,1), box-shadow .3s; }
        .identity-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(0,0,0,0.15);
        }
        .identity-card .card-tag {
            background: rgba(255, 194, 71, 0.18);
            color: var(--green);
            border: 1px solid rgba(75, 23, 22, 0.15);
            align-self: flex-start;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .identity-card h3 {
            color: var(--green);
            margin-top: 22px;
            margin-bottom: 12px;
            font-size: 22px;
            font-weight: 600;
            line-height: 1.3;
        }
        .identity-card p {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.5;
        }

    </style>

    <div class="grid-3 identity-gallery" aria-label="Images de l’identité de Néré Mining">
        <?php $__currentLoopData = $identityImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <figure>
                <img src="<?php echo e($image); ?>" alt="<?php echo e($en ? 'Néré Mining identity image' : 'Image illustrant l’identité de Néré Mining'); ?>" loading="lazy">
            </figure>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="identity-description">
        <h2>Le sens des symboles : Racines, présent et avenir au Burkina Faso</h2>
        <p>Le nom « Néré » porte en lui plusieurs résonances, à la fois culturelle, écologique et humaine, profondément ancrées dans l’identité du Burkina Faso.</p>
        <p>En premier lieu, le Néré (<em>Parkia biglobosa</em>) est un arbre providentiel et polyvalent. Dans les traditions sahéliennes, chaque composante de cet arbre est valorisée pour l’alimentation humaine, animale ou l’artisanat. Au-delà de ses vertus nutritives, le Néré est un pilier écologique : il enrichit durablement les sols grâce à la fixation de l’azote et déploie un système racinaire puissant qui combat efficacement l’érosion. Véritable moteur des économies rurales, il incarne la durabilité et l’inclusion au cœur des systèmes agroforestiers.</p>
        <p>C’est cette richesse et cette résilience qui ont inspiré l’identité visuelle de notre société. Le logo de Néré Mining puise sa force dans la fleur stylisée du Néré. Son cercle central d’un jaune éclatant symbolise la mine d’or, protégée et nourrie par son environnement.</p>
        <p>Enfin, par une heureuse harmonie linguistique, « Néré » signifie également « belle » en mooré, la principale langue parlée au Burkina Faso.</p>
        <p>À travers ce nom et ce symbole, Néré Mining réaffirme sa vision : celle d’une entreprise minière souveraine, aux racines profondes, génératrice de valeur partagée pour les communautés et bâtisseuse d’un avenir radieux pour le Burkina Faso.</p>
    </div>

    <div class="grid-3">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card identity-card">
            <div class="card-tag"><?php echo e(__('site.company_id'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.company_id'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_id'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company-identity.blade.php ENDPATH**/ ?>