<?php $__env->startSection('title', 'Upload Multiple d\'Images'); ?>
<?php $__env->startSection('page-title', 'Upload Multiple'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .upload-zone {
        border: 3px dashed var(--line);
        border-radius: 12px;
        padding: 60px 40px;
        text-align: center;
        background: var(--sand);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }
    .upload-zone:hover,
    .upload-zone.drag-over {
        border-color: var(--gold);
        background: rgba(255, 194, 71, 0.1);
    }
    .upload-zone.drag-over {
        transform: scale(1.02);
    }
    .upload-icon {
        font-size: 64px;
        margin-bottom: 16px;
        opacity: 0.6;
    }
    .upload-text {
        font-size: 18px;
        font-weight: 600;
        color: var(--green);
        margin-bottom: 8px;
    }
    .upload-hint {
        font-size: 13px;
        color: var(--muted);
    }
    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 16px;
        margin-top: 32px;
    }
    .preview-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        background: white;
        border: 2px solid var(--line);
    }
    .preview-img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        display: block;
    }
    .preview-remove {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(215, 47, 47, 0.95);
        color: white;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s;
    }
    .preview-remove:hover {
        transform: scale(1.1);
        background: var(--red);
    }
    .preview-name {
        padding: 8px;
        font-size: 11px;
        color: var(--muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        background: var(--light);
    }
    .upload-summary {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        background: white;
        border-radius: 8px;
        border: 1px solid var(--line);
        margin-top: 24px;
    }
    .summary-stat {
        font-size: 14px;
        color: var(--muted);
    }
    .summary-stat strong {
        font-size: 24px;
        color: var(--green);
        display: block;
        margin-bottom: 4px;
    }
    .progress-bar {
        width: 100%;
        height: 4px;
        background: var(--line);
        border-radius: 2px;
        overflow: hidden;
        margin-top: 16px;
        display: none;
    }
    .progress-fill {
        height: 100%;
        background: var(--gold);
        width: 0%;
        transition: width 0.3s ease;
    }
    .upload-zone.uploading {
        pointer-events: none;
        opacity: 0.6;
    }
</style>

<form method="POST" action="<?php echo e(route('admin.media.bulk.store')); ?>" enctype="multipart/form-data" id="bulk-upload-form">
    <?php echo csrf_field(); ?>
    
    <div class="card">
        <div class="card-header">
            <h2>Upload Multiple d'Images</h2>
            <a href="<?php echo e(route('admin.media.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        
        <div class="card-body">
            <!-- Upload Zone -->
            <div class="upload-zone" id="upload-zone">
                <input type="file" 
                       name="files[]" 
                       id="file-input" 
                       multiple 
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       style="display: none;">
                
                <div class="upload-icon">📸</div>
                <div class="upload-text">Glissez vos images ici</div>
                <div class="upload-hint">ou cliquez pour sélectionner (JPG, PNG, WebP • Max 10MB par image • Max 50 images)</div>
            </div>

            <!-- Preview Grid -->
            <div class="preview-grid" id="preview-grid" style="display: none;"></div>

            <!-- Upload Summary -->
            <div class="upload-summary" id="upload-summary" style="display: none;">
                <div class="summary-stat">
                    <strong id="file-count">0</strong>
                    Images sélectionnées
                </div>
                <div class="summary-stat">
                    <strong id="total-size">0 MB</strong>
                    Taille totale
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar" id="progress-bar">
                <div class="progress-fill" id="progress-fill"></div>
            </div>

            <!-- Options -->
            <div class="form-grid" style="margin-top: 32px;">
                <div class="form-group">
                    <label>Emplacement *</label>
                    <select name="placement" required>
                        <option value="gallery">Médiathèque</option>
                        <option value="homepage_slideshow">Diaporama de l'accueil</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Album (optionnel)</label>
                    <?php if($albums->isNotEmpty()): ?>
                    <select name="album_id">
                        <option value="">Aucun album</option>
                        <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($album->id); ?>"><?php echo e($album->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php else: ?>
                    <p style="padding:12px;background:var(--sand);border-radius:6px;font-size:13px;color:var(--muted);">
                        ℹ️ Aucun album créé. <a href="<?php echo e(route('admin.albums.create')); ?>" style="color:var(--green);text-decoration:underline;">Créer un album</a>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1" checked>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">
                            Publier les images sur le site
                        </label>
                    </div>
                </div>

                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary" id="submit-btn" disabled>
                        ⬆️ Uploader <span id="btn-count"></span>
                    </button>
                    <a href="<?php echo e(route('admin.media.index')); ?>" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
(function() {
    'use strict';

    const uploadZone = document.getElementById('upload-zone');
    const fileInput = document.getElementById('file-input');
    const previewGrid = document.getElementById('preview-grid');
    const uploadSummary = document.getElementById('upload-summary');
    const fileCountEl = document.getElementById('file-count');
    const totalSizeEl = document.getElementById('total-size');
    const submitBtn = document.getElementById('submit-btn');
    const btnCount = document.getElementById('btn-count');
    const form = document.getElementById('bulk-upload-form');
    const progressBar = document.getElementById('progress-bar');
    const progressFill = document.getElementById('progress-fill');

    let selectedFiles = [];

    // Click to select files
    uploadZone.addEventListener('click', () => fileInput.click());

    // File input change
    fileInput.addEventListener('change', (e) => {
        handleFiles(Array.from(e.target.files));
    });

    // Drag and drop
    uploadZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadZone.classList.add('drag-over');
    });

    uploadZone.addEventListener('dragleave', () => {
        uploadZone.classList.remove('drag-over');
    });

    uploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadZone.classList.remove('drag-over');
        
        const files = Array.from(e.dataTransfer.files).filter(file => 
            file.type.startsWith('image/')
        );
        
        handleFiles(files);
    });

    function handleFiles(files) {
        if (files.length === 0) return;

        // Limit to 50 files
        if (selectedFiles.length + files.length > 50) {
            alert('Maximum 50 images autorisées');
            return;
        }

        files.forEach(file => {
            // Validate size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                alert(`${file.name} est trop volumineux (max 10MB)`);
                return;
            }

            // Validate type
            if (!['image/jpeg', 'image/jpg', 'image/png', 'image/webp'].includes(file.type)) {
                alert(`${file.name} n'est pas un format supporté`);
                return;
            }

            selectedFiles.push(file);
            addPreview(file);
        });

        updateSummary();
        updateSubmitButton();
    }

    function addPreview(file) {
        const reader = new FileReader();
        
        reader.onload = (e) => {
            const div = document.createElement('div');
            div.className = 'preview-item';
            div.dataset.fileName = file.name;
            
            div.innerHTML = `
                <img src="${e.target.result}" alt="${file.name}" class="preview-img">
                <button type="button" class="preview-remove" onclick="removeFile('${file.name}')">×</button>
                <div class="preview-name" title="${file.name}">${file.name}</div>
            `;
            
            previewGrid.appendChild(div);
            previewGrid.style.display = 'grid';
        };
        
        reader.readAsDataURL(file);
    }

    window.removeFile = function(fileName) {
        selectedFiles = selectedFiles.filter(f => f.name !== fileName);
        
        const preview = previewGrid.querySelector(`[data-file-name="${fileName}"]`);
        if (preview) preview.remove();
        
        if (selectedFiles.length === 0) {
            previewGrid.style.display = 'none';
            uploadSummary.style.display = 'none';
        }
        
        updateSummary();
        updateSubmitButton();
        
        // Update file input
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
    };

    function updateSummary() {
        if (selectedFiles.length === 0) {
            uploadSummary.style.display = 'none';
            return;
        }

        const totalSize = selectedFiles.reduce((sum, file) => sum + file.size, 0);
        const totalSizeMB = (totalSize / (1024 * 1024)).toFixed(2);
        
        fileCountEl.textContent = selectedFiles.length;
        totalSizeEl.textContent = `${totalSizeMB} MB`;
        uploadSummary.style.display = 'flex';
    }

    function updateSubmitButton() {
        if (selectedFiles.length > 0) {
            submitBtn.disabled = false;
            btnCount.textContent = `(${selectedFiles.length})`;
        } else {
            submitBtn.disabled = true;
            btnCount.textContent = '';
        }
    }

    // Form submission with progress
    form.addEventListener('submit', (e) => {
        if (selectedFiles.length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner au moins une image');
            return;
        }

        uploadZone.classList.add('uploading');
        submitBtn.disabled = true;
        submitBtn.textContent = '⏳ Upload en cours...';
        progressBar.style.display = 'block';
        
        // Simulate progress (real progress would need AJAX)
        let progress = 0;
        const interval = setInterval(() => {
            progress += 5;
            progressFill.style.width = progress + '%';
            if (progress >= 90) clearInterval(interval);
        }, 100);
    });

    // Update file input when files change
    function syncFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
    }

    console.log('✓ Bulk upload initialized');
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\media\bulk-upload.blade.php ENDPATH**/ ?>