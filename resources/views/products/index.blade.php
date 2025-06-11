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
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Libellé</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Prix Unitaire</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Couleur / Motif</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Photo</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Catégorie</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Créé le</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($produits as $produit)
                                <tr>
                                    <td class="px-4 py-2">{{ $produit->id }}</td>
                                    <td class="px-4 py-2">{{ $produit->lib_produit }}</td>
                                    <td class="px-4 py-2">{{ number_format($produit->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                    <td class="px-4 py-2">{{ $produit->couleur_motif }}</td>
                                    <td class="px-4 py-2">
                                        @if($produit->photo_produit)
                                            <img src="{{ asset('storage/' . $produit->photo_produit) }}" alt="Produit" width="150">


                                        @else
                                            <span class="text-gray-400 italic">Pas de photo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $produit->categorie->lib_cat_produit ?? 'Inconnu' }}</td>
                                    <td class="px-4 py-2">{{ $produit->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
