<?php $__env->startSection('content'); ?>


<section>
    <div class="sub-nav">
        <a href="<?php echo e($en ? route('english.sustainability') : route('sustainability')); ?>"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.communities')   : route('sustainability.communities')); ?>"><?php echo e(__('site.subnav_communities', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.environment')   : route('sustainability.environment')); ?>"><?php echo e(__('site.subnav_environment', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.hse')           : route('sustainability.hse')); ?>"><?php echo e(__('site.subnav_hse', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.local-content') : route('sustainability.local-content')); ?>" class="active"><?php echo e(__('site.subnav_local_content', [], $loc)); ?></a>
    </div>

    <h2><?php echo e(__('site.local_policy_h2', [], $loc)); ?></h2>
    <p class="lead"><?php echo e(__('site.local_policy_lead', [], $loc)); ?></p>

    <div class="grid-2">
        
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.local_card1_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.local_recruit_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.local_recruit_p', [], $loc)); ?></p>
        </div>
        
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.local_card2_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.local_purchase_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.local_purchase_p', [], $loc)); ?></p>
        </div>
    </div>

    
    <div class="stat-band" style="margin-top:32px;">
        <div class="stat-item">
            <span class="stat-value">409</span>
            <span class="stat-label"><?php echo e($en ? 'Direct employees' : 'Emplois directs'); ?></span>
        </div>
        <div class="stat-item">
            <span class="stat-value">1 500</span>
            <span class="stat-label"><?php echo e($en ? 'Subcontracted workers' : 'Travailleurs sous-traitants'); ?></span>
        </div>
        <div class="stat-item">
            <span class="stat-value">60%</span>
            <span class="stat-label"><?php echo e($en ? 'Local & regional employment' : 'Emploi local et régional'); ?></span>
        </div>
        <div class="stat-item">
            <span class="stat-value">99%</span>
            <span class="stat-label"><?php echo e($en ? 'Burkinabe workers' : 'Travailleurs burkinabè'); ?></span>
        </div>
    </div>
</section>


<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Local Spending Impact' : 'Impact Dépenses Locales'); ?></h2>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px; margin-bottom:40px;">
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">60%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Local & regional employment' : 'Emploi local et régional'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;"><?php echo e($en ? 'of the workforce' : 'de la main-d’œuvre'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">77 809 850 000</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Local purchases' : 'Achats locaux'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;"><?php echo e($en ? 'CFA' : 'FCFA'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">744 280 000</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'State-owned company payments' : "Paiements aux Entreprises d'État"); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;"><?php echo e($en ? 'CFA' : 'FCFA'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">99%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Burkinabe workers' : 'Travailleurs burkinabè'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;"><?php echo e($en ? 'of the workforce' : 'de la main-d’œuvre'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">1 500</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Subcontracted workers' : 'Travailleurs sous-traitants'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;"><?php echo e($en ? 'supporting operations' : 'en appui aux opérations'); ?></div>
            </div>
        </div>
    </div>
</section>


<section>
    <h2><?php echo e(__('site.local_supplier_h2', [], $loc)); ?></h2>
    <p class="lead"><?php echo e(__('site.local_supplier_lead', [], $loc)); ?></p>

    <div class="grid-3">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.local_supp'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.local_supp'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.local_supp'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:40px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Categories of Local Sourcing' : 'Catégories d\'Approvisionnement Local'); ?></h2>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:24px;">
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">🏗️ <?php echo e($en ? 'Construction & Services' : 'Construction & Services'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• <?php echo e($en ? 'Civil works & excavation' : 'Travaux civils & excavation'); ?></li>
                    <li>• <?php echo e($en ? 'Equipment rental & leasing' : 'Location équipements'); ?></li>
                    <li>• <?php echo e($en ? 'Facility management' : 'Gestion installations'); ?></li>
                    <li>• <?php echo e($en ? 'Security services' : 'Services sécurité'); ?></li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">⚙️ <?php echo e($en ? 'Equipment & Parts' : 'Équipements & Pièces'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• <?php echo e($en ? 'Spare parts & components' : 'Pièces de rechange'); ?></li>
                    <li>• <?php echo e($en ? 'Maintenance & repairs' : 'Maintenance & réparations'); ?></li>
                    <li>• <?php echo e($en ? 'Industrial machinery' : 'Machinerie industrielle'); ?></li>
                    <li>• <?php echo e($en ? 'Fuel & lubricants' : 'Carburants & lubrifiants'); ?></li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">🍽️ <?php echo e($en ? 'Food & Provisions' : 'Alimentation & Provisions'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• <?php echo e($en ? 'Fresh produce & staples' : 'Produits frais & base'); ?></li>
                    <li>• <?php echo e($en ? 'Meat & dairy' : 'Viande & produits laitiers'); ?></li>
                    <li>• <?php echo e($en ? 'Beverages & catering' : 'Boissons & catering'); ?></li>
                    <li>• <?php echo e($en ? 'Restaurant services' : 'Services restaurants'); ?></li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">📚 <?php echo e($en ? 'Professional Services' : 'Services Professionnels'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• <?php echo e($en ? 'Consulting & engineering' : 'Conseil & ingénierie'); ?></li>
                    <li>• <?php echo e($en ? 'Training & HR' : 'Formation & RH'); ?></li>
                    <li>• <?php echo e($en ? 'Legal & accounting' : 'Légal & comptabilité'); ?></li>
                    <li>• <?php echo e($en ? 'Transportation & logistics' : 'Transport & logistique'); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\local-content.blade.php ENDPATH**/ ?>