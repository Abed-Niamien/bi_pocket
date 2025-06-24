@extends('layouts.sidebar')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">

    <!-- 🔹 Bouton de retour en haut à gauche -->
    <div class="mb-6">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            ← Retour au tableau de bord
        </a>
    </div>

    <!-- 🔹 Titre -->
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Liste des Catégories de Produits</h2>

    <!-- 🔹 Tableau des catégories -->
    <div class="bg-white p-6 rounded shadow">
        @if($categories->isEmpty())
            <p class="text-gray-500 italic">Aucune catégorie enregistrée.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border font-semibold text-gray-700 whitespace-nowrap">Libellé</th>
                            <th class="px-4 py-2 border font-semibold text-gray-700 whitespace-nowrap">Date de création</th>
                            <th class="px-4 py-2 border font-semibold text-gray-700 text-center whitespace-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border whitespace-nowrap">{{ $cat->lib_cat_produit }}</td>
                                <td class="px-4 py-2 border whitespace-nowrap">{{ \Carbon\Carbon::parse($cat->created_at)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2 border text-center whitespace-nowrap">
                                    <form action="{{ route('categorie_produit.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression de cette catégorie ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium px-3 py-1 rounded text-sm">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
