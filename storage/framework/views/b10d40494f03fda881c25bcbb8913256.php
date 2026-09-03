<?php
    $loc = $loc ?? app()->getLocale();
    $en  = $en  ?? ($loc === 'en');
    $contactUrl = $en ? route('english.contact') : route('contact');
    
    // Récupérer les settings depuis la BD
    use App\Models\SiteSetting;
    $companyPhone = SiteSetting::get('company_phone', '+226 25 33 35 69');
    $companyEmail = SiteSetting::get('company_email', 'contact@nere-mining.bf');
    $copyright = SiteSetting::get('footer_copyright', '© '.date('Y').' Néré Mining. Tous droits réservés.');
    $footerDescription = SiteSetting::get('footer_description', 'Groupe aurifère burkinabè exploitant la mine de Karma dans le nord du Burkina Faso.');
?>

<?php if (! $__env->hasRenderedOnce('83ee9862-969e-4fdc-a9cc-84d5cc9ae976')): $__env->markAsRenderedOnce('83ee9862-969e-4fdc-a9cc-84d5cc9ae976'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/chrome.css')); ?>">
<?php endif; ?>

<footer class="site-footer">
    <div class="site-footer__inner">
        <div class="site-footer__top">
            <a class="site-footer__brand" href="<?php echo e($en ? route('english') : url('/')); ?>">
                <img src="<?php echo e(asset('images/logo-nere.png')); ?>" alt="Néré Mining">
            </a>
            <a class="site-btn site-footer__cta" href="<?php echo e($contactUrl); ?>">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <?php echo e($en ? 'Contact us' : 'Nous contacter'); ?>

            </a>
        </div>

        <div class="site-footer__grid">
            <div>
                <p class="site-footer__lead"><?php echo e($footerDescription); ?></p>
                <a class="site-footer__meta" href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $companyPhone)); ?>"><?php echo e($companyPhone); ?></a>
                <a class="site-footer__meta" href="mailto:<?php echo e($companyEmail); ?>"><?php echo e($companyEmail); ?></a>
            </div>
            <div>
                <div class="site-footer__label"><?php echo e($en ? 'Company' : 'Entreprise'); ?></div>
                <a href="<?php echo e($en ? route('english.company') : route('company')); ?>"><?php echo e(__('site.nav_company', [], $loc)); ?></a>
                <a href="<?php echo e($en ? route('english.karma') : route('karma')); ?>"><?php echo e(__('site.nav_karma', [], $loc)); ?></a>
                <a href="<?php echo e($en ? route('english.projects') : route('projects')); ?>"><?php echo e(__('site.nav_projects', [], $loc)); ?></a>
                <a href="<?php echo e($en ? route('english.sustainability') : route('sustainability')); ?>"><?php echo e(__('site.nav_sustainability', [], $loc)); ?></a>
            </div>
            <div>
                <div class="site-footer__label"><?php echo e($en ? 'Resources' : 'Ressources'); ?></div>
                <a href="<?php echo e($en ? route('english.news') : route('news.index')); ?>"><?php echo e(__('site.nav_news', [], $loc)); ?></a>
                <a href="<?php echo e($en ? route('english.reports') : route('reports')); ?>"><?php echo e(__('site.nav_reports', [], $loc)); ?></a>
                <a href="<?php echo e($en ? route('english.gallery') : route('gallery')); ?>"><?php echo e(__('site.nav_gallery', [], $loc)); ?></a>
                <a href="<?php echo e($en ? route('english.careers') : route('careers')); ?>"><?php echo e(__('site.nav_careers', [], $loc)); ?></a>
            </div>
            <div>
                <div class="site-footer__label">IPRE</div>
                <span><?php echo e($en ? 'Integrity' : 'Intégrité'); ?></span>
                <span><?php echo e($en ? 'Professionalism' : 'Professionnalisme'); ?></span>
                <span>Respect</span>
                <span><?php echo e($en ? 'Teamwork' : "Esprit d'équipe"); ?></span>
            </div>
        </div>

        <div class="site-footer__bottom">
            <span><?php echo e($copyright); ?></span>
            <span>Ouagadougou, Burkina Faso</span>
        </div>
    </div>
</footer>
<?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\partials\_footer.blade.php ENDPATH**/ ?>