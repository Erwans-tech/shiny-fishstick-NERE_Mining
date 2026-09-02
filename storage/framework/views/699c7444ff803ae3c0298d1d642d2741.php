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
        $bgImages = [
            asset('images/identite/Image1-qwt443rdtdnnrn7bp8ramn12pvfx6i3sw3tfmpqolc.jpg'),
            asset('images/identite/Image2-qwt43i53g6u0aycarvjmokwh0mk24viuvs9he1z8qo.jpg'),
            asset('images/identite/Image3-qwt444p807oy395yjr5x74sjb9bae77j88gx3zpaf4.png')
        ];
    ?>

    <style>
        .identity-card {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            color: #fff;
            border: none;
            border-radius: 18px;
            overflow: hidden;
            min-height: 320px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            transition: transform 0.4s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.4s;
            box-shadow: 0 10px 24px rgba(0,0,0,0.1);
        }
        .identity-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(0,0,0,0.15);
        }
        .identity-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(20, 35, 25, 0.4) 0%, rgba(13, 29, 19, 0.95) 100%);
            z-index: 1;
            transition: opacity 0.3s ease;
        }
        .identity-card:hover::before {
            background: linear-gradient(180deg, rgba(20, 35, 25, 0.5) 0%, rgba(13, 29, 19, 1) 100%);
        }
        .identity-card > * {
            position: relative;
            z-index: 2;
        }
        .identity-card .card-tag {
            background: rgba(255, 194, 71, 0.2);
            color: var(--gold);
            border: 1px solid rgba(255, 194, 71, 0.3);
            align-self: flex-start;
        }
        .identity-card h3 {
            color: #fff;
            margin-top: auto;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }
        .identity-card p {
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 1px 3px rgba(0,0,0,0.5);
        }
    </style>

    <div class="grid-3">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card identity-card" style="background-image: url('<?php echo e($bgImages[$i-1]); ?>');">
            <div class="card-tag"><?php echo e(__('site.company_id'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.company_id'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_id'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sand">
    <h2><?php echo e($en ? 'Certifications & Compliance' : 'Certifications et conformité'); ?></h2>
    <p class="lead"><?php echo e($en
        ? 'Néré Mining maintains international standards and certifications to ensure operational excellence and environmental responsibility.'
        : 'Néré Mining respecte les normes internationales et certifications pour assurer l\'excellence opérationnelle et la responsabilité environnementale.'); ?></p>

    <div class="grid-3" style="margin-top:32px;">
        
        <div class="card" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:200px; text-align:center; background:rgba(255,255,255,.9); border:1px solid rgba(255,194,71,.3);">
            <div style="font-size:3rem; color:var(--gold); margin-bottom:12px; line-height:1;">✓</div>
            <div class="card-tag" style="margin-bottom:12px;"><?php echo e($en ? 'Quality Management' : 'Gestion de la qualité'); ?></div>
            <h3 style="margin:0;">ISO 9001:2008</h3>
            <p style="font-size:13px; margin-top:8px;"><?php echo e($en ? 'International standard for quality management systems' : 'Norme internationale de systèmes de gestion de la qualité'); ?></p>
        </div>

        
        <div class="card" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:200px; text-align:center; background:rgba(255,255,255,.9); border:1px solid rgba(255,194,71,.3);">
            <div style="font-size:3rem; color:var(--gold); margin-bottom:12px; line-height:1;">✓</div>
            <div class="card-tag" style="margin-bottom:12px;"><?php echo e($en ? 'Transparency' : 'Transparence'); ?></div>
            <h3 style="margin:0;"><?php echo e($en ? 'EITI' : 'ITIE'); ?></h3>
            <p style="font-size:13px; margin-top:8px;"><?php echo e($en ? 'Extractive Industries Transparency Initiative member' : 'Membre de l\'Initiative pour la transparence de l\'industrie extractive'); ?></p>
        </div>

        
        <div class="card" style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:200px; text-align:center; background:rgba(255,255,255,.9); border:1px solid rgba(255,194,71,.3);">
            <div style="font-size:3rem; color:var(--gold); margin-bottom:12px; line-height:1;">✓</div>
            <div class="card-tag" style="margin-bottom:12px;"><?php echo e($en ? 'Environmental' : 'Environnement'); ?></div>
            <h3 style="margin:0;"><?php echo e($en ? 'ESG Standards' : 'Normes RSE'); ?></h3>
            <p style="font-size:13px; margin-top:8px;"><?php echo e($en ? 'Environmental, Social & Governance standards compliance' : 'Conformité aux normes environnementales, sociales et de gouvernance'); ?></p>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/pages/company-identity.blade.php ENDPATH**/ ?>