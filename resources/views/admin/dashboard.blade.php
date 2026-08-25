@extends('admin.partials.layout')
@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="stat-grid">
    <a href="{{ route('admin.news.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">📰</div>
        <div>
            <div class="stat-tile-num">{{ $counts['news'] }}</div>
            <div class="stat-tile-lbl">Actualités</div>
        </div>
    </a>
    <a href="{{ route('admin.reports.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">📄</div>
        <div>
            <div class="stat-tile-num">{{ $counts['reports'] }}</div>
            <div class="stat-tile-lbl">Publications</div>
        </div>
    </a>
    <a href="{{ route('admin.jobs.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">💼</div>
        <div>
            <div class="stat-tile-num">{{ $counts['jobs'] }}</div>
            <div class="stat-tile-lbl">Offres publiées</div>
        </div>
    </a>
    <a href="{{ route('admin.messages.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">✉️</div>
        <div>
            <div class="stat-tile-num">{{ $counts['messages'] }}</div>
            <div class="stat-tile-lbl">Messages non lus</div>
        </div>
    </a>
    <a href="{{ route('admin.partners.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">🤝</div>
        <div>
            <div class="stat-tile-num">{{ $counts['partners'] }}</div>
            <div class="stat-tile-lbl">Partenaires</div>
        </div>
    </a>
    <a href="{{ route('admin.media.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">🖼️</div>
        <div>
            <div class="stat-tile-num">{{ $counts['media'] }}</div>
            <div class="stat-tile-lbl">Médias</div>
        </div>
    </a>
    <a href="{{ route('admin.press.index') }}" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">📢</div>
        <div>
            <div class="stat-tile-num">{{ $counts['press'] }}</div>
            <div class="stat-tile-lbl">Communiqués</div>
        </div>
    </a>
    <a href="{{ url('/') }}" target="_blank" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon">🌐</div>
        <div>
            <div class="stat-tile-num" style="font-size:20px;">→</div>
            <div class="stat-tile-lbl">Voir le site</div>
        </div>
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h2>Accès rapides</h2>
    </div>
    <div class="card-body" style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">+ Nouvelle actualité</a>
        <a href="{{ route('admin.jobs.create') }}"  class="btn btn-gold">+ Nouvelle offre</a>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-ghost">+ Partenaire</a>
        <a href="{{ route('admin.reports.create') }}"  class="btn btn-ghost">+ Publication</a>
        <a href="{{ route('admin.press.create') }}"    class="btn btn-ghost">+ Communiqué</a>
        <a href="{{ route('admin.media.create') }}"    class="btn btn-ghost">+ Média</a>
    </div>
</div>
@endsection
