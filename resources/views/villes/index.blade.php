@extends('layouts.sidebar')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- 🔹 Bouton de retour en haut à gauche -->
    <div class="mb-6">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            ← Retour au tableau de bord
        </a>
    </div>

    <!-- 🔹 Titre -->
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Liste des Villes</h2>

    <!-- 🔹 Tableau des villes -->
    <div class="bg-white p-6 rounded shadow overflow-x-auto">
        @if($villes->isEmpty())
            <p class="text-gray-500 italic">Aucune ville enregistrée.</p>
        @else
            <table class="min-w-full table-auto border text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border font-semibold text-gray-700">Nom de la ville</th>
                        <th class="px-4 py-2 border font-semibold text-gray-700">Pays</th>
                        <th class="px-4 py-2 border font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($villes as $ville)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $ville->lib_ville }}</td>
                            <td class="px-4 py-2 border">{{ $ville->pays->nom_pays ?? 'Sans pays' }}</td>
                            <td class="px-4 py-2 border">
                                <form action="{{ route('villes.destroy', $ville->id) }}" method="POST" onsubmit="return confirm('Supprimer cette ville ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
