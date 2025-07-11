@extends('layouts.sidebar')

@section('content')

<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Bouton de retour en haut à gauche -->
        <div class="flex justify-start mb-4">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 whitespace-nowrap">
                ← Retour au tableau de bord
            </a>
        </div>

        <!-- Titre -->
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 text-center mb-6">
            {{ __('Liste des Ventes') }}
        </h2>

        <div class="bg-white shadow rounded-lg p-6 overflow-x-auto">
            <h3 class="text-lg font-bold text-indigo-700 mb-4">Ventes enregistrées</h3>

            @if($ventes->isEmpty())
                <p class="text-gray-500 italic">Aucune vente enregistrée.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID Vente</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Client</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Produit</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Quantité</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Montant Total</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date Vente</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($ventes as $vente)
                            @foreach($vente->produits as $produit)
                                <tr>
                                    <td class="px-4 py-2">{{ $vente->id }}</td>
                                    <td class="px-4 py-2">{{ $vente->client->nom_client ?? 'Inconnu' }}</td>
                                    <td class="px-4 py-2">{{ $produit->lib_produit ?? 'Inconnu' }}</td>
                                    <td class="px-4 py-2">{{ $produit->pivot->quantite_vente }}</td>
                                    <td class="px-4 py-2">{{ number_format($produit->pivot->montant_total, 0, ',', ' ') }} FCFA</td>
                                    <td class="px-4 py-2">{{ $vente->created_at->format('d/m/Y') }}</td>
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
