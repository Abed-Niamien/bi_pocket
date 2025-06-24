@extends('layouts.sidebar')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">

    <!-- Bouton retour au-dessus du titre -->
    <div class="mb-4">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 whitespace-nowrap">
            ← Retour au tableau de bord
        </a>
    </div>

    <!-- Titre centré -->
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 text-center w-full mb-6">
        {{ __('Liste des Produits') }}
    </h2>

    <div class="bg-white shadow rounded-lg p-6 overflow-x-auto">
        <h3 class="text-lg font-bold text-indigo-700 mb-4">Produits enregistrés</h3>

        @if($produits->isEmpty())
            <p class="text-gray-500 italic">Aucun produit enregistré.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">ID</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Libellé</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Prix Unitaire</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Couleur / Motif</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Photo</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Catégorie</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 whitespace-nowrap">Créé le</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($produits as $produit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $produit->id }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $produit->lib_produit }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">
                                {{ number_format($produit->prix_unitaire, 0, ',', ' ') }} FCFA
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $produit->couleur_motif }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                @if($produit->photo_produit)
                                    <img src="{{ asset('storage/' . $produit->photo_produit) }}" alt="Produit" class="h-16 w-auto object-contain rounded">
                                @else
                                    <span class="text-gray-400 italic text-sm">Pas de photo</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $produit->categorie->lib_cat_produit ?? 'Inconnu' }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $produit->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
</div>

@endsection
