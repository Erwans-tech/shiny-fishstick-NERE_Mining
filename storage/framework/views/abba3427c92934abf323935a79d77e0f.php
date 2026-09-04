<?php $__env->startSection('title', 'Paramètres du site'); ?>
<?php $__env->startSection('page-title', 'Paramètres du site'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h2>⚙️ Paramètres du site</h2>
        <span class="card-header-sub">Configurer les paramètres généraux du site</span>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success" style="margin:0 20px 16px;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.settings.update')); ?>" class="card-body">
        <?php echo csrf_field(); ?>

        <?php $__empty_1 = true; $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $categorySettings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <fieldset style="margin-bottom:32px;">
                <legend style="font:600 16px Inter,sans-serif; color:var(--green); text-transform:capitalize; margin-bottom:16px; border-bottom:2px solid var(--line); padding-bottom:12px;">
                    <?php if($category === 'carousel'): ?>
                        🎬 Carrousel héro
                    <?php elseif($category === 'press'): ?>
                        Contact presse
                    <?php else: ?>
                        <?php echo e($category); ?>

                    <?php endif; ?>
                </legend>

                <?php $__currentLoopData = $categorySettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $labelText = implode(' ', array_slice(explode('_', $setting->key), 1));
                        $descriptions = [
                            'press_contact_name' => 'Nom affiché sur la fiche de contact presse publique',
                            'press_contact_job' => 'Fonction affichée sous le nom du contact presse',
                            'press_contact_photo' => 'URL de la photo affichée sur la fiche de contact presse (laisser vide pour le placeholder)',
                            'press_contact_phone' => 'Numéro affiché pour le contact presse',
                            'press_contact_email' => 'Adresse e-mail affichée et utilisée pour le contact presse',
                            'press_contact_hours' => 'Plage horaire affichée pour la disponibilité presse',
                            'carousel_autoplay' => 'Active la rotation automatique des slides',
                            'carousel_interval' => 'Durée d\'affichage de chaque slide (en millisecondes)',
                            'carousel_transition_speed' => 'Vitesse de transition entre les slides (en millisecondes)',
                            'carousel_pause_on_hover' => 'Mettre en pause le carrousel au survol de la souris',
                            'carousel_show_indicators' => 'Afficher les points indicateurs en bas',
                            'carousel_show_arrows' => 'Afficher les flèches de navigation',
                        ];
                    ?>

                    <div class="form-group" style="margin-bottom:20px;">
                        <?php if($setting->type === 'boolean'): ?>
                            
                            <div class="toggle-wrap">
                                <input type="hidden" name="settings[<?php echo e($setting->key); ?>]" value="false">
                                <input type="checkbox" id="settings_<?php echo e($setting->key); ?>" 
                                       name="settings[<?php echo e($setting->key); ?>]" 
                                       value="true"
                                       <?php echo e($setting->value === 'true' ? 'checked' : ''); ?>>
                                <label for="settings_<?php echo e($setting->key); ?>" style="text-transform:none; letter-spacing:0; font-size:14px; font-weight:500; color:var(--ink);">
                                    <?php echo e(ucfirst($labelText)); ?>

                                </label>
                            </div>
                            <?php if(isset($descriptions[$setting->key])): ?>
                            <span class="form-hint" style="margin-top:4px;">
                                <?php echo e($descriptions[$setting->key]); ?>

                            </span>
                            <?php endif; ?>

                        <?php elseif($setting->type === 'number'): ?>
                            <label for="settings[<?php echo e($setting->key); ?>]">
                                <?php echo e(ucfirst($labelText)); ?>

                            </label>
                            <input type="number" name="settings[<?php echo e($setting->key); ?>]" id="settings[<?php echo e($setting->key); ?>]" 
                                   value="<?php echo e($setting->value); ?>" 
                                   min="0"
                                   step="<?php echo e(in_array($setting->key, ['carousel_interval', 'carousel_transition_speed']) ? '100' : '1'); ?>"
                                   style="width:200px; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                            <?php if(isset($descriptions[$setting->key])): ?>
                            <span class="form-hint">
                                <?php echo e($descriptions[$setting->key]); ?>

                                <?php if($setting->key === 'carousel_interval'): ?>
                                    — Valeur actuelle : <?php echo e(number_format($setting->value / 1000, 1)); ?> secondes
                                <?php elseif($setting->key === 'carousel_transition_speed'): ?>
                                    — Valeur actuelle : <?php echo e(number_format($setting->value / 1000, 2)); ?> secondes
                                <?php endif; ?>
                            </span>
                            <?php endif; ?>

                        <?php elseif($setting->type === 'textarea'): ?>
                            <label for="settings[<?php echo e($setting->key); ?>]">
                                <?php echo e(ucfirst($labelText)); ?>

                            </label>
                            <textarea name="settings[<?php echo e($setting->key); ?>]" id="settings[<?php echo e($setting->key); ?>]" 
                                      style="width:100%; min-height:120px; padding:10px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif; resize:vertical;"><?php echo e($setting->value); ?></textarea>
                            <?php if(isset($descriptions[$setting->key])): ?>
                            <span class="form-hint"><?php echo e($descriptions[$setting->key]); ?></span>
                            <?php endif; ?>

                        <?php elseif($setting->type === 'email'): ?>
                            <label for="settings[<?php echo e($setting->key); ?>]">
                                <?php echo e(ucfirst($labelText)); ?>

                            </label>
                            <input type="email" name="settings[<?php echo e($setting->key); ?>]" id="settings[<?php echo e($setting->key); ?>]" 
                                   value="<?php echo e($setting->value); ?>" 
                                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                            <?php if(isset($descriptions[$setting->key])): ?>
                            <span class="form-hint"><?php echo e($descriptions[$setting->key]); ?></span>
                            <?php endif; ?>

                        <?php elseif($setting->type === 'url'): ?>
                            <label for="settings[<?php echo e($setting->key); ?>]">
                                <?php echo e(ucfirst($labelText)); ?>

                            </label>
                            <input type="url" name="settings[<?php echo e($setting->key); ?>]" id="settings[<?php echo e($setting->key); ?>]" 
                                   value="<?php echo e($setting->value); ?>" 
                                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                            <?php if(isset($descriptions[$setting->key])): ?>
                            <span class="form-hint"><?php echo e($descriptions[$setting->key]); ?></span>
                            <?php endif; ?>

                        <?php else: ?>
                            <label for="settings[<?php echo e($setting->key); ?>]">
                                <?php echo e(ucfirst($labelText)); ?>

                            </label>
                            <input type="text" name="settings[<?php echo e($setting->key); ?>]" id="settings[<?php echo e($setting->key); ?>]" 
                                   value="<?php echo e($setting->value); ?>" 
                                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                            <?php if(isset($descriptions[$setting->key])): ?>
                            <span class="form-hint"><?php echo e($descriptions[$setting->key]); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </fieldset>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="color:var(--muted); text-align:center; padding:40px;">Aucun paramètre à afficher.</p>
        <?php endif; ?>

        <div style="display:flex; gap:12px; margin-top:28px; padding-top:20px; border-top:2px solid var(--line);">
            <button type="submit" class="btn btn-primary">💾 Enregistrer les paramètres</button>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-ghost">Annuler</a>
        </div>
    </form>
</div>


<?php if($grouped->has('carousel')): ?>
<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <h2>👁️ Aperçu en direct</h2>
        <span class="card-header-sub">Les paramètres seront appliqués au carrousel du site</span>
    </div>
    <div class="card-body">
        <div style="background:#faf8f4; padding:20px; border-radius:8px; border:1px solid var(--line);">
            <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:16px; font:13px Inter,sans-serif;">
                <div>
                    <strong style="color:var(--green); display:block; margin-bottom:6px;">Durée par slide</strong>
                    <span id="preview-interval">5 secondes</span>
                </div>
                <div>
                    <strong style="color:var(--green); display:block; margin-bottom:6px;">Vitesse transition</strong>
                    <span id="preview-speed">0.8 secondes</span>
                </div>
                <div>
                    <strong style="color:var(--green); display:block; margin-bottom:6px;">Lecture automatique</strong>
                    <span id="preview-autoplay">Activée</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Update preview live
document.addEventListener('DOMContentLoaded', function() {
    var intervalInput = document.getElementById('settings[carousel_interval]');
    var speedInput = document.getElementById('settings[carousel_transition_speed]');
    var autoplayInput = document.getElementById('settings_carousel_autoplay');
    
    if (intervalInput) {
        intervalInput.addEventListener('input', function() {
            document.getElementById('preview-interval').textContent = (this.value / 1000).toFixed(1) + ' secondes';
        });
    }
    
    if (speedInput) {
        speedInput.addEventListener('input', function() {
            document.getElementById('preview-speed').textContent = (this.value / 1000).toFixed(2) + ' secondes';
        });
    }
    
    if (autoplayInput) {
        autoplayInput.addEventListener('change', function() {
            document.getElementById('preview-autoplay').textContent = this.checked ? 'Activée' : 'Désactivée';
        });
    }
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\settings\index.blade.php ENDPATH**/ ?>