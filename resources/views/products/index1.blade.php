@extends('layouts.sidebar')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 mt-6">

    <!-- Bouton de retour en haut à gauche, avant le libellé -->
    <div class="mb-4">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            ← Retour au tableau de bord
        </a>
    </div>

    <!-- Titre centré -->
    <h2 class="text-xl font-semibold text-gray-800 text-center w-full mb-6">
        {{ __('Liste des Produits') }}
    </h2>

    <div class="bg-white p-6 rounded shadow overflow-x-auto">
        <h3 class="text-lg font-bold text-indigo-700 mb-4">Produits enregistrés</h3>

        @if($produits->isEmpty())
            <p class="text-gray-500 italic">Aucun produit enregistré.</p>
        @else
            <table class="w-full table-auto border border-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">ID</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Libellé</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Prix Unitaire</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Couleur / Motif</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Photo</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Catégorie</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Créé le</th>
                        <th class="px-4 py-2 font-semibold text-gray-700 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($produits as $produit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $produit->id }}</td>
                            <td class="px-4 py-2">{{ $produit->lib_produit }}</td>
                            <td class="px-4 py-2">{{ number_format($produit->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                            <td class="px-4 py-2">{{ $produit->couleur_motif }}</td>
                            <td class="px-4 py-2">
                                @if($produit->photo_produit)
                                    <img src="{{ asset('storage/' . $produit->photo_produit) }}" alt="Produit"
                                         class="h-16 w-auto object-contain rounded">
                                @else
                                    <span class="text-gray-400 italic">Pas de photo</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $produit->categorie->lib_cat_produit ?? 'Inconnu' }}</td>
                            <td class="px-4 py-2">{{ $produit->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 text-center min-w-[100px]">
                                <form action="{{ route('products.destroy', $produit->id) }}" method="POST"
                                      onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-medium px-3 py-1 rounded text-sm">
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
