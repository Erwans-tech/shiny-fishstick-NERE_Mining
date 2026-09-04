<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/sustainability-animations.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="sa-animated-section" style="padding-top:40px;">

    <div class="sa-particles-container" data-count="6"></div>

    <div class="sa-section-heading sa-reveal">
        <p class="lead" style="max-width:780px; margin:0 auto 32px;"><?php echo e(__('site.sustain_lead', [], $loc)); ?></p>
    </div>

    <?php
        $pillarLinks = [
            1 => $en ? route('english.communities')   : route('sustainability.communities'),
            2 => $en ? route('english.environment')   : route('sustainability.environment'),
            3 => $en ? route('english.hse')           : route('sustainability.hse'),
            4 => $en ? route('english.local-content') : route('sustainability.local-content'),
        ];
        $pillarIcons = ['🤝', '🌿', '🛡️', '🏭'];
        $pillarColors = [
            'linear-gradient(135deg,rgba(255,194,71,.15),rgba(75,23,22,.08))',
            'linear-gradient(135deg,rgba(45,90,39,.15),rgba(255,194,71,.08))',
            'linear-gradient(135deg,rgba(215,47,47,.12),rgba(75,23,22,.08))',
            'linear-gradient(135deg,rgba(26,58,92,.15),rgba(255,194,71,.08))',
        ];
    ?>

    <div class="grid-2" style="gap:28px;">
        <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($pillarLinks[$i]); ?>" class="sa-pillar-card sa-reveal sa-delay-<?php echo e($i); ?>" style="display:block; text-decoration:none;">
            <div class="sa-pillar-icon" style="background: <?php echo e($pillarColors[$i-1]); ?>; font-size:32px;">
                <?php echo e($pillarIcons[$i-1]); ?>

            </div>
            <div class="card-tag"><?php echo e(__('site.sustain_pillar'.$i.'_num', [], $loc)); ?></div>
            <h3><?php echo e(__('site.sustain_pillar'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.sustain_pillar'.$i.'_p', [], $loc)); ?></p>
            <span class="sa-btn-animated" style="margin-top:20px; display:inline-flex;">
                <span><?php echo e(__('site.sustain_discover', [], $loc)); ?></span>
                <span class="sa-btn-arrow">→</span>
            </span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e($en ? 'ESG Performance' : 'Performance ESG'); ?></h2>
            <div class="sa-divider"></div>
            <p style="color:var(--muted); font-size:15px; line-height:1.8; margin:0;">
                <?php echo e($en ? 'Our commitment to Environmental, Social, and Governance excellence drives sustainable value creation.' : 'Notre engagement pour excellence Environnementale, Sociale et Gouvernance crée de la valeur durable.'); ?>

            </p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(165px,1fr)); gap:20px; margin-top:48px;">

            <?php
                $esgData = [
                    ['count'=>32,'prefix'=>'-','suffix'=>'%','label'=>$en?'CO₂ Reduction (2020-2024)':'Réduction CO₂ (2020-2024)','bar'=>'32%','icon'=>'🌱'],
                    ['count'=>28,'prefix'=>'-','suffix'=>'%','label'=>$en?'Water Consumption Reduced':'Consommation Eau Réduite','bar'=>'28%','icon'=>'💧'],
                    ['count'=>95,'suffix'=>'%','label'=>$en?'Waste Recycled/Reused':'Déchets Recyclés/Réutilisés','bar'=>'95%','icon'=>'♻️'],
                    ['count'=>80,'suffix'=>'%+','label'=>$en?'Local Hiring Rate':'Taux Recrutement Local','bar'=>'80%','icon'=>'👷'],
                    ['count'=>100,'suffix'=>'%','label'=>$en?'Safety Culture':'Culture sécurité','bar'=>'100%','icon'=>'🛡️'],
                    ['count'=>100,'suffix'=>'%','label'=>$en?'Conflict-Free Gold':'Or Conflit-Libre','bar'=>'100%','icon'=>'✨'],
                ];
            ?>

            <?php $__currentLoopData = $esgData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j => $metric): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-metric-card sa-reveal sa-delay-<?php echo e($j+1); ?>">
                <div style="font-size:28px; margin-bottom:10px;"><?php echo e($metric['icon']); ?></div>
                <div class="sa-metric-value esg-value"
                     data-count="<?php echo e($metric['count']); ?>"
                     <?php if(isset($metric['prefix'])): ?> data-prefix="<?php echo e($metric['prefix']); ?>" <?php endif; ?>
                     data-suffix="<?php echo e($metric['suffix'] ?? ''); ?>"
                     data-original="<?php echo e(($metric['prefix']??'').$metric['count'].($metric['suffix']??'')); ?>">
                    <?php echo e(($metric['prefix']??'').$metric['count'].($metric['suffix']??'')); ?>

                </div>
                <div style="font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; margin-top:8px; line-height:1.4;"><?php echo e($metric['label']); ?></div>
                <div class="sa-progress-bar" style="margin-top:14px;">
                    <div class="sa-progress-fill" data-width="<?php echo e($metric['bar']); ?>" style="background:linear-gradient(90deg,var(--gold),var(--gold2));"></div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>


<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e($en ? 'Our Initiatives' : 'Nos Initiatives'); ?></h2>
            <div class="sa-divider"></div>
            <p style="color:var(--muted); font-size:15px; line-height:1.8; margin:0;">
                <?php echo e($en ? 'Strategic programs addressing environmental, social and economic priorities.' : 'Programmes stratégiques adressant priorités environnementales, sociales et économiques.'); ?>

            </p>
        </div>

        <div class="grid-3" style="margin-top:48px;">
            <?php
                $initiatives = [
                    ['icon'=>'🌍','title'=>$en?'Environmental Stewardship':'Intendance Environnementale','items'=>$en?['Land reclamation & biodiversity','Water resource management','Renewable energy projects','Emission reduction targets']:['Restauration terrain & biodiversité','Gestion ressources hydriques','Projets énergies renouvelables','Objectifs réduction émissions']],
                    ['icon'=>'👥','title'=>$en?'Community Development':'Développement Communautaire','items'=>$en?['Education & scholarships','Healthcare services','Infrastructure development','Local economic empowerment']:['Éducation & bourses','Services santé','Développement infrastructures','Autonomisation économique locale']],
                    ['icon'=>'🛡️','title'=>$en?'Health & Safety Excellence':'Excellence Santé & Sécurité','items'=>$en?['Zero-harm culture','Occupational health programs','Safety training & certification','Incident prevention systems']:['Culture zéro accident','Programmes santé professionnelle','Formation & certification sécurité','Systèmes prévention incidents']],
                ];
            ?>
            <?php $__currentLoopData = $initiatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $init): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-program-card sa-reveal sa-delay-<?php echo e($k+1); ?>">
                <div style="font-size:40px; margin-bottom:16px; display:block;"><?php echo e($init['icon']); ?></div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:18px;"><?php echo e($init['title']); ?></h3>
                <ul class="sa-animated-list">
                    <?php $__currentLoopData = $init['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <span class="sa-list-bullet">✓</span>
                        <span style="font-size:14px; color:var(--muted); line-height:1.6;"><?php echo e($item); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/sustainability-animations.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\sustainability.blade.php ENDPATH**/ ?>