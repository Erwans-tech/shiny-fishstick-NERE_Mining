<?php $__env->startSection('content'); ?>
<div style="min-height: 70vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%); position: relative; overflow: hidden;">
    <!-- Animated background elements -->
    <div style="position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><circle cx=%2220%22 cy=%2220%22 r=%225%22 fill=%22rgba(239,68,68,0.1)%22/><circle cx=%2280%22 cy=%2280%22 r=%2210%22 fill=%22rgba(239,68,68,0.05)%22/></svg>'); opacity: 0.5; animation: floatingBg 15s linear infinite;"></div>

    <div style="position: relative; z-index: 1; text-align: center; padding: 40px 20px; max-width: 600px;">
        <!-- Error code -->
        <div style="font-size: 120px; font-weight: 900; color: #ef4444; line-height: 1; margin-bottom: 20px; text-shadow: 0 10px 30px rgba(239,68,68,0.2); animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;">
            500
        </div>

        <!-- Error title -->
        <h1 style="font-size: 48px; color: #ffffff; margin: 20px 0; font-weight: 700; letter-spacing: -1px;">
            Server error
        </h1>

        <!-- Error description -->
        <p style="font-size: 18px; color: #b0b9c6; margin: 20px 0 40px; line-height: 1.6;">
            Something went wrong on our end. Our team has been notified and is working to fix it. Please try again in a few moments.
        </p>

        <!-- Error details (show only in debug mode) -->
        <?php if(config('app.debug') && $exception): ?>
        <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 6px; padding: 20px; margin: 20px 0; text-align: left; max-height: 200px; overflow-y: auto;">
            <p style="font-size: 12px; color: #ef4444; margin: 0; font-family: monospace; word-break: break-all;">
                <strong>Error:</strong> <?php echo e($exception->getMessage()); ?>

            </p>
        </div>
        <?php endif; ?>

        <!-- Action buttons -->
        <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; margin: 40px 0;">
            <a href="<?php echo e(url('/')); ?>" style="display: inline-block; padding: 14px 32px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s ease; border: 2px solid transparent;">
                Back to home
            </a>
            <a href="javascript:location.reload()" style="display: inline-block; padding: 14px 32px; background: transparent; color: #ef4444; text-decoration: none; border-radius: 6px; font-weight: 600; border: 2px solid #ef4444; transition: all 0.3s ease;">
                Retry
            </a>
        </div>

        <!-- Support info -->
        <div style="margin-top: 60px; padding-top: 40px; border-top: 1px solid rgba(239,68,68,0.2);">
            <p style="color: #7a8190; font-size: 14px; margin-bottom: 16px;">If this problem persists, please contact us:</p>
            <a href="mailto:contact@nere-mining.bf" style="color: #ef4444; text-decoration: none; font-weight: 600; transition: color 0.3s;">contact@nere-mining.bf</a>
        </div>
    </div>
</div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.05); }
}

@keyframes floatingBg {
    0% { transform: translate(0, 0); }
    100% { transform: translate(50px, 50px); }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\errors\500.blade.php ENDPATH**/ ?>