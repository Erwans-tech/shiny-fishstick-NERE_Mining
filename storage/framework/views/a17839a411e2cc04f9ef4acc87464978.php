<?php $__env->startSection('content'); ?>

<style>
    .karma-page h2,
    .karma-page h3,
    .karma-page h4 { text-align: center; }
    .karma-page > section > .lead,
    .karma-page .card p { text-align: justify; }

    .karma-page > section > .lead {
        width: 100%;
        max-width: none;
        font-size: clamp(16px, 1.35vw, 19px);
        line-height: 1.65;
    }

    @media (max-width: 600px) {
        .karma-page > section > .lead {
            width: 100%;
            text-align: left;
            line-height: 1.55;
        }
    }

    /* Premium touches */
    .karma-production-card { border-left: 4px solid var(--gold); }
    .karma-production-card .card-img { object-position: center; }
    .karma-production-card--open-pit .card-img { object-position: 52% center; }
    .karma-production-card--processing .card-img { object-position: center 58%; }
    .karma-production-card--team .card-img { object-position: center 32%; }
    .karma-step-connector { display: flex; align-items: center; justify-content: center; }
</style>

<div class="karma-page">

<section id="presentation" class="sa-animated-section" style="padding-top:40px;">
    <div class="sa-particles-container" data-count="5"></div>

    <div class="sa-section-heading sa-reveal" style="text-align:left; max-width:none; margin-bottom:24px;">
        <h2 style="text-align:left;"><?php echo e(__('site.karma_pres_h2', [], $loc)); ?></h2>
        <div class="sa-divider" style="margin: 0;"></div>
    </div>
    
    <p class="lead sa-reveal sa-delay-1"><?php echo e(__('site.karma_pres_lead', [], $loc)); ?></p>

    <div class="grid-2" style="margin-bottom:40px; margin-top:32px;">
        <div>
            <div class="sa-program-card sa-reveal sa-delay-1" style="margin-bottom:20px;">
                <h4 style="color:var(--green); margin-bottom:12px; text-align:left;"><?php echo e(__('site.karma_history_h4', [], $loc)); ?></h4>
                <p><?php echo e(__('site.karma_history_p', [], $loc)); ?></p>
            </div>
            <div class="sa-program-card sa-reveal sa-delay-2" style="margin-bottom:20px;">
                <h4 style="color:var(--green); margin-bottom:12px; text-align:left;"><?php echo e(__('site.karma_loc_h4', [], $loc)); ?></h4>
                <p><?php echo nl2br(e(__('site.karma_loc_p', [], $loc))); ?></p>
            </div>
            <div class="sa-program-card sa-reveal sa-delay-3">
                <h4 style="color:var(--green); margin-bottom:12px; text-align:left;"><?php echo e(__('site.karma_area_h4', [], $loc)); ?></h4>
                <p><?php echo e(__('site.karma_area_p', [], $loc)); ?></p>
            </div>
        </div>
        <div class="map-wrap sa-reveal sa-delay-2" style="height:100%;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125836.0!2d-2.2!3d13.63!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMine+de+Karma!5e0!3m2!1s<?php echo e($loc); ?>!2sbf!4v1"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                style="height:100%; min-height:400px; border-radius:12px;"
                title="<?php echo e($en ? 'Location of the Karma mine' : 'Localisation de la mine de Karma'); ?>">
            </iframe>
        </div>
    </div>
</section>

<?php if(false): ?>

<section id="exploitation" class="sa-sand-animated" style="position:relative; padding:70px 5vw;">
    <div class="sa-wave-top"></div>
    <div style="position:relative; z-index:1; max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e(__('site.karma_prod_h2', [], $loc)); ?></h2>
            <div class="sa-divider"></div>
        </div>

        <div class="stat-band sa-reveal sa-delay-1" style="margin-top:40px;">
            <div class="stat-item sa-stat-item-enhanced">
                <span class="stat-value" data-count="97" data-suffix=" koz">97 koz</span>
                <span class="stat-label"><?php echo e($en ? 'Annual average (2019-2021)' : "Production annuelle moyenne (2019-2021)"); ?></span>
            </div>
            <div class="stat-item sa-stat-item-enhanced">
                <span class="stat-value" data-count="949" data-suffix=" koz">949 koz</span>
                <span class="stat-label"><?php echo e($en ? 'Total gold reserves' : 'Réserves or totales'); ?></span>
            </div>
            <div class="stat-item sa-stat-item-enhanced">
                <span class="stat-value" data-count="33.2" data-suffix=" Mt">33.2 Mt</span>
                <span class="stat-label"><?php echo e($en ? 'Ore reserves' : 'Réserves minerai'); ?></span>
            </div>
            <div class="stat-item sa-stat-item-enhanced">
                <span class="stat-value" data-count="11" data-suffix=" yrs">11 yrs</span>
                <span class="stat-label"><?php echo e($en ? 'Extended mine life' : 'Durée mine étendue'); ?></span>
            </div>
        </div>
        
        <div class="grid-3" style="margin-top:40px;">
            <div class="sa-program-card sa-reveal sa-delay-1 karma-production-card karma-production-card--open-pit" style="padding:0; overflow:hidden;">
                <img class="card-img" style="width:100%; height:200px; object-fit:cover;" src="<?php echo e(asset('images/mining/karma-05.jpg')); ?>" alt="<?php echo e($en ? 'Open-pit mining' : 'Extraction à ciel ouvert'); ?>">
                <div style="padding:24px;">
                    <h3 style="color:var(--green); margin-bottom:12px; text-align:left;"><?php echo e(__('site.karma_card1_h3', [], $loc)); ?></h3>
                    <p><?php echo e(__('site.karma_card1_p', [], $loc)); ?></p>
                </div>
            </div>
            <div class="sa-program-card sa-reveal sa-delay-2 karma-production-card karma-production-card--processing" style="padding:0; overflow:hidden;">
                <img class="card-img" style="width:100%; height:200px; object-fit:cover;" src="<?php echo e(asset('images/mining/karma-04.jpg')); ?>" alt="<?php echo e($en ? 'Gold processing plant' : "Usine de traitement de l'or"); ?>">
                <div style="padding:24px;">
                    <h3 style="color:var(--green); margin-bottom:12px; text-align:left;"><?php echo e(__('site.karma_card2_h3', [], $loc)); ?></h3>
                    <p><?php echo e(__('site.karma_card2_p', [], $loc)); ?></p>
                </div>
            </div>
            <div class="sa-program-card sa-reveal sa-delay-3 karma-production-card karma-production-card--team" style="padding:0; overflow:hidden;">
                <img class="card-img" style="width:100%; height:200px; object-fit:cover;" src="<?php echo e(asset('images/mining/karma-01.jpg')); ?>" alt="<?php echo e($en ? 'Burkinabe mining team' : 'Équipe minière burkinabè'); ?>">
                <div style="padding:24px;">
                    <h3 style="color:var(--green); margin-bottom:12px; text-align:left;"><?php echo e(__('site.karma_card3_h3', [], $loc)); ?></h3>
                    <p><?php echo e(__('site.karma_card3_p', [], $loc)); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>

<?php if(false): ?>

<section id="production-timeline" class="sa-animated-section" style="padding:70px 5vw;">
    <div class="sa-section-heading sa-reveal">
        <h2><?php echo e($en ? 'Production & Development Timeline' : 'Timeline de Production & Développement'); ?></h2>
        <div class="sa-divider"></div>
    </div>
    <p class="lead sa-reveal" style="text-align:center; margin-bottom:48px;"><?php echo e($en ? 'Karma mine history from 2007 to present' : 'Historique de la mine de Karma de 2007 à nos jours'); ?></p>
    
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:16px; margin-bottom:40px;">
        <div class="sa-step-card sa-reveal sa-delay-1" data-step="07">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2007</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;"><?php echo e($en ? 'Acquisition by True Gold Mining' : 'Acquisition par True Gold Mining'); ?></div>
        </div>
        <div class="sa-step-card sa-reveal sa-delay-2" data-step="12">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2012-2016</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;"><?php echo e($en ? 'Exploration & development' : 'Exploration & développement'); ?></div>
        </div>
        <div class="sa-step-card sa-reveal sa-delay-3" data-step="17">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2017-2018</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;"><?php echo e($en ? 'Construction phase' : 'Phase de construction'); ?></div>
        </div>
        <div class="sa-step-card sa-reveal sa-delay-4" data-step="19">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2019</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;"><?php echo e($en ? 'First production' : 'Première production'); ?></div>
        </div>
        <div class="sa-step-card sa-reveal sa-delay-5" data-step="24">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2024</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;"><?php echo e($en ? 'Néré Mining transition' : 'Transition Néré Mining'); ?></div>
        </div>
        <div class="sa-step-card sa-reveal sa-delay-6" data-step="26">
            <div style="font-size:24px; font-weight:700; color:var(--green); margin-bottom:4px;">2026+</div>
            <div style="font-size:13px; color:var(--muted); line-height:1.6;"><?php echo e($en ? 'CIL plant & expansion' : 'Usine CIL & expansion'); ?></div>
        </div>
    </div>

    <div class="sa-program-card sa-reveal" style="max-width:800px; margin:0 auto;">
        <h3 style="color:var(--green); margin:0 0 16px 0; font-size:18px; font-weight:600; text-align:left;"><?php echo e($en ? 'Key Milestones' : 'Jalons Clés'); ?></h3>
        <ul class="sa-animated-list">
            <li><span class="sa-list-bullet">✓</span><span style="font-size:14px; color:var(--muted);"><?php echo e($en ? '2007: Acquired Goulagou and Rounga properties (487 km²)' : '2007: Acquisition des propriétés Goulagou et Rounga (487 km²)'); ?></span></li>
            <li><span class="sa-list-bullet">✓</span><span style="font-size:14px; color:var(--muted);"><?php echo e($en ? '2019: Commenced gold production at 80 Koz annually' : '2019: Démarrage production or à 80 Koz annuels'); ?></span></li>
            <li><span class="sa-list-bullet">✓</span><span style="font-size:14px; color:var(--muted);"><?php echo e($en ? '2024: Transition to Burkinabè-majority ownership (Néré Mining)' : '2024: Transition vers majorité actionnaire burkinabè (Néré Mining)'); ?></span></li>
            <li><span class="sa-list-bullet">✓</span><span style="font-size:14px; color:var(--muted);"><?php echo e($en ? '2026+: CIL plant commissioning for refractory ore processing' : '2026+: Mise en service usine CIL pour traitement minerai réfractaire'); ?></span></li>
        </ul>
    </div>
</section>


<section id="ressources" class="sa-sand-animated" style="position:relative; padding:70px 5vw;">
    <div class="sa-wave-top"></div>
    <div style="position:relative; z-index:1; max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e($en ? 'Mineral Resources & Reserves' : 'Ressources & Réserves Minérales'); ?></h2>
            <div class="sa-divider"></div>
        </div>
        <p class="lead sa-reveal" style="text-align:center; margin-bottom:48px;"><?php echo e($en ? 'JORC-classified mineral resources across five major deposits at Karma' : 'Ressources minérales classifiées JORC dans cinq gisements majeurs'); ?></p>
        
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:28px; align-items:start; margin-bottom:48px;">
            
            <div class="sa-reveal sa-delay-1" style="border:1px solid var(--line); border-radius:12px; overflow:hidden; box-shadow:0 8px 24px rgba(40,29,24,.08); background:#fff;">
                <table style="width:100%; border-collapse:collapse; font-size:14px; line-height:1.6;">
                    <thead>
                        <tr style="background:linear-gradient(135deg, var(--green), #682321); color:#fff;">
                            <th style="padding:16px; text-align:left; font-weight:600;"><?php echo e($en ? 'Deposit' : 'Gisement'); ?></th>
                            <th style="padding:16px; text-align:center; font-weight:600;">Tonnage (Kt)</th>
                            <th style="padding:16px; text-align:center; font-weight:600;">Grade (g/t)</th>
                            <th style="padding:16px; text-align:center; font-weight:600;">Gold (Koz)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom:1px solid var(--line);">
                            <td style="padding:14px 16px; font-weight:600;">Nami</td>
                            <td style="padding:14px 16px; text-align:center;">1,634</td>
                            <td style="padding:14px 16px; text-align:center;">0.82</td>
                            <td style="padding:14px 16px; text-align:center;">43</td>
                        </tr>
                        <tr style="border-bottom:1px solid var(--line);">
                            <td style="padding:14px 16px; font-weight:600;">GG1</td>
                            <td style="padding:14px 16px; text-align:center;">5,888</td>
                            <td style="padding:14px 16px; text-align:center;">1.00</td>
                            <td style="padding:14px 16px; text-align:center;">189</td>
                        </tr>
                        <tr style="border-bottom:1px solid var(--line);">
                            <td style="padding:14px 16px; font-weight:600;">GG2</td>
                            <td style="padding:14px 16px; text-align:center;">5,320</td>
                            <td style="padding:14px 16px; text-align:center;">1.65</td>
                            <td style="padding:14px 16px; text-align:center;">281</td>
                        </tr>
                        <tr style="border-bottom:1px solid var(--line);">
                            <td style="padding:14px 16px; font-weight:600;">Kao</td>
                            <td style="padding:14px 16px; text-align:center;">3,200</td>
                            <td style="padding:14px 16px; text-align:center;">1.42</td>
                            <td style="padding:14px 16px; text-align:center;">146</td>
                        </tr>
                        <tr style="border-bottom:1px solid var(--line);">
                            <td style="padding:14px 16px; font-weight:600;">Goulagou</td>
                            <td style="padding:14px 16px; text-align:center;">1,950</td>
                            <td style="padding:14px 16px; text-align:center;">1.28</td>
                            <td style="padding:14px 16px; text-align:center;">80</td>
                        </tr>
                        <tr style="background:var(--sand); font-weight:600; border-top:2px solid var(--gold);">
                            <td style="padding:14px 16px;"><?php echo e($en ? 'Total' : 'Total'); ?></td>
                            <td style="padding:14px 16px; text-align:center;">17,992</td>
                            <td style="padding:14px 16px; text-align:center;">1.24</td>
                            <td style="padding:14px 16px; text-align:center;">739</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
            <div>
                <div class="sa-program-card sa-reveal sa-delay-2" style="margin-bottom:16px;">
                    <h3 style="color:var(--green); margin-bottom:12px; font-size:16px; font-weight:600; text-align:left;"><?php echo e($en ? 'Resource Overview' : 'Vue d\'Ensemble des Ressources'); ?></h3>
                    <p style="color:var(--muted); font-size:14px; line-height:1.7; margin:0;"><?php echo e($en ? 'The Karma mine contains JORC-compliant mineral resources across five major deposits. Total measured, indicated and inferred resources amount to approximately 18 Mt with an average grade of 1.24 g/t Au.' : 'La mine de Karma contient des ressources minérales conformes JORC réparties sur cinq gisements majeurs. Les ressources mesurées, indiquées et inférées totalisent environ 18 Mt avec une teneur moyenne de 1,24 g/t Au.'); ?></p>
                </div>

                <div class="sa-partner-card sa-reveal sa-delay-3" style="border-left:4px solid var(--green);">
                    <h4 style="color:var(--green); margin:0 0 12px 0; font-size:14px; font-weight:600; text-align:left;"><?php echo e($en ? 'Classification' : 'Classification'); ?></h4>
                    <ul class="sa-animated-list">
                        <li><span class="sa-list-bullet" style="font-size:11px;">•</span><span style="font-size:13px; color:var(--muted);"><?php echo e($en ? 'Measured Resources: High confidence deposits' : 'Ressources Mesurées: Gisements haute confiance'); ?></span></li>
                        <li><span class="sa-list-bullet" style="font-size:11px;">•</span><span style="font-size:13px; color:var(--muted);"><?php echo e($en ? 'Indicated Resources: Established geological continuity' : 'Ressources Indiquées: Continuité géologique établie'); ?></span></li>
                        <li><span class="sa-list-bullet" style="font-size:11px;">•</span><span style="font-size:13px; color:var(--muted);"><?php echo e($en ? 'Inferred Resources: Limited geological evidence' : 'Ressources Inférées: Preuves géologiques limitées'); ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>


<?php endif; ?>
<section id="organisation" class="sa-animated-section" style="padding:70px 5vw;">
    <div class="sa-section-heading sa-reveal">
        <h2><?php echo e(__('site.karma_org_h2', [], $loc)); ?></h2>
        <div class="sa-divider"></div>
    </div>
    <p class="lead sa-reveal" style="text-align:center; margin-bottom:40px;"><?php echo e(__('site.karma_org_lead', [], $loc)); ?></p>
    <div class="grid-3">
        <?php $__empty_1 = true; $__currentLoopData = $karmaDepartments ?? collect(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $deptTag = trim((string) $dept->localizedTag($loc));
            $deptTitle = trim((string) $dept->localizedTitle($loc));
            $deptBody = trim((string) $dept->localizedBody($loc));
        ?>
        <div class="sa-program-card sa-reveal sa-delay-<?php echo e($loop->iteration % 3 + 1); ?>">
            <div class="card-tag"><?php echo e($deptTag !== '' ? $deptTag : __('site.karma_dept'.$loop->iteration.'_tag', [], $loc)); ?></div>
            <h3 style="text-align:left;"><?php echo e($deptTitle !== '' ? $deptTitle : __('site.karma_dept'.$loop->iteration.'_h3', [], $loc)); ?></h3>
            <p><?php echo e($deptBody !== '' ? $deptBody : __('site.karma_dept'.$loop->iteration.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php $__currentLoopData = range(1, 9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="sa-program-card sa-reveal sa-delay-<?php echo e($i % 3 + 1); ?>">
            <div class="card-tag"><?php echo e(__('site.karma_dept'.$i.'_tag', [], $loc)); ?></div>
            <h3 style="text-align:left;"><?php echo e(__('site.karma_dept'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.karma_dept'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</section>


<section id="modele-operationnel" class="sa-sand-animated" style="position:relative; padding:70px 5vw;">
    <div class="sa-wave-top"></div>
    <div style="position:relative; z-index:1; max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e(__('site.karma_model_h2', [], $loc)); ?></h2>
            <div class="sa-divider"></div>
        </div>
        <p class="lead sa-reveal" style="text-align:center; margin-bottom:48px;"><?php echo e(__('site.karma_model_lead', [], $loc)); ?></p>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:24px;">
            <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-step-card sa-reveal sa-delay-<?php echo e($i); ?>" data-step="<?php echo e($i); ?>">
                <h4 style="color:var(--green); margin-bottom:12px; font-size:18px;"><?php echo e(__('site.karma_step'.$i.'_h4', [], $loc)); ?></h4>
                <p style="font-size:14px; line-height:1.6; color:var(--muted);"><?php echo e(__('site.karma_step'.$i.'_p', [], $loc)); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>


<section id="impact" class="sa-animated-section" style="padding:70px 5vw;">
    <div class="sa-section-heading sa-reveal">
        <h2><?php echo e(__('site.karma_impact_h2', [], $loc)); ?></h2>
        <div class="sa-divider"></div>
    </div>
    <p class="lead sa-reveal" style="text-align:center; margin-bottom:48px;"><?php echo e(__('site.karma_impact_lead', [], $loc)); ?></p>
    <div class="grid-2">
        <div>
            <h3 class="sa-reveal" style="text-align:left; color:var(--green); margin-bottom:24px;"><?php echo e(__('site.karma_imp_jobs_h3', [], $loc)); ?></h3>
            <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-achievement-card sa-reveal sa-delay-<?php echo e($i); ?>" style="margin-bottom:18px; text-align:left;">
                <div class="card-tag"><?php echo e(__('site.karma_imp_job'.$i.'_tag', [], $loc)); ?></div>
                <p style="margin-top:8px;"><?php echo e(__('site.karma_imp_job'.$i.'_p', [], $loc)); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div>
            <h3 class="sa-reveal" style="text-align:left; color:var(--green); margin-bottom:24px;"><?php echo e(__('site.karma_imp_eco_h3', [], $loc)); ?></h3>
            <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-achievement-card sa-reveal sa-delay-<?php echo e($i); ?>" style="margin-bottom:18px; text-align:left;">
                <div class="card-tag"><?php echo e(__('site.karma_imp_eco'.$i.'_tag', [], $loc)); ?></div>
                <p style="margin-top:8px;"><?php echo e(__('site.karma_imp_eco'.$i.'_p', [], $loc)); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\karma.blade.php ENDPATH**/ ?>