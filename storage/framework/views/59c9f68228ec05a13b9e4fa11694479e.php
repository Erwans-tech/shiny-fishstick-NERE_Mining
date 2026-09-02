<?php $__env->startSection('content'); ?>
<?php $companyBase = $en ? route('english.company') : route('company'); ?>

<section>
    <div class="sub-nav">
        <a href="<?php echo e($companyBase); ?>"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.ceo')        : route('company.ceo')); ?>" class="active"><?php echo e(__('site.subnav_company_ceo', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.identity')   : route('company.identity')); ?>"><?php echo e(__('site.subnav_company_identity', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.history')    : route('company.history')); ?>"><?php echo e(__('site.subnav_company_history', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.values')     : route('company.values')); ?>"><?php echo e(__('site.subnav_company_values', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>"><?php echo e(__('site.subnav_company_governance', [], $loc)); ?></a>
    </div>

    <style>
        .pdg-block {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 48px;
            align-items: center;
            background: linear-gradient(135deg, #ffffff 0%, #f6f1ea 100%);
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 12px 32px rgba(40,29,24,0.06);
            margin-top: 40px;
        }
        .pdg-photo {
            height: 380px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4b1716 0%, #2d0d10 100%);
            box-shadow: 0 12px 24px rgba(75,23,22,0.2);
            position: relative;
            overflow: hidden;
        }
        .pdg-photo::after {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(circle at top right, rgba(255,194,71,0.1), transparent 60%);
        }
        .pdg-quote {
            font-size: clamp(22px, 3vw, 30px);
            line-height: 1.4;
            color: var(--ink);
            font-weight: 300;
            margin-bottom: 32px;
            position: relative;
        }
        .pdg-quote::before {
            content: '«';
            position: absolute;
            left: -40px;
            top: -20px;
            font-size: 80px;
            color: rgba(229,167,47,0.3);
            font-family: serif;
            line-height: 1;
        }
        .pdg-name { font-size: 20px; font-weight: 700; color: var(--green); margin-bottom: 4px; }
        .pdg-title { font-size: 14px; font-weight: 500; color: var(--muted); text-transform: uppercase; letter-spacing: 0.1em; }
        .pdg-letter p { color: var(--muted); font-size: 16px; line-height: 1.8; margin-bottom: 18px; }
        .pdg-letter strong { color: var(--green); }
        .pdg-letter .pdg-signature { margin-top: 28px; margin-bottom: 0; color: var(--green); font-weight: 700; }

        @media(max-width: 900px) {
            .pdg-block { grid-template-columns: 1fr; gap: 32px; padding: 32px 24px; }
            .pdg-quote::before { left: -10px; top: -30px; }
        }
    </style>

    <div class="pdg-block sr">
        <div>
            <div class="pdg-photo">
                    <img src="<?php echo e(asset('images/company/pdg.jpg')); ?>" alt="<?php echo e($en ? 'President and CEO of Néré Mining' : 'Président-Directeur Général de Néré Mining'); ?>" loading="lazy" style="width:100%; height:100%; object-fit:cover;">
            </div>
        </div>
        <div>
                <?php if($en): ?>
                    <p class="pdg-quote">Welcome to the official website of Néré Mining.</p>
                    <div class="pdg-letter">
                        <p>Dear partners and visitors,</p>
                        <p>Through these pages, you will discover our gold exploration, extraction, production and marketing activities, carried out from our Karma site in the Northern Region of Burkina Faso.</p>
                        <p>Our mission fully supports the country's economic development. We work to create lasting value for the region, Burkina Faso as a whole and the local communities around us.</p>
                        <p>This website is a space for exchange and information with our partners, colleagues and everyone interested in our approach. It reflects the core values that guide us every day: <strong>Integrity, Professionalism, Respect and Team Spirit.</strong></p>
                        <p>You will also find information about our ongoing projects, particularly our commitments to environmental protection and community development in our areas of operation.</p>
                        <p>We invite you to visit this website regularly and share your suggestions, ideas and comments so that we can continue to progress together.</p>
                        <p>On behalf of the entire Néré Mining team, I wish you an excellent visit.</p>
                        <p class="pdg-signature">The President and Chief Executive Officer</p>
                    </div>
                <?php else: ?>
                    <p class="pdg-quote">Chers partenaires, chers visiteurs,</p>
                    <div class="pdg-letter">
                        <p>Bienvenue sur le site officiel de Néré Mining.</p>
                        <p>À travers ces pages, vous découvrirez nos activités de prospection, d’extraction, de production et de commercialisation de l’or, menées depuis notre site de Karma, situé dans la région du Nord du Burkina Faso.</p>
                        <p>Notre mission s’inscrit pleinement dans la dynamique de développement économique du pays. Nous œuvrons à créer de la valeur durable, au bénéfice de la région, du Burkina Faso dans son ensemble, et des communautés locales qui nous entourent.</p>
                        <p>Ce site se veut un espace d’échange et d’information avec nos partenaires, nos collaborateurs et tous ceux qui s’intéressent à notre démarche. Il reflète les valeurs cardinales qui nous animent au quotidien : <strong>Intégrité, Professionnalisme, Respect et Esprit d’équipe.</strong></p>
                        <p>Vous y trouverez également des informations sur nos projets en cours, notamment nos engagements en matière de protection de l’environnement et de développement communautaire dans nos zones d’intervention.</p>
                        <p>Nous vous invitons à consulter régulièrement ce site et à nous faire part de vos suggestions, idées ou remarques pour continuer à progresser ensemble.</p>
                        <p>Au nom de toute l’équipe de Néré Mining, je vous souhaite une excellente visite.</p>
                        <p class="pdg-signature">Le Président-Directeur Général</p>
                    </div>
                <?php endif; ?>
                <div class="pdg-title"><?php echo e(__('site.company_pdg_company', [], $loc)); ?></div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company-ceo.blade.php ENDPATH**/ ?>