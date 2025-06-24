@extends('layouts.sidebar')

@section('content')

<!-- Bouton de retour -->
<div class="max-w-7xl mx-auto p-6 mb-6">
    <a href="{{ url('/dashboard') }}"
       class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        ← Retour au tableau de bord
    </a>
</div>

<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Stocks par Entreprise</h1>

    @forelse ($stocksParEntreprise as $group)
        <div class="mb-8 bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-indigo-700">{{ $group['entreprise'] }}</h2>

            <div class="flex justify-start mb-4">
                <a href="{{ route('admin.stocks.mouvements', ['entreprise' => $group['id']]) }}"
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-semibold shadow">
                    Voir les mouvements de stock
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Produit</th>
                            <th class="px-4 py-2">Quantité</th>
                            <th class="px-4 py-2">Date d'entrée</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($group['stocks'] as $stock)
                            <tr>
                                <td class="px-4 py-2">{{ $stock->lib_produit }}</td>
                                <td class="px-4 py-2">{{ $stock->quantite_stock }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($stock->date_entree)->translatedFormat('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 py-2">Aucun stock pour cette entreprise.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Aucune entreprise associée à cet utilisateur.</p>
    @endforelse
</div>

@endsection
