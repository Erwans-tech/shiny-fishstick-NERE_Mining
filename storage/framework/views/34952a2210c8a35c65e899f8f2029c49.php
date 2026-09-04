<?php $__env->startSection('content'); ?>


<section class="sa-animated-section" style="padding:60px 5vw;">
    <div class="sa-particles-container" data-count="3"></div>
    <div style="max-width:1180px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e($en ? 'Our Locations' : 'Nos Localisations'); ?></h2>
            <div class="sa-divider"></div>
        </div>
        
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px; margin-bottom:48px; margin-top:40px;">

            
            <div class="contact-card sa-reveal sa-delay-1">
                <div class="contact-card-header">
                    <span class="contact-card-icon">🏢</span>
                    <div>
                        <div class="contact-card-num">01</div>
                        <h3><?php echo e(__('site.contact_hq_h3', [], $loc)); ?></h3>
                    </div>
                </div>
                <ul class="contact-info">
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_hq_address', [], $loc)); ?></span>
                        <span class="ci-value"><?php echo e(__('site.contact_hq_address_v', [], $loc)); ?></span>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_hq_phone', [], $loc)); ?></span>
                        <a href="tel:+22625333569" class="ci-value ci-link">
                            <?php echo e(__('site.contact_hq_phone_v', [], $loc)); ?>

                        </a>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_hq_email', [], $loc)); ?></span>
                        <a href="mailto:<?php echo e(__('site.contact_hq_email_v', [], $loc)); ?>" class="ci-value ci-link">
                            <?php echo e(__('site.contact_hq_email_v', [], $loc)); ?>

                        </a>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_hq_hours', [], $loc)); ?></span>
                        <span class="ci-value"><?php echo e(__('site.contact_hq_hours_v', [], $loc)); ?></span>
                    </li>
                </ul>
            </div>

            
            <div class="contact-card contact-card--mine sa-reveal sa-delay-2">
                <div class="contact-card-header">
                    <span class="contact-card-icon">⛏️</span>
                    <div>
                        <div class="contact-card-num">02</div>
                        <h3><?php echo e(__('site.contact_mine_h3', [], $loc)); ?></h3>
                    </div>
                </div>
                <ul class="contact-info">
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_mine_location', [], $loc)); ?></span>
                        <span class="ci-value"><?php echo e(__('site.contact_mine_location_v', [], $loc)); ?></span>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_mine_access', [], $loc)); ?></span>
                        <span class="ci-value"><?php echo e(__('site.contact_mine_access_v', [], $loc)); ?></span>
                    </li>
                    <li class="ci-separator">
                        <span class="ci-label ci-section"><?php echo e(__('site.contact_mine_field', [], $loc)); ?></span>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_mine_phone', [], $loc)); ?></span>
                        <a href="tel:+22625333569" class="ci-value ci-link">
                            <?php echo e(__('site.contact_mine_phone_v', [], $loc)); ?>

                        </a>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_mine_hse', [], $loc)); ?></span>
                        <a href="tel:+22625333569" class="ci-value ci-link ci-urgent">
                            <?php echo e(__('site.contact_mine_hse_v', [], $loc)); ?>

                        </a>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_mine_community', [], $loc)); ?></span>
                        <a href="mailto:<?php echo e(__('site.contact_mine_community_v', [], $loc)); ?>" class="ci-value ci-link">
                            <?php echo e(__('site.contact_mine_community_v', [], $loc)); ?>

                        </a>
                    </li>
                </ul>
            </div>

            
            <div class="contact-card sa-reveal sa-delay-3">
                <div class="contact-card-header">
                    <span class="contact-card-icon">📍</span>
                    <div>
                        <div class="contact-card-num">03</div>
                        <h3><?php echo e(__('site.contact_office_h3', [], $loc)); ?></h3>
                    </div>
                </div>
                <ul class="contact-info">
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_office_role', [], $loc)); ?></span>
                        <span class="ci-value ci-muted"><?php echo e(__('site.contact_office_role_v', [], $loc)); ?></span>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_office_address', [], $loc)); ?></span>
                        <span class="ci-value"><?php echo e(__('site.contact_office_address_v', [], $loc)); ?></span>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_office_phone', [], $loc)); ?></span>
                        <a href="tel:+22625333569" class="ci-value ci-link">
                            <?php echo e(__('site.contact_office_phone_v', [], $loc)); ?>

                        </a>
                    </li>
                    <li>
                        <span class="ci-label"><?php echo e(__('site.contact_office_email', [], $loc)); ?></span>
                        <a href="mailto:<?php echo e(__('site.contact_office_email_v', [], $loc)); ?>" class="ci-value ci-link">
                            <?php echo e(__('site.contact_office_email_v', [], $loc)); ?>

                        </a>
                    </li>
                </ul>
            </div>
        </div>

        
        <div class="map-wrap sa-reveal sa-delay-2">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d935649.2!2d-1.5!3d13.2!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xe2e9eb9d1aba949%3A0x7f46e8f12f1c0a55!2sOuagadougou!5e0!3m2!1s<?php echo e($loc); ?>!2sbf!4v1"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="<?php echo e($en ? 'Néré Mining locations' : 'Localisation des bureaux Néré Mining'); ?>">
            </iframe>
        </div>
    </div>
</section>


<section class="sa-sand-animated" style="position:relative; padding:80px 5vw; border-top:1px solid var(--line);">
    <div class="sa-wave-top"></div>
    <div style="position:relative; z-index:1; max-width:1000px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e(__('site.contact_form_h2', [], $loc)); ?></h2>
            <div class="sa-divider"></div>
            <p style="color:var(--muted); font-size:15px; line-height:1.8; margin:0;"><?php echo e(__('site.contact_form_lead', [], $loc)); ?></p>
        </div>

        <?php if(session('success')): ?>
        <div class="sa-reveal" style="background:#dcfce7; border:1px solid #86efac; color:#166534; padding:16px 20px; border-radius:8px; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
            <span style="font-size:20px;">✓</span>
            <span><?php echo e(session('success')); ?></span>
        </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
        <div class="sa-reveal" style="background:#fee2e2; border:1px solid #fecaca; color:#991b1b; padding:16px 20px; border-radius:8px; margin-bottom:24px;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;"><span>✕</span><span><?php echo e($e); ?></span></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <form class="sa-program-card sa-reveal sa-delay-1" style="margin-top:40px; padding:40px; box-shadow:0 8px 24px rgba(40,29,24,.08); background:#fff;" method="POST" action="<?php echo e($en ? route('english.contact.store') : route('contact.store')); ?>">
            <?php echo csrf_field(); ?>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">

                <div>
                    <label for="name" style="display:block; font:600 13px Inter,sans-serif; color:var(--ink); margin-bottom:8px; letter-spacing:.01em; text-transform:uppercase;"><?php echo e(__('site.contact_name_label', [], $loc)); ?> *</label>
                    <input id="name" name="name" required value="<?php echo e(old('name')); ?>"
                           placeholder="<?php echo e($en ? 'Your full name' : 'Votre nom complet'); ?>"
                           style="width:100%; padding:12px 14px; border:1px solid var(--line); border-radius:8px; font:14px Inter,sans-serif; transition:border-color .2s, box-shadow .2s; outline:none;"
                           onfocus="this.style.borderColor='var(--gold2)'; this.style.boxShadow='0 0 0 3px rgba(229,167,47,.1)'"
                           onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='none'">
                </div>

                <div>
                    <label for="email" style="display:block; font:600 13px Inter,sans-serif; color:var(--ink); margin-bottom:8px; letter-spacing:.01em; text-transform:uppercase;"><?php echo e(__('site.contact_email_label', [], $loc)); ?> *</label>
                    <input id="email" type="email" name="email" required value="<?php echo e(old('email')); ?>"
                           placeholder="<?php echo e($en ? 'your@email.com' : 'votre@email.com'); ?>"
                           style="width:100%; padding:12px 14px; border:1px solid var(--line); border-radius:8px; font:14px Inter,sans-serif; transition:border-color .2s, box-shadow .2s; outline:none;"
                           onfocus="this.style.borderColor='var(--gold2)'; this.style.boxShadow='0 0 0 3px rgba(229,167,47,.1)'"
                           onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='none'">
                </div>

                <div style="grid-column:span 2;">
                    <label for="contact-form-type" style="display:block; font:600 13px Inter,sans-serif; color:var(--ink); margin-bottom:8px; letter-spacing:.01em; text-transform:uppercase;"><?php echo e(__('site.contact_type_label', [], $loc)); ?></label>
                    <select id="contact-form-type" name="type"
                            style="width:100%; padding:12px 14px; border:1px solid var(--line); border-radius:8px; font:14px Inter,sans-serif; transition:border-color .2s, box-shadow .2s; cursor:pointer; outline:none;"
                            onfocus="this.style.borderColor='var(--gold2)'; this.style.boxShadow='0 0 0 3px rgba(229,167,47,.1)'"
                            onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='none'">
                        <?php
                            $types = [
                                'general'               => 'contact_type_general',
                                'partenariat'           => 'contact_type_partner',
                                'investissement'        => 'contact_type_invest',
                                'emploi'                => 'contact_type_job',
                                'fournisseur'           => 'contact_type_supplier',
                                'presse'                => 'contact_type_press',
                                'communaute'            => 'contact_type_community',
                                'candidature-spontanee' => 'contact_type_spontaneous',
                            ];
                        ?>
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>" <?php echo e(request('type', 'general') === $value ? 'selected' : ''); ?>>
                            <?php echo e(__('site.'.$key, [], $loc)); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div style="grid-column:span 2;">
                    <label for="subject" style="display:block; font:600 13px Inter,sans-serif; color:var(--ink); margin-bottom:8px; letter-spacing:.01em; text-transform:uppercase;"><?php echo e(__('site.contact_subject_label', [], $loc)); ?></label>
                    <input id="subject" name="subject" value="<?php echo e(old('subject', request('subject'))); ?>"
                           placeholder="<?php echo e($en ? 'Brief subject of your message' : 'Objet de votre message en quelques mots'); ?>"
                           style="width:100%; padding:12px 14px; border:1px solid var(--line); border-radius:8px; font:14px Inter,sans-serif; transition:border-color .2s, box-shadow .2s; outline:none;"
                           onfocus="this.style.borderColor='var(--gold2)'; this.style.boxShadow='0 0 0 3px rgba(229,167,47,.1)'"
                           onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='none'">
                </div>

                <div style="grid-column:span 2;">
                    <label for="contact-message" style="display:block; font:600 13px Inter,sans-serif; color:var(--ink); margin-bottom:8px; letter-spacing:.01em; text-transform:uppercase;"><?php echo e(__('site.contact_message_label', [], $loc)); ?> *</label>
                    <textarea id="contact-message" name="message" required
                              placeholder="<?php echo e($en ? 'Write your message here…' : 'Rédigez votre message ici…'); ?>"
                              style="width:100%; min-height:140px; padding:12px 14px; border:1px solid var(--line); border-radius:8px; font:14px Inter,sans-serif; transition:border-color .2s, box-shadow .2s; resize:vertical; outline:none;"
                              onfocus="this.style.borderColor='var(--gold2)'; this.style.boxShadow='0 0 0 3px rgba(229,167,47,.1)'"
                              onblur="this.style.borderColor='var(--line)'; this.style.boxShadow='none'"><?php echo e(old('message')); ?></textarea>
                </div>

                <div style="grid-column:span 2; margin-top:12px;">
                    <button class="sa-btn-animated" type="submit" 
                            style="width:100%; padding:16px 32px; border:0; justify-content:center; box-shadow:0 8px 24px rgba(255,194,71,.2);">
                        <span><?php echo e(__('site.send_message', [], $loc)); ?></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="sa-wave-bottom"></div>
</section>


<section class="sa-animated-section" style="padding:80px 5vw; background:#fff;">
    <div style="max-width:900px; margin:0 auto;">
        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e($en ? 'Frequently Asked Questions' : 'Questions Fréquemment Posées'); ?></h2>
            <div class="sa-divider"></div>
        </div>
        
        <div style="display:grid; gap:20px; margin-top:40px;">
            <?php
                $faqs = [
                    [
                        'q_en' => 'What is the best way to reach your team?',
                        'q_fr' => 'Quel est le meilleur moyen de joindre votre équipe ?',
                        'a_en' => 'You can contact us via email, phone, or use the contact form above. For urgent matters, the mine site has a dedicated hotline.',
                        'a_fr' => 'Vous pouvez nous contacter par email, téléphone, ou en utilisant le formulaire ci-dessus. Pour les urgences, le site de la mine dispose d\'une ligne dédiée.'
                    ],
                    [
                        'q_en' => 'How long does it take to receive a response?',
                        'q_fr' => 'Combien de temps faut-il pour recevoir une réponse ?',
                        'a_en' => 'We typically respond within 24-48 business hours. Urgent matters are prioritized.',
                        'a_fr' => 'Nous répondons généralement dans les 24 à 48 heures ouvrables. Les urgences sont prioritaires.'
                    ],
                    [
                        'q_en' => 'Can I visit the Karma mine site?',
                        'q_fr' => 'Puis-je visiter le site de la mine de Karma ?',
                        'a_en' => 'Yes, visits are possible with prior arrangement. Please contact our community office for details.',
                        'a_fr' => 'Oui, les visites sont possibles sur arrangement préalable. Veuillez contacter notre bureau communautaire pour les détails.'
                    ],
                    [
                        'q_en' => 'Who should I contact about partnerships?',
                        'q_fr' => 'Qui dois-je contacter pour les partenariats ?',
                        'a_en' => 'Select "Partnerships" in the contact form, or reach out to our headquarters directly.',
                        'a_fr' => 'Sélectionnez « Partenariats » dans le formulaire, ou contactez directement notre siège social.'
                    ]
                ];
            ?>
            
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <details class="sa-reveal sa-delay-<?php echo e($idx + 1); ?>" style="border:1px solid var(--line); border-radius:12px; padding:24px; background:var(--light); cursor:pointer; transition:all .3s; box-shadow:0 4px 12px rgba(40,29,24,.03);">
                <summary style="font:600 15px Inter,sans-serif; color:var(--green); cursor:pointer; list-style:none; display:flex; justify-content:space-between; align-items:center;">
                    <span><?php echo e($en ? $faq['q_en'] : $faq['q_fr']); ?></span>
                    <span style="display:inline-flex; align-items:center; justify-content:center; width:24px; height:24px; background:rgba(229,167,47,.1); border-radius:50%; transition:transform .3s;">→</span>
                </summary>
                <p style="color:var(--muted); line-height:1.7; margin:16px 0 0 0; font-size:14px;"><?php echo e($en ? $faq['a_en'] : $faq['a_fr']); ?></p>
            </details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<?php $__env->startPush('styles'); ?>
<style>
    /* ── Fiches de contact enrichies ── */
    .contact-card {
        padding:0;
        border:1px solid var(--line);
        background:#fff;
        border-radius:12px;
        overflow:hidden;
        transition:box-shadow .3s cubic-bezier(.22,1,.36,1), transform .3s cubic-bezier(.22,1,.36,1), border-color .3s;
        position:relative;
    }
    .contact-card::before {
        content:'';
        position:absolute;
        inset:0;
        background:linear-gradient(135deg, rgba(255,255,255,.4) 0%, rgba(255,255,255,0) 100%);
        opacity:0;
        transition:opacity .3s;
        pointer-events:none;
        border-radius:12px;
    }
    .contact-card:hover {
        box-shadow:0 12px 40px rgba(75,23,22,.12);
        transform:translateY(-6px);
        border-color:rgba(255,194,71,.3);
    }
    .contact-card:hover::before { opacity:1; }
    .contact-card--mine { border-top:4px solid var(--gold); }
    .contact-card-header {
        display:flex;
        align-items:center;
        gap:16px;
        padding:28px 24px 18px;
        border-bottom:1px solid var(--line);
        background:linear-gradient(135deg, rgba(255,255,255,.5), rgba(255,255,255,.2));
    }
    .contact-card-icon { font-size:32px; flex-shrink:0; }
    .contact-card-num {
        font:700 10px Inter,sans-serif;
        letter-spacing:.15em;
        text-transform:uppercase;
        color:var(--gold2, #e5a72f);
        margin-bottom:4px;
    }
    .contact-card-header h3 { margin:0; font-size:17px; font-weight:600; color:var(--green); }
    .contact-info { list-style:none; padding:20px 24px 24px; display:flex; flex-direction:column; gap:14px; }
    .contact-info li { display:flex; flex-direction:column; gap:3px; }
    .ci-label { font:600 11px Inter,sans-serif; text-transform:uppercase; letter-spacing:.08em; color:var(--muted); }
    .ci-section { color:var(--green); font-size:11px; font-weight:700; }
    .ci-separator { border-top:1px dashed var(--line); padding-top:14px; margin-top:6px; }
    .ci-value { font:15px Inter,sans-serif; color:var(--ink); font-weight:500; }
    .ci-muted { color:var(--muted); font-style:italic; font-weight:400; }
    .ci-link { color:var(--green); transition:color .2s; cursor:pointer; }
    .ci-link:hover { color:var(--red); text-decoration:underline; }
    .ci-urgent { color:var(--red) !important; font-weight:700; }
    .map-wrap { 
        margin-top:40px; 
        border-radius:14px; 
        overflow:hidden; 
        border:1px solid var(--line); 
        height:420px;
        box-shadow:0 8px 24px rgba(0,0,0,.06);
    }
    .map-wrap iframe { width:100%; height:100%; border:0; display:block; }
    
    /* Responsive grille contact */
    @media(max-width:900px) {
        section > div > div[style*="grid-template-columns:repeat(3"] {
            grid-template-columns:1fr !important;
        }
        form > div > div[style*="grid-column:span 2"] {
            grid-column:span 1 !important;
        }
    }
    
    /* Smooth scroll */
    html { scroll-behavior:smooth; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\contact.blade.php ENDPATH**/ ?>