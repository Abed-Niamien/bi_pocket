@extends('layouts.sidebar')

@section('content')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Liste des Produits') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-bold text-indigo-700 mb-4">Produits enregistrés</h3>

            @if($produits->isEmpty())
                <p class="text-gray-500 italic">Aucun produit enregistré.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
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
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $produit->id }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $produit->lib_produit }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ number_format($produit->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $produit->couleur_motif }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        @if($produit->photo_produit)
                                            <img src="{{ asset('storage/' . $produit->photo_produit) }}" alt="Produit" class="h-16 w-auto object-contain rounded">
                                        @else
                                            <span class="text-gray-400 italic">Pas de photo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $produit->categorie->lib_cat_produit ?? 'Inconnu' }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $produit->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
