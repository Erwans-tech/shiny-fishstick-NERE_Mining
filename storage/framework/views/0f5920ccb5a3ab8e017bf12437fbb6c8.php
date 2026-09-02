<?php $__env->startSection('content'); ?>


<section>
    <div class="sub-nav">
        <a href="<?php echo e($en ? route('english.sustainability') : route('sustainability')); ?>"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.communities')   : route('sustainability.communities')); ?>"><?php echo e(__('site.subnav_communities', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.environment')   : route('sustainability.environment')); ?>" class="active"><?php echo e(__('site.subnav_environment', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.hse')           : route('sustainability.hse')); ?>"><?php echo e(__('site.subnav_hse', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.local-content') : route('sustainability.local-content')); ?>"><?php echo e(__('site.subnav_local_content', [], $loc)); ?></a>
    </div>

    <p class="lead"><?php echo e(__('site.env_policy_lead', [], $loc)); ?></p>

    <div class="grid-3">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.env_policy'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.env_policy'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.env_policy'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Environmental Performance' : 'Performance Environnementale'); ?></h2>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px; margin-bottom:40px;">
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">-32%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'CO₂ Emissions Reduced' : 'Émissions CO₂ Réduites'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;">2020-2024</div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">-28%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Water Consumption' : 'Consommation Eau'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;"><?php echo e($en ? 'Reduction efficiency' : 'Amélioration efficacité'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">95%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Waste Recycled' : 'Déchets Recyclés'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;"><?php echo e($en ? 'or reused annually' : 'ou réutilisés annuels'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px;">100%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Conflict-Free Gold' : 'Or Conflit-Libre'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:8px;"><?php echo e($en ? 'Responsible sourcing' : 'Approvisionnement responsable'); ?></div>
            </div>
        </div>
    </div>
</section>


<section>
    <p class="lead"><?php echo e(__('site.env_mitigation_lead', [], $loc)); ?></p>

    <div class="grid-3">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.env_mitigation'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.env_mitigation'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.env_mitigation'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <p class="lead"><?php echo e(__('site.env_water_lead', [], $loc)); ?></p>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start;">
            <div>
                <h3 style="color:var(--green); margin-bottom:20px; font-size:20px; font-weight:600;"><?php echo e($en ? 'Water Management' : 'Gestion de l\'Eau'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:12px;">• <?php echo e($en ? 'Rainwater harvesting & storage systems' : 'Systèmes récupération eau pluie'); ?></li>
                    <li style="margin-bottom:12px;">• <?php echo e($en ? 'Wastewater treatment & recycling' : 'Traitement & recyclage eaux usées'); ?></li>
                    <li style="margin-bottom:12px;">• <?php echo e($en ? 'Groundwater monitoring programs' : 'Programmes suivi eau souterraine'); ?></li>
                    <li style="margin-bottom:12px;">• <?php echo e($en ? 'Community water access initiatives' : 'Initiatives accès eau communautaire'); ?></li>
                    <li>• <?php echo e($en ? 'Biodiversity & wetland protection' : 'Protection biodiversité & zones humides'); ?></li>
                </ul>
            </div>
            <div>
                <h3 style="color:var(--green); margin-bottom:20px; font-size:20px; font-weight:600;"><?php echo e($en ? 'Waste & Emissions' : 'Déchets & Émissions'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:12px;">• <?php echo e($en ? 'Tailings management & disposal' : 'Gestion & disposition des rejets'); ?></li>
                    <li style="margin-bottom:12px;">• <?php echo e($en ? 'Hazardous waste segregation & treatment' : 'Séparation & traitement déchets dangereux'); ?></li>
                    <li style="margin-bottom:12px;">• <?php echo e($en ? 'Greenhouse gas reduction targets' : 'Objectifs réduction gaz serre'); ?></li>
                    <li style="margin-bottom:12px;">• <?php echo e($en ? 'Renewable energy transition (solar pilot)' : 'Transition énergies renouvelables (pilot solaire)'); ?></li>
                    <li>• <?php echo e($en ? 'Air quality monitoring & dust control' : 'Suivi qualité air & contrôle poussières'); ?></li>
                </ul>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:24px; margin-top:40px;">
            <div class="card">
                <div class="card-tag"><?php echo e($en ? 'Land Rehabilitation' : 'Réhabilitation Terrains'); ?></div>
                <h3><?php echo e($en ? 'Post-Mining Land Use' : 'Utilisation Terre Post-Minière'); ?></h3>
                <p><?php echo e($en ? 'Closure plans include reforestation, agricultural use restoration, and creation of wildlife habitats compatible with community needs.' : 'Plans de fermeture incluent reboisement, restauration usage agricole, création habitats faune compatible besoins communautaires.'); ?></p>
            </div>
            <div class="card">
                <div class="card-tag"><?php echo e($en ? 'Biodiversity' : 'Biodiversité'); ?></div>
                <h3><?php echo e($en ? 'Flora & Fauna Protection' : 'Protection Flore & Faune'); ?></h3>
                <p><?php echo e($en ? 'Regular biodiversity surveys, protected species monitoring, and habitat corridors maintained throughout operations and closure phases.' : 'Surveys biodiversité réguliers, suivi espèces protégées, corridors habitat maintenus opérations & fermeture.'); ?></p>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\environment.blade.php ENDPATH**/ ?>