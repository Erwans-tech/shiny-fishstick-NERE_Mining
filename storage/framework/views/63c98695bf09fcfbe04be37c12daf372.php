<?php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';
    $applyRoute = $en ? route('english.spontaneous.apply') : route('spontaneous.apply');
    $listRoute  = $en ? route('english.careers') : route('careers');
?>
<!DOCTYPE html>
<html lang="<?php echo e($loc); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('site.careers_spontaneous_title', [], $loc)); ?> | Néré Mining</title>
    <meta name="description" content="<?php echo e(__('site.careers_spontaneous_lead', [], $loc)); ?>">
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
        .masthead{padding:80px 5vw 60px;color:#fff;
            background:linear-gradient(100deg,rgba(75,23,22,.97) 40%,rgba(75,23,22,.6)),
                       url('<?php echo e(asset('images/mining/karma-04.jpg')); ?>') center/cover;}
        .back-link{display:inline-flex;align-items:center;gap:7px;color:rgba(255,255,255,.65);font:500 12px Inter,sans-serif;text-transform:uppercase;letter-spacing:.08em;margin-bottom:24px;transition:color .15s;}
        .back-link:hover{color:var(--gold);}
        .eyebrow{color:var(--gold);font:700 11px Inter,sans-serif;letter-spacing:.2em;text-transform:uppercase;margin-bottom:12px;display:flex;align-items:center;gap:10px;}
        .eyebrow::before{content:'';display:block;width:24px;height:2px;background:var(--gold);}
        .masthead h1{font:300 clamp(32px,5vw,60px)/1.05 Inter,sans-serif;color:#fff;max-width:700px;margin-bottom:14px;}
        .masthead-lead{font:16px/1.7 Inter,sans-serif;color:rgba(255,255,255,.72);max-width:600px;}
        .breadcrumb{margin-top:20px;font:12px Inter,sans-serif;color:rgba(255,255,255,.55);}
        .breadcrumb a{color:var(--gold);}

        /* Layout */
        .page-body{max-width:1100px;margin:0 auto;padding:64px 5vw;}

        /* Info cards */
        .info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:52px;}
        .info-card{background:#fff;border:1px solid var(--line);border-radius:10px;padding:26px 22px;display:flex;flex-direction:column;gap:10px;transition:border-color .2s,transform .2s;}
        .info-card:hover{border-color:var(--gold);transform:translateY(-2px);}
        .info-icon{font-size:28px;}
        .info-title{font:600 14px Inter,sans-serif;color:var(--green);}
        .info-text{font:13px/1.6 Inter,sans-serif;color:var(--muted);}

        /* Form */
        .form-section h2{font:400 clamp(24px,3vw,36px)/1.1 Inter,sans-serif;color:var(--green);margin-bottom:10px;}
        .form-lead{font:16px/1.7 Inter,sans-serif;color:var(--muted);margin-bottom:32px;max-width:640px;}
        .form-card{background:#fff;border:1px solid var(--line);border-radius:10px;padding:36px 32px;}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;}
        .form-group{display:flex;flex-direction:column;gap:6px;}
        .form-group.full{grid-column:span 2;}
        .fl{font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);}
        .fl .req{color:var(--red);}
        input[type=text],input[type=email],input[type=tel],select,textarea{width:100%;border:1px solid var(--line);border-radius:6px;padding:11px 13px;font:14px Inter,sans-serif;color:var(--ink);background:#fff;transition:border-color .15s;}
        input:focus,select:focus,textarea:focus{outline:none;border-color:var(--gold);}
        textarea{min-height:130px;resize:vertical;}
        .file-zone{border:2px dashed var(--line);border-radius:8px;padding:20px;text-align:center;transition:border-color .2s,background .2s;cursor:pointer;}
        .file-zone:hover{border-color:var(--gold);background:var(--sand);}
        .file-zone input[type=file]{display:none;}
        .file-zone-icon{font-size:24px;margin-bottom:8px;}
        .file-zone-label{font:500 13px Inter,sans-serif;color:var(--muted);}
        .file-zone-hint{font:11px Inter,sans-serif;color:var(--muted);margin-top:4px;}
        .file-zone-name{font:600 13px Inter,sans-serif;color:var(--green);margin-top:8px;display:none;}
        .form-error{font:12px Inter,sans-serif;color:#dc2626;}
        .form-submit{width:100%;padding:16px;background:var(--green);color:#fff;border:none;border-radius:8px;font:600 13px Inter,sans-serif;letter-spacing:.1em;text-transform:uppercase;cursor:pointer;transition:background .15s;}
        .form-submit:hover{background:#3a100f;}

        /* Alerts */
        .alert-success{padding:14px 18px;background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:8px;font:500 14px Inter,sans-serif;margin-bottom:28px;}
        .alert-error{padding:14px 18px;background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:8px;font:500 14px Inter,sans-serif;margin-bottom:24px;}

        /* Offres ouvertes suggestion */
        .open-offers{margin-top:52px;padding-top:40px;border-top:1px solid var(--line);}
        .open-offers h3{font:500 20px Inter,sans-serif;color:var(--green);margin-bottom:20px;}
        .offer-pill{display:flex;justify-content:space-between;align-items:center;padding:16px 20px;background:#fff;border:1px solid var(--line);border-radius:8px;margin-bottom:10px;transition:border-color .2s,box-shadow .2s;}
        .offer-pill:hover{border-color:var(--gold);box-shadow:0 4px 14px rgba(0,0,0,.06);}
        .offer-pill-info .title{font:600 15px Inter,sans-serif;color:var(--green);}
        .offer-pill-info .meta{font:12px Inter,sans-serif;color:var(--muted);margin-top:2px;}
        .offer-pill a{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:var(--green);color:#fff;border-radius:6px;font:600 11px Inter,sans-serif;text-transform:uppercase;letter-spacing:.08em;transition:background .15s;}
        .offer-pill a:hover{background:#3a100f;}

        /* Responsive */
        @media(max-width:900px){
            .info-grid{grid-template-columns:1fr 1fr;}
            .form-grid{grid-template-columns:1fr;}
            .form-group.full{grid-column:span 1;}
        }
        @media(max-width:600px){
            .info-grid{grid-template-columns:1fr;}
        }
    </style>
</head>
<body>
<?php echo $__env->make('partials._nav', ['locale' => $loc, 'section' => 'careers'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<div class="masthead">
    <a href="<?php echo e($listRoute); ?>" class="back-link">← <?php echo e(__('site.careers_back', [], $loc)); ?></a>
    <h1><?php echo e(__('site.careers_spontaneous_title', [], $loc)); ?></h1>
    <p class="masthead-lead"><?php echo e(__('site.careers_spontaneous_lead', [], $loc)); ?></p>
    <div class="breadcrumb">
        <a href="<?php echo e($en ? route('english') : url('/')); ?>"><?php echo e(__('site.home_link', [], $loc)); ?></a> ›
        <a href="<?php echo e($listRoute); ?>"><?php echo e(__('site.nav_careers', [], $loc)); ?></a> ›
        <?php echo e(__('site.careers_spontaneous_title', [], $loc)); ?>

    </div>
</div>

<div class="page-body">

    <?php if(session('apply_success')): ?>
        <div class="alert-success">✓ <?php echo e(session('apply_success')); ?></div>
    <?php endif; ?>

    
    <div class="info-grid">
        <div class="info-card">
            <div class="info-icon">🎯</div>
            <div class="info-title"><?php echo e($en ? 'We keep your profile' : 'Votre profil conservé'); ?></div>
            <div class="info-text"><?php echo e($en ? 'Your application is reviewed and kept on file for 12 months for any matching opportunity.' : 'Votre dossier est étudié et conservé 12 mois pour toute opportunité correspondant à votre profil.'); ?></div>
        </div>
        <div class="info-card">
            <div class="info-icon">🇧🇫</div>
            <div class="info-title"><?php echo e($en ? 'Burkinabe priority' : 'Priorité burkinabè'); ?></div>
            <div class="info-text"><?php echo e($en ? 'All positions are first open to Burkinabe nationals, in line with our local content policy.' : 'Tous nos postes sont ouverts en priorité aux ressortissants burkinabè, conformément à notre politique de contenu local.'); ?></div>
        </div>
        <div class="info-card">
            <div class="info-icon">📬</div>
            <div class="info-title"><?php echo e($en ? 'Confirmed receipt' : 'Accusé de réception'); ?></div>
            <div class="info-text"><?php echo e($en ? 'You receive a confirmation e-mail as soon as your application is registered.' : 'Vous recevez un e-mail de confirmation dès que votre candidature est enregistrée.'); ?></div>
        </div>
    </div>

    
    <div class="form-section">
        <h2><?php echo e($en ? 'Submit your unsolicited application' : 'Déposer votre candidature spontanée'); ?></h2>
        <p class="form-lead"><?php echo e(__('site.careers_apply_lead', [], $loc)); ?></p>

        <?php if(!empty($errors) && $errors->isNotEmpty()): ?>
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
                        <label class="fl" for="sp_fname"><?php echo e(__('site.careers_field_firstname', [], $loc)); ?> <span class="req">*</span></label>
                        <input id="sp_fname" type="text" name="first_name" value="<?php echo e(old('first_name')); ?>" required>
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
                        <label class="fl" for="sp_lname"><?php echo e(__('site.careers_field_lastname', [], $loc)); ?> <span class="req">*</span></label>
                        <input id="sp_lname" type="text" name="last_name" value="<?php echo e(old('last_name')); ?>" required>
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
                        <label class="fl" for="sp_email"><?php echo e(__('site.careers_field_email', [], $loc)); ?> <span class="req">*</span></label>
                        <input id="sp_email" type="email" name="email" value="<?php echo e(old('email')); ?>" required>
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
                        <label class="fl" for="sp_phone"><?php echo e(__('site.careers_field_phone', [], $loc)); ?></label>
                        <input id="sp_phone" type="tel" name="phone" value="<?php echo e(old('phone')); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label class="fl" for="sp_nat"><?php echo e(__('site.careers_field_nationality', [], $loc)); ?></label>
                        <input id="sp_nat" type="text" name="nationality" value="<?php echo e(old('nationality')); ?>"
                               placeholder="<?php echo e($en ? 'Burkinabe, French…' : 'Burkinabè, Française…'); ?>">
                    </div>

                    
                    <div class="form-group">
                        <label class="fl" for="sp_exp"><?php echo e(__('site.careers_field_exp_years', [], $loc)); ?></label>
                        <select id="sp_exp" name="experience_years">
                            <option value="">—</option>
                            <option value="0-1"  <?php echo e(old('experience_years') === '0-1'  ? 'selected' : ''); ?>>0 – 1 <?php echo e($en ? 'yr' : 'an'); ?></option>
                            <option value="2-4"  <?php echo e(old('experience_years') === '2-4'  ? 'selected' : ''); ?>>2 – 4 <?php echo e($en ? 'yrs' : 'ans'); ?></option>
                            <option value="5-9"  <?php echo e(old('experience_years') === '5-9'  ? 'selected' : ''); ?>>5 – 9 <?php echo e($en ? 'yrs' : 'ans'); ?></option>
                            <option value="10+"  <?php echo e(old('experience_years') === '10+'  ? 'selected' : ''); ?>>10+ <?php echo e($en ? 'yrs' : 'ans'); ?></option>
                        </select>
                    </div>

                    
                    <div class="form-group full">
                        <label class="fl" for="sp_pos"><?php echo e(__('site.careers_field_current_pos', [], $loc)); ?></label>
                        <input id="sp_pos" type="text" name="current_position" value="<?php echo e(old('current_position')); ?>"
                               placeholder="<?php echo e($en ? 'E.g. Mining Engineer, Accountant…' : 'Ex : Ingénieur minier, Comptable…'); ?>">
                    </div>

                    
                    <div class="form-group full">
                        <label class="fl" for="sp_motiv"><?php echo e(__('site.careers_field_motivation', [], $loc)); ?> <span class="req">*</span></label>
                        <textarea id="sp_motiv" name="motivation" required style="min-height:160px;"
                                  placeholder="<?php echo e($en
                                      ? 'Introduce yourself, describe your skills and explain why you want to join Néré Mining…'
                                      : 'Présentez-vous, décrivez vos compétences et expliquez pourquoi vous souhaitez rejoindre Néré Mining…'); ?>"><?php echo e(old('motivation')); ?></textarea>
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
                        <div class="file-zone" onclick="document.getElementById('sp_cv').click()">
                            <input type="file" id="sp_cv" name="cv" accept=".pdf,.doc,.docx"
                                   onchange="showFile(this, 'sp_cv_name')">
                            <div class="file-zone-icon">📎</div>
                            <div class="file-zone-label"><?php echo e($en ? 'Click to attach your CV' : 'Cliquez pour joindre votre CV'); ?></div>
                            <div class="file-zone-hint"><?php echo e(__('site.careers_file_hint', [], $loc)); ?></div>
                            <div class="file-zone-name" id="sp_cv_name"></div>
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
                        <div class="file-zone" onclick="document.getElementById('sp_cover').click()">
                            <input type="file" id="sp_cover" name="cover_letter_file" accept=".pdf,.doc,.docx"
                                   onchange="showFile(this, 'sp_cover_name')">
                            <div class="file-zone-icon">📄</div>
                            <div class="file-zone-label"><?php echo e($en ? 'Attach cover letter (optional)' : 'Lettre de motivation (optionnel)'); ?></div>
                            <div class="file-zone-hint"><?php echo e(__('site.careers_file_hint', [], $loc)); ?></div>
                            <div class="file-zone-name" id="sp_cover_name"></div>
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

    
    <?php
        $openJobs = \App\Models\JobOffer::open()->latest()->take(4)->get();
    ?>
    <?php if($openJobs->isNotEmpty()): ?>
    <div class="open-offers">
        <h3><?php echo e($en ? 'Open positions — maybe one fits you' : 'Offres ouvertes — peut-être l\'une d\'elles vous correspond'); ?></h3>
        <?php $__currentLoopData = $openJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            if (empty($oj->slug)) {
                $oj->slug = \App\Models\JobOffer::makeUniqueSlug($oj->title, $oj->id);
                $oj->timestamps = false;
                $oj->save();
            }
            $ojRoute = $en ? route('english.jobs.show', $oj) : route('jobs.show', $oj);
        ?>
        <div class="offer-pill">
            <div class="offer-pill-info">
                <div class="title"><?php echo e($oj->title); ?></div>
                <div class="meta"><?php echo e($oj->department); ?> · <?php echo e($oj->contract_type); ?> · <?php echo e($oj->location); ?></div>
            </div>
            <a href="<?php echo e($ojRoute); ?>"><?php echo e(__('site.careers_see_offer', [], $loc)); ?></a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

</div>

<?php echo $__env->make('partials._footer', ['loc' => $loc, 'en' => $en], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
function showFile(input, nameId) {
    var el = document.getElementById(nameId);
    if (input.files && input.files[0]) {
        el.textContent = '✓ ' + input.files[0].name;
        el.style.display = 'block';
    }
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
<?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\careers\spontaneous.blade.php ENDPATH**/ ?>