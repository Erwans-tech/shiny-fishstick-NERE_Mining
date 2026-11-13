@extends('admin.partials.layout')
@section('title','Vidéos')
@section('page-title','Vidéos')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Vidéos ({{ $videos->total() }})</h2>
        <a href="{{ route('admin.videos.create') }}" class="btn btn-primary">+ Ajouter une vidéo</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Aperçu</th><th>Titre</th><th>Date</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            @forelse($videos as $v)
            <tr>
                <td>
                    @if($v->posterUrl())
                        <img src="{{ $v->posterUrl() }}" alt="" style="width:110px;height:62px;object-fit:cover;border-radius:6px;">
                    @else
                        <span class="badge badge-gray">Sans aperçu</span>
                    @endif
                </td>
                <td>
                    {{ $v->title }}
                    @if($v->title_en)<div class="td-muted" style="font-size:12px;">{{ $v->title_en }}</div>@endif
                </td>
                <td class="td-muted">{{ $v->video_date?->format('d/m/Y') }}</td>
                <td><span class="badge {{ $v->is_published ? 'badge-green' : 'badge-gray' }}">{{ $v->is_published ? 'Visible' : 'Masquée' }}</span></td>
                <td>
                    <a href="{{ route('admin.videos.edit', $v) }}" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="{{ route('admin.videos.destroy', $v) }}" style="display:inline;" onsubmit="return confirm('Supprimer cette vidéo ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">Aucune vidéo.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($videos->hasPages())<div class="card-body">{{ $videos->links() }}</div>@endif
</div>
@endsection
