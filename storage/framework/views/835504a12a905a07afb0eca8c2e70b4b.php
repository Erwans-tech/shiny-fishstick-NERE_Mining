
<?php $__env->startSection('title', 'Contenu éditable'); ?>
<?php $__env->startSection('page-title', 'Contenu éditable'); ?>

<?php
    $sectionMeta = [
        'home_stats' => ['title' => 'Accueil', 'description' => 'Les chiffres clés affichés sous le hero.', 'icon' => '⌂'],
        'karma_stats' => ['title' => 'Karma', 'description' => 'Les statistiques de la page Karma.', 'icon' => '◆'],
        'sustainability_stats' => ['title' => 'Développement durable', 'description' => 'Les repères chiffrés de la page durable.', 'icon' => '♧'],
        'history' => ['title' => 'Histoire de l’entreprise', 'description' => 'Les événements de la timeline de l’entreprise.', 'icon' => '◷'],
        'karma_history' => ['title' => 'Histoire de Karma', 'description' => 'Les jalons de la timeline de Karma.', 'icon' => '◈'],
    ];
    $groupedContents = $contents->groupBy('section');
?>

<?php $__env->startSection('content'); ?>
<div class="content-manager">
    <div class="content-hero">
        <div>
            <p class="content-eyebrow">Éditeur du site public</p>
            <h2>Contenu éditable</h2>
            <p>Modifiez les textes et les chiffres visibles sur le site, en français et en anglais.</p>
        </div>
        <div class="content-hero-stat"><strong><?php echo e($contents->count()); ?></strong><span>éléments gérés</span></div>
    </div>

    <?php if(session('success')): ?><div class="alert alert-success content-alert"><?php echo e(session('success')); ?></div><?php endif; ?>
    <?php if($errors->any()): ?><div class="alert alert-danger content-alert"><?php echo e($errors->first()); ?></div><?php endif; ?>

    <div class="content-toolbar">
        <label class="content-search"><span aria-hidden="true">⌕</span><input type="search" id="content-search" placeholder="Rechercher un titre, une valeur..." autocomplete="off"></label>
        <div class="content-filters" role="tablist" aria-label="Filtrer les sections">
            <button type="button" class="content-filter is-active" data-filter="all">Tout <b><?php echo e($contents->count()); ?></b></button>
            <?php $__currentLoopData = $sectionMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($groupedContents->has($section)): ?><button type="button" class="content-filter" data-filter="<?php echo e($section); ?>"><?php echo e($meta['title']); ?> <b><?php echo e($groupedContents[$section]->count()); ?></b></button><?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <section class="content-add card">
        <div class="content-section-heading"><div class="content-section-icon">＋</div><div><h3>Ajouter un élément</h3><p>Créez une nouvelle statistique ou un nouvel événement.</p></div></div>
        <form method="POST" action="<?php echo e(route('admin.site-content.store')); ?>" class="content-form">
            <?php echo csrf_field(); ?>
            <div class="field"><label for="new-section">Section</label><select id="new-section" name="section" required><?php $__currentLoopData = $sectionMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($section); ?>"><?php echo e($meta['title']); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></div>
            <div class="field"><label for="new-key">Identifiant interne</label><input id="new-key" name="key" placeholder="ex. emplois-directs" required><small>Utilisé uniquement pour identifier l’élément.</small></div>
            <div class="field"><label for="new-label-fr">Titre / année FR</label><input id="new-label-fr" name="label_fr" required></div>
            <div class="field"><label for="new-label-en">Titre / année EN</label><input id="new-label-en" name="label_en"></div>
            <div class="field field-wide"><label for="new-value-fr">Valeur / description FR</label><textarea id="new-value-fr" name="value_fr" rows="3"></textarea></div>
            <div class="field field-wide"><label for="new-value-en">Valeur / description EN</label><textarea id="new-value-en" name="value_en" rows="3"></textarea></div>
            <div class="field"><label for="new-icon">Icône</label><input id="new-icon" name="icon" placeholder="ex. 📍"></div>
            <div class="field"><label for="new-suffix">Suffixe</label><input id="new-suffix" name="suffix" placeholder="%, km, koz..."></div>
            <div class="field"><label for="new-order">Ordre d’affichage</label><input id="new-order" type="number" name="sort_order" value="0" min="0"></div>
            <label class="visibility-toggle"><input type="checkbox" name="is_published" value="1" checked><span></span><b>Visible sur le site</b></label>
            <div class="form-actions"><button class="btn btn-primary" type="submit">＋ Ajouter l’élément</button></div>
        </form>
    </section>

    <div class="content-sections">
        <?php $__currentLoopData = $sectionMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($groupedContents->has($section)): ?>
                <section class="content-section" data-content-section="<?php echo e($section); ?>">
                    <div class="content-section-title"><div class="content-section-icon"><?php echo e($meta['icon']); ?></div><div><h3><?php echo e($meta['title']); ?></h3><p><?php echo e($meta['description']); ?></p></div><span class="content-count"><?php echo e($groupedContents[$section]->count()); ?> éléments</span></div>
                    <div class="content-items">
                        <?php $__currentLoopData = $groupedContents[$section]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="content-item" data-content-search="<?php echo e(strtolower($content->section.' '.$content->key.' '.$content->label_fr.' '.$content->label_en.' '.$content->value_fr.' '.$content->value_en)); ?>">
                                <form method="POST" action="<?php echo e(route('admin.site-content.update', $content)); ?>" class="content-edit-form">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                    <div class="content-item-top"><div class="content-item-number"><?php echo e(str_pad($loop->iteration, 2, '0', STR_PAD_LEFT)); ?></div><div class="content-item-summary"><strong><?php echo e($content->label_fr); ?></strong><small><?php echo e($content->key); ?></small></div><label class="visibility-toggle compact"><input type="checkbox" name="is_published" value="1" <?php echo e($content->is_published ? 'checked' : ''); ?>><span></span><b><?php echo e($content->is_published ? 'Publié' : 'Masqué'); ?></b></label></div>
                                    <div class="content-edit-grid">
                                        <div class="field"><label>Titre / année FR</label><input name="label_fr" value="<?php echo e($content->label_fr); ?>" required></div>
                                        <div class="field"><label>Titre / année EN</label><input name="label_en" value="<?php echo e($content->label_en); ?>"></div>
                                        <div class="field field-wide"><label>Valeur / description FR</label><textarea name="value_fr" rows="3"><?php echo e($content->value_fr); ?></textarea></div>
                                        <div class="field field-wide"><label>Valeur / description EN</label><textarea name="value_en" rows="3"><?php echo e($content->value_en); ?></textarea></div>
                                        <div class="field"><label>Icône</label><input name="icon" value="<?php echo e($content->icon); ?>" placeholder="📊"></div>
                                        <div class="field"><label>Suffixe</label><input name="suffix" value="<?php echo e($content->suffix); ?>" placeholder="%, km..."></div>
                                        <div class="field"><label>Ordre</label><input type="number" name="sort_order" value="<?php echo e($content->sort_order); ?>" min="0"></div>
                                        <input type="hidden" name="section" value="<?php echo e($content->section); ?>"><input type="hidden" name="key" value="<?php echo e($content->key); ?>">
                                    </div>
                                    <div class="content-item-actions"><span class="content-item-id">ID : <?php echo e($content->key); ?></span><button class="btn btn-primary" type="submit">Enregistrer les modifications</button></div>
                                </form>
                                <form method="POST" action="<?php echo e(route('admin.site-content.destroy', $content)); ?>" class="delete-form" onsubmit="return confirm('Supprimer cet élément ?');"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" title="Supprimer cet élément">Supprimer</button></form>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <p id="content-empty" class="content-empty" hidden>Aucun élément ne correspond à votre recherche.</p>
    </div>
</div>

<style>
    .content-manager { max-width:1280px; }
    .content-hero { display:flex; align-items:flex-end; justify-content:space-between; gap:24px; padding:28px 30px; margin-bottom:18px; color:#fff; background:linear-gradient(120deg,var(--green),#6b2824); border-radius:12px; box-shadow:0 12px 30px rgba(75,23,22,.14); }
    .content-eyebrow { margin:0 0 8px; color:var(--gold); font:700 10px Inter,sans-serif; letter-spacing:.16em; text-transform:uppercase; }
    .content-hero h2 { margin:0; font:600 28px/1.15 Inter,sans-serif; }
    .content-hero p:last-child { margin:8px 0 0; color:rgba(255,255,255,.68); font-size:13px; }
    .content-hero-stat { min-width:130px; padding-left:24px; border-left:1px solid rgba(255,255,255,.2); text-align:right; }
    .content-hero-stat strong,.content-hero-stat span { display:block; }.content-hero-stat strong { color:var(--gold); font-size:30px; line-height:1; }.content-hero-stat span { margin-top:5px; color:rgba(255,255,255,.65); font-size:11px; }
    .content-alert { margin:0 0 18px; }
    .content-toolbar { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:15px 18px; margin-bottom:18px; background:#fff; border:1px solid var(--line); border-radius:10px; }
    .content-search { display:flex; align-items:center; gap:9px; width:min(360px,100%); padding:0 12px; border:1px solid var(--line); border-radius:7px; color:var(--muted); }.content-search span { font-size:21px; }.content-search input { width:100%; padding:10px 0; border:0; outline:0; font:13px Inter,sans-serif; }
    .content-filters { display:flex; flex-wrap:wrap; justify-content:flex-end; gap:6px; }.content-filter { padding:7px 10px; border:1px solid var(--line); border-radius:6px; background:#fff; color:var(--muted); font:600 11px Inter,sans-serif; cursor:pointer; }.content-filter b { margin-left:4px; color:var(--green); }.content-filter.is-active,.content-filter:hover { border-color:var(--green); background:var(--green); color:#fff; }.content-filter.is-active b,.content-filter:hover b { color:var(--gold); }
    .content-add { margin-bottom:26px; overflow:hidden; }.content-section-heading,.content-section-title { display:flex; align-items:center; gap:13px; }.content-section-heading { padding:18px 22px; border-bottom:1px solid var(--line); background:#fffaf1; }.content-section-heading h3,.content-section-title h3 { margin:0; color:var(--green); font-size:16px; }.content-section-heading p,.content-section-title p { margin:3px 0 0; color:var(--muted); font-size:12px; }.content-section-icon { display:flex; align-items:center; justify-content:center; flex:0 0 34px; width:34px; height:34px; border-radius:8px; background:var(--green); color:var(--gold); font-size:18px; font-weight:700; }
    .content-form,.content-edit-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:14px; }.content-form { padding:22px; }.field { min-width:0; }.field-wide { grid-column:span 2; }.field label { display:block; margin-bottom:6px; color:var(--ink); font-size:11px; font-weight:700; }.field small { display:block; margin-top:5px; color:var(--muted); font-size:10px; }.field input,.field select,.field textarea { width:100%; border:1px solid var(--line); border-radius:6px; background:#fff; color:var(--ink); font:13px Inter,sans-serif; outline:0; }.field input,.field select { height:38px; padding:0 10px; }.field textarea { min-height:76px; padding:9px 10px; resize:vertical; }.field input:focus,.field select:focus,.field textarea:focus { border-color:var(--gold2); box-shadow:0 0 0 3px rgba(229,167,47,.13); }
    .visibility-toggle { display:flex; align-items:center; gap:8px; align-self:end; min-height:38px; color:var(--muted); font-size:12px; cursor:pointer; }.visibility-toggle input { position:absolute; opacity:0; }.visibility-toggle span { position:relative; width:34px; height:20px; border-radius:20px; background:#d6cec3; transition:.2s; }.visibility-toggle span::after { content:''; position:absolute; top:3px; left:3px; width:14px; height:14px; border-radius:50%; background:#fff; transition:.2s; }.visibility-toggle input:checked + span { background:var(--green); }.visibility-toggle input:checked + span::after { transform:translateX(14px); }.form-actions { grid-column:1/-1; padding-top:4px; }
    .content-sections { display:grid; gap:24px; }.content-section { transition:opacity .2s; }.content-section.is-hidden { display:none; }.content-section-title { padding:0 4px 11px; border-bottom:2px solid var(--line); }.content-section-title .content-section-icon { width:30px; height:30px; flex-basis:30px; font-size:16px; }.content-count { margin-left:auto; color:var(--muted); font-size:11px; }.content-items { display:grid; gap:10px; padding-top:12px; }.content-item { position:relative; padding:17px 18px 14px; background:#fff; border:1px solid var(--line); border-radius:9px; box-shadow:0 2px 8px rgba(40,29,24,.025); }.content-item:hover { border-color:rgba(229,167,47,.65); }.content-item-top { display:flex; align-items:center; gap:11px; margin-bottom:15px; }.content-item-number { color:var(--gold2); font:700 13px Inter,sans-serif; }.content-item-summary { min-width:0; flex:1; }.content-item-summary strong,.content-item-summary small { display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }.content-item-summary strong { color:var(--green); font-size:13px; }.content-item-summary small { margin-top:2px; color:var(--muted); font:10px ui-monospace,monospace; }.visibility-toggle.compact { min-height:auto; font-size:10px; }.content-item-actions { display:flex; align-items:center; justify-content:flex-end; gap:12px; margin-top:14px; }.content-item-id { margin-right:auto; color:#9b9086; font:10px ui-monospace,monospace; }.delete-form { position:absolute; top:17px; right:18px; }.delete-form button { display:none; border:0; background:transparent; color:var(--danger); font:600 11px Inter,sans-serif; cursor:pointer; }.content-item:hover .delete-form button { display:block; }.content-empty { padding:35px; color:var(--muted); text-align:center; background:#fff; border:1px dashed var(--line); border-radius:9px; }
    @media (max-width:900px) { .content-toolbar,.content-hero { align-items:stretch; flex-direction:column; }.content-search { width:100%; }.content-filters { justify-content:flex-start; }.content-form,.content-edit-grid { grid-template-columns:repeat(2,minmax(0,1fr)); }.field-wide { grid-column:span 2; } }
    @media (max-width:560px) { .content-hero { padding:22px; }.content-hero-stat { padding:12px 0 0; border:0; text-align:left; }.content-form,.content-edit-grid { grid-template-columns:1fr; }.field-wide { grid-column:auto; }.content-item { padding:14px; }.content-item-actions { align-items:stretch; flex-direction:column; }.content-item-id { margin:0; }.delete-form { position:static; margin-top:10px; text-align:right; }.delete-form button { display:inline-block; } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('content-search');
    const filters = document.querySelectorAll('.content-filter');
    const sections = document.querySelectorAll('[data-content-section]');
    const empty = document.getElementById('content-empty');
    let activeFilter = 'all';
    function refreshContent() {
        const term = (search.value || '').toLowerCase().trim();
        let visibleItems = 0;
        sections.forEach(function (section) {
            const filterMatches = activeFilter === 'all' || section.dataset.contentSection === activeFilter;
            let sectionItems = 0;
            section.querySelectorAll('[data-content-search]').forEach(function (item) {
                const matches = filterMatches && (!term || item.dataset.contentSearch.includes(term));
                item.hidden = !matches;
                if (matches) { sectionItems++; visibleItems++; }
            });
            section.classList.toggle('is-hidden', sectionItems === 0);
        });
        empty.hidden = visibleItems !== 0;
    }
    search.addEventListener('input', refreshContent);
    filters.forEach(function (filter) { filter.addEventListener('click', function () { activeFilter = filter.dataset.filter; filters.forEach(function (item) { item.classList.toggle('is-active', item === filter); }); refreshContent(); }); });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\site-content\index.blade.php ENDPATH**/ ?>