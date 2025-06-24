@extends('layouts.sidebar')

@section('content')

<!-- Conteneur global -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 relative">

    <!-- Bouton de retour -->
<div class="max-w-3xl mt-6 px-4 sm:px-0">
    <a href="{{ route('dashboard') }}"
       class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 whitespace-nowrap">
        ← Retour au tableau de bord
    </a>
</div>
    <!-- Titre centré -->
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 text-center mb-6">
        {{ __('Liste des Clients') }}
    </h2>

    <div class="bg-white shadow rounded-lg p-6 overflow-x-auto">
        <h3 class="text-lg font-bold text-indigo-700 mb-4">Clients enregistrés</h3>

        @if($clients->isEmpty())
            <p class="text-gray-500 italic">Aucun client enregistré.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Nom</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Téléphone</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Commune</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Créé le</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($clients as $client)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $client->id }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $client->nom_client }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $client->telephone_client }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $client->email_client }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $client->commune->lib_commune }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $client->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
