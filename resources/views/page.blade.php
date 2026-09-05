{{--
    Dispatcher générique.

    Ce fichier est le seul point d'entrée pour toutes les pages publiques
    servies via le helper $page() dans routes/web.php.

    Il transmet les variables ($locale, $section, $reports, $jobs…) au layout
    partagé layouts/app.blade.php, puis inclut la vue dédiée à chaque section
    dans resources/views/pages/{section}.blade.php.

    Pour ajouter une nouvelle page :
      1. Créer resources/views/pages/ma-section.blade.php
      2. Ajouter la route dans routes/web.php : fn() => $page('fr', 'ma-section')
      C'est tout  - aucune modification de ce fichier n'est nécessaire.
--}}
@php
    $en  = ($locale ?? 'fr') === 'en';
    $loc = $locale ?? 'fr';
@endphp

@if(view()->exists('pages.' . $section))
    @include('pages.' . $section)
@else
    {{-- Fallback : section inconnue → page 404 propre --}}
    @php abort(404); @endphp
@endif
