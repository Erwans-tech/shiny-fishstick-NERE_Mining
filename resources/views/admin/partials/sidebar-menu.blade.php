<?php
// Déterminer le rôle de l'utilisateur
$userRole = session('admin_role', 'site_manager');
$userId = session('admin_id');
?>

<aside class="bg-gray-900 text-white w-64 min-h-screen p-4">
    <div class="mb-8">
        <h1 class="text-2xl font-bold">Néré Mining</h1>
        <p class="text-gray-400 text-sm">
            @if($userRole === 'admin')
                Administrateur
            @elseif($userRole === 'hr')
                Ressources Humaines
            @elseif($userRole === 'site_manager')
                Gérant du site
            @endif
        </p>
    </div>

    <nav class="space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
            📊 Tableau de bord
        </a>

        @if($userRole === 'admin')
            <!-- Admin: Tous les accès -->
            <hr class="my-4 border-gray-700">
            <h3 class="px-4 py-2 text-xs font-bold text-gray-400 uppercase">Contenu</h3>
            
            <a href="{{ route('admin.news.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.news.*') ? 'bg-blue-600' : '' }}">
                📰 Actualités
            </a>
            <a href="{{ route('admin.reports.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600' : '' }}">
                📄 Publications
            </a>
            <a href="{{ route('admin.jobs.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.jobs.*') ? 'bg-blue-600' : '' }}">
                💼 Offres d'emploi
            </a>
            <a href="{{ route('admin.media.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.media.*') ? 'bg-blue-600' : '' }}">
                🖼️ Médiathèque
            </a>

            <hr class="my-4 border-gray-700">
            <h3 class="px-4 py-2 text-xs font-bold text-gray-400 uppercase">Ressources Humaines</h3>
            
            <a href="{{ route('admin.applications.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.applications.*') ? 'bg-blue-600' : '' }}">
                👥 Candidatures
            </a>
            <a href="{{ route('admin.messages.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.messages.*') ? 'bg-blue-600' : '' }}">
                ✉️ Messages
            </a>
            <a href="{{ route('admin.newsletter.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.newsletter.*') ? 'bg-blue-600' : '' }}">
                📬 Newsletter
            </a>

            <hr class="my-4 border-gray-700">
            <h3 class="px-4 py-2 text-xs font-bold text-gray-400 uppercase">Administration</h3>
            
            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-blue-600' : '' }}">
                👤 Utilisateurs
            </a>
            <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600' : '' }}">
                ⚙️ Paramètres
            </a>
            <a href="{{ route('admin.analytics.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.analytics.*') ? 'bg-blue-600' : '' }}">
                📈 Statistiques
            </a>

        @elseif($userRole === 'hr')
            <!-- RH: Candidatures, messages, newsletter -->
            <hr class="my-4 border-gray-700">
            <h3 class="px-4 py-2 text-xs font-bold text-gray-400 uppercase">Ressources Humaines</h3>
            
            <a href="{{ route('admin.applications.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.applications.*') ? 'bg-blue-600' : '' }}">
                👥 Candidatures
                @php
                    $newApps = \App\Models\JobApplication::where('status', 'new')->count();
                @endphp
                @if($newApps > 0)
                    <span class="ml-2 inline-block bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $newApps }}</span>
                @endif
            </a>
            <a href="{{ route('admin.messages.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.messages.*') ? 'bg-blue-600' : '' }}">
                ✉️ Messages
                @php
                    $unreadMsgs = \App\Models\ContactMessage::whereNull('read_at')->count();
                @endphp
                @if($unreadMsgs > 0)
                    <span class="ml-2 inline-block bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadMsgs }}</span>
                @endif
            </a>
            <a href="{{ route('admin.newsletter.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.newsletter.*') ? 'bg-blue-600' : '' }}">
                📬 Newsletter
            </a>

        @elseif($userRole === 'site_manager')
            <!-- Gérant du site: Contenu et configuration -->
            <hr class="my-4 border-gray-700">
            <h3 class="px-4 py-2 text-xs font-bold text-gray-400 uppercase">Contenu</h3>
            
            <a href="{{ route('admin.news.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.news.*') ? 'bg-blue-600' : '' }}">
                📰 Actualités
            </a>
            <a href="{{ route('admin.jobs.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.jobs.*') ? 'bg-blue-600' : '' }}">
                💼 Offres d'emploi
            </a>
            <a href="{{ route('admin.reports.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.reports.*') ? 'bg-blue-600' : '' }}">
                📄 Publications
            </a>
            <a href="{{ route('admin.media.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.media.*') ? 'bg-blue-600' : '' }}">
                🖼️ Médiathèque
            </a>

            <hr class="my-4 border-gray-700">
            <h3 class="px-4 py-2 text-xs font-bold text-gray-400 uppercase">Configuration</h3>
            
            <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600' : '' }}">
                ⚙️ Paramètres
            </a>
            <a href="{{ route('admin.hero.index') }}" class="block px-4 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('admin.hero.*') ? 'bg-blue-600' : '' }}">
                🎪 Carrousel
            </a>
        @endif
    </nav>

    <!-- Pied de page -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700">
        <p class="text-xs text-gray-400 mb-3">{{ session('admin_name') }}</p>
        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-gray-800 text-red-500 hover:text-red-400">
                🚪 Déconnexion
            </button>
        </form>
    </div>
</aside>
