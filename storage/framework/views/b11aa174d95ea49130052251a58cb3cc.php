<?php $__env->startSection('content'); ?>
<?php $companyBase = $en ? route('english.company') : route('company'); ?>

<style>
    .company-overview-grid .card {
        background-image: radial-gradient(circle at top right, rgba(255,194,71,0.05), transparent 60%);
    }
    .company-value-icon { font-size:36px; margin-bottom:12px; display:block; }
</style>

<section class="sa-animated-section">
    <div class="sa-particles-container" data-count="6"></div>

    <div class="sa-section-heading sa-reveal" style="margin-bottom:32px;">
        <h2 style="text-align:left;"><?php echo e(__('site.nav_company', [], $loc)); ?></h2>
        <div class="sa-divider" style="margin: 0;"></div>
    </div>

    <p class="lead sa-reveal sa-delay-1"><?php echo e(__('site.company_identity_lead', [], $loc)); ?></p>

    <div class="grid-3" style="margin-top:32px;">
        <a href="<?php echo e($en ? route('english.company.ceo') : route('company.ceo')); ?>" class="sa-program-card sa-reveal sa-delay-1" style="display:block; text-decoration:none;">
            <div class="card-tag">01</div>
            <h3><?php echo e(__('site.subnav_company_ceo', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_pdg_quote', [], $loc)); ?></p>
            <span class="sa-btn-animated" style="margin-top:16px; display:inline-flex;">
                <span><?php echo e(__('site.discover', [], $loc)); ?></span>
                <span class="sa-btn-arrow">→</span>
            </span>
        </a>
        <a href="<?php echo e($en ? route('english.company.identity') : route('company.identity')); ?>" class="sa-program-card sa-reveal sa-delay-2" style="display:block; text-decoration:none;">
            <div class="card-tag">02</div>
            <h3><?php echo e(__('site.subnav_company_identity', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_identity_lead', [], $loc)); ?></p>
            <span class="sa-btn-animated" style="margin-top:16px; display:inline-flex;">
                <span><?php echo e(__('site.discover', [], $loc)); ?></span>
                <span class="sa-btn-arrow">→</span>
            </span>
        </a>
        <a href="<?php echo e($en ? route('english.company.history') : route('company.history')); ?>" class="sa-program-card sa-reveal sa-delay-3" style="display:block; text-decoration:none;">
            <div class="card-tag">03</div>
            <h3><?php echo e(__('site.subnav_company_history', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_history_lead', [], $loc)); ?></p>
            <span class="sa-btn-animated" style="margin-top:16px; display:inline-flex;">
                <span><?php echo e(__('site.discover', [], $loc)); ?></span>
                <span class="sa-btn-arrow">→</span>
            </span>
        </a>
        <a href="<?php echo e($en ? route('english.company.values') : route('company.values')); ?>" class="sa-program-card sa-reveal sa-delay-1" style="display:block; text-decoration:none;">
            <div class="card-tag">04</div>
            <h3><?php echo e(__('site.subnav_company_values', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_vision_lead', [], $loc)); ?></p>
            <span class="sa-btn-animated" style="margin-top:16px; display:inline-flex;">
                <span><?php echo e(__('site.discover', [], $loc)); ?></span>
                <span class="sa-btn-arrow">→</span>
            </span>
        </a>
        <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>" class="sa-program-card sa-reveal sa-delay-2" style="display:block; text-decoration:none;">
            <div class="card-tag">05</div>
            <h3><?php echo e(__('site.subnav_company_governance', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_gov_lead', [], $loc)); ?></p>
            <span class="sa-btn-animated" style="margin-top:16px; display:inline-flex;">
                <span><?php echo e(__('site.discover', [], $loc)); ?></span>
                <span class="sa-btn-arrow">→</span>
            </span>
        </a>
    </div>
</section>


<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e($en ? 'Our Mission & Vision' : 'Notre Mission & Vision'); ?></h2>
            <div class="sa-divider"></div>
        </div>
        
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center; margin-top:40px;">
            <div class="sa-step-card sa-reveal sa-delay-1" data-step="1">
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px; font-weight:600;"><?php echo e($en ? 'Mission' : 'Mission'); ?></h3>
                <p style="color:var(--muted); font-size:15px; line-height:1.8;"><?php echo e($en ? 'To extract gold responsibly while creating lasting value for our shareholders, employees, and the communities where we operate. We commit to the highest standards of safety, environmental stewardship, and social responsibility.' : 'Extraire l\'or de manière responsable tout en créant de la valeur durable pour nos actionnaires, employés et les communautés où nous opérons. Nous nous engageons aux plus hauts standards de sécurité, intendance environnementale et responsabilité sociale.'); ?></p>
            </div>
            <div class="sa-step-card sa-reveal sa-delay-2" data-step="2">
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px; font-weight:600;"><?php echo e($en ? 'Vision' : 'Vision'); ?></h3>
                <p style="color:var(--muted); font-size:15px; line-height:1.8;"><?php echo e($en ? 'To be the leading responsible mining company in Burkina Faso, recognized for operational excellence, environmental excellence, and meaningful contributions to local economic development.' : 'Être la principale entreprise minière responsable au Burkina Faso, reconnue pour excellence opérationnelle, excellence environnementale et contributions significatives au développement économique local.'); ?></p>
            </div>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>


<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e($en ? 'Our Core Values' : 'Nos Valeurs Fondamentales'); ?></h2>
            <div class="sa-divider"></div>
            <p style="color:var(--muted); font-size:15px; line-height:1.8; margin:0;">
                <?php echo e($en ? 'These values guide every decision and action at Néré Mining' : 'Ces valeurs guident chaque décision et action chez Néré Mining'); ?>

            </p>
        </div>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:24px; margin-top:48px;">
            <?php
                $values = [
                    ['icon'=>'🤝','title'=>$en?'Teamwork':'Travail d\'Équipe','desc'=>$en?'Collaboration and mutual respect in all we do':'Collaboration et respect mutuel dans tout ce que nous faisons'],
                    ['icon'=>'🎯','title'=>$en?'Results-Oriented':'Orienté Résultats','desc'=>$en?'Commitment to excellence and shared goals':'Engagement pour excellence et objectifs partagés'],
                    ['icon'=>'⚖️','title'=>$en?'Integrity':'Intégrité','desc'=>$en?'Clear standards and ethical conduct always':'Standards clairs et conduite éthique toujours'],
                    ['icon'=>'🛡️','title'=>$en?'Safety First':'Sécurité Avant Tout','desc'=>$en?'Zero tolerance for unsafe practices':'Tolérance zéro pour pratiques dangereuses'],
                    ['icon'=>'🌍','title'=>$en?'Community Respect':'Respect Communautaire','desc'=>$en?'Commitment to local development and inclusion':'Engagement pour développement local et inclusion'],
                    ['icon'=>'🌱','title'=>$en?'Sustainability':'Durabilité','desc'=>$en?'Environmental responsibility in operations':'Responsabilité environnementale dans opérations'],
                ];
            ?>
            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-partner-card sa-reveal sa-delay-<?php echo e($k+1); ?>" style="text-align:center;">
                <div class="company-value-icon"><?php echo e($val['icon']); ?></div>
                <h4 style="color:var(--green); margin:0 0 8px 0; font-size:16px; font-weight:600;"><?php echo e($val['title']); ?></h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;"><?php echo e($val['desc']); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company.blade.php ENDPATH**/ ?>