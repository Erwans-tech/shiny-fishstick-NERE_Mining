<?php $__env->startSection('title', $slide->exists ? 'Modifier la slide' : 'Nouvelle slide'); ?>
<?php $__env->startSection('page-title', $slide->exists ? 'Modifier la slide' : 'Ajouter une slide au carrousel'); ?>

<?php $__env->startSection('content'); ?>

<?php $currentType = old('type', $slide->type ?? 'image'); ?>

<form method="POST"
      action="<?php echo e($slide->exists ? route('admin.hero.update', $slide) : route('admin.hero.store')); ?>"
      enctype="multipart/form-data"
      id="hero-form"
      novalidate>
    <?php echo csrf_field(); ?>
    <?php if($slide->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

        
        <div>

            
            <div class="card" style="margin-bottom:16px;">
                <div class="card-header">
                    <h2>Type de slide</h2>
                    <a href="<?php echo e(route('admin.hero.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
                </div>
                <div class="card-body">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">

                        <label id="tab-image"
                               style="display:flex; align-items:center; gap:14px; padding:18px 20px; border:2px solid <?php echo e($currentType === 'image' ? 'var(--gold)' : 'var(--line)'); ?>; border-radius:10px; cursor:pointer; background:<?php echo e($currentType === 'image' ? 'var(--sand)' : '#fff'); ?>; transition:all .2s;"
                               onclick="setType('image')">
                            <input type="radio" name="type" value="image"
                                   <?php echo e($currentType === 'image' ? 'checked' : ''); ?>

                                   style="display:none;" id="type-image">
                            <span style="font-size:28px;">🖼️</span>
                            <div>
                                <div style="font:600 14px Inter,sans-serif; color:var(--green);">Image</div>
                                <div style="font:12px Inter,sans-serif; color:var(--muted);">JPG, PNG, WebP, GIF</div>
                            </div>
                        </label>

                        <label id="tab-video"
                               style="display:flex; align-items:center; gap:14px; padding:18px 20px; border:2px solid <?php echo e($currentType === 'video' ? 'var(--gold)' : 'var(--line)'); ?>; border-radius:10px; cursor:pointer; background:<?php echo e($currentType === 'video' ? 'var(--sand)' : '#fff'); ?>; transition:all .2s;"
                               onclick="setType('video')">
                            <input type="radio" name="type" value="video"
                                   <?php echo e($currentType === 'video' ? 'checked' : ''); ?>

                                   style="display:none;" id="type-video">
                            <span style="font-size:28px;">🎬</span>
                            <div>
                                <div style="font:600 14px Inter,sans-serif; color:var(--green);">Vidéo</div>
                                <div style="font:12px Inter,sans-serif; color:var(--muted);">YouTube, Vimeo ou MP4</div>
                            </div>
                        </label>

                    </div>
                </div>
            </div>

            
            <div class="card" style="margin-bottom:16px;">
                <div class="card-header"><h2>Informations générales</h2></div>
                <div class="card-body">
                    <div class="form-grid">

                        <div class="form-group full">
                            <label for="title">Titre (usage interne)</label>
                            <input id="title" type="text" name="title"
                                   value="<?php echo e(old('title', $slide->title)); ?>"
                                   placeholder="Ex : Panorama Karma — Août 2025">
                            <span class="form-hint">Visible uniquement dans l'admin, pas sur le site.</span>
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group full">
                            <label for="caption">Légende <span style="font-weight:400; text-transform:none; letter-spacing:0;">(optionnelle — affichée sur le héro)</span></label>
                            <input id="caption" type="text" name="caption"
                                   value="<?php echo e(old('caption', $slide->caption)); ?>"
                                   placeholder="Ex : La mine de Karma vue du ciel"
                                   maxlength="255">
                            <?php $__errorArgs = ['caption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="sort_order">Position</label>
                            <input id="sort_order" type="number" name="sort_order" min="0" max="99"
                                   value="<?php echo e(old('sort_order', $slide->sort_order ?? 0)); ?>">
                            <span class="form-hint">0 = première position.</span>
                        </div>

                        <div class="form-group" style="align-self:end;">
                            <div class="toggle-wrap" style="height:42px;">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" id="is_active" name="is_active" value="1"
                                       <?php echo e(old('is_active', $slide->is_active ?? true) ? 'checked' : ''); ?>>
                                <label for="is_active" style="text-transform:none; letter-spacing:0; font-size:14px; font-weight:500; color:var(--ink);">
                                    Slide visible sur le site
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            
            <div id="block-image" class="card" style="<?php echo e($currentType !== 'image' ? 'display:none;' : ''); ?>">
                <div class="card-header"><h2>🖼️ Image</h2></div>
                <div class="card-body">

                    <?php if($slide->exists && $slide->image_path && $slide->isImage()): ?>
                    <div style="margin-bottom:14px;">
                        <img src="<?php echo e($slide->url); ?>"
                             style="height:140px; border-radius:8px; object-fit:cover; border:1px solid var(--line);"
                             alt="Image actuelle">
                        <div style="font:600 10px Inter,sans-serif; letter-spacing:.1em; color:var(--muted); margin-top:6px; text-transform:uppercase;">
                            Image actuelle
                        </div>
                    </div>
                    <?php endif; ?>

                    <div id="image-drop-zone"
                         style="border:2px dashed var(--line); border-radius:10px; padding:28px 20px; text-align:center; cursor:pointer; transition:border-color .2s, background .2s;"
                         onclick="document.getElementById('image-input').click()"
                         ondragover="event.preventDefault(); this.style.borderColor='var(--gold)'; this.style.background='var(--sand)';"
                         ondragleave="this.style.borderColor='var(--line)'; this.style.background='';"
                         ondrop="handleDrop(event,'image-input','image-preview-wrap','image-drop-text')">
                        <div style="font-size:28px; margin-bottom:8px;">📷</div>
                        <div id="image-drop-text" style="font:500 14px Inter,sans-serif; color:var(--muted);">
                            Cliquez ou glissez une image ici
                        </div>
                        <div style="font:12px Inter,sans-serif; color:var(--muted); margin-top:5px;">
                            JPG · PNG · WebP · GIF — max 10 Mo — recommandé : 1920×1080 px
                        </div>
                    </div>
                    <input type="file" id="image-input" name="image" data-conditional-field="image"
                           accept="image/jpeg,image/png,image/webp,image/gif"
                           style="display:none;"
                           onchange="previewFile(this,'image-preview-wrap','image-drop-text','image-drop-zone')">

                    <div id="image-preview-wrap" style="display:none; margin-top:12px;">
                        <img id="image-preview"
                             style="height:140px; max-width:100%; border-radius:8px; object-fit:cover; border:2px solid var(--gold);"
                             alt="Aperçu">
                        <div style="font:600 11px Inter,sans-serif; color:var(--gold2); margin-top:5px; text-transform:uppercase; letter-spacing:.08em;">
                            ✓ Nouvelle image sélectionnée
                        </div>
                    </div>

                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error" style="margin-top:8px;"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            
            <div id="block-video" class="card" style="<?php echo e($currentType !== 'video' ? 'display:none;' : ''); ?>">
                <div class="card-header"><h2>🎬 Vidéo</h2></div>
                <div class="card-body">
                    <div class="form-grid">

                        
                        <div class="form-group full">
                            <label>Source vidéo</label>
                            <div style="display:flex; gap:12px; margin-top:8px;">
                                <label style="display:flex; align-items:center; gap:8px; padding:10px 16px; border:2px solid var(--line); border-radius:8px; cursor:pointer; flex:1;"
                                       onclick="toggleVideoSource('url')">
                                    <input type="radio" name="video_source" value="url" checked id="video-source-url"
                                           style="width:18px; height:18px;">
                                    <div>
                                        <div style="font:600 13px Inter,sans-serif; color:var(--ink);">URL (YouTube/Vimeo)</div>
                                        <div style="font:11px Inter,sans-serif; color:var(--muted);">Intégration externe</div>
                                    </div>
                                </label>
                                <label style="display:flex; align-items:center; gap:8px; padding:10px 16px; border:2px solid var(--line); border-radius:8px; cursor:pointer; flex:1;"
                                       onclick="toggleVideoSource('file')">
                                    <input type="radio" name="video_source" value="file" id="video-source-file"
                                           style="width:18px; height:18px;">
                                    <div>
                                        <div style="font:600 13px Inter,sans-serif; color:var(--ink);">Fichier MP4</div>
                                        <div style="font:11px Inter,sans-serif; color:var(--muted);">Upload depuis PC (max 50 Mo)</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        
                        <div class="form-group full" id="video-url-field">
                            <label for="video_url">URL de la vidéo</label>
                            <input id="video_url" type="text" name="video_url" data-conditional-field="video_url"
                                   value="<?php echo e(old('video_url', $slide->video_url)); ?>"
                                   placeholder="https://www.youtube.com/watch?v=…  ou  https://vimeo.com/…">
                            <span class="form-hint">
                                Formats acceptés : lien YouTube (<code>youtu.be/…</code>, <code>youtube.com/watch?v=…</code>)
                                ou Vimeo (<code>vimeo.com/…</code>).
                                La vidéo sera intégrée en lecture automatique, muette, en boucle.
                            </span>
                            <?php $__errorArgs = ['video_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="form-group full" id="video-file-field" style="display:none;">
                            <label for="video_file">Fichier vidéo (MP4, WebM, MOV)</label>
                            
                            <div id="video-drop-zone"
                                 style="border:2px dashed var(--line); border-radius:10px; padding:28px 20px; text-align:center; cursor:pointer; transition:border-color .2s, background .2s;"
                                 onclick="document.getElementById('video_file').click()"
                                 ondragover="event.preventDefault(); this.style.borderColor='var(--gold)'; this.style.background='var(--sand)';"
                                 ondragleave="this.style.borderColor='var(--line)'; this.style.background='';"
                                 ondrop="handleDrop(event,'video_file','video-file-preview-wrap','video-drop-text')">
                                <div style="font-size:28px; margin-bottom:8px;">🎥</div>
                                <div id="video-drop-text" style="font:500 14px Inter,sans-serif; color:var(--muted);">
                                    Cliquez ou glissez votre vidéo ici
                                </div>
                                <div style="font:12px Inter,sans-serif; color:var(--muted); margin-top:5px;">
                                    MP4 · WebM · MOV — max 50 Mo — recommandé : 1920×1080 px
                                </div>
                            </div>
                            <input type="file" id="video_file" name="video_file"
                                   accept="video/mp4,video/webm,video/quicktime"
                                   style="display:none;"
                                   onchange="previewVideoFile(this)">

                            <div id="video-file-preview-wrap" style="display:none; margin-top:12px;">
                                <video id="video-file-preview" controls
                                       style="width:100%; max-height:300px; border-radius:8px; object-fit:cover; border:2px solid var(--gold);">
                                </video>
                                <div style="font:600 11px Inter,sans-serif; color:var(--gold2); margin-top:5px; text-transform:uppercase; letter-spacing:.08em;">
                                    ✓ Vidéo sélectionnée
                                </div>
                                <div style="font:12px Inter,sans-serif; color:var(--muted); margin-top:4px;">
                                    ⚡ Une image de couverture sera générée automatiquement
                                </div>
                            </div>
                            
                            <?php $__errorArgs = ['video_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error" style="margin-top:8px;"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="form-group full" id="video-preview-container"
                             style="<?php echo e(old('video_url', $slide->video_url) ? '' : 'display:none;'); ?>">
                            <label>Aperçu</label>
                            <div style="position:relative; padding-bottom:35%; border-radius:8px; overflow:hidden; background:#000; border:1px solid var(--line);">
                                <iframe id="video-preview-frame"
                                        style="position:absolute; inset:0; width:100%; height:100%; border:0;"
                                        src="<?php echo e($slide->embed_url ?? ''); ?>"
                                        allow="autoplay; encrypted-media"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        </div>

                        
                        <div class="form-group full">
                            <label>Image de couverture <span style="font-weight:400; text-transform:none; letter-spacing:0;">(optionnelle — générée auto pour MP4)</span></label>

                            <?php if($slide->exists && $slide->image_path && $slide->isVideo()): ?>
                            <div style="margin-bottom:10px;">
                                <img src="<?php echo e($slide->url); ?>"
                                     style="height:100px; border-radius:6px; object-fit:cover; border:1px solid var(--line);"
                                     alt="Couverture actuelle">
                            </div>
                            <?php endif; ?>

                            <div id="cover-drop-zone"
                                 style="border:2px dashed var(--line); border-radius:8px; padding:20px; text-align:center; cursor:pointer; transition:border-color .2s;"
                                 onclick="document.getElementById('cover-input').click()"
                                 ondragover="event.preventDefault(); this.style.borderColor='var(--gold)';"
                                 ondragleave="this.style.borderColor='var(--line)';"
                                 ondrop="handleDrop(event,'cover-input','cover-preview-wrap','cover-drop-text')">
                                <div style="font-size:20px; margin-bottom:6px;">🎞️</div>
                                <div id="cover-drop-text" style="font:500 13px Inter,sans-serif; color:var(--muted);">
                                    Cliquez pour uploader une image de couverture personnalisée
                                </div>
                            </div>
                            <input type="file" id="cover-input" name="cover_image" data-conditional-field="cover_image"
                                   accept="image/jpeg,image/png,image/webp"
                                   style="display:none;"
                                   onchange="previewFile(this,'cover-preview-wrap','cover-drop-text','cover-drop-zone')">
                            <div id="cover-preview-wrap" style="display:none; margin-top:10px;">
                                <img id="cover-preview"
                                     style="height:100px; border-radius:6px; object-fit:cover; border:2px solid var(--gold);"
                                     alt="Aperçu couverture">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            
            <div class="card" style="margin-top:16px;">
                <div class="card-body">
                    <div class="form-actions" style="border:0; padding:0; margin:0; display:flex; gap:8px; align-items:center;">
                        <button type="submit" class="btn btn-primary">
                            <?php echo e($slide->exists ? '✓ Enregistrer' : '+ Ajouter au carrousel'); ?>

                        </button>
                        <a href="<?php echo e(route('admin.hero.index')); ?>" class="btn btn-ghost">Annuler</a>
                        <?php if($slide->exists): ?>
                        <button type="button" class="btn btn-danger" style="margin-left:auto;"
                                onclick="deleteSlide()">
                            Supprimer
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        
        <div style="position:sticky; top:76px;">
            <div class="card">
                <div class="card-header"><h2>💡 Conseils</h2></div>
                <div class="card-body" style="display:flex; flex-direction:column; gap:16px; font:13px Inter,sans-serif;">

                    <div id="tips-image" style="<?php echo e($currentType !== 'image' ? 'display:none;' : ''); ?>">
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">📐</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Format recommandé</strong>
                            1920 × 1080 px (16:9). Images plus petites = risque de flou.</div>
                        </div>
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">⚡</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Performance</strong>
                            Compressez à &lt; 500 Ko (Squoosh.app ou TinyPNG).</div>
                        </div>
                        <div style="display:flex; gap:10px;">
                            <span style="font-size:16px;">🎨</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Zone de lisibilité</strong>
                            Le texte du héro couvre la gauche de l'image. Évitez les sujets importants dans le tiers gauche.</div>
                        </div>
                    </div>

                    <div id="tips-video" style="<?php echo e($currentType !== 'video' ? 'display:none;' : ''); ?>">
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">▶️</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Deux options</strong>
                            <strong>URL:</strong> YouTube/Vimeo (intégration externe, lecture auto, muette, en boucle)<br>
                            <strong>Fichier:</strong> MP4/WebM depuis votre PC (max 50 Mo, couverture auto-générée)</div>
                        </div>
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">🎬</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Génération automatique</strong>
                            Si vous uploadez un MP4, une image de couverture sera générée automatiquement depuis la 1ère frame.</div>
                        </div>
                        <div style="display:flex; gap:10px; margin-bottom:12px;">
                            <span style="font-size:16px;">🔇</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Lecture muette</strong>
                            Les navigateurs exigent que les vidéos en lecture automatique soient muettes. C'est géré automatiquement.</div>
                        </div>
                        <div style="display:flex; gap:10px;">
                            <span style="font-size:16px;">📐</span>
                            <div><strong style="color:var(--green); display:block; margin-bottom:3px;">Format recommandé</strong>
                            1920×1080 px (16:9) pour une qualité optimale. Compressez pour réduire le poids.</div>
                        </div>
                    </div>

                </div>
            </div>

            <?php if($slide->exists): ?>
            <div class="card" style="margin-top:14px;">
                <div class="card-header"><h2>📊 Informations</h2></div>
                <div class="card-body" style="font:13px Inter,sans-serif; color:var(--muted); display:flex; flex-direction:column; gap:8px;">
                    <div><strong style="color:var(--ink);">Type :</strong>
                        <span class="badge <?php echo e($slide->type === 'video' ? 'badge-blue' : 'badge-green'); ?>">
                            <?php echo e($slide->type === 'video' ? '🎬 Vidéo' : '🖼️ Image'); ?>

                        </span>
                    </div>
                    <?php if($slide->image_path): ?>
                    <div><strong style="color:var(--ink);">Fichier :</strong> <?php echo e(basename($slide->image_path)); ?></div>
                    <?php endif; ?>
                    <?php if($slide->video_url): ?>
                    <div><strong style="color:var(--ink);">URL vidéo :</strong>
                        <a href="<?php echo e($slide->video_url); ?>" target="_blank" style="color:var(--green); word-break:break-all;">
                            <?php echo e(Str::limit($slide->video_url, 50)); ?>

                        </a>
                    </div>
                    <?php endif; ?>
                    <div><strong style="color:var(--ink);">Position :</strong> <?php echo e($slide->sort_order + 1); ?></div>
                    <div><strong style="color:var(--ink);">Statut :</strong>
                        <span class="badge <?php echo e($slide->is_active ? 'badge-green' : 'badge-gray'); ?>">
                            <?php echo e($slide->is_active ? 'Visible' : 'Masquée'); ?>

                        </span>
                    </div>
                    <div><strong style="color:var(--ink);">Ajoutée le :</strong> <?php echo e($slide->created_at?->format('d/m/Y à H:i')); ?></div>
                </div>
            </div>
            <?php endif; ?>
        </div>

    </div>
</form>

<script>
function setType(type) {
    // Update radio
    document.getElementById('type-' + type).checked = true;
    
    // Update tab styling
    var imgTab   = document.getElementById('tab-image');
    var vidTab   = document.getElementById('tab-video');
    
    if (type === 'image') {
        imgTab.style.borderColor = 'var(--gold)';
        imgTab.style.background = 'var(--sand)';
        vidTab.style.borderColor = 'var(--line)';
        vidTab.style.background = '#fff';
    } else {
        imgTab.style.borderColor = 'var(--line)';
        imgTab.style.background = '#fff';
        vidTab.style.borderColor = 'var(--gold)';
        vidTab.style.background = 'var(--sand)';
    }
    
    // Show/hide blocks
    document.getElementById('block-image').style.display = type === 'image' ? '' : 'none';
    document.getElementById('block-video').style.display = type === 'video' ? '' : 'none';
    
    // Show/hide tips
    document.getElementById('tips-image').style.display = type === 'image' ? '' : 'none';
    document.getElementById('tips-video').style.display = type === 'video' ? '' : 'none';
}

function previewFile(input, wrapId, textId, zoneId) {
    if (!input.files || !input.files[0]) return;
    var file = input.files[0];
    var wrap = document.getElementById(wrapId);
    var previewImg = wrap ? wrap.querySelector('img') : null;

    if (previewImg && file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            wrap.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    var textEl = document.getElementById(textId);
    if (textEl) textEl.textContent = '✓ ' + file.name + ' (' + (file.size / 1024).toFixed(0) + ' Ko)';

    var zone = document.getElementById(zoneId);
    if (zone) { 
        zone.style.borderColor = 'var(--gold)'; 
        zone.style.background = 'var(--sand)'; 
    }
}

function handleDrop(event, inputId, wrapId, textId) {
    event.preventDefault();
    var files = event.dataTransfer.files;
    if (!files.length) return;
    var input = document.getElementById(inputId);
    var dt = new DataTransfer();
    dt.items.add(files[0]);
    input.files = dt.files;
    previewFile(input, wrapId, textId, event.currentTarget.id);
    event.currentTarget.style.borderColor = 'var(--line)';
    event.currentTarget.style.background = '';
}

// YouTube/Vimeo preview
var videoInput = document.getElementById('video_url');
if (videoInput) {
    videoInput.addEventListener('input', function() {
        var url = this.value.trim();
        var embedUrl = getEmbedUrl(url);
        var container = document.getElementById('video-preview-container');
        var frame     = document.getElementById('video-preview-frame');
        if (embedUrl && container && frame) {
            frame.src = embedUrl;
            container.style.display = '';
        } else if (container) {
            container.style.display = 'none';
        }
    });
}

function getEmbedUrl(url) {
    // YouTube
    var ytMatch = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([A-Za-z0-9_\-]{11})/);
    if (ytMatch) {
        return 'https://www.youtube.com/embed/' + ytMatch[1] + '?autoplay=1&mute=1&loop=1&playlist=' + ytMatch[1] + '&controls=0&rel=0';
    }
    // Vimeo
    var vmMatch = url.match(/vimeo\.com\/(\d+)/);
    if (vmMatch) {
        return 'https://player.vimeo.com/video/' + vmMatch[1] + '?autoplay=1&muted=1&loop=1&background=1';
    }
    return null;
}

// Toggle video source (URL vs File)
function toggleVideoSource(source) {
    var urlField = document.getElementById('video-url-field');
    var fileField = document.getElementById('video-file-field');
    var urlPreview = document.getElementById('video-preview-container');
    
    if (source === 'url') {
        urlField.style.display = '';
        fileField.style.display = 'none';
        document.getElementById('video-source-url').checked = true;
    } else {
        urlField.style.display = 'none';
        fileField.style.display = '';
        urlPreview.style.display = 'none';
        document.getElementById('video-source-file').checked = true;
    }
}

// Preview video file
function previewVideoFile(input) {
    if (!input.files || !input.files[0]) return;
    
    var file = input.files[0];
    var wrap = document.getElementById('video-file-preview-wrap');
    var video = document.getElementById('video-file-preview');
    var textEl = document.getElementById('video-drop-text');
    
    if (video && file.type.startsWith('video/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
            video.src = e.target.result;
            wrap.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
    
    if (textEl) {
        textEl.textContent = '✓ ' + file.name + ' (' + (file.size / 1024 / 1024).toFixed(1) + ' Mo)';
    }
    
    var zone = document.getElementById('video-drop-zone');
    if (zone) { 
        zone.style.borderColor = 'var(--gold)'; 
        zone.style.background = 'var(--sand)'; 
    }
}

// Form submission - simple and clean
document.getElementById('hero-form').addEventListener('submit', function(e) {
    var selectedType = document.querySelector('input[name="type"]:checked')?.value;
    
    if (!selectedType) {
        e.preventDefault();
        alert('Sélectionnez un type (Image ou Vidéo)');
        return false;
    }
    
    // If IMAGE type but no file selected, show error
    if (selectedType === 'image') {
        var imageFile = document.getElementById('image-input');
        var hasExistingImage = '<?php echo e($slide->image_path && $slide->isImage() ? "yes" : "no"); ?>' === 'yes';
        
        if (!imageFile.files.length && !hasExistingImage) {
            e.preventDefault();
            alert('Veuillez sélectionner une image');
            return false;
        }
    }
    
    // If VIDEO type, check URL or File
    if (selectedType === 'video') {
        var videoSource = document.querySelector('input[name="video_source"]:checked')?.value;
        
        if (videoSource === 'url') {
            var videoUrl = document.getElementById('video_url').value.trim();
            if (!videoUrl) {
                e.preventDefault();
                alert('Veuillez entrer une URL vidéo (YouTube ou Vimeo)');
                return false;
            }
        } else if (videoSource === 'file') {
            var videoFile = document.getElementById('video_file');
            if (!videoFile.files.length) {
                e.preventDefault();
                alert('Veuillez sélectionner un fichier vidéo (MP4, WebM, MOV)');
                return false;
            }
        }
    }
});

// Delete button handler
function deleteSlide() {
    if (!confirm('Êtes-vous sûr ? Cette action ne peut pas être annulée.')) {
        return;
    }
    
    <?php if($slide->exists): ?>
    fetch('<?php echo e(route("admin.hero.destroy", $slide->id)); ?>', {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            window.location.href = '<?php echo e(route("admin.hero.index")); ?>';
        } else {
            alert('Erreur lors de la suppression');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors de la suppression');
    });
    <?php endif; ?>
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/admin/hero/form.blade.php ENDPATH**/ ?>