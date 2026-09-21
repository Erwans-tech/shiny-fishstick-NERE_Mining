@extends('admin.partials.layout')
@section('title', 'Contenu éditable')
@section('page-title', 'Contenu éditable')
@section('content')
<div class="card">
    <div class="card-header"><h2>Contenu des pages</h2><span class="card-header-sub">Statistiques et événements de la timeline</span></div>
    @if(session('success'))<div class="alert alert-success" style="margin:20px;">{{ session('success') }}</div>@endif
    <div class="card-body">
        <form method="POST" action="{{ route('admin.site-content.store') }}" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;padding-bottom:24px;border-bottom:1px solid var(--line);">
            @csrf
            <select name="section" required><option value="home_stats">Accueil - statistiques</option><option value="karma_stats">Karma - statistiques</option><option value="sustainability_stats">Développement durable - statistiques</option><option value="history">Histoire - événement</option></select>
            <input name="key" placeholder="Identifiant (ex: emploi-direct)" required>
            <input name="label_fr" placeholder="Titre / année (français)" required><input name="label_en" placeholder="Titre / année (anglais)">
            <textarea name="value_fr" placeholder="Valeur ou description (français)"></textarea><textarea name="value_en" placeholder="Valeur ou description (anglais)"></textarea>
            <input name="icon" placeholder="Icône (optionnel)"><input name="suffix" placeholder="Suffixe (%, koz, km...)" >
            <input type="number" name="sort_order" value="0" min="0" placeholder="Ordre"><label><input type="checkbox" name="is_published" value="1" checked> Visible</label>
            <button class="btn btn-primary" type="submit">Ajouter le contenu</button>
        </form>
        @foreach($contents as $content)
        <form method="POST" action="{{ route('admin.site-content.update', $content) }}" style="display:grid;grid-template-columns:140px 1fr 1fr 1fr 1fr 110px 90px;gap:8px;align-items:start;padding:14px 0;border-bottom:1px solid var(--line);">
            @csrf @method('PUT')
            <input name="section" value="{{ $content->section }}" required>
            <input name="key" value="{{ $content->key }}" required>
            <input name="label_fr" value="{{ $content->label_fr }}" required>
            <input name="label_en" value="{{ $content->label_en }}" placeholder="Titre / année EN">
            <textarea name="value_fr" placeholder="Valeur / description FR">{{ $content->value_fr }}</textarea>
            <textarea name="value_en" placeholder="Valeur / description EN">{{ $content->value_en }}</textarea>
            <input name="icon" value="{{ $content->icon }}" placeholder="Icône">
            <input name="suffix" value="{{ $content->suffix }}" placeholder="Suffixe">
            <input type="number" name="sort_order" value="{{ $content->sort_order }}" min="0">
            <label><input type="checkbox" name="is_published" value="1" {{ $content->is_published ? 'checked' : '' }}> Visible</label>
            <button class="btn btn-primary" type="submit">Enregistrer</button>
        </form>
        <form method="POST" action="{{ route('admin.site-content.destroy', $content) }}" style="margin-top:-42px;text-align:right;">@csrf @method('DELETE')<button class="btn btn-ghost" type="submit">Supprimer</button></form>
        @endforeach
    </div>
</div>
@endsection