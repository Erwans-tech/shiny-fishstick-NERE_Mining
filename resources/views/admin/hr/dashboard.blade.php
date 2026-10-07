@extends('admin.layouts.app')

@section('title', 'Tableau de bord RH')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-4xl font-bold mb-8">Tableau de bord RH</h1>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Nouvelles candidatures</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['new_applications'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Total des candidatures</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $stats['total_applications'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Messages non lus</h3>
            <p class="text-3xl font-bold text-red-600">{{ $stats['new_messages'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">En attente de révision</h3>
            <p class="text-3xl font-bold text-orange-600">{{ $stats['pending_reviews'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Abonnés newsletter</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['newsletter_subscribers'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-gray-600 text-sm font-medium">Messages reçus</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $stats['total_messages'] ?? 0 }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Candidatures récentes -->
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Candidatures récentes</h2>
            @forelse($recent_applications as $app)
                <div class="mb-4 pb-4 border-b last:border-b-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">{{ $app->first_name }} {{ $app->last_name }}</p>
                            <p class="text-sm text-gray-600">{{ $app->jobOffer?->title ?? 'Candidature spontanée' }}</p>
                            <p class="text-xs text-gray-500">{{ $app->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                            @if($app->status === 'new') bg-blue-100 text-blue-800
                            @elseif($app->status === 'in_review') bg-orange-100 text-orange-800
                            @elseif($app->status === 'accepted') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif
                        ">
                            {{ ucfirst($app->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Aucune candidature</p>
            @endforelse
            <a href="{{ route('admin.applications.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                Voir toutes les candidatures →
            </a>
        </div>

        <!-- Messages récents -->
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Messages récents</h2>
            @forelse($recent_messages as $msg)
                <div class="mb-4 pb-4 border-b last:border-b-0">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">{{ $msg->name }}</p>
                            <p class="text-sm text-gray-600">{{ $msg->subject ?? $msg->type }}</p>
                            <p class="text-xs text-gray-500">{{ $msg->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        @if(!$msg->read_at)
                            <span class="inline-block w-3 h-3 bg-red-500 rounded-full"></span>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Aucun message</p>
            @endforelse
            <a href="{{ route('admin.messages.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                Voir tous les messages →
            </a>
        </div>
    </div>
</div>
@endsection
