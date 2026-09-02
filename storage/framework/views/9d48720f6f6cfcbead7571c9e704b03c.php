<?php $__env->startSection('title', $job->exists ? 'Modifier l\'offre' : 'Nouvelle offre'); ?>
<?php $__env->startSection('page-title', $job->exists ? 'Modifier l\'offre' : 'Nouvelle offre'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST"
      action="<?php echo e($job->exists ? route('admin.jobs.update', $job) : route('admin.jobs.store')); ?>">
    <?php echo csrf_field(); ?>
    <?php if($job->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h2><?php echo e($job->exists ? $job->title : "Nouvelle offre d'emploi"); ?></h2>
            <div style="display:flex;gap:8px;align-items:center;">
                <?php if($job->exists): ?>
                    <a href="<?php echo e(route('jobs.show', $job)); ?>" target="_blank" class="btn btn-ghost btn-sm">Voir sur le site ↗</a>
                    <span class="badge <?php echo e($job->is_published ? 'badge-green' : 'badge-gray'); ?>">
                        <?php echo e($job->is_published ? 'Publié' : 'Brouillon'); ?>

                    </span>
                <?php endif; ?>
                <a href="<?php echo e(route('admin.jobs.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
            </div>
        </div>
        <div class="card-body">
            <div class="form-grid">

                
                <div class="form-group full">
                    <label>Intitulé du poste *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $job->title)); ?>" required
                           placeholder="Ex : Ingénieur minier senior">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group">
                    <label>Département *</label>
                    <input type="text" name="department" value="<?php echo e(old('department', $job->department)); ?>" required
                           placeholder="Ex : Mining, Processing, HSE…">
                </div>
                <div class="form-group">
                    <label>Lieu *</label>
                    <input type="text" name="location"
                           value="<?php echo e(old('location', $job->location ?? 'Karma, Burkina Faso')); ?>" required>
                </div>

                
                <div class="form-group">
                    <label>Type de contrat *</label>
                    <input type="text" name="contract_type"
                           value="<?php echo e(old('contract_type', $job->contract_type)); ?>"
                           placeholder="CDI, CDD, Stage…" required>
                </div>
                <div class="form-group">
                    <label>Niveau d'expérience</label>
                    <select name="experience_level">
                        <option value="">— Non précisé —</option>
                        <?php $__currentLoopData = \App\Models\JobOffer::experienceLevels(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $labels): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(old('experience_level', $job->experience_level) === $key ? 'selected' : ''); ?>>
                            <?php echo e($labels['fr']); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="form-group">
                    <label>Rémunération / Fourchette salariale</label>
                    <input type="text" name="salary_range"
                           value="<?php echo e(old('salary_range', $job->salary_range)); ?>"
                           placeholder="Ex : Selon profil · 400–600 k FCFA/mois">
                </div>
                <div class="form-group">
                    <label>Date limite de candidature</label>
                    <input type="date" name="deadline"
                           value="<?php echo e(old('deadline', $job->deadline?->format('Y-m-d'))); ?>">
                    <span class="form-hint">Laisser vide pour une offre sans date d'expiration.</span>
                </div>

                
                <div class="form-group full">
                    <label>Description du poste *</label>
                    <textarea name="description" style="min-height:180px;" required
                              placeholder="Décrivez les missions, le contexte et les responsabilités du poste…"><?php echo e(old('description', $job->description)); ?></textarea>
                </div>

                
                <div class="form-group full">
                    <label>Profil recherché / Exigences</label>
                    <textarea name="requirements" style="min-height:130px;"
                              placeholder="Liste les critères : diplôme, expérience, compétences. Un critère par ligne."><?php echo e(old('requirements', $job->requirements)); ?></textarea>
                    <span class="form-hint">Un critère par ligne — chaque ligne sera affichée avec une coche ✓ sur le site.</span>
                </div>

                
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               <?php echo e(old('is_published', $job->is_published) ? 'checked' : ''); ?>>
                        <label for="is_published"
                               style="text-transform:none;letter-spacing:0;font-size:14px;font-weight:500;color:var(--ink);">
                            Publier cette offre (visible sur le site)
                        </label>
                    </div>
                </div>

                
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_spontaneous" value="0">
                        <input type="checkbox" id="is_spontaneous" name="is_spontaneous" value="1"
                               <?php echo e(old('is_spontaneous', $job->is_spontaneous ?? false) ? 'checked' : ''); ?>>
                        <label for="is_spontaneous"
                               style="text-transform:none;letter-spacing:0;font-size:14px;font-weight:500;color:var(--ink);">
                            Candidature spontanée
                            <span style="font:400 12px Inter,sans-serif;color:var(--muted);display:block;">
                                Cette offre n'apparaît pas dans la liste — elle alimente uniquement la page candidature spontanée.
                            </span>
                        </label>
                    </div>
                </div>

                
                <?php if($job->exists): ?>
                <div class="form-group" style="align-self:center;">
                    <?php $appCount = $job->applications()->count(); ?>
                    <a href="<?php echo e(route('admin.applications.index', ['job' => $job->id])); ?>"
                       style="display:inline-flex;align-items:center;gap:8px;font:500 13px Inter,sans-serif;color:var(--green);">
                        📋 <?php echo e($appCount); ?> candidature(s) reçue(s) →
                    </a>
                </div>
                <?php endif; ?>

                
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">
                        <?php echo e($job->exists ? '✓ Enregistrer les modifications' : '+ Créer l\'offre'); ?>

                    </button>
                    <a href="<?php echo e(route('admin.jobs.index')); ?>" class="btn btn-ghost">Annuler</a>
                    <?php if($job->exists): ?>
                    <form method="POST" action="<?php echo e(route('admin.jobs.destroy', $job)); ?>"
                          style="margin-left:auto;"
                          onsubmit="return confirm('Supprimer définitivement cette offre et ses candidatures ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\jobs\form.blade.php ENDPATH**/ ?>