<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — Néré Mining</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-animations.css') }}">
    <style>
        /* ══ Variables ════════════════════════════════════════════ */
        :root {
            --green:      #4b1716;
            --green2:     #3a100f;
            --green-soft: #5e2120;
            --red:        #d72f2f;
            --gold:       #ffc247;
            --gold2:      #e5a72f;
            --sand:       #fff4dc;
            --muted:      #70645c;
            --line:       #eadcc5;
            --light:      #fbfaf7;
            --ink:        #281d18;
            --sidebar-w:  256px;
            --topbar-h:   60px;
            --danger:     #dc2626;
            --success-bg: #dcfce7;
            --success-fg: #166534;
            --error-bg:   #fee2e2;
            --error-fg:   #991b1b;
            --bg-page:    #f2ede8;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-page); color: var(--ink); display: flex; min-height: 100vh; }
        a { color: inherit; text-decoration: none; }

        /* ══ Sidebar ══════════════════════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--green);
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 200;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .sidebar::-webkit-scrollbar { display: none; }

        /* Logo */
        .sidebar-logo {
            padding: 22px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-logo img { width: 120px; display: block; }
        .sidebar-logo-badge {
            display: inline-block;
            padding: 3px 8px;
            background: var(--gold);
            color: var(--ink);
            font: 700 9px Inter, sans-serif;
            letter-spacing: .14em;
            text-transform: uppercase;
            border-radius: 4px;
        }

        /* Nav sections */
        .sidebar-nav { padding: 12px 0 8px; flex: 1; }
        .nav-section {
            padding: 14px 18px 5px;
            font: 700 9px Inter, sans-serif;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: rgba(255,255,255,.28);
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 18px;
            margin: 1px 8px;
            border-radius: 6px;
            font: 500 13px Inter, sans-serif;
            color: rgba(255,255,255,.72);
            transition: background .15s, color .15s;
            cursor: pointer;
        }
        .nav-item:hover  { background: rgba(255,255,255,.09); color: #fff; }
        .nav-item.active {
            background: rgba(255,255,255,.14);
            color: #fff;
            font-weight: 600;
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 3px;
            height: 28px;
            background: var(--gold);
            border-radius: 0 3px 3px 0;
            margin-left: -8px;
        }
        .nav-item { position: relative; }
        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }
        .nav-badge {
            margin-left: auto;
            min-width: 20px;
            height: 18px;
            background: var(--red);
            color: #fff;
            font: 700 10px Inter, sans-serif;
            padding: 0 5px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .nav-badge-gold {
            background: var(--gold);
            color: var(--ink);
        }

        /* Footer sidebar */
        .sidebar-footer {
            padding: 14px 18px 18px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .sidebar-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font: 700 13px Inter, sans-serif;
            color: #fff;
            flex-shrink: 0;
        }
        .sidebar-user-name { font: 600 13px Inter, sans-serif; color: #fff; }
        .sidebar-user-role { font: 500 11px Inter, sans-serif; color: rgba(255,255,255,.45); }
        .sidebar-logout {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 6px;
            background: rgba(255,255,255,.07);
            border: none;
            color: rgba(255,255,255,.6);
            font: 500 12px Inter, sans-serif;
            cursor: pointer;
            transition: background .15s, color .15s;
        }
        .sidebar-logout:hover { background: rgba(255,255,255,.14); color: #fff; }

        /* ══ Main ═════════════════════════════════════════════════ */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* ── Topbar ── */
        .topbar {
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid var(--line);
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 4px rgba(0,0,0,.04);
        }
        .topbar-left { display: flex; align-items: center; gap: 14px; }
        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font: 500 13px Inter, sans-serif;
            color: var(--muted);
        }
        .topbar-breadcrumb span { color: var(--ink); font-weight: 600; }
        .topbar-right { display: flex; align-items: center; gap: 16px; }

        /* Notification bell */
        .topbar-notif {
            position: relative;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: background .15s;
        }
        .topbar-notif:hover { background: var(--light); }
        .topbar-notif-dot {
            position: absolute;
            top: 6px;
            right: 7px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--red);
            border: 2px solid #fff;
        }

        /* Date badge */
        .topbar-date {
            font: 500 12px Inter, sans-serif;
            color: var(--muted);
            background: var(--light);
            padding: 5px 12px;
            border-radius: 6px;
            border: 1px solid var(--line);
        }

        /* View site button */
        .topbar-site {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: var(--green);
            color: #fff;
            border-radius: 6px;
            font: 600 12px Inter, sans-serif;
            transition: background .15s;
        }
        .topbar-site:hover { background: var(--green2); }

        /* ── Content area ── */
        .content { padding: 28px; flex: 1; }

        /* ══ Alerts ═══════════════════════════════════════════════ */
        .alert {
            padding: 13px 18px;
            border-radius: 8px;
            font: 500 14px Inter, sans-serif;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: var(--success-bg); color: var(--success-fg); border: 1px solid #bbf7d0; }
        .alert-error   { background: var(--error-bg);   color: var(--error-fg);   border: 1px solid #fecaca; }

        /* ══ Cards ════════════════════════════════════════════════ */
        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            overflow: hidden;
        }
        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .card-header h2 { font: 600 14px Inter, sans-serif; color: var(--green); }
        .card-header .card-header-sub { font: 500 12px Inter, sans-serif; color: var(--muted); }
        .card-body { padding: 20px; }

        /* ══ Badges ═══════════════════════════════════════════════ */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 20px;
            font: 600 11px Inter, sans-serif;
            letter-spacing: .04em;
        }
        .badge-green  { background: #dcfce7; color: #166534; }
        .badge-red    { background: #fee2e2; color: #991b1b; }
        .badge-yellow { background: #fef9c3; color: #854d0e; }
        .badge-blue   { background: #dbeafe; color: #1e40af; }
        .badge-gray   { background: #f1f5f9; color: #475569; }
        .badge-orange { background: #ffedd5; color: #9a3412; }

        /* ══ Boutons ══════════════════════════════════════════════ */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 8px;
            font: 600 12px Inter, sans-serif;
            letter-spacing: .04em;
            border: 0;
            cursor: pointer;
            transition: all .15s;
        }
        .btn-primary { background: var(--green); color: #fff; }
        .btn-primary:hover { background: var(--green2); transform: translateY(-1px); }
        .btn-gold    { background: var(--gold); color: var(--ink); }
        .btn-gold:hover { background: var(--gold2); transform: translateY(-1px); }
        .btn-danger  { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-ghost   { background: #fff; border: 1px solid var(--line); color: var(--ink); }
        .btn-ghost:hover { border-color: var(--green); color: var(--green); background: var(--light); }
        .btn-sm { padding: 5px 11px; font-size: 11px; border-radius: 6px; }

        /* ══ Tableaux ══════════════════════════════════════════════ */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        thead th {
            text-align: left;
            padding: 10px 14px;
            font: 600 11px Inter, sans-serif;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: var(--muted);
            background: #f9f7f4;
            border-bottom: 1px solid var(--line);
        }
        tbody td {
            padding: 13px 14px;
            border-bottom: 1px solid #f0ebe3;
            color: var(--ink);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover td { background: #faf8f4; }
        .td-muted { color: var(--muted); font-size: 13px; }

        /* ══ Formulaires ══════════════════════════════════════════ */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: span 2; }
        label { font: 600 11px Inter, sans-serif; letter-spacing: .07em; text-transform: uppercase; color: var(--muted); }
        input[type=text], input[type=email], input[type=date], input[type=number],
        input[type=url], select, textarea {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 10px 13px;
            font: 14px Inter, sans-serif;
            color: var(--ink);
            background: #fff;
            transition: border-color .15s, box-shadow .15s;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(255,194,71,.15);
        }
        textarea { min-height: 120px; resize: vertical; }
        .form-hint { font: 12px Inter, sans-serif; color: var(--muted); }
        .form-error { font: 12px Inter, sans-serif; color: var(--danger); }
        .toggle-wrap { display: flex; align-items: center; gap: 10px; }
        .toggle-wrap input[type=checkbox] { width: 18px; height: 18px; cursor: pointer; accent-color: var(--green); }
        .form-actions { display: flex; gap: 12px; margin-top: 8px; padding-top: 20px; border-top: 1px solid var(--line); }

        /* ══ Pagination ═══════════════════════════════════════════ */
        .pagination { display: flex; gap: 6px; justify-content: center; padding-top: 20px; }
        .pagination a, .pagination span {
            padding: 7px 13px;
            border-radius: 6px;
            font: 500 13px Inter, sans-serif;
            border: 1px solid var(--line);
            color: var(--ink);
            transition: all .15s;
        }
        .pagination a:hover { border-color: var(--green); color: var(--green); }
        .pagination .active span { background: var(--green); color: #fff; border-color: var(--green); }
        .pagination .disabled span { opacity: .4; }

        /* ══ Dashboard — stat tiles ═══════════════════════════════ */
        .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-tile {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            transition: box-shadow .2s, transform .2s;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }
        .stat-tile::before {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 3px;
            background: var(--line);
            transition: background .2s;
        }
        .stat-tile:hover { box-shadow: 0 6px 20px rgba(0,0,0,.07); transform: translateY(-2px); }
        .stat-tile:hover::before { background: var(--gold); }
        .stat-tile--alert::before { background: var(--red) !important; }
        .stat-tile--warn::before  { background: var(--gold) !important; }
        .stat-tile-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            background: var(--light);
        }
        .stat-tile-icon--red  { background: #fee2e2; }
        .stat-tile-icon--gold { background: #fef9c3; }
        .stat-tile-icon--blue { background: #dbeafe; }
        .stat-tile-icon--green{ background: #dcfce7; }
        .stat-tile-body { flex: 1; min-width: 0; }
        .stat-tile-num  { font: 300 30px Inter, sans-serif; color: var(--green); line-height: 1; }
        .stat-tile-lbl  { font: 500 12px Inter, sans-serif; color: var(--muted); margin-top: 4px; }
        .stat-tile-sub  { font: 500 11px Inter, sans-serif; color: var(--muted); margin-top: 4px; opacity: .7; }
        .stat-tile-arrow{ position: absolute; bottom: 14px; right: 16px; font-size: 14px; color: var(--line); transition: color .2s, transform .2s; }
        .stat-tile:hover .stat-tile-arrow { color: var(--gold); transform: translateX(2px); }

        /* ══ Responsive ═══════════════════════════════════════════ */
        @media(max-width: 1100px) {
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media(max-width: 900px) {
            .sidebar { transform: translateX(-100%); transition: transform .25s; }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: span 1; }
        }
    </style>
</head>
<body>

{{-- ── Sidebar ── --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/logo-nere.png') }}" alt="Néré Mining">
    </div>

    <nav class="sidebar-nav">

        <div class="nav-section">Tableau de bord</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">📊</span> Vue d'ensemble
        </a>
        <a href="{{ route('admin.analytics.index') }}"
           class="nav-item {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
            <span class="nav-icon">📈</span> Statistiques
            <span class="nav-badge nav-badge-gold">NEW</span>
        </a>

        <div class="nav-section">Contenu</div>
        <a href="{{ route('admin.news.index') }}"
           class="nav-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <span class="nav-icon">📰</span> Actualités
        </a>
        <a href="{{ route('admin.reports.index') }}"
           class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <span class="nav-icon">📄</span> Publications
        </a>
        <a href="{{ route('admin.press.index') }}"
           class="nav-item {{ request()->routeIs('admin.press.*') ? 'active' : '' }}">
            <span class="nav-icon">📢</span> Communiqués
        </a>
        <a href="{{ route('admin.media.index') }}"
           class="nav-item {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
            <span class="nav-icon">🖼️</span> Médiathèque
        </a>

        <div class="nav-section">Recrutement</div>
        <a href="{{ route('admin.jobs.index') }}"
           class="nav-item {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
            <span class="nav-icon">💼</span> Offres d'emploi
        </a>
        @php $newApps = \App\Models\JobApplication::where('status','new')->whereNull('read_at')->count(); @endphp
        <a href="{{ route('admin.applications.index') }}"
           class="nav-item {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
            <span class="nav-icon">📋</span> Candidatures
            @if($newApps > 0)
                <span class="nav-badge">{{ $newApps }}</span>
            @endif
        </a>

        <div class="nav-section">Relations</div>
        <a href="{{ route('admin.partners.index') }}"
           class="nav-item {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
            <span class="nav-icon">🤝</span> Partenaires
        </a>
        <a href="{{ route('admin.leadership.index') }}"
           class="nav-item {{ request()->routeIs('admin.leadership.*') ? 'active' : '' }}">
            <span class="nav-icon">👥</span> Équipe de direction
        </a>
        @php $unread = \App\Models\ContactMessage::whereNull('read_at')->count(); @endphp
        <a href="{{ route('admin.messages.index') }}"
           class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <span class="nav-icon">✉️</span> Messages
            @if($unread > 0)
                <span class="nav-badge">{{ $unread }}</span>
            @endif
        </a>
        <a href="{{ route('admin.newsletter.index') }}"
           class="nav-item {{ request()->routeIs('admin.newsletter.*') ? 'active' : '' }}">
            <span class="nav-icon">📧</span> Newsletter
        </a>

        <div class="nav-section">Karma</div>
        <a href="{{ route('admin.karma-departments.index') }}"
           class="nav-item {{ request()->routeIs('admin.karma-departments.*') ? 'active' : '' }}">
            <span class="nav-icon">🗂️</span> Organigramme
        </a>

        <div class="nav-section">Site public</div>
        <a href="{{ route('admin.hero.index') }}"
           class="nav-item {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
            <span class="nav-icon">🎠</span> Carrousel Hero
        </a>
        <a href="{{ route('admin.certifications.index') }}"
           class="nav-item {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}">
            <span class="nav-icon">🏆</span> Certifications
        </a>
        <a href="{{ route('admin.settings.index') }}"
           class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <span class="nav-icon">⚙️</span> Paramètres
        </a>

        <div class="nav-section">Administration</div>
        <a href="{{ route('admin.users.index') }}"
           class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <span class="nav-icon">👥</span> Utilisateurs Admin
        </a>

        <div class="nav-section">Accès rapide</div>
        <a href="{{ url('/') }}" target="_blank" class="nav-item">
            <span class="nav-icon">🌐</span> Voir le site public
        </a>

    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(session('admin_name', 'A'), 0, 1)) }}
            </div>
            <div>
                <div class="sidebar-user-name">{{ session('admin_name', 'Admin') }}</div>
                <div class="sidebar-user-role">Administrateur</div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="sidebar-logout">
                <span>↩</span> Déconnexion
            </button>
        </form>
    </div>
</aside>

{{-- ── Main ── --}}
<div class="main">

    {{-- Topbar --}}
    <header class="topbar">
        <div class="topbar-left">
            <div class="topbar-breadcrumb">
                Néré Mining Admin
                <span style="color:var(--muted);">/</span>
                <span>@yield('page-title', 'Administration')</span>
            </div>
        </div>
        <div class="topbar-right">
            @php $totalAlerts = \App\Models\ContactMessage::whereNull('read_at')->count() + \App\Models\JobApplication::where('status','new')->whereNull('read_at')->count(); @endphp
            <a href="{{ route('admin.messages.index') }}" class="topbar-notif" title="Messages non lus">
                ✉️
                @if($totalAlerts > 0)<span class="topbar-notif-dot"></span>@endif
            </a>
            <span class="topbar-date">{{ now()->isoFormat('dddd D MMM Y') }}</span>
            <a href="{{ url('/') }}" target="_blank" class="topbar-site">
                🌐 Voir le site
            </a>
        </div>
    </header>

    {{-- Content --}}
    <div class="content">
        @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $e)<div>✕ {{ $e }}</div>@endforeach
        </div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')

<script src="{{ asset('js/admin-animations.js') }}"></script>
<script>
// Mobile sidebar toggle
(function(){
    var sidebar = document.getElementById('sidebar');
    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape') sidebar.classList.remove('open');
    });
})();

// Initialisation des animations admin
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter les classes d'animation aux éléments existants
    document.querySelectorAll('.metric-card, .stat-tile').forEach(function(tile) {
        tile.classList.add('admin-stat-tile');
    });
    
    // Animation des alertes de succès/erreur
    document.querySelectorAll('.alert').forEach(function(alert) {
        alert.classList.add('admin-alert');
    });
    
    // Auto-fermeture des alertes après 5 secondes
    document.querySelectorAll('.admin-alert').forEach(function(alert) {
        if (alert.classList.contains('success')) {
            setTimeout(function() {
                alert.classList.add('fade-out');
                setTimeout(function() {
                    alert.remove();
                }, 300);
            }, 5000);
        }
    });
});
</script>
</body>
</html>
