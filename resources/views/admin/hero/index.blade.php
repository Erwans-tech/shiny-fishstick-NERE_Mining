@extends('admin.partials.layout')
@section('title', 'Carrousel Hero')
@section('page-title', 'Carrousel — Page d\'accueil')

@section('content')

{{-- En-tête --}}
<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <div>
            <h2>🖼️ Diaporama de la page d'accueil</h2>
            <span class="card-header-sub">
                {{ $slides->count() }} slide(s) · {{ $slides->where('is_active', true)->count() }} active(s)
            </span>
        </div>
        <a href="{{ route('admin.hero.create') }}" class="btn btn-primary">
            + Ajouter une image
        </a>
    </div>

    {{-- Aperçu en direct --}}
    <div style="height:3px; background:linear-gradient(to right,
        {{ $slides->where('is_active',true)->count() > 0 ? '#ffc247' : '#eadcc5' }},
        {{ $slides->where('is_active',true)->count() > 0 ? '#e5a72f' : '#eadcc5' }}
    );"></div>

    {{-- Info box --}}
    <div style="padding:14px 20px; background:#faf8f4; border-bottom:1px solid var(--line); font:13px Inter,sans-serif; color:var(--muted); display:flex; align-items:center; gap:10px;">
        <span style="font-size:16px;">💡</span>
        <span>
            Faites glisser les lignes pour réordonner. Cliquez sur <strong>Activer/Masquer</strong> pour contrôler l'affichage sur le site en temps réel.
            @if($slides->isEmpty())
                <strong style="color:#854d0e;"> — Aucune slide configurée : les 5 images par défaut (karma-01 à karma-05) sont utilisées.</strong>
            @endif
        </span>
    </div>
</div>

{{-- Grille de slides --}}
@if($slides->isEmpty())
<div class="card" style="padding:48px; text-align:center; color:var(--muted);">
    <div style="font-size:40px; margin-bottom:14px;">🏔️</div>
    <h3 style="font:500 18px Inter,sans-serif; color:var(--green); margin-bottom:8px;">Aucune slide configurée</h3>
    <p style="font-size:14px; margin-bottom:20px;">Le carrousel utilise actuellement les 5 images par défaut.<br>Ajoutez vos propres images pour personnaliser le diaporama.</p>
    <a href="{{ route('admin.hero.create') }}" class="btn btn-primary">+ Ajouter la première slide</a>
</div>

{{-- Aperçu des slides par défaut --}}
<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <h2 style="color:var(--muted);">Images par défaut (actuellement affichées)</h2>
    </div>
    <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:12px; padding:20px;">
        @foreach(range(1,5) as $i)
        <div style="border-radius:8px; overflow:hidden; border:1px solid var(--line);">
            <img src="{{ asset('images/mining/karma-0'.$i.'.jpg') }}"
                 style="width:100%; height:120px; object-fit:cover; display:block;"
                 alt="Karma 0{{ $i }}">
            <div style="padding:8px 10px; font:500 11px Inter,sans-serif; color:var(--muted); background:#faf8f4;">
                karma-0{{ $i }}.jpg
            </div>
        </div>
        @endforeach
    </div>
</div>

@else

<div id="slides-list" class="card">
    <div class="card-header">
        <h2>Slides configurées</h2>
        <span style="font:500 12px Inter,sans-serif; color:var(--muted);">⠿ Glisser pour réordonner</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:44px;">⠿</th>
                    <th style="width:120px;">Aperçu</th>
                    <th>Titre / Légende</th>
                    <th style="width:80px;">Ordre</th>
                    <th style="width:100px;">Statut</th>
                    <th style="width:160px;">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable-slides">
                @foreach($slides as $slide)
                <tr data-id="{{ $slide->id }}" style="cursor:grab; {{ !$slide->is_active ? 'opacity:.55;' : '' }}">
                    {{-- Handle drag --}}
                    <td style="text-align:center; font-size:18px; color:var(--muted); cursor:grab;">⠿</td>

                    {{-- Aperçu image --}}
                    <td>
                        <div style="width:110px; height:65px; border-radius:6px; overflow:hidden; border:1px solid var(--line);">
                            <img src="{{ $slide->url }}"
                                 style="width:100%; height:100%; object-fit:cover;"
                                 alt="{{ $slide->title ?? 'Slide' }}"
                                 loading="lazy">
                        </div>
                    </td>

                    {{-- Titre + légende --}}
                    <td>
                        <div style="font:600 13px Inter,sans-serif; color:var(--green);">
                            {{ $slide->title ?? '—' }}
                        </div>
                        @if($slide->caption)
                        <div style="font:12px Inter,sans-serif; color:var(--muted); margin-top:3px; font-style:italic;">
                            "{{ Str::limit($slide->caption, 60) }}"
                        </div>
                        @endif
                        <div style="font:11px Inter,sans-serif; color:var(--muted); margin-top:4px;">
                            {{ basename($slide->image_path) }}
                        </div>
                    </td>

                    {{-- Ordre --}}
                    <td style="text-align:center;">
                        <span style="display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:50%; background:var(--sand); font:600 13px Inter,sans-serif; color:var(--green);">
                            {{ $slide->sort_order + 1 }}
                        </span>
                    </td>

                    {{-- Statut --}}
                    <td>
                        <form method="POST" action="{{ route('admin.hero.toggle', $slide) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                class="badge {{ $slide->is_active ? 'badge-green' : 'badge-gray' }}"
                                style="border:none; cursor:pointer; padding:5px 12px;">
                                {{ $slide->is_active ? '● Visible' : '○ Masquée' }}
                            </button>
                        </form>
                    </td>

                    {{-- Actions --}}
                    <td>
                        <div style="display:flex; gap:6px;">
                            <a href="{{ route('admin.hero.edit', $slide) }}" class="btn btn-ghost btn-sm">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('admin.hero.destroy', $slide) }}"
                                  onsubmit="return confirm('Supprimer cette slide ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">✕</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Prévisualisation du carrousel --}}
<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <h2>👁 Prévisualisation du carrousel</h2>
        <span class="card-header-sub">Rendu approximatif — {{ $slides->where('is_active', true)->count() }} slide(s) active(s)</span>
    </div>
    <div style="position:relative; height:220px; overflow:hidden; background:#1a0505;">
        @php $activeSlides = $slides->where('is_active', true)->values(); @endphp
        @forelse($activeSlides as $idx => $slide)
        <div style="
            position:absolute; inset:0;
            background:url('{{ $slide->url }}') center/cover;
            opacity:{{ $idx === 0 ? '1' : '0' }};
            transition:opacity 1s;
        " id="preview-slide-{{ $idx }}">
            <div style="position:absolute; inset:0; background:linear-gradient(to right, rgba(20,4,4,.75), rgba(20,4,4,.2));"></div>
            @if($slide->caption)
            <div style="position:absolute; bottom:20px; left:24px; color:#fff; font:500 16px Inter,sans-serif; text-shadow:0 1px 4px rgba(0,0,0,.5);">
                {{ $slide->caption }}
            </div>
            @endif
        </div>
        @empty
        <div style="display:flex; align-items:center; justify-content:center; height:100%; color:rgba(255,255,255,.4); font:14px Inter,sans-serif;">
            Aucune slide active
        </div>
        @endforelse

        {{-- Indicateurs --}}
        @if($activeSlides->count() > 1)
        <div style="position:absolute; bottom:10px; left:50%; transform:translateX(-50%); display:flex; gap:6px;">
            @foreach($activeSlides as $idx => $slide)
            <div class="preview-dot" data-idx="{{ $idx }}"
                 style="width:8px; height:8px; border-radius:50%; background:{{ $idx === 0 ? '#ffc247' : 'rgba(255,255,255,.4)' }}; cursor:pointer; transition:background .2s;"></div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- Script drag-and-drop et prévisualisation --}}
<script>
(function(){
    var count = {{ $activeSlides->count() }};
    var current = 0;
    var timer;

    function showSlide(idx){
        document.querySelectorAll('[id^="preview-slide-"]').forEach(function(el, i){
            el.style.opacity = i === idx ? '1' : '0';
        });
        document.querySelectorAll('.preview-dot').forEach(function(dot, i){
            dot.style.background = i === idx ? '#ffc247' : 'rgba(255,255,255,.4)';
        });
        current = idx;
    }

    function autoAdvance(){
        timer = setInterval(function(){
            showSlide((current + 1) % Math.max(count, 1));
        }, 3000);
    }

    document.querySelectorAll('.preview-dot').forEach(function(dot){
        dot.addEventListener('click', function(){
            clearInterval(timer);
            showSlide(parseInt(this.dataset.idx));
            autoAdvance();
        });
    });

    if(count > 1) autoAdvance();

    // ── Drag-and-drop pour réordonner ──
    var tbody = document.getElementById('sortable-slides');
    if(!tbody) return;

    var dragged = null;

    tbody.addEventListener('dragstart', function(e){
        dragged = e.target.closest('tr');
        dragged.style.opacity = '.5';
    });
    tbody.addEventListener('dragend', function(){
        if(dragged) dragged.style.opacity = '';
        dragged = null;
        saveOrder();
    });
    tbody.addEventListener('dragover', function(e){
        e.preventDefault();
        var target = e.target.closest('tr');
        if(target && target !== dragged && target.parentNode === tbody){
            var rect = target.getBoundingClientRect();
            var mid  = rect.top + rect.height / 2;
            tbody.insertBefore(dragged, e.clientY < mid ? target : target.nextSibling);
        }
    });

    // Rendre les lignes draggables
    tbody.querySelectorAll('tr').forEach(function(tr){ tr.draggable = true; });

    function saveOrder(){
        var rows = tbody.querySelectorAll('tr');
        var order = [];
        rows.forEach(function(tr, i){ order.push({id: parseInt(tr.dataset.id), order: i}); });

        fetch('{{ route('admin.hero.reorder') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content
                    || '{{ csrf_token() }}'
            },
            body: JSON.stringify({order: order})
        }).then(function(r){ return r.json(); })
          .then(function(d){ if(d.success) showToast('Ordre sauvegardé ✓'); })
          .catch(function(){ showToast('Erreur lors de la sauvegarde', true); });
    }

    function showToast(msg, error){
        var t = document.createElement('div');
        t.textContent = msg;
        t.style.cssText = 'position:fixed;bottom:24px;right:24px;padding:12px 20px;border-radius:8px;font:600 13px Inter,sans-serif;z-index:9999;animation:fadeIn .3s;' +
            (error ? 'background:#fee2e2;color:#991b1b;' : 'background:#dcfce7;color:#166534;');
        document.body.appendChild(t);
        setTimeout(function(){ t.remove(); }, 3000);
    }
})();
</script>
@endif

@endsection
