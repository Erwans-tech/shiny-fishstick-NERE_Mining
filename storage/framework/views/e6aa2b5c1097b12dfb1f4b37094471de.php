<?php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';
    $daysLeft = $job->deadline ? now()->diffInDays($job->deadline, false) : null;
    $isUrgent = $daysLeft !== null && $daysLeft <= 3;
    $applyRoute = $en ? route('english.jobs.apply', $job) : route('jobs.apply', $job);
    $listRoute  = $en ? route('english.careers') : route('careers');
?>
<!DOCTYPE html>
<html lang="<?php echo e($loc); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($job->title); ?> | <?php echo e(__('site.nav_careers', [], $loc)); ?> | Néré Mining</title>
    <meta name="description" content="<?php echo e(Str::limit($job->description, 160)); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/chrome.css')); ?>">
    <style>
        :root{--ink:#281d18;--green:#4b1716;--red:#d72f2f;--gold:#ffc247;--gold2:#e5a72f;--sand:#fff4dc;--muted:#70645c;--line:#eadcc5;--light:#fbfaf7;}
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        body{color:var(--ink);background:var(--light);font-family:'Inter',Arial,sans-serif;line-height:1.6;}
        a{color:inherit;text-decoration:none;}

        /* Masthead */
        .masthead{padding:80px 5vw 60px;color:#fff;background:linear-gradient(100deg,rgba(75,23,22,.97) 40%,rgba(75,23,22,.6)),url('<?php echo e(asset('images/mining/karma-04.jpg')); ?>') center/cover;}
        .back-link{display:inline-flex;align-items:center;gap:7px;color:rgba(255,255,255,.65);font:500 12px Inter,sans-serif;text-transform:uppercase;letter-spacing:.08em;margin-bottom:24px;transition:color .15s;}
        .back-link:hover{color:var(--gold);}
        .eyebrow{color:var(--gold);font:700 11px Inter,sans-serif;letter-spacing:.2em;text-transform:uppercase;margin-bottom:12px;}
        .masthead h1{font:300 clamp(32px,5vw,60px)/1.05 Inter,sans-serif;color:#fff;max-width:800px;margin-bottom:24px;}
        .meta-badges{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:20px;}
        .badge{padding:6px 14px;border-radius:20px;font:600 11px Inter,sans-serif;letter-spacing:.05em;}
        .b-white{background:rgba(255,255,255,.15);color:#fff;}
        .b-gold{background:var(--gold);color:var(--ink);}
        .b-urgent{background:#dc2626;color:#fff;}
        .breadcrumb{font:12px Inter,sans-serif;color:rgba(255,255,255,.55);}
        .breadcrumb a{color:var(--gold);}

        /* Layout */
        .page-body{max-width:1240px;margin:0 auto;padding:60px 5vw;display:grid;grid-template-columns:1fr 380px;gap:48px;align-items:start;}

        /* Left — job detail */
        .job-detail{}
        .section-block{margin-bottom:40px;}
        .section-block h2{font:600 20px Inter,sans-serif;color:var(--green);margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid var(--line);}
        .job-description{font:16px/1.8 Inter,sans-serif;color:var(--ink);white-space:pre-line;}
        .job-description p{margin-bottom:12px;}
        .requirements-list{list-style:none;display:flex;flex-direction:column;gap:10px;}
        .requirements-list li{display:flex;gap:10px;align-items:flex-start;font:14px/1.6 Inter,sans-serif;color:var(--muted);}
        .requirements-list li::before{content:'✓';color:var(--gold2);font-weight:700;flex-shrink:0;margin-top:1px;}

        /* Right — sticky sidebar */
        .sidebar{position:sticky;top:92px;}
        .sidebar-card{background:#fff;border:1px solid var(--line);border-radius:10px;overflow:hidden;}
        .sidebar-head{padding:20px 22px;background:var(--green);color:#fff;}
        .sidebar-head h3{font:600 16px Inter,sans-serif;margin-bottom:4px;}
        .sidebar-head p{font:13px Inter,sans-serif;color:rgba(255,255,255,.65);}
        .sidebar-meta{padding:20px 22px;border-bottom:1px solid var(--line);}
        .meta-row{display:flex;align-items:flex-start;gap:12px;padding:8px 0;border-bottom:1px solid #f5f0e8;}
        .meta-row:last-child{border-bottom:0;}
        .meta-icon{font-size:16px;width:22px;text-align:center;flex-shrink:0;margin-top:1px;}
        .meta-label{font:600 10px Inter,sans-serif;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-bottom:2px;}
        .meta-value{font:500 13px Inter,sans-serif;color:var(--ink);}
        .sidebar-share{padding:16px 22px;border-top:1px solid var(--line);display:flex;align-items:center;gap:8px;}
        .share-btn{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border:1px solid var(--line);border-radius:6px;font:500 12px Inter,sans-serif;color:var(--muted);cursor:pointer;background:#fff;transition:all .15s;}
        .share-btn:hover{border-color:var(--green);color:var(--green);}

        /* Application form */
        .apply-section{margin-top:48px;}
        .apply-section h2{font:400 clamp(24px,3vw,36px)/1.1 Inter,sans-serif;color:var(--green);margin-bottom:10px;}
        .apply-lead{font:16px/1.7 Inter,sans-serif;color:var(--muted);margin-bottom:32px;max-width:640px;}
        .form-card{background:#fff;border:1px solid var(--line);border-radius:10px;padding:36px 32px;}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
        .form-group{display:flex;flex-direction:column;gap:6px;}
        .form-group.full{grid-column:span 2;}
        label.fl{font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);}
        label.fl span.req{color:var(--red);}
        input[type=text],input[type=email],input[type=tel],select,textarea{width:100%;border:1px solid var(--line);border-radius:6px;padding:11px 13px;font:14px Inter,sans-serif;color:var(--ink);background:#fff;transition:border-color .15s;}
        input:focus,select:focus,textarea:focus{outline:none;border-color:var(--gold);}
        textarea{min-height:130px;resize:vertical;}
        .file-group{border:2px dashed var(--line);border-radius:6px;padding:16px;text-align:center;transition:border-color .2s;cursor:pointer;}
        .file-group:hover{border-color:var(--gold);}
        .file-group input[type=file]{display:none;}
        .file-group .file-label{font:500 13px Inter,sans-serif;color:var(--muted);cursor:pointer;}
        .file-group .file-hint{font:11px Inter,sans-serif;color:var(--muted);margin-top:4px;}
        .file-group .file-name{font:600 13px Inter,sans-serif;color:var(--green);margin-top:6px;display:none;}
        .form-error{font:12px Inter,sans-serif;color:#dc2626;}
        .form-submit{width:100%;padding:15px;background:var(--green);color:#fff;border:none;border-radius:6px;font:600 13px Inter,sans-serif;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;transition:background .15s;}
        .form-submit:hover{background:#3a100f;}
        .alert-success{padding:14px 18px;background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:6px;font:500 14px Inter,sans-serif;margin-bottom:24px;}
        .alert-error{padding:14px 18px;background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:6px;font:500 14px Inter,sans-serif;margin-bottom:24px;}

        /* Responsive */
        @media(max-width:1024px){
            .page-body{grid-template-columns:1fr;gap:32px;}
            .sidebar{position:static;}
        }
        @media(max-width:900px){
            .form-grid{grid-template-columns:1fr;}
            .form-group.full{grid-column:span 1;}
        }
    </style>
</head>
<body>
<?php echo $__env->make('partials._nav', ['locale' => $loc, 'section' => 'careers'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<div class="masthead">
    <a href="<?php echo e($listRoute); ?>" class="back-link">← <?php echo e(__('site.careers_back', [], $loc)); ?></a>
    <h1><?php echo e($job->title); ?></h1>
    <div class="meta-badges">
        <span class="badge b-white"><?php echo e($job->contract_type); ?></span>
        <span class="badge b-white">📍 <?php echo e($job->location); ?></span>
        <?php if($job->experience_level): ?>
            <span class="badge b-white"><?php echo e($en ? $job->experienceLabelEn() : $job->experienceLabelFr()); ?></span>
        <?php endif; ?>
        <?php if($job->salary_range): ?>
            <span class="badge b-gold"><?php echo e($job->salary_range); ?></span>
        <?php endif; ?>
        <?php if($isUrgent): ?>
            <span class="badge b-urgent">
                <?php echo e($daysLeft === 0
                    ? __('site.careers_alert_urgent', [], $loc)
                    : str_replace(':n', $daysLeft, __('site.careers_alert_deadline', [], $loc))); ?>

            </span>
        <?php endif; ?>
    </div>
    <div class="breadcrumb">
        <a href="<?php echo e($en ? route('english') : url('/')); ?>"><?php echo e(__('site.home_link', [], $loc)); ?></a> ›
        <a href="<?php echo e($listRoute); ?>"><?php echo e(__('site.nav_careers', [], $loc)); ?></a> ›
        <?php echo e(Str::limit($job->title, 50)); ?>

    </div>
</div>


<div class="page-body">

    
    <div>

        <?php if(session('apply_success')): ?>
            <div class="alert-success">✓ <?php echo e(session('apply_success')); ?></div>
        <?php endif; ?>

        
        <div class="section-block">
            <h2><?php echo e($en ? 'Job description' : 'Description du poste'); ?></h2>
            <div class="job-description"><?php echo e($job->description); ?></div>
        </div>

        
        <?php if($job->requirements): ?>
        <div class="section-block">
            <h2><?php echo e(__('site.careers_requirements_h3', [], $loc)); ?></h2>
            <ul class="requirements-list">
                <?php $__currentLoopData = preg_split('/\r?\n/', trim($job->requirements)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(trim($line)): ?><li><?php echo e($line); ?></li><?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        
        <div class="apply-section" id="apply">
            <h2><?php echo e(__('site.careers_apply_title', [], $loc)); ?></h2>
            <p class="apply-lead"><?php echo e(__('site.careers_apply_lead', [], $loc)); ?></p>

            <?php if($errors->any()): ?>
                <div class="alert-error">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div>✕ <?php echo e($e); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="form-card">
                <form method="POST" action="<?php echo e($applyRoute); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="locale" value="<?php echo e($loc); ?>">
                    <div class="form-grid">
                        
                        <div class="form-group">
                            <label class="fl" for="first_name"><?php echo e(__('site.careers_field_firstname', [], $loc)); ?> <span class="req">*</span></label>
                            <input id="first_name" type="text" name="first_name" value="<?php echo e(old('first_name')); ?>" required>
                            <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="form-group">
                            <label class="fl" for="last_name"><?php echo e(__('site.careers_field_lastname', [], $loc)); ?> <span class="req">*</span></label>
                            <input id="last_name" type="text" name="last_name" value="<?php echo e(old('last_name')); ?>" required>
                            <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="form-group">
                            <label class="fl" for="email"><?php echo e(__('site.careers_field_email', [], $loc)); ?> <span class="req">*</span></label>
                            <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="form-group">
                            <label class="fl" for="phone"><?php echo e(__('site.careers_field_phone', [], $loc)); ?></label>
                            <input id="phone" type="tel" name="phone" value="<?php echo e(old('phone')); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="fl" for="nationality"><?php echo e(__('site.careers_field_nationality', [], $loc)); ?></label>
                            <input id="nationality" type="text" name="nationality" value="<?php echo e(old('nationality')); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="fl" for="experience_years"><?php echo e(__('site.careers_field_exp_years', [], $loc)); ?></label>
                            <select id="experience_years" name="experience_years">
                                <option value="">—</option>
                                <option value="0-1" <?php echo e(old('experience_years') === '0-1' ? 'selected' : ''); ?>>0 – 1 <?php echo e($en ? 'yr' : 'an'); ?></option>
                                <option value="2-4" <?php echo e(old('experience_years') === '2-4' ? 'selected' : ''); ?>>2 – 4 <?php echo e($en ? 'yrs' : 'ans'); ?></option>
                                <option value="5-9" <?php echo e(old('experience_years') === '5-9' ? 'selected' : ''); ?>>5 – 9 <?php echo e($en ? 'yrs' : 'ans'); ?></option>
                                <option value="10+" <?php echo e(old('experience_years') === '10+' ? 'selected' : ''); ?>>10+ <?php echo e($en ? 'yrs' : 'ans'); ?></option>
                            </select>
                        </div>
                        
                        <div class="form-group full">
                            <label class="fl" for="current_position"><?php echo e(__('site.careers_field_current_pos', [], $loc)); ?></label>
                            <input id="current_position" type="text" name="current_position" value="<?php echo e(old('current_position')); ?>" placeholder="<?php echo e($en ? 'E.g. Mining Engineer' : 'Ex : Ingénieur minier'); ?>">
                        </div>
                        
                        <div class="form-group full">
                            <label class="fl" for="motivation"><?php echo e(__('site.careers_field_motivation', [], $loc)); ?> <span class="req">*</span></label>
                            <textarea id="motivation" name="motivation" required placeholder="<?php echo e($en ? 'Tell us why you want to join Néré Mining and what makes you a strong candidate...' : 'Expliquez-nous pourquoi vous souhaitez rejoindre Néré Mining et ce qui fait de vous un candidat idéal...'); ?>" style="min-height:160px;"><?php echo e(old('motivation')); ?></textarea>
                            <?php $__errorArgs = ['motivation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="form-group">
                            <label class="fl"><?php echo e(__('site.careers_field_cv', [], $loc)); ?></label>
                            <div class="file-group" onclick="document.getElementById('cv-input').click()">
                                <input type="file" id="cv-input" name="cv" accept=".pdf,.doc,.docx"
                                       onchange="showFileName(this,'cv-name')">
                                <div class="file-label">📎 <?php echo e($en ? 'Click to attach your CV' : 'Cliquez pour joindre votre CV'); ?></div>
                                <div class="file-hint"><?php echo e(__('site.careers_file_hint', [], $loc)); ?></div>
                                <div class="file-name" id="cv-name"></div>
                            </div>
                            <?php $__errorArgs = ['cv'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="form-error"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="form-group">
                            <label class="fl"><?php echo e(__('site.careers_field_cover', [], $loc)); ?></label>
                            <div class="file-group" onclick="document.getElementById('cover-input').click()">
                                <input type="file" id="cover-input" name="cover_letter_file" accept=".pdf,.doc,.docx"
                                       onchange="showFileName(this,'cover-name')">
                                <div class="file-label">📎 <?php echo e($en ? 'Attach cover letter (optional)' : 'Joindre la lettre (optionnel)'); ?></div>
                                <div class="file-hint"><?php echo e(__('site.careers_file_hint', [], $loc)); ?></div>
                                <div class="file-name" id="cover-name"></div>
                            </div>
                        </div>
                        
                        <div class="form-group full" style="margin-top:8px;">
                            <button type="submit" class="form-submit">
                                <?php echo e(__('site.careers_submit_application', [], $loc)); ?>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <aside class="sidebar">
        <div class="sidebar-card">
            <div class="sidebar-head">
                <h3><?php echo e($job->title); ?></h3>
                <p><?php echo e($job->department); ?> · Néré Mining S.A.</p>
            </div>
            <div class="sidebar-meta">
                <div class="meta-row">
                    <span class="meta-icon">📋</span>
                    <div><div class="meta-label"><?php echo e($en ? 'Contract' : 'Contrat'); ?></div><div class="meta-value"><?php echo e($job->contract_type); ?></div></div>
                </div>
                <div class="meta-row">
                    <span class="meta-icon">📍</span>
                    <div><div class="meta-label"><?php echo e($en ? 'Location' : 'Lieu'); ?></div><div class="meta-value"><?php echo e($job->location); ?></div></div>
                </div>
                <?php if($job->experience_level): ?>
                <div class="meta-row">
                    <span class="meta-icon">🎓</span>
                    <div><div class="meta-label"><?php echo e(__('site.careers_experience_label', [], $loc)); ?></div><div class="meta-value"><?php echo e($en ? $job->experienceLabelEn() : $job->experienceLabelFr()); ?></div></div>
                </div>
                <?php endif; ?>
                <?php if($job->salary_range): ?>
                <div class="meta-row">
                    <span class="meta-icon">💰</span>
                    <div><div class="meta-label"><?php echo e(__('site.careers_salary_label', [], $loc)); ?></div><div class="meta-value"><?php echo e($job->salary_range); ?></div></div>
                </div>
                <?php endif; ?>
                <div class="meta-row">
                    <span class="meta-icon">📅</span>
                    <div><div class="meta-label"><?php echo e(__('site.careers_posted_label', [], $loc)); ?></div><div class="meta-value"><?php echo e($job->created_at->translatedFormat('d M Y')); ?></div></div>
                </div>
                <?php if($job->deadline): ?>
                <div class="meta-row">
                    <span class="meta-icon">⏰</span>
                    <div>
                        <div class="meta-label"><?php echo e(__('site.careers_expires_label', [], $loc)); ?></div>
                        <div class="meta-value" style="<?php echo e($isUrgent ? 'color:#dc2626;font-weight:600;' : ''); ?>"><?php echo e($job->deadline->translatedFormat('d M Y')); ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div style="padding:20px 22px;">
                <a href="#apply" class="form-submit" style="display:block;text-align:center;text-transform:uppercase;letter-spacing:.1em;padding:14px;background:var(--green);color:#fff;border-radius:6px;font:600 12px Inter,sans-serif;">
                    <?php echo e(__('site.careers_apply_title', [], $loc)); ?> →
                </a>
            </div>
            <div class="sidebar-share">
                <button class="share-btn" onclick="copyJobUrl(this)">
                    🔗 <?php echo e(__('site.careers_share', [], $loc)); ?>

                </button>
            </div>
        </div>

        
        <?php
            $others = \App\Models\JobOffer::open()
                ->where('id', '!=', $job->id)
                ->latest()
                ->take(3)
                ->get();
        ?>
        <?php if($others->isNotEmpty()): ?>
        <div style="margin-top:20px;background:#fff;border:1px solid var(--line);border-radius:10px;overflow:hidden;">
            <div style="padding:16px 20px;border-bottom:1px solid var(--line);">
                <span style="font:600 12px Inter,sans-serif;text-transform:uppercase;letter-spacing:.1em;color:var(--muted);">
                    <?php echo e($en ? 'Other open positions' : 'Autres postes ouverts'); ?>

                </span>
            </div>
            <?php $__currentLoopData = $others; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $other): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                if (empty($other->slug)) {
                    $other->slug = \App\Models\JobOffer::makeUniqueSlug($other->title, $other->id);
                    $other->timestamps = false;
                    $other->save();
                }
                $oRoute = $en ? route('english.jobs.show', $other) : route('jobs.show', $other);
            ?>
            <a href="<?php echo e($oRoute); ?>" style="display:block;padding:14px 20px;border-bottom:1px solid var(--line);transition:background .15s;">
                <div style="font:600 13px Inter,sans-serif;color:var(--green);margin-bottom:3px;"><?php echo e($other->title); ?></div>
                <div style="font:12px Inter,sans-serif;color:var(--muted);"><?php echo e($other->department); ?> · <?php echo e($other->contract_type); ?></div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </aside>
</div>

<?php echo $__env->make('partials._footer', ['loc' => $loc, 'en' => $en], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
function showFileName(input, nameId) {
    var el = document.getElementById(nameId);
    if (input.files && input.files[0]) {
        el.textContent = '✓ ' + input.files[0].name;
        el.style.display = 'block';
    }
}
function copyJobUrl(btn) {
    navigator.clipboard.writeText(window.location.href).then(function(){
        var orig = btn.innerHTML;
        btn.innerHTML = '✓ <?php echo e(__('site.careers_share_copied', [], $loc)); ?>';
        setTimeout(function(){ btn.innerHTML = orig; }, 2000);
    });
}
(function(){
    var b = document.querySelector('.menu-btn');
    if(b) b.addEventListener('click', function(){
        b.closest('header').querySelector('nav').classList.toggle('open');
    });
})();
</script>
</body>
</html>
<?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\careers\show.blade.php ENDPATH**/ ?>