<?php $__env->startSection('content'); ?>
<?php $companyBase = $en ? route('english.company') : route('company'); ?>

<section>
    <div class="sub-nav">
        <a href="<?php echo e($companyBase); ?>"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.ceo')        : route('company.ceo')); ?>"><?php echo e(__('site.subnav_company_ceo', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.identity')   : route('company.identity')); ?>"><?php echo e(__('site.subnav_company_identity', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.history')    : route('company.history')); ?>"><?php echo e(__('site.subnav_company_history', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.values')     : route('company.values')); ?>"><?php echo e(__('site.subnav_company_values', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>" class="active"><?php echo e(__('site.subnav_company_governance', [], $loc)); ?></a>
    </div>

    <p class="lead"><?php echo e(__('site.company_gov_lead', [], $loc)); ?></p>

    
    <div class="governance-intro">
        <div class="governance-callout">
            <h3><?php echo e(__('site.company_gov_callout_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_gov_callout_p', [], $loc)); ?></p>
        </div>
        <div class="governance-principles">
            <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="governance-principle">
                <strong><?php echo e(__('site.company_gov_principle'.$i.'_title', [], $loc)); ?></strong>
                <span><?php echo e(__('site.company_gov_principle'.$i.'_p', [], $loc)); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="governance-chart-panel">
        <div class="governance-chart-heading">
            <h3><?php echo e(__('site.company_gov_chart_h3', [], $loc)); ?></h3>
        </div>
        <div class="governance-legend">
            <span><i class="legend-pdg"></i><?php echo e(__('site.company_gov_legend_pdg', [], $loc)); ?></span>
            <span><i class="legend-dga"></i><?php echo e(__('site.company_gov_legend_dga', [], $loc)); ?></span>
        </div>

        <div class="org-chart">
            
            <div class="org-level org-level--top">
                <div class="org-box org-box--pdg">
                    <div class="org-name">Dr. Justin Elie OUEDRAOGO</div>
                    <div class="org-title"><?php echo e($en ? 'Chief Executive Officer' : 'Président Directeur Général'); ?></div>
                </div>
            </div>
            <div class="org-connector-v"></div>
            <div class="org-hbar"></div>

            
            <div class="org-level org-level--dga">
                <?php
                    $dgas = [
                        ['name' => 'Justin SAVADOGO',       'grade' => 'DGA', 'title_fr' => 'Administration & Finance',          'title_en' => 'Administration & Finance'],
                        ['name' => 'Pascal Y. OUEDRAOGO',   'grade' => 'DGA', 'title_fr' => 'Approvisionnements',                 'title_en' => 'Supply & Procurement'],
                        ['name' => 'Laurent Michel DABIRE', 'grade' => 'DGA', 'title_fr' => 'Affaires Corporatives & Juridiques', 'title_en' => 'Corporate & Legal Affairs'],
                        ['name' => 'Augustine OBENG-FORI',  'grade' => $en ? 'Deputy CEO (interim)' : 'DGA par intérim', 'title_fr' => 'Opérations', 'title_en' => 'Operations'],
                    ];
                ?>
                <?php $__currentLoopData = $dgas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="org-branch">
                    <div class="org-connector-branch"></div>
                    <div class="org-box org-box--dga">
                        <div class="org-name"><?php echo e($dga['name']); ?></div>
                        <div class="org-grade"><?php echo e($dga['grade']); ?></div>
                        <div class="org-title"><?php echo e($en ? $dga['title_en'] : $dga['title_fr']); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company-governance.blade.php ENDPATH**/ ?>