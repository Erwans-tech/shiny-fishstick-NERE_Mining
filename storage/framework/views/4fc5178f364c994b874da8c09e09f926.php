<section>
	<p class="lead"><?php echo e(__('site.press_lead', [], $loc)); ?></p>

	<div class="grid-3">
		<?php $__empty_1 = true; $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
			<article class="card">
				<div class="card-tag"><?php echo e($document->document_type); ?></div>
				<h3><?php echo e($document->title); ?></h3>

				<?php if($document->description): ?>
					<p><?php echo e($document->description); ?></p>
				<?php endif; ?>

				<?php if($document->file_path): ?>
					<a class="btn btn-gold" href="<?php echo e(asset($document->file_path)); ?>">
						<?php echo e(__('site.download_pdf', [], $loc)); ?>

					</a>
				<?php endif; ?>
			</article>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			<p class="lead"><?php echo e(__('site.press_empty', [], $loc)); ?></p>
		<?php endif; ?>
	</div>
</section><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/resources/press.blade.php ENDPATH**/ ?>