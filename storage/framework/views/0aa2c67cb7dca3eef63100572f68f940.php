


<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/sustainability-animations.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="sa-animated-section" style="padding-top:40px;">
    <div class="sa-particles-container" data-count="6"></div>

    <p class="lead sa-reveal"><?php echo e(__('site.env_policy_lead', [], $loc)); ?></p>

    <div class="grid-3" style="margin-top:24px;">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="sa-program-card sa-reveal sa-delay-<?php echo e($i); ?>">
            <div class="card-tag"><?php echo e(__('site.env_policy'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.env_policy'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.env_policy'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sa-sand-animated environment-commitment" style="padding:70px 5vw; position:relative;">
    <div style="max-width:980px; margin:0 auto; position:relative; z-index:1;">
        <div class="sa-section-heading sa-reveal">
            
            <div class="sa-divider"></div>
        </div>

        <div class="environment-commitment__body sa-reveal sa-delay-1">
            <p>Riverstone Karma est engagée dans une démarche de développement durable fondée sur une gestion responsable de l’environnement et une exploitation maîtrisée des ressources minérales. Notre approche repose sur le principe d’une gestion environnementale « sans préjudice » et sur la mise en place de systèmes permettant d’identifier, de surveiller et de maîtriser les aspects et impacts environnementaux de nos activités. Nous nous engageons à respecter les lois et réglementations nationales ainsi que les standards internationaux applicables au secteur minier, notamment les normes environnementales, de santé et de sécurité de la Société financière internationale (SFI) et de la Banque mondiale, ainsi que le Code international de gestion du cyanure.</p>

            <p>Notre engagement se traduit par une amélioration continue de notre performance environnementale, notamment à travers la maîtrise de notre empreinte écologique, l’amélioration de l’efficacité énergétique, la gestion responsable de l’eau et la prise en compte des enjeux liés au changement climatique et aux émissions de gaz à effet de serre. Nous renforçons également les compétences de nos employés et sous-traitants afin de leur permettre d’exercer leurs responsabilités conformément aux exigences environnementales et aux bonnes pratiques de l’industrie.</p>

            <p>La transparence, la concertation et la responsabilité constituent des principes essentiels de notre démarche. Riverstone Karma travaille avec les représentants des communautés locales afin de les sensibiliser aux enjeux environnementaux liés à ses activités et s’engage à consulter les parties prenantes concernées. Des audits permettent régulièrement d’évaluer l’efficacité de nos systèmes de gestion environnementale et d’en communiquer les résultats. Nous veillons également à disposer des ressources nécessaires à la réhabilitation des sites et à la fermeture des opérations conformément à nos obligations.</p>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>


<section class="sa-animated-section" style="padding:70px 5vw;">
    <p class="lead sa-reveal"><?php echo e(__('site.env_mitigation_lead', [], $loc)); ?></p>
    <div class="grid-3" style="margin-top:24px;">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="sa-program-card sa-reveal sa-delay-<?php echo e($i); ?>">
            <div class="card-tag"><?php echo e(__('site.env_mitigation'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.env_mitigation'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.env_mitigation'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">

        <p class="lead sa-reveal"><?php echo e(__('site.env_water_lead', [], $loc)); ?></p>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start; margin-top:32px;">
            <div class="sa-program-card sa-reveal sa-delay-1">
                <div style="font-size:32px; margin-bottom:14px;">💧</div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px;"><?php echo e($en ? 'Water Management' : 'Gestion de l\'Eau'); ?></h3>
                <ul class="sa-animated-list">
                    <?php $__currentLoopData = [
                        $en?'Rainwater harvesting & storage systems':'Systèmes récupération eau pluie',
                        $en?'Wastewater treatment & recycling':'Traitement & recyclage eaux usées',
                        $en?'Groundwater monitoring programs':'Programmes suivi eau souterraine',
                        $en?'Community water access initiatives':'Initiatives accès eau communautaire',
                        $en?'Biodiversity & wetland protection':'Protection biodiversité & zones humides',
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <span class="sa-list-bullet" style="font-size:11px;">•</span>
                        <span style="font-size:14px; color:var(--muted); line-height:1.6;"><?php echo e($item); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div class="sa-program-card sa-reveal sa-delay-2">
                <div style="font-size:32px; margin-bottom:14px;">🏭</div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px;"><?php echo e($en ? 'Waste & Emissions' : 'Déchets & Émissions'); ?></h3>
                <ul class="sa-animated-list">
                    <?php $__currentLoopData = [
                        $en?'Tailings management & disposal':'Gestion & disposition des rejets',
                        $en?'Hazardous waste segregation & treatment':'Séparation & traitement déchets dangereux',
                        $en?'Greenhouse gas reduction targets':'Objectifs réduction gaz serre',
                        $en?'Renewable energy transition (solar pilot)':'Transition énergies renouvelables (pilot solaire)',
                        $en?'Air quality monitoring & dust control':'Suivi qualité air & contrôle poussières',
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <span class="sa-list-bullet" style="font-size:11px;">•</span>
                        <span style="font-size:14px; color:var(--muted); line-height:1.6;"><?php echo e($item); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>

        
        <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:24px; margin-top:40px;">
            <div class="sa-achievement-card sa-reveal sa-delay-1">
                <div class="sa-category-icon">🌱</div>
                <div class="card-tag"><?php echo e($en ? 'Land Rehabilitation' : 'Réhabilitation Terrains'); ?></div>
                <h3 style="color:var(--green); margin-bottom:10px;"><?php echo e($en ? 'Post-Mining Land Use' : 'Utilisation Terre Post-Minière'); ?></h3>
                <p style="font-size:14px; margin:0;">
                    <?php echo e($en ? 'Closure plans include reforestation, agricultural use restoration, and creation of wildlife habitats compatible with community needs.' : 'Plans de fermeture incluent reboisement, restauration usage agricole, création habitats faune compatible besoins communautaires.'); ?>

                </p>
            </div>
            <div class="sa-achievement-card sa-reveal sa-delay-2">
                <div class="sa-category-icon">🦋</div>
                <div class="card-tag"><?php echo e($en ? 'Biodiversity' : 'Biodiversité'); ?></div>
                <h3 style="color:var(--green); margin-bottom:10px;"><?php echo e($en ? 'Flora & Fauna Protection' : 'Protection Flore & Faune'); ?></h3>
                <p style="font-size:14px; margin:0;">
                    <?php echo e($en ? 'Regular biodiversity surveys, protected species monitoring, and habitat corridors maintained throughout operations and closure phases.' : 'Surveys biodiversité réguliers, suivi espèces protégées, corridors habitat maintenus opérations & fermeture.'); ?>

                </p>
            </div>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/sustainability-animations.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/pages/environment.blade.php ENDPATH**/ ?>