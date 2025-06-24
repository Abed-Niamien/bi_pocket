@extends('layouts.sidebar')

@section('content')

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Bouton de retour en haut à gauche de la liste -->
        <div class="flex justify-start mb-4">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 whitespace-nowrap">
                ← Retour au tableau de bord
            </a>
        </div>

        <!-- Titre de la page -->
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 text-center mb-6">
            {{ __('Liste des Stocks disponibles') }}
        </h2>

        <div class="bg-white shadow rounded-lg p-6 overflow-x-auto">
            <h3 class="text-lg font-bold text-indigo-700 mb-4">Stocks disponibles</h3>

            @if($stocks->isEmpty())
                <p class="text-gray-500 italic">Aucun stock enregistré.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID Stock</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Produit</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Quantité</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date Entrée</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($stocks as $stock)
                            @foreach($stock->produits as $produit)
                                <tr>
                                    <td class="px-4 py-2">{{ $stock->id }}</td>
                                    <td class="px-4 py-2">{{ $produit->lib_produit ?? 'Inconnu' }}</td>
                                    <td class="px-4 py-2">{{ $produit->pivot->quantite_stock }}</td>
                                    <td class="px-4 py-2">{{ $stock->date_entree }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
</div>

@endsection
