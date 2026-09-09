
<?php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';
?>

<?php if(view()->exists('pages.' . $section)): ?>
    <?php echo $__env->make('pages.' . $section, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php else: ?>
    
    <?php abort(404); ?>
<?php endif; ?>
<?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/page.blade.php ENDPATH**/ ?>