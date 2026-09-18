@extends('admin.partials.layout')
@section('title', $album->title)
@section('page-title', $album->title)

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2>{{ $album->title }}</h2>
            @if($album->description)
                <p style="margin-top:8px;color:var(--muted);font-size:14px;">{{ $album->description }}</p>
            @endif
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.albums.edit', $album) }}" class="btn btn-ghost">Modifier l'album</a>
            <a href="{{ route('admin.albums.index') }}" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
    </div>
    
    <div class="card-body">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;padding:16px;background:var(--sand);border-radius:8px;">
            <div>
                <strong style="font-size:15px;">{{ $album->media->count() }} photos dans cet album</strong>
                <p style="margin-top:4px;font-size:13px;color:var(--muted);">
                    Ordre d'affichage: {{ $album->sort_order }} • 
                    Statut: <span class="badge {{ $album->is_published ? 'badge-green' : 'badge-gray' }}">
                        {{ $album->is_published ? 'Publié' : 'Brouillon' }}
                    </span>
                </p>
            </div>
            <a href="{{ route('admin.media.create') }}" class="btn btn-primary">+ Ajouter une photo</a>
        </div>

        @if($album->media->isEmpty())
            <div style="text-align:center;padding:60px 20px;color:var(--muted);">
                <div style="font-size:64px;margin-bottom:16px;">📸</div>
                <h3 style="font-size:18px;margin-bottom:8px;">Aucune photo dans cet album</h3>
                <p style="margin-bottom:20px;">Ajoutez des photos depuis la médiathèque</p>
                <a href="{{ route('admin.media.create') }}" class="btn btn-primary">+ Ajouter une photo</a>
            </div>
        @else
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
                @foreach($album->media as $media)
                    <div style="border:1px solid var(--line);border-radius:8px;overflow:hidden;background:white;">
                        <div style="aspect-ratio:4/3;overflow:hidden;background:var(--sand);">
                            @if($media->type === 'image' && $media->url)
                                <img src="{{ $media->url }}" alt="{{ $media->title }}" 
                                     style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:32px;">
                                    📄
                                </div>
                            @endif
                        </div>
                        <div style="padding:12px;">
                            <strong style="font-size:13px;display:block;margin-bottom:4px;">{{ $media->title }}</strong>
                            <div style="font-size:11px;color:var(--muted);margin-bottom:8px;">
                                Ordre: {{ $media->sort_order }} • 
                                <span class="badge {{ $media->is_published ? 'badge-green' : 'badge-gray' }}" style="font-size:10px;">
                                    {{ $media->is_published ? 'Publié' : 'Masqué' }}
                                </span>
                            </div>
                            <div style="display:flex;gap:4px;">
                                <a href="{{ route('admin.media.edit', $media) }}" class="btn btn-ghost btn-sm" style="font-size:11px;padding:4px 8px;">
                                    Modifier
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div class="card" style="margin-top:24px;background:var(--sand);">
    <div class="card-body">
        <h3 style="margin-bottom:12px;font-size:16px;">💡 Astuce</h3>
        <p style="line-height:1.6;color:var(--muted);">
            Pour réorganiser l'ordre des photos, modifiez le champ "Ordre d'affichage" de chaque photo. 
            Les photos sont affichées du plus petit au plus grand numéro.
        </p>
    </div>
</div>
@endsection
