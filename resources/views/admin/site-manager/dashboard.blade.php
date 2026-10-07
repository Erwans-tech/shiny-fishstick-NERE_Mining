@extends('admin.layouts.app')

@section('title', 'Tableau de bord - Gérant du site')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-4xl font-bold mb-8">Tableau de bord - Gestion du site</h1>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Actualités</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total_news'] ?? 0 }}</p>
            <p class="text-xs text-gray-500">{{ $stats['published_news'] ?? 0 }} publiées</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Offres d'emploi</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['total_jobs'] ?? 0 }}</p>
            <p class="text-xs text-gray-500">{{ $stats['active_jobs'] ?? 0 }} actives</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Publications</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $stats['total_reports'] ?? 0 }}</p>
            <p class="text-xs text-gray-500">{{ $stats['published_reports'] ?? 0 }} publiées</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Médias</h3>
            <p class="text-3xl font-bold text-orange-600">{{ $stats['total_media'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Carrousel</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $stats['hero_slides'] ?? 0 }}</p>
            <p class="text-xs text-gray-500">diapositives</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Dernières actualités -->
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Dernières actualités</h2>
            @forelse($recent_news as $news)
                <div class="mb-4 pb-4 border-b last:border-b-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">{{ $news->title }}</p>
                            <p class="text-sm text-gray-600">{{ Str::limit($news->excerpt, 50) }}</p>
                            <p class="text-xs text-gray-500">{{ $news->published_at?->format('d/m/Y H:i') ?? 'Non publiée' }}</p>
                        </div>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                            {{ $news->published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}
                        ">
                            {{ $news->published ? 'Publiée' : 'Brouillon' }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Aucune actualité</p>
            @endforelse
            <a href="{{ route('admin.news.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                Gérer les actualités →
            </a>
        </div>

        <!-- Offres d'emploi actives -->
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Offres d'emploi actives</h2>
            @forelse($active_jobs as $job)
                <div class="mb-4 pb-4 border-b last:border-b-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">{{ $job->title }}</p>
                            <p class="text-sm text-gray-600">{{ $job->location }}</p>
                            <p class="text-xs text-gray-500">Publiée le {{ $job->created_at->format('d/m/Y') }}</p>
                        </div>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            Active
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Aucune offre d'emploi active</p>
            @endforelse
            <a href="{{ route('admin.jobs.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                Gérer les offres →
            </a>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="mt-8 bg-white rounded shadow p-6">
        <h2 class="text-2xl font-bold mb-4">Actions rapides</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.news.create') }}" class="block p-4 border rounded hover:bg-blue-50 hover:border-blue-300">
                <p class="font-semibold text-blue-600">+ Nouvelle actualité</p>
                <p class="text-xs text-gray-500">Créer une actualité</p>
            </a>
            <a href="{{ route('admin.jobs.create') }}" class="block p-4 border rounded hover:bg-green-50 hover:border-green-300">
                <p class="font-semibold text-green-600">+ Offre d'emploi</p>
                <p class="text-xs text-gray-500">Publier une offre</p>
            </a>
            <a href="{{ route('admin.media.create') }}" class="block p-4 border rounded hover:bg-purple-50 hover:border-purple-300">
                <p class="font-semibold text-purple-600">+ Média</p>
                <p class="text-xs text-gray-500">Ajouter un média</p>
            </a>
            <a href="{{ route('admin.hero.create') }}" class="block p-4 border rounded hover:bg-indigo-50 hover:border-indigo-300">
                <p class="font-semibold text-indigo-600">+ Carrousel</p>
                <p class="text-xs text-gray-500">Ajouter une diapositive</p>
            </a>
        </div>
    </div>
</div>
@endsection
