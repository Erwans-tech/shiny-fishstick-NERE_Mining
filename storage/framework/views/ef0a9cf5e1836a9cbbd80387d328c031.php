<?php $__env->startSection('content'); ?>
<?php $sustainBase = $en ? route('english.sustainability') : route('sustainability'); ?>


<section>
    <div class="sub-nav">
        <a href="<?php echo e($sustainBase); ?>"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.communities')   : route('sustainability.communities')); ?>" class="active"><?php echo e(__('site.subnav_communities', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.environment')   : route('sustainability.environment')); ?>"><?php echo e(__('site.subnav_environment', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.hse')           : route('sustainability.hse')); ?>"><?php echo e(__('site.subnav_hse', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.local-content') : route('sustainability.local-content')); ?>"><?php echo e(__('site.subnav_local_content', [], $loc)); ?></a>
    </div>

    <p class="lead"><?php echo e(__('site.communities_lead', [], $loc)); ?></p>

    <div class="grid-2">
        <div>
            
            <h3><?php echo e(__('site.communities_policy_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.communities_policy_p', [], $loc)); ?></p>

            
            <h3 style="margin-top:36px;"><?php echo e(__('site.communities_dialogue_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.communities_dialogue_p', [], $loc)); ?></p>
        </div>
        <div>
            
            <h3><?php echo e(__('site.communities_invest_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.communities_invest_p', [], $loc)); ?></p>
            <div class="card" style="background:var(--sand); border:0; margin-top:16px;">
                <h4><?php echo e(__('site.communities_achiev_h4', [], $loc)); ?></h4>
                <p><?php echo e(__('site.communities_achiev_p', [], $loc)); ?></p>
            </div>
        </div>
    </div>
</section>


<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Community Impact 2024' : 'Impact Communautaire 2024'); ?></h2>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px;">
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">850</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Students in Programs' : 'Étudiants en Programmes'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">12</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Healthcare Clinics' : 'Cliniques Santé'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">85%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'of Grievances Resolved' : 'Griefs Résolus'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">42km</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Roads Built/Maintained' : 'Routes Construites/Entretenues'); ?></div>
            </div>
        </div>
    </div>
</section>


<section class="sand">
    <p class="lead"><?php echo e(__('site.communities_fmd_lead', [], $loc)); ?></p>
    <h3 style="margin-bottom:20px;"><?php echo e(__('site.communities_fmd_projects_h3', [], $loc)); ?></h3>
    <div class="grid-3" style="grid-template-columns:repeat(2,1fr);">
        <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.communities_fmd_proj'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.communities_fmd_proj'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.communities_fmd_proj'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:40px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Our Programs' : 'Nos Programmes'); ?></h2>
        
        <div class="grid-3">
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px; font-size:18px;">🎓 <?php echo e($en ? 'Education Initiative' : 'Initiative Éducation'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:10px;">• <?php echo e($en ? '850+ students in scholarship programs' : '850+ étudiants en bourses'); ?></li>
                    <li style="margin-bottom:10px;">• <?php echo e($en ? 'Technical vocational training' : 'Formation technique professionnelle'); ?></li>
                    <li style="margin-bottom:10px;">• <?php echo e($en ? 'Teacher development programs' : 'Programmes développement enseignants'); ?></li>
                    <li>• <?php echo e($en ? 'School infrastructure improvements' : 'Améliorations infrastructures scolaires'); ?></li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px; font-size:18px;">🏥 <?php echo e($en ? 'Healthcare Program' : 'Programme Santé'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:10px;">• <?php echo e($en ? '12 community health clinics' : '12 cliniques santé communautaire'); ?></li>
                    <li style="margin-bottom:10px;">• <?php echo e($en ? 'Free medical consultations' : 'Consultations médicales gratuites'); ?></li>
                    <li style="margin-bottom:10px;">• <?php echo e($en ? 'Maternal & child health focus' : 'Focus santé maternelle & infantile'); ?></li>
                    <li>• <?php echo e($en ? 'Nutritional support programs' : 'Programmes soutien nutritionnel'); ?></li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px; font-size:18px;">🛣️ <?php echo e($en ? 'Infrastructure Development' : 'Développement Infrastructures'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:10px;">• <?php echo e($en ? '42km of roads built/maintained' : '42km routes construites/entretenues'); ?></li>
                    <li style="margin-bottom:10px;">• <?php echo e($en ? 'Water supply systems' : 'Systèmes approvisionnement eau'); ?></li>
                    <li style="margin-bottom:10px;">• <?php echo e($en ? 'Electricity access expansion' : 'Expansion accès électricité'); ?></li>
                    <li>• <?php echo e($en ? 'Market and community centers' : 'Marchés et centres communautaires'); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="sand">
    <p class="lead"><?php echo e(__('site.communities_complaint_lead', [], $loc)); ?></p>
    <div class="grid-3">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.communities_step'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.communities_step'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.communities_step'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sand">
    <p class="lead"><?php echo e(__('site.communities_map_lead', [], $loc)); ?></p>

    <div class="grid-2">
        
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125836.0!2d-2.2!3d13.63!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMine+de+Karma!5e0!3m2!1s<?php echo e($loc); ?>!2sbf!4v1"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="<?php echo e($en ? 'Map of impacted villages' : 'Carte des villages impactés'); ?>">
            </iframe>
        </div>
        
        <div class="card" style="background:#fff; align-self:start;">
            <div class="card-tag"><?php echo e($en ? 'Surrounding villages' : 'Villages riverains'); ?></div>
            <p><?php echo e(__('site.communities_map_note', [], $loc)); ?></p>
            <p style="margin-top:16px; padding-top:16px; border-top:1px solid var(--line); font-size:13px; color:var(--muted);">
                <?php echo e(__('site.communities_map_soon', [], $loc)); ?>

            </p>
        </div>
    </div>
</section>


<section>
    <p class="lead"><?php echo e(__('site.communities_partners_p', [], $loc)); ?></p>
    <h3 style="margin-bottom:20px;"><?php echo e(__('site.communities_partners_types_h3', [], $loc)); ?></h3>
    <div class="grid-3" style="grid-template-columns:repeat(2,1fr);">
        <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.communities_partner'.$i.'_tag', [], $loc)); ?></div>
            <p><?php echo e(__('site.communities_partner'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div style="margin-top:32px; text-align:center;">
        <a class="btn btn-dark"
           href="<?php echo e(($en ? route('english.contact') : route('contact'))); ?>?type=communaute">
            <?php echo e(__('site.contact_us', [], $loc)); ?>

        </a>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/pages/communities.blade.php ENDPATH**/ ?>