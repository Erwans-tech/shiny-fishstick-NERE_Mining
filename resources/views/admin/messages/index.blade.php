@extends('admin.partials.layout')
@section('title','Messages')
@section('page-title','Messages de contact')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Messages ({{ $messages->total() }})</h2>
        @php $unread = $messages->getCollection()->whereNull('read_at')->count(); @endphp
        @if($unread > 0)<span class="badge badge-red">{{ $unread }} non lu(s)</span>@endif
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Nom</th><th>E-mail</th><th>Type</th><th>Objet</th><th>Date</th><th>Statut</th><th>Action</th></tr></thead>
            <tbody>
            @forelse($messages as $m)
            <tr style="{{ $m->read_at ? '' : 'font-weight:600;' }}">
                <td>{{ $m->name }}</td>
                <td class="td-muted">{{ $m->email }}</td>
                <td><span class="badge badge-gray">{{ $m->type }}</span></td>
                <td class="td-muted">{{ Str::limit($m->subject, 35) }}</td>
                <td class="td-muted">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($m->read_at)
                        <span class="badge badge-green">Lu</span>
                    @else
                        <span class="badge badge-yellow">Non lu</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-ghost btn-sm">Voir</a>
                    <form method="POST" action="{{ route('admin.messages.destroy', $m) }}" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">✕</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">Aucun message.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())<div class="card-body">{{ $messages->links() }}</div>@endif
</div>
@endsection
