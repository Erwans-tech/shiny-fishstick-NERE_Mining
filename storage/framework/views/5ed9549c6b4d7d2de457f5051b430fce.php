<?php $__env->startSection('title', 'Candidature de '.$application->full_name); ?>
<?php $__env->startSection('page-title', 'Dossier de candidature'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:grid;grid-template-columns:1fr 320px;gap:24px;align-items:start;">

    
    <div>
        
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header">
                <div>
                    <h2 style="font-size:20px;"><?php echo e($application->full_name); ?></h2>
                    <div style="font:13px Inter,sans-serif;color:var(--muted);margin-top:4px;">
                        Candidature pour : <strong style="color:var(--green);"><?php echo e($application->jobOffer?->title ?? 'Poste inconnu'); ?></strong>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.applications.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>E-mail</label>
                        <div style="padding:8px 0;">
                            <a href="mailto:<?php echo e($application->email); ?>" style="color:var(--green);"><?php echo e($application->email); ?></a>
                        </div>
                    </div>
                    <?php if($application->phone): ?>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <div style="padding:8px 0;"><?php echo e($application->phone); ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if($application->nationality): ?>
                    <div class="form-group">
                        <label>Nationalité</label>
                        <div style="padding:8px 0;"><?php echo e($application->nationality); ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if($application->current_position): ?>
                    <div class="form-group">
                        <label>Poste actuel</label>
                        <div style="padding:8px 0;"><?php echo e($application->current_position); ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if($application->experience_years): ?>
                    <div class="form-group">
                        <label>Années d'expérience</label>
                        <div style="padding:8px 0;"><?php echo e($application->experience_years); ?></div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Reçue le</label>
                        <div style="padding:8px 0;color:var(--muted);"><?php echo e($application->created_at->format('d/m/Y à H:i')); ?></div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header"><h2>Lettre de motivation</h2></div>
            <div class="card-body">
                <div style="background:#f9f7f4;border:1px solid var(--line);border-radius:6px;padding:18px;font:15px/1.75 Inter,sans-serif;color:var(--ink);white-space:pre-line;"><?php echo e($application->motivation); ?></div>
            </div>
        </div>

        
        <?php if($application->cv_path || $application->cover_letter_path): ?>
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header"><h2>Pièces jointes</h2></div>
            <div class="card-body" style="display:flex;gap:14px;flex-wrap:wrap;">
                <?php if($application->cv_path): ?>
                <a href="<?php echo e(route('admin.applications.cv', $application)); ?>" target="_blank"
                   class="btn btn-gold" style="display:inline-flex;align-items:center;gap:8px;">
                    📎 Télécharger le CV
                </a>
                <?php endif; ?>
                <?php if($application->cover_letter_path): ?>
                <a href="<?php echo e(route('admin.applications.cover-letter', $application)); ?>" target="_blank"
                   class="btn btn-ghost" style="display:inline-flex;align-items:center;gap:8px;">
                    📄 Lettre de motivation
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        
        <div class="card">
            <div class="card-header"><h2>Répondre par e-mail</h2></div>
            <div class="card-body">
                <?php
                    $applicationTemplateKey = match($application->status) {
                        'interview' => 'interview',
                        'accepted' => 'accepted',
                        'rejected' => 'rejected',
                        default => 'received',
                    };
                    $applicationTemplates = [
                        'received' => [
                            'label' => 'Accusé de réception',
                            'subject' => 'Votre candidature — '.$application->jobOffer?->title,
                            'body' => "Bonjour :first_name,\n\nNous vous confirmons la bonne réception de votre candidature au poste de :job_title. Notre équipe va étudier votre dossier avec attention et reviendra vers vous dès que possible.\n\nCordialement,\nL'équipe Néré Mining",
                        ],
                        'interview' => [
                            'label' => 'Proposer un entretien',
                            'subject' => 'Entretien — '.$application->jobOffer?->title,
                            'body' => "Bonjour :first_name,\n\nAprès examen de votre candidature au poste de :job_title, nous souhaitons échanger avec vous lors d'un entretien. Merci de nous indiquer vos disponibilités afin que nous puissions convenir d'un créneau.\n\nCordialement,\nL'équipe Néré Mining",
                        ],
                        'accepted' => [
                            'label' => 'Candidature retenue',
                            'subject' => 'Suite à votre candidature — '.$application->jobOffer?->title,
                            'body' => "Bonjour :first_name,\n\nNous avons le plaisir de vous informer que votre candidature au poste de :job_title a retenu notre attention. Nous vous contacterons prochainement pour vous communiquer les prochaines étapes.\n\nCordialement,\nL'équipe Néré Mining",
                        ],
                        'rejected' => [
                            'label' => 'Réponse négative',
                            'subject' => 'Suite à votre candidature — '.$application->jobOffer?->title,
                            'body' => "Bonjour :first_name,\n\nNous vous remercions pour l'intérêt porté à Néré Mining et pour le temps consacré à votre candidature au poste de :job_title. Après étude attentive de votre dossier, nous ne sommes malheureusement pas en mesure de donner une suite favorable à votre candidature.\n\nNous vous souhaitons pleine réussite dans vos projets.\n\nCordialement,\nL'équipe Néré Mining",
                        ],
                    ];
                ?>
                <div class="form-group" style="margin-bottom:14px;">
                    <label for="application-template">Réponse pré-enregistrée</label>
                    <select id="application-template" style="width:100%;margin-top:6px;">
                        <?php $__currentLoopData = $applicationTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e($applicationTemplateKey === $key ? 'selected' : ''); ?>><?php echo e($template['label']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <textarea id="application-reply" style="width:100%;min-height:170px;margin-bottom:14px;border:1px solid var(--line);border-radius:6px;padding:12px;font:14px/1.6 Inter,sans-serif;resize:vertical;"></textarea>
                <a id="application-mail-link" href="#" class="btn btn-primary" style="display:inline-flex;align-items:center;gap:8px;">
                    ✉️ Préparer l’e-mail à <?php echo e($application->first_name); ?>

                </a>
            </div>
        </div>
    </div>

    
    <div>
        <div class="card">
            <div class="card-header"><h2>Statut & Notes</h2></div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('admin.applications.status', $application)); ?>">
                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                    <div class="form-group" style="margin-bottom:16px;">
                        <label>Statut de la candidature</label>
                        <select name="status" style="width:100%;margin-top:6px;">
                            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e($application->status === $key ? 'selected' : ''); ?>>
                                <?php echo e($s['label']); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom:20px;">
                        <label>Notes internes</label>
                        <textarea name="admin_notes" style="width:100%;min-height:100px;margin-top:6px;border:1px solid var(--line);border-radius:6px;padding:10px 12px;font:14px Inter,sans-serif;resize:vertical;"><?php echo e($application->admin_notes); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;">✓ Mettre à jour</button>
                </form>

                <div style="margin-top:16px;padding-top:16px;border-top:1px solid var(--line);">
                    <form method="POST" action="<?php echo e(route('admin.applications.destroy', $application)); ?>"
                          onsubmit="return confirm('Supprimer définitivement cette candidature ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger" style="width:100%;">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="card" style="margin-top:16px;">
            <div class="card-header"><h2>Offre liée</h2></div>
            <div class="card-body">
                <?php if($application->jobOffer): ?>
                <div style="font:600 14px Inter,sans-serif;color:var(--green);margin-bottom:6px;"><?php echo e($application->jobOffer->title); ?></div>
                <div style="font:13px Inter,sans-serif;color:var(--muted);margin-bottom:12px;">
                    <?php echo e($application->jobOffer->department); ?> · <?php echo e($application->jobOffer->contract_type); ?>

                </div>
                <a href="<?php echo e(route('admin.jobs.edit', $application->jobOffer)); ?>" class="btn btn-ghost btn-sm">
                    Voir l'offre →
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    (() => {
        const templates = <?php echo json_encode($applicationTemplates, 15, 512) ?>;
        const firstName = <?php echo json_encode($application->first_name, 15, 512) ?>;
        const jobTitle = <?php echo json_encode($application->jobOffer?->title ?? 'l’offre sélectionnée', 15, 512) ?>;
        const recipient = <?php echo json_encode($application->email, 15, 512) ?>;
        const selector = document.getElementById('application-template');
        const reply = document.getElementById('application-reply');
        const link = document.getElementById('application-mail-link');

        const refreshMailto = () => {
            const template = templates[selector.value];
            const body = reply.value.replaceAll(':first_name', firstName).replaceAll(':job_title', jobTitle);
            link.href = `mailto:${recipient}?subject=${encodeURIComponent(template.subject)}&body=${encodeURIComponent(body)}`;
        };

        const selectTemplate = () => {
            reply.value = templates[selector.value].body;
            refreshMailto();
        };

        selector.addEventListener('change', selectTemplate);
        reply.addEventListener('input', refreshMailto);
        selectTemplate();
    })();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\applications\show.blade.php ENDPATH**/ ?>