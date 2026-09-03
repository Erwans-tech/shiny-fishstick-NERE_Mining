<?php $__env->startSection('content'); ?>

<section>

    <style>
        .pillar-card {
            background: linear-gradient(180deg, #ffffff 0%, #f9f6f0 100%);
            border: 1px solid rgba(75,23,22,0.1);
            transition: transform 0.3s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.3s, border-color 0.3s;
        }
        .pillar-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 32px rgba(40,29,24,0.08);
            border-color: rgba(255,194,71,0.4);
        }
        .esg-metric { text-align:center; padding:20px; }
        .esg-value { font-size:32px; font-weight:700; color:var(--green); margin-bottom:8px; }
        .esg-label { font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; }
    </style>
    <p class="lead"><?php echo e(__('site.sustain_lead', [], $loc)); ?></p>

    <?php
        $pillarLinks = [
            1 => $en ? route('english.communities')   : route('sustainability.communities'),
            2 => $en ? route('english.environment')   : route('sustainability.environment'),
            3 => $en ? route('english.hse')           : route('sustainability.hse'),
            4 => $en ? route('english.local-content') : route('sustainability.local-content'),
        ];
    ?>

    <div class="grid-2">
        <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($pillarLinks[$i]); ?>" class="card pillar-card sr" style="display:block;">
            <div class="card-tag"><?php echo e(__('site.sustain_pillar'.$i.'_num', [], $loc)); ?></div>
            <h3><?php echo e(__('site.sustain_pillar'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.sustain_pillar'.$i.'_p', [], $loc)); ?></p>
            <span class="btn btn-outline" style="margin-top:16px; display:inline-block;">
                <?php echo e(__('site.sustain_discover', [], $loc)); ?>

            </span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;"><?php echo e($en ? 'ESG Performance' : 'Performance ESG'); ?></h2>
        <p style="text-align:center; color:var(--muted); font-size:15px; margin-bottom:40px; line-height:1.8;"><?php echo e($en ? 'Our commitment to Environmental, Social, and Governance excellence drives sustainable value creation.' : 'Notre engagement pour excellence Environnementale, Sociale et Gouvernance crée de la valeur durable.'); ?></p>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:24px;">
            <div class="esg-metric">
                <div class="esg-value">-32%</div>
                <div class="esg-label"><?php echo e($en ? 'CO₂ Reduction (2020-2024)' : 'Réduction CO₂ (2020-2024)'); ?></div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">-28%</div>
                <div class="esg-label"><?php echo e($en ? 'Water Consumption Reduced' : 'Consommation Eau Réduite'); ?></div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">95%</div>
                <div class="esg-label"><?php echo e($en ? 'Waste Recycled/Reused' : 'Déchets Recyclés/Réutilisés'); ?></div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">80%+</div>
                <div class="esg-label"><?php echo e($en ? 'Local Hiring Rate' : 'Taux Recrutement Local'); ?></div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">100%</div>
                <div class="esg-label"><?php echo e($en ? 'Safety Culture' : 'Culture sécurité'); ?></div>
            </div>
            <div class="esg-metric">
                <div class="esg-value">100%</div>
                <div class="esg-label"><?php echo e($en ? 'Conflict-Free Gold' : 'Or Conflit-Libre'); ?></div>
            </div>
        </div>
    </div>
</section>


<section style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Our Initiatives' : 'Nos Initiatives'); ?></h2>
        <p style="text-align:center; color:var(--muted); font-size:15px; margin-bottom:40px; line-height:1.8;"><?php echo e($en ? 'Strategic programs addressing environmental, social and economic priorities.' : 'Programmes stratégiques adressant priorités environnementales, sociales et économiques.'); ?></p>
        
        <div class="grid-3">
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">🌍 <?php echo e($en ? 'Environmental Stewardship' : 'Intendance Environnementale'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• <?php echo e($en ? 'Land reclamation & biodiversity' : 'Restauration terrain & biodiversité'); ?></li>
                    <li>• <?php echo e($en ? 'Water resource management' : 'Gestion ressources hydriques'); ?></li>
                    <li>• <?php echo e($en ? 'Renewable energy projects' : 'Projets énergies renouvelables'); ?></li>
                    <li>• <?php echo e($en ? 'Emission reduction targets' : 'Objectifs réduction émissions'); ?></li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">👥 <?php echo e($en ? 'Community Development' : 'Développement Communautaire'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• <?php echo e($en ? 'Education & scholarships' : 'Éducation & bourses'); ?></li>
                    <li>• <?php echo e($en ? 'Healthcare services' : 'Services santé'); ?></li>
                    <li>• <?php echo e($en ? 'Infrastructure development' : 'Développement infrastructures'); ?></li>
                    <li>• <?php echo e($en ? 'Local economic empowerment' : 'Autonomisation économique locale'); ?></li>
                </ul>
            </div>
            <div class="card">
                <h3 style="color:var(--green); margin-bottom:12px;">🛡️ <?php echo e($en ? 'Health & Safety Excellence' : 'Excellence Santé & Sécurité'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li>• <?php echo e($en ? 'Zero-harm culture' : 'Culture zéro accident'); ?></li>
                    <li>• <?php echo e($en ? 'Occupational health programs' : 'Programmes santé professionnelle'); ?></li>
                    <li>• <?php echo e($en ? 'Safety training & certification' : 'Formation & certification sécurité'); ?></li>
                    <li>• <?php echo e($en ? 'Incident prevention systems' : 'Systèmes prévention incidents'); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\sustainability.blade.php ENDPATH**/ ?>