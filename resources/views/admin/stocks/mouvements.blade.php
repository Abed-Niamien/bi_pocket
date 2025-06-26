@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Historique des Mouvements de Stock</h1>

    {{-- Bouton de retour --}}
    <div class="mb-4">
        <a href="{{ route('admin.stocks.index') }}"
           class="inline-block bg-blue-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">
            ← Retour à la gestion des stocks
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Produit</th>
                    <th class="px-4 py-2">Quantité</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Heure</th> <!-- Nouvelle colonne -->
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($mouvements as $mv)
                    <tr>
                        <td class="px-4 py-2 font-semibold text-{{ $mv->type == 'Entrée' ? 'green-600' : 'red-600' }}">
                            {{ $mv->type }}
                        </td>
                        <td class="px-4 py-2">{{ $mv->lib_produit }}</td>
                        <td class="px-4 py-2">{{ $mv->quantite }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($mv->date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($mv->date)->format('H:i:s') }}</td> <!-- Heure -->
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 px-4 py-2">Aucun mouvement trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
