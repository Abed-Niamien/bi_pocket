@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-2xl font-bold mb-6">Détails de l’entreprise : {{ $entreprise->nom_entreprise }}</h2>

    {{-- Conteneur principal --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- 🔹 Ventes par période --}}
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4">Ventes par période (mois/année)</h3>
            @if($stats['ventesParPeriode']->isEmpty())
                <p class="text-gray-500">Aucune vente enregistrée.</p>
            @else
                <ul class="space-y-2">
                    @foreach($stats['ventesParPeriode'] as $periode)
                        <li class="flex justify-between border-b border-gray-200 pb-2">
                            <span>{{ $periode['periode'] }}</span>
                            <span class="font-semibold text-blue-600">{{ number_format($periode['total'], 0, ',', ' ') }} FCFA</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- 🔹 Ventes par catégorie --}}
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-lg font-semibold mb-4">Ventes par catégorie</h3>
            @if($stats['ventesParCategorie']->isEmpty())
                <p class="text-gray-500">Aucune vente par catégorie.</p>
            @else
                <ul class="space-y-2">
                    @foreach($stats['ventesParCategorie'] as $categorie)
                        <li class="flex justify-between border-b border-gray-200 pb-2">
                            <span>{{ $categorie->categorie }}</span>
                            <span class="font-semibold text-green-600">{{ number_format($categorie->total, 0, ',', ' ') }} FCFA</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- 🔹 Produits les plus vendus --}}
    <div class="bg-white shadow-md rounded-xl p-6 mt-8">
        <h3 class="text-lg font-semibold mb-4">Top 5 des produits les plus vendus</h3>
        @if($stats['produitsPlusVendus']->isEmpty())
            <p class="text-gray-500">Aucun produit vendu.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="py-3 px-4 font-semibold">Produit</th>
                            <th class="py-3 px-4 font-semibold">Quantité totale</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['produitsPlusVendus'] as $produit)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $produit->produit }}</td>
                                <td class="py-3 px-4">{{ $produit->quantite_totale }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
