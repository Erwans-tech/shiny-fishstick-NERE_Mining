<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') — Néré Mining</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --green:  #4b1716;
            --green2: #3a100f;
            --red:    #d72f2f;
            --gold:   #ffc247;
            --sand:   #fff4dc;
            --muted:  #70645c;
            --line:   #eadcc5;
            --light:  #fbfaf7;
            --ink:    #281d18;
            --sidebar-w: 240px;
            --danger: #dc2626;
            --success-bg: #dcfce7;
            --success-fg: #166534;
            --error-bg:   #fee2e2;
            --error-fg:   #991b1b;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f4f1ec; color: var(--ink); display: flex; min-height: 100vh; }
        a { color: inherit; text-decoration: none; }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--green);
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar-logo {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .sidebar-logo img { width: 140px; display: block; }
        .sidebar-brand {
            font: 600 10px Inter, sans-serif;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: rgba(255,255,255,.45);
            margin-top: 6px;
        }
        .sidebar-nav { padding: 16px 0; flex: 1; }
        .nav-section {
            padding: 8px 20px 4px;
            font: 600 10px Inter, sans-serif;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: rgba(255,255,255,.35);
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            font: 500 13px Inter, sans-serif;
            color: rgba(255,255,255,.78);
            transition: background .15s, color .15s;
            border-left: 3px solid transparent;
        }
        .nav-item:hover  { background: rgba(255,255,255,.08); color: #fff; }
        .nav-item.active { background: rgba(255,255,255,.12); color: #fff; border-left-color: var(--gold); }
        .nav-item .icon  { font-size: 16px; width: 20px; text-align: center; }
        .nav-badge {
            margin-left: auto;
            background: var(--red);
            color: #fff;
            font: 700 10px Inter, sans-serif;
            padding: 2px 7px;
            border-radius: 20px;
        }
        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,.1);
            font: 500 12px Inter, sans-serif;
            color: rgba(255,255,255,.55);
        }
        .sidebar-footer a {
            display: block;
            color: rgba(255,255,255,.7);
            margin-top: 10px;
            transition: color .15s;
        }
        .sidebar-footer a:hover { color: var(--gold); }

        /* ── Main area ── */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* ── Topbar ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--line);
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title { font: 600 16px Inter, sans-serif; color: var(--green); }
        .topbar-right  { display: flex; align-items: center; gap: 16px; font: 500 13px Inter, sans-serif; color: var(--muted); }
        .topbar-right a:hover { color: var(--red); }

        /* ── Content ── */
        .content { padding: 28px; flex: 1; }

        /* ── Alerts ── */
        .alert {
            padding: 13px 18px;
            border-radius: 6px;
            font: 500 14px Inter, sans-serif;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: var(--success-bg); color: var(--success-fg); border: 1px solid #bbf7d0; }
        .alert-error   { background: var(--error-bg);   color: var(--error-fg);   border: 1px solid #fecaca; }

        /* ── Cards ── */
        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            overflow: hidden;
        }
        .card-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .card-header h2 { font: 600 15px Inter, sans-serif; color: var(--green); }
        .card-body { padding: 22px; }

        /* ── Stat tiles (dashboard) ── */
        .stat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 28px; }
        .stat-tile {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 22px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: box-shadow .2s;
        }
        .stat-tile:hover { box-shadow: 0 4px 16px rgba(0,0,0,.07); }
        .stat-tile-icon {
            width: 46px; height: 46px;
            border-radius: 10px;
            background: var(--sand);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }
        .stat-tile-num { font: 300 32px Inter, sans-serif; color: var(--green); line-height: 1; }
        .stat-tile-lbl { font: 500 12px Inter, sans-serif; color: var(--muted); margin-top: 4px; }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }
        thead th {
            text-align: left;
            padding: 11px 14px;
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

        /* ── Badges ── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font: 600 11px Inter, sans-serif;
            letter-spacing: .06em;
        }
        .badge-green  { background: #dcfce7; color: #166534; }
        .badge-red    { background: #fee2e2; color: #991b1b; }
        .badge-blue   { background: #dbeafe; color: #1e40af; }
        .badge-gray   { background: #f1f5f9; color: #475569; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 6px;
            font: 600 12px Inter, sans-serif;
            letter-spacing: .06em;
            border: 0;
            cursor: pointer;
            transition: all .15s;
            text-transform: uppercase;
        }
        .btn-primary { background: var(--green); color: #fff; }
        .btn-primary:hover { background: var(--green2); }
        .btn-gold    { background: var(--gold); color: var(--ink); }
        .btn-gold:hover { background: #e5a72f; }
        .btn-danger  { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-ghost   { background: transparent; border: 1px solid var(--line); color: var(--ink); }
        .btn-ghost:hover { border-color: var(--green); color: var(--green); }
        .btn-sm { padding: 5px 11px; font-size: 11px; }

        /* ── Form ── */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: span 2; }
        label { font: 600 11px Inter, sans-serif; letter-spacing: .07em; text-transform: uppercase; color: var(--muted); }
        input[type=text], input[type=email], input[type=date], input[type=number],
        input[type=url], select, textarea {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 10px 13px;
            font: 14px Inter, sans-serif;
            color: var(--ink);
            background: #fff;
            transition: border-color .15s;
        }
        input:focus, select:focus, textarea:focus { outline: none; border-color: var(--gold); }
        textarea { min-height: 120px; resize: vertical; }
        .form-hint { font: 12px Inter, sans-serif; color: var(--muted); }
        .form-error { font: 12px Inter, sans-serif; color: var(--danger); }
        .toggle-wrap { display: flex; align-items: center; gap: 10px; }
        .toggle-wrap input[type=checkbox] { width: 18px; height: 18px; cursor: pointer; accent-color: var(--green); }
        .form-actions { display: flex; gap: 12px; margin-top: 8px; padding-top: 20px; border-top: 1px solid var(--line); }

        /* ── Pagination ── */
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

        /* ── Responsive ── */
        @media(max-width: 900px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .stat-grid { grid-template-columns: 1fr 1fr; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: span 1; }
        }
    </style>
</head>
<body>
<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/logo-nere.png') }}" alt="Néré Mining">
        <div class="sidebar-brand">Administration</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">Tableau de bord</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="icon">🏠</span> Tableau de bord
        </a>

        <div class="nav-section" style="margin-top:10px;">Contenu</div>
        <a href="{{ route('admin.news.index') }}"
           class="nav-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
            <span class="icon">📰</span> Actualités
        </a>
        <a href="{{ route('admin.reports.index') }}"
           class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <span class="icon">📄</span> Publications
        </a>
        <a href="{{ route('admin.press.index') }}"
           class="nav-item {{ request()->routeIs('admin.press.*') ? 'active' : '' }}">
            <span class="icon">📢</span> Communiqués
        </a>
        <a href="{{ route('admin.media.index') }}"
           class="nav-item {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
            <span class="icon">🖼️</span> Médiathèque
        </a>

        <div class="nav-section" style="margin-top:10px;">Recrutement</div>
        <a href="{{ route('admin.jobs.index') }}"
           class="nav-item {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
            <span class="icon">💼</span> Offres d'emploi
        </a>
        @php $newApps = \App\Models\JobApplication::where('status','new')->whereNull('read_at')->count(); @endphp
        <a href="{{ route('admin.applications.index') }}"
           class="nav-item {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
            <span class="icon">📋</span> Candidatures
            @if($newApps > 0)<span class="nav-badge">{{ $newApps }}</span>@endif
        </a>

        <div class="nav-section" style="margin-top:10px;">Relations</div>
        <a href="{{ route('admin.partners.index') }}"
           class="nav-item {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
            <span class="icon">🤝</span> Partenaires
        </a>
        @php $unread = \App\Models\ContactMessage::whereNull('read_at')->count(); @endphp
        <a href="{{ route('admin.messages.index') }}"
           class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <span class="icon">✉️</span> Messages
            @if($unread > 0)<span class="nav-badge">{{ $unread }}</span>@endif
        </a>

        <div class="nav-section" style="margin-top:10px;">Site public</div>
        <a href="{{ url('/') }}" target="_blank" class="nav-item">
            <span class="icon">🌐</span> Voir le site
        </a>
    </nav>

    <div class="sidebar-footer">
        <span>{{ session('admin_name', 'Admin') }}</span>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;color:rgba(255,255,255,.6);font:500 12px Inter,sans-serif;padding:0;margin-top:10px;">
                ← Déconnexion
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <span class="topbar-title">@yield('page-title', 'Administration')</span>
        <div class="topbar-right">
            <span>{{ date('d/m/Y') }}</span>
            <form method="POST" action="{{ route('admin.logout') }}" style="margin:0;">
                @csrf
                <button type="submit" style="background:none;border:none;cursor:pointer;font:500 13px Inter,sans-serif;color:var(--muted);">Déconnexion</button>
            </form>
        </div>
    </header>

    <div class="content">
        @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-error">
            <div>
                @foreach($errors->all() as $e)
                <div>✕ {{ $e }}</div>
                @endforeach
            </div>
        </div>
        @endif

        @yield('content')
    </div>
</div>
</body>
</html>
