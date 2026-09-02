<?php $companyBase = $en ? route('english.company') : route('company'); ?>
<div class="sub-nav">
    <a href="<?php echo e($companyBase); ?>" class="<?php echo e($section === 'company' ? 'active' : ''); ?>"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
    <a href="<?php echo e($en ? route('english.company.ceo') : route('company.ceo')); ?>" class="<?php echo e($section === 'company-ceo' ? 'active' : ''); ?>"><?php echo e(__('site.subnav_company_ceo', [], $loc)); ?></a>
    <a href="<?php echo e($en ? route('english.company.identity') : route('company.identity')); ?>" class="<?php echo e($section === 'company-identity' ? 'active' : ''); ?>"><?php echo e(__('site.subnav_company_identity', [], $loc)); ?></a>
    <a href="<?php echo e($en ? route('english.company.history') : route('company.history')); ?>" class="<?php echo e($section === 'company-history' ? 'active' : ''); ?>"><?php echo e(__('site.subnav_company_history', [], $loc)); ?></a>
    <a href="<?php echo e($en ? route('english.company.values') : route('company.values')); ?>" class="<?php echo e($section === 'company-values' ? 'active' : ''); ?>"><?php echo e(__('site.subnav_company_values', [], $loc)); ?></a>
    <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>" class="<?php echo e($section === 'company-governance' ? 'active' : ''); ?>"><?php echo e(__('site.subnav_company_governance', [], $loc)); ?></a>
</div><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\partials\_company-nav.blade.php ENDPATH**/ ?>