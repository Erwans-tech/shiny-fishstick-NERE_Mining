<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Néré Mining</title>
    <style>
        :root { --green:#4b1716; --gold:#ffc247; --light:#f8f9fa; }
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:sans-serif; background:var(--light); }
        .header { background:var(--green); color:white; padding:15px 20px; }
        .container { max-width:1200px; margin:20px auto; padding:0 20px; }
        .card { background:white; border-radius:8px; padding:20px; margin:10px 0; box-shadow:0 2px 4px rgba(0,0,0,0.1); }
        .stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:15px; }
        .stat { background:white; padding:15px; border-radius:8px; text-align:center; border-left:4px solid var(--green); }
        .stat-number { font-size:24px; font-weight:bold; color:var(--green); }
        .stat-label { font-size:12px; text-transform:uppercase; color:#666; margin-top:5px; }
        .nav { margin:15px 0; }
        .nav a { 
            display:inline-block; background:var(--green); color:white; padding:8px 16px; 
            text-decoration:none; border-radius:4px; margin:0 5px 5px 0; 
        }
        .nav a:hover { background:#3a100f; }
        .success { background:#d4edda; color:#155724; padding:10px; border-radius:4px; margin:10px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏢 Administration Néré Mining</h1>
        <p>Dashboard Diagnostic (<?php echo e($stats['app_env']); ?> - <?php echo e($stats['session_driver']); ?>)</p>
        <p>Connecté en tant que: <strong><?php echo e($stats['admin_user']); ?></strong></p>
    </div>

    <div class="container">
        <div class="success">
            ✅ <strong>Connexion admin réussie !</strong> Le problème 419 Page Expired a été temporairement contourné.
        </div>

        <div class="nav">
            <a href="/gestion-nm/utilisateurs">👥 Gestion Utilisateurs</a>
            <a href="/gestion-nm/actualites">📰 Actualités</a>
            <a href="/gestion-nm/emploi">💼 Emplois</a>
            <a href="/gestion-nm/messages">💬 Messages</a>
            <a href="/gestion-nm/parametres">⚙️ Paramètres</a>
            <a href="/gestion-nm/diagnostic">🔍 Diagnostic</a>
        </div>

        <div class="card">
            <h2>📊 Statistiques du site</h2>
            <div class="stats">
                <div class="stat">
                    <div class="stat-number"><?php echo e($stats['admin_count']); ?></div>
                    <div class="stat-label">Administrateurs</div>
                </div>
                <div class="stat">
                    <div class="stat-number"><?php echo e($stats['users_count']); ?></div>
                    <div class="stat-label">Utilisateurs</div>
                </div>
                <div class="stat">
                    <div class="stat-number"><?php echo e($stats['news_count']); ?></div>
                    <div class="stat-label">Actualités</div>
                </div>
                <div class="stat">
                    <div class="stat-number"><?php echo e($stats['jobs_count']); ?></div>
                    <div class="stat-label">Offres d'emploi</div>
                </div>
                <div class="stat">
                    <div class="stat-number"><?php echo e($stats['messages_count']); ?></div>
                    <div class="stat-label">Messages</div>
                </div>
            </div>
        </div>

        <div class="card">
            <h2>🛠️ Actions rapides</h2>
            <div class="nav">
                <a href="/gestion-nm/actualites/creer">➕ Nouvelle actualité</a>
                <a href="/gestion-nm/emploi/creer">➕ Nouvelle offre d'emploi</a>
                <a href="/gestion-nm/utilisateurs/creer">➕ Nouvel admin</a>
            </div>
        </div>

        <div class="card">
            <h2>⚠️ Note importante</h2>
            <p>Cette interface fonctionne temporairement sans protection CSRF pour diagnostiquer le problème. 
            Une fois les sessions corrigées, nous réactiverons la sécurité CSRF complète.</p>
            
            <div style="margin-top:15px;">
                <strong>Pour accéder au dashboard complet :</strong><br>
                <a href="/gestion-nm/tableau-de-bord">🏠 Dashboard principal</a>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\dashboard-alt.blade.php ENDPATH**/ ?>