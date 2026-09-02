<?php $__env->startSection('content'); ?>
<?php $companyBase = $en ? route('english.company') : route('company'); ?>

<style>
    .company-overview-grid .card {
        background-image: radial-gradient(circle at top right, rgba(255,194,71,0.05), transparent 60%);
    }
    .company-value-icon { font-size:36px; margin-bottom:12px; display:block; }
</style>

<section>
    <div class="sub-nav">
        <a href="<?php echo e($companyBase); ?>" class="active"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.ceo')        : route('company.ceo')); ?>"><?php echo e(__('site.subnav_company_ceo', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.identity')   : route('company.identity')); ?>"><?php echo e(__('site.subnav_company_identity', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.history')    : route('company.history')); ?>"><?php echo e(__('site.subnav_company_history', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.values')     : route('company.values')); ?>"><?php echo e(__('site.subnav_company_values', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>"><?php echo e(__('site.subnav_company_governance', [], $loc)); ?></a>
    </div>

    <p class="lead"><?php echo e(__('site.company_identity_lead', [], $loc)); ?></p>

    <div class="company-overview-grid">
        <a href="<?php echo e($en ? route('english.company.ceo') : route('company.ceo')); ?>" class="card" style="display:block;">
            <div class="card-tag">01</div>
            <h3><?php echo e(__('site.subnav_company_ceo', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_pdg_quote', [], $loc)); ?></p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;"><?php echo e(__('site.discover', [], $loc)); ?></span>
        </a>
        <a href="<?php echo e($en ? route('english.company.identity') : route('company.identity')); ?>" class="card" style="display:block;">
            <div class="card-tag">02</div>
            <h3><?php echo e(__('site.subnav_company_identity', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_identity_lead', [], $loc)); ?></p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;"><?php echo e(__('site.discover', [], $loc)); ?></span>
        </a>
        <a href="<?php echo e($en ? route('english.company.history') : route('company.history')); ?>" class="card" style="display:block;">
            <div class="card-tag">03</div>
            <h3><?php echo e(__('site.subnav_company_history', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_history_lead', [], $loc)); ?></p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;"><?php echo e(__('site.discover', [], $loc)); ?></span>
        </a>
        <a href="<?php echo e($en ? route('english.company.values') : route('company.values')); ?>" class="card" style="display:block;">
            <div class="card-tag">04</div>
            <h3><?php echo e(__('site.subnav_company_values', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_vision_lead', [], $loc)); ?></p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;"><?php echo e(__('site.discover', [], $loc)); ?></span>
        </a>
        <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>" class="card">
            <div class="card-tag">05</div>
            <h3><?php echo e(__('site.subnav_company_governance', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_gov_lead', [], $loc)); ?></p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;"><?php echo e(__('site.discover', [], $loc)); ?></span>
        </a>
    </div>
</section>


<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:32px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Our Mission & Vision' : 'Notre Mission & Vision'); ?></h2>
        
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center; margin-bottom:40px;">
            <div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px; font-weight:600;"><?php echo e($en ? 'Mission' : 'Mission'); ?></h3>
                <p style="color:var(--muted); font-size:15px; line-height:1.8;"><?php echo e($en ? 'To extract gold responsibly while creating lasting value for our shareholders, employees, and the communities where we operate. We commit to the highest standards of safety, environmental stewardship, and social responsibility.' : 'Extraire l\'or de manière responsable tout en créant de la valeur durable pour nos actionnaires, employés et les communautés où nous opérons. Nous nous engageons aux plus hauts standards de sécurité, intendance environnementale et responsabilité sociale.'); ?></p>
            </div>
            <div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px; font-weight:600;"><?php echo e($en ? 'Vision' : 'Vision'); ?></h3>
                <p style="color:var(--muted); font-size:15px; line-height:1.8;"><?php echo e($en ? 'To be the leading responsible mining company in Burkina Faso, recognized for operational excellence, environmental excellence, and meaningful contributions to local economic development.' : 'Être la principale entreprise minière responsable au Burkina Faso, reconnue pour excellence opérationnelle, excellence environnementale et contributions significatives au développement économique local.'); ?></p>
            </div>
        </div>
    </div>
</section>


<section style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Our Core Values' : 'Nos Valeurs Fondamentales'); ?></h3>
        <p style="text-align:center; color:var(--muted); font-size:15px; line-height:1.8; max-width:600px; margin:0 auto 40px;"><?php echo e($en ? 'These values guide every decision and action at Néré Mining' : 'Ces valeurs guident chaque décision et action chez Néré Mining'); ?></p>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:24px;">
            <div style="background:#fff; padding:28px; border-radius:8px; border:1px solid var(--line); text-align:center;">
                <div class="company-value-icon">🤝</div>
                <h4 style="color:var(--green); margin:0 0 8px 0; font-size:16px; font-weight:600;"><?php echo e($en ? 'Teamwork' : 'Travail d\'Équipe'); ?></h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;"><?php echo e($en ? 'Collaboration and mutual respect in all we do' : 'Collaboration et respect mutuel dans tout ce que nous faisons'); ?></p>
            </div>
            <div style="background:#fff; padding:28px; border-radius:8px; border:1px solid var(--line); text-align:center;">
                <div class="company-value-icon">🎯</div>
                <h4 style="color:var(--green); margin:0 0 8px 0; font-size:16px; font-weight:600;"><?php echo e($en ? 'Results-Oriented' : 'Orienté Résultats'); ?></h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;"><?php echo e($en ? 'Commitment to excellence and shared goals' : 'Engagement pour excellence et objectifs partagés'); ?></p>
            </div>
            <div style="background:#fff; padding:28px; border-radius:8px; border:1px solid var(--line); text-align:center;">
                <div class="company-value-icon">⚖️</div>
                <h4 style="color:var(--green); margin:0 0 8px 0; font-size:16px; font-weight:600;"><?php echo e($en ? 'Integrity' : 'Intégrité'); ?></h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;"><?php echo e($en ? 'Clear standards and ethical conduct always' : 'Standards clairs et conduite éthique toujours'); ?></p>
            </div>
            <div style="background:#fff; padding:28px; border-radius:8px; border:1px solid var(--line); text-align:center;">
                <div class="company-value-icon">🛡️</div>
                <h4 style="color:var(--green); margin:0 0 8px 0; font-size:16px; font-weight:600;"><?php echo e($en ? 'Safety First' : 'Sécurité Avant Tout'); ?></h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;"><?php echo e($en ? 'Zero tolerance for unsafe practices' : 'Tolérance zéro pour pratiques dangereuses'); ?></p>
            </div>
            <div style="background:#fff; padding:28px; border-radius:8px; border:1px solid var(--line); text-align:center;">
                <div class="company-value-icon">🌍</div>
                <h4 style="color:var(--green); margin:0 0 8px 0; font-size:16px; font-weight:600;"><?php echo e($en ? 'Community Respect' : 'Respect Communautaire'); ?></h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;"><?php echo e($en ? 'Commitment to local development and inclusion' : 'Engagement pour développement local et inclusion'); ?></p>
            </div>
            <div style="background:#fff; padding:28px; border-radius:8px; border:1px solid var(--line); text-align:center;">
                <div class="company-value-icon">🌱</div>
                <h4 style="color:var(--green); margin:0 0 8px 0; font-size:16px; font-weight:600;"><?php echo e($en ? 'Sustainability' : 'Durabilité'); ?></h4>
                <p style="color:var(--muted); font-size:13px; margin:0; line-height:1.6;"><?php echo e($en ? 'Environmental responsibility in operations' : 'Responsabilité environnementale dans opérations'); ?></p>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company.blade.php ENDPATH**/ ?>