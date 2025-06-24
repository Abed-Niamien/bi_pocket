@extends('layouts.sidebar')

@section('content')

<!-- En-tête : bouton + titre -->
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            ← Retour au tableau de bord
        </a>

        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 text-center sm:text-right">
            Enregistrer une vente
        </h2>
    </div>

    <!-- Bloc formulaire -->
    <div class="bg-white rounded shadow p-4 sm:p-6">

        <!-- Messages d'erreur -->
        @if ($errors->any())
            <div class="mb-6 text-red-600">
                <ul class="list-disc list-inside text-sm sm:text-base">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6 text-center sm:text-left">Nouvelle Vente</h2>

        <!-- Formulaire -->
        <form action="{{ route('ventes.store') }}" method="POST">
            @csrf

            <!-- Client -->
            <div class="mb-4">
                <label for="client" class="block mb-1 font-medium text-sm text-gray-700">Client</label>
                <select name="id_client"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom_client }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Canal de vente -->
            <div class="mb-4">
                <label for="canal_vente" class="block text-sm font-medium text-gray-700 mb-1">Canal de vente</label>
                <select name="canal_vente" id="canal_vente"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <option value="" disabled selected>-- Sélectionnez un canal --</option>
                    <option value="en ligne">En ligne</option>
                    <option value="en magasin">En magasin</option>
                </select>
            </div>

            <!-- Liste des produits -->
            <div id="produits-container">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <select name="produits[0][id_produit]"
                            class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">
                                {{ $produit->lib_produit }} ({{ $produit->prix_unitaire }} FCFA)
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="produits[0][quantite]"
                           class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Quantité">
                </div>
            </div>

            <!-- Date de la vente -->
            <div class="mb-4">
                <label for="date_vente" class="block mb-1 text-sm font-medium text-gray-700">Date de la vente</label>
                <input type="date" name="date_vente"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       required>
            </div>

            <!-- Bouton pour ajouter un produit -->
            <button type="button" onclick="ajouterProduit()"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition mb-4">
                + Ajouter un produit
            </button>

            <!-- Bouton de soumission -->
            <div class="mt-6 text-right">
                <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script pour ajouter dynamiquement un produit -->
<script>
    let index = 1;
    function ajouterProduit() {
        const container = document.getElementById('produits-container');
        const row = document.createElement('div');
        row.classList.add('grid', 'grid-cols-1', 'sm:grid-cols-2', 'gap-4', 'mb-4');
        row.innerHTML = `
            <select name="produits[${index}][id_produit]"
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">
                        {{ $produit->lib_produit }} ({{ $produit->prix_unitaire }} FCFA)
                    </option>
                @endforeach
            </select>
            <input type="number" name="produits[${index}][quantite]"
                   class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Quantité">
        `;
        container.appendChild(row);
        index++;
    }
</script>

@endsection
