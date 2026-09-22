<?php
    $loc = $loc ?? app()->getLocale();
    $en  = $en  ?? ($loc === 'en');
    $contactUrl = $en ? route('english.contact') : route('contact');
    
    // Récupérer les settings depuis la BD
    use App\Models\SiteSetting;
    $companyPhone = SiteSetting::get('company_phone', '+226 25 33 35 69');
    $companyEmail = SiteSetting::get('company_email', 'info@nere-mining.bf');
    $copyright = SiteSetting::get('footer_copyright', '© '.date('Y').' Néré Mining. Tous droits réservés.');
    $footerDescription = SiteSetting::get('footer_description', 'Groupe aurifère burkinabè exploitant la mine de Karma dans le nord du Burkina Faso.');
    $socialLinks = collect([
        ['name' => 'Facebook', 'key' => 'social_facebook', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8h3V4h-3c-3.3 0-5 1.8-5 5v3H6v4h3v4h4v-4h3l1-4h-4V9c0-.7.3-1 1-1Z"/></svg>'],
        ['name' => 'LinkedIn', 'key' => 'social_linkedin', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 8v10M6 5.5v.1M10 18v-6a3 3 0 0 1 6 0v6M10 12V8"/><path d="M4 4h16v16H4z"/></svg>'],
        ['name' => 'Instagram', 'key' => 'social_instagram', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="4"/><circle cx="12" cy="12" r="3.5"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor" stroke="none"/></svg>'],
        ['name' => 'YouTube', 'key' => 'social_youtube', 'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 7.5a2.5 2.5 0 0 0-1.8-1.8C17.1 5.3 12 5.3 12 5.3s-5.1 0-6.7.4a2.5 2.5 0 0 0-1.8 1.8C3.1 9.1 3.1 12 3.1 12s0 2.9.4 4.5a2.5 2.5 0 0 0 1.8 1.8c1.6.4 6.7.4 6.7.4s5.1 0 6.7-.4a2.5 2.5 0 0 0 1.8-1.8c.4-1.6.4-4.5.4-4.5s0-2.9-.4-4.5Z"/><path d="m10 9 5 3-5 3V9Z" fill="currentColor" stroke="none"/></svg>'],
    ])->map(function ($social) {
        $social['url'] = trim((string) SiteSetting::get($social['key'], ''));
        return $social;
    })->filter(fn ($social) => filter_var($social['url'], FILTER_VALIDATE_URL));
?>

<?php if (! $__env->hasRenderedOnce('a48d1af2-9fb0-486e-b1a1-7d86644342b8')): $__env->markAsRenderedOnce('a48d1af2-9fb0-486e-b1a1-7d86644342b8'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/chrome.css')); ?>?v=<?php echo e(filemtime(public_path('css/chrome.css'))); ?>">
<?php endif; ?>

<footer class="site-footer">
    <div class="site-footer__inner">
        <div class="site-footer__top">
            <a class="site-footer__brand" href="<?php echo e($en ? route('english') : url('/')); ?>">
                <img src="<?php echo e(asset('images/logo-nere.png')); ?>" alt="Néré Mining">
            </a>
            <?php if($socialLinks->isNotEmpty()): ?>
        <div class="site-footer__social" aria-label="<?php echo e($en ? 'Social networks' : 'Réseaux sociaux'); ?>">
            <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="site-footer__social-link" href="<?php echo e($social['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo e($social['name']); ?>" title="<?php echo e($social['name']); ?>">
                    <?php echo $social['icon']; ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
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

        

        <div class="site-footer__legal">
            <a href="<?php echo e($en ? route('english.cookies.policy') : route('cookies.policy')); ?>"><?php echo e($en ? 'Cookies policy' : 'Politique cookies'); ?></a>
            <a href="<?php echo e($en ? route('english.privacy.policy') : route('privacy.policy')); ?>"><?php echo e($en ? 'Privacy policy' : 'Confidentialité'); ?></a>
            <a href="<?php echo e($en ? route('english.legal.notice') : route('legal.notice')); ?>"><?php echo e($en ? 'Legal notice' : 'Mentions légales'); ?></a>
            <a href="https://erwans2003.github.io/ERWAN-PORTFOLIO/" target="_blank" rel="noopener noreferrer" class="site-footer__signature" title="Design & Development" aria-label="Designer signature">•</a>
        </div>
    </div>
</footer>
<?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/partials/_footer.blade.php ENDPATH**/ ?>