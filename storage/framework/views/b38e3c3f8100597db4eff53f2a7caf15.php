<?php $__env->startSection('content'); ?>
<?php $companyBase = $en ? route('english.company') : route('company'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .governance-page { width:100vw; max-width:none; margin-left:calc(50% - 50vw); padding-left:clamp(24px,5vw,88px); padding-right:clamp(24px,5vw,88px); background:linear-gradient(180deg,rgba(255,255,255,.35),rgba(255,244,220,.5)); }
    .leadership-section { padding-top:0; }
    .leadership-intro { max-width:760px; margin:0 auto 34px; text-align:center; }
    .leadership-intro h2 { margin-bottom:10px; }
    .leadership-level { margin-top:32px; }
    .leadership-level + .leadership-level { margin-top:42px; }
    .leadership-level-heading { display:flex; align-items:center; gap:14px; margin:0 0 18px; color:var(--green); font-size:12px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; }
    .leadership-level-heading::after { content:""; height:1px; flex:1; background:linear-gradient(90deg,var(--gold),transparent); }
    .leadership-grid { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:22px; }
    .leadership-card { min-height:350px; display:flex; flex-direction:column; align-items:center; padding:28px 20px 24px; text-align:center; background:rgba(255,255,255,.9); border:1px solid var(--line); border-top:4px solid var(--gold); border-radius:14px; box-shadow:0 8px 24px rgba(40,29,24,.07); transition:transform .25s,box-shadow .25s,border-color .25s; }
    .leadership-card:hover { transform:translateY(-5px); border-color:var(--gold); box-shadow:0 16px 30px rgba(40,29,24,.12); }
    .leadership-card--lead { grid-column:1 / -1; width:min(700px,100%); justify-self:center; max-width:700px; margin:0 auto; flex-direction:row; gap:24px; align-items:center; text-align:left; background:linear-gradient(135deg,#4b1716,#2d0d10); color:#fff; border-top-color:var(--gold); }
    .leadership-card--lead .leadership-name,.leadership-card--lead .leadership-title { color:#fff; }
    .leadership-card--lead .leadership-department { color:rgba(255,255,255,.7); }
    .leadership-photo { width:184px; height:184px; flex:0 0 184px; object-fit:cover; border-radius:50%; border:5px solid rgba(255,194,71,.75); background:var(--sand); }
    .leadership-card:not(.leadership-card--lead) .leadership-photo { width:150px; height:150px; flex-basis:150px; margin-bottom:20px; }
    .leadership-initials { display:grid; place-items:center; font-size:48px; font-weight:700; color:var(--green); }
    .leadership-card--lead .leadership-initials { color:#fff; background:rgba(255,255,255,.12); }
    .leadership-name { margin:0 0 8px; color:var(--green); font-size:18px; font-weight:700; line-height:1.25; }
    .leadership-card > div:last-child { width:100%; min-width:0; }
    .leadership-name, .leadership-title, .leadership-department { overflow-wrap:break-word; word-break:normal; }
    .leadership-title { margin:0 0 8px; color:var(--gold2); font-size:12px; font-weight:700; line-height:1.4; text-transform:uppercase; letter-spacing:.02em; }
    .leadership-department { margin:0; color:var(--muted); font-size:14px; line-height:1.5; word-break:normal; }
    @media(max-width:900px) { .leadership-grid { grid-template-columns:repeat(2,minmax(0,1fr)); } }
    @media(max-width:540px) { .leadership-grid { grid-template-columns:1fr; } .leadership-card--lead { flex-direction:column; text-align:center; } }
</style>
<?php $__env->stopPush(); ?>

    <section class="governance-page">

    <?php
        $fallbackLeadership = [
            ['name' => 'Dr. Justin Elie OUEDRAOGO', 'title' => $en ? 'Chief Executive Officer' : 'Président Directeur Général', 'department' => '', 'hierarchy_level' => 1, 'photo_path' => 'images/mining/mining-workers-01.jpg'],
            ['name' => 'Justin SAVADOGO', 'title' => $en ? 'Deputy CEO' : 'Directeur Général Adjoint', 'department' => 'Administration & Finance', 'hierarchy_level' => 2, 'photo_path' => 'images/mining/gold-processing-01.jpg'],
            ['name' => 'Pascal Y. OUEDRAOGO', 'title' => $en ? 'Deputy CEO' : 'Directeur Général Adjoint', 'department' => $en ? 'Supply & Procurement' : 'Approvisionnements', 'hierarchy_level' => 2, 'photo_path' => 'images/mining/mining-equipment-01.jpg'],
            ['name' => 'Laurent Michel DABIRE', 'title' => $en ? 'Deputy CEO' : 'Directeur Général Adjoint', 'department' => $en ? 'Corporate & Legal Affairs' : 'Affaires Corporatives & Juridiques', 'hierarchy_level' => 2, 'photo_path' => 'images/mining/mining-site-aerial-01.jpg'],
            ['name' => 'Augustine OBENG-FORI', 'title' => $en ? 'Deputy CEO (interim)' : 'DGA par intérim', 'department' => $en ? 'Operations' : 'Opérations', 'hierarchy_level' => 2, 'photo_path' => 'images/mining/mining-environment-01.jpg'],
        ];
        $leadershipMembers = $leadership->isNotEmpty() ? $leadership : collect($fallbackLeadership);
        $leadershipLevels = $leadershipMembers->groupBy(fn($member) => is_array($member) ? $member['hierarchy_level'] : $member->hierarchy_level);
        $levelLabels = [1 => $en ? 'Executive leadership' : 'Direction générale', 2 => $en ? 'Deputy executive leadership' : 'Direction générale adjointe', 3 => $en ? 'Management' : 'Directions et responsables'];
    ?>

    <div class="leadership-section">
        <div class="leadership-intro">
            <h2><?php echo e($en ? 'Our leadership team' : 'Notre équipe de direction'); ?></h2>
            <p><?php echo e($en ? 'Meet the leaders who guide Néré Mining and its commitments to the territory.' : 'Découvrez les dirigeants qui portent la vision de Néré Mining et ses engagements pour le territoire.'); ?></p>
        </div>
        <?php $__currentLoopData = $leadershipLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level => $levelMembers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <section class="leadership-level" aria-labelledby="leadership-level-<?php echo e($level); ?>">
            <h3 class="leadership-level-heading" id="leadership-level-<?php echo e($level); ?>"><?php echo e($levelLabels[$level] ?? $levelLabels[3]); ?></h3>
            <div class="leadership-grid">
            <?php $__currentLoopData = $levelMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $name = is_array($member) ? $member['name'] : $member->name;
                $title = is_array($member) ? $member['title'] : $member->title;
                $department = is_array($member) ? $member['department'] : $member->department;
                $photoPath = is_array($member) ? $member['photo_path'] : $member->photo_path;
                $memberLevel = is_array($member) ? $member['hierarchy_level'] : $member->hierarchy_level;
                $photoUrl = $photoPath ? \App\Helpers\StorageHelper::uploadUrl($photoPath) : null;
                $initials = collect(preg_split('/\s+/', trim($name)))->filter()->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->implode('');
            ?>
            <article class="leadership-card <?php echo e($memberLevel === 1 ? 'leadership-card--lead' : ''); ?>">
                <?php if($photoUrl): ?>
                <img class="leadership-photo" src="<?php echo e($photoUrl); ?>" alt="<?php echo e($name); ?>" loading="lazy">
                <?php else: ?>
                <div class="leadership-photo leadership-initials" aria-hidden="true"><?php echo e($initials); ?></div>
                <?php endif; ?>
                <div>
                    <h3 class="leadership-name"><?php echo e($name); ?></h3>
                    <p class="leadership-title"><?php echo e($title); ?></p>
                    <?php if($department): ?><p class="leadership-department"><?php echo e($department); ?></p><?php endif; ?>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company-governance.blade.php ENDPATH**/ ?>