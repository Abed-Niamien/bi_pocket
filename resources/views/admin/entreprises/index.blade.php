@extends('layouts.sidebar')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <!-- Bouton de retour en haut à gauche du contenu -->
    <div class="mb-4">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            ← Retour au tableau de bord
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6">Liste des Entreprises Créées</h1>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 font-semibold text-gray-700">Nom de l’entreprise</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Date de création</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Nombre d’employés</th>
                    <th class="px-4 py-3 font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($entreprises as $entreprise)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3">{{ $entreprise->nom_entreprise }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($entreprise->created_at)->translatedFormat('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $entreprise->nb_employes }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.entreprises.show', $entreprise->id) }}"
                               class="text-indigo-600 hover:underline font-medium">Afficher plus de détails</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500 italic">Aucune entreprise trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
