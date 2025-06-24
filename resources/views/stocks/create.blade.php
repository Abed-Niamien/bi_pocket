@extends('layouts.app')

@section('content')

<!-- Conteneur principal -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">

    <!-- Bouton + Titre -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            ← Retour au tableau de bord
        </a>

        <h2 class="text-lg sm:text-xl font-bold text-gray-800 text-center sm:text-right">
            Ajouter des Produits au Stock
        </h2>
    </div>

    <!-- Carte blanche -->
    <div class="bg-white rounded shadow p-4 sm:p-6">

        <form action="{{ route('stocks.store') }}" method="POST">
            @csrf

            <!-- Date d'entrée -->
            <div class="mb-4">
                <label for="date_entree" class="block mb-1 font-medium text-sm text-gray-700">Date d'entrée</label>
                <input type="date" name="date_entree"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       required>
            </div>

            <!-- Liste des produits -->
            <div id="produit-list">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                    <select name="produits[0][id_produit]"
                            class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            required>
                        <option value="">Choisir un produit</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">{{ $produit->lib_produit }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="produits[0][quantite_stock]"
                           class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Quantité" min="1" required>
                </div>
            </div>

            <!-- Bouton pour ajouter une ligne -->
            <button type="button" onclick="addProduit()"
                    class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                + Ajouter un produit
            </button>

            <!-- Bouton de validation -->
            <div class="mt-6 text-right">
                <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                    Ajouter au stock
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script dynamique -->
<script>
    let index = 1;
    function addProduit() {
        const container = document.getElementById('produit-list');
        const html = `
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
            <select name="produits[${index}][id_produit]"
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
                <option value="">Choisir un produit</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->lib_produit }}</option>
                @endforeach
            </select>
            <input type="number" name="produits[${index}][quantite_stock]"
                   class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Quantité" min="1" required>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        index++;
    }
</script>

@endsection
