@extends('layouts.sidebar')

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enregistrer une vente') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow mt-6">

        @if ($errors->any())
            <div class="mb-6 text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Nouvelle Vente</h2>

    <form action="{{ route('ventes.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="client" class="block mb-1">Client</label>
            <select name="id_client" class="w-full border rounded p-2">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->nom_client }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="canal_vente" class="block text-gray-700 font-bold mb-2">Canal de vente</label>
            <select name="canal_vente" id="canal_vente" class="w-full border border-gray-300 rounded p-2" required>
                <option value="" disabled selected>-- Sélectionnez un canal --</option>
                <option value="en ligne">En ligne</option>
                <option value="en magasin">En magasin</option>
            </select>
        </div>

        <div id="produits-container">
            <div class="produit-row mb-4 flex gap-4">
                <select name="produits[0][id_produit]" class="border p-2 rounded w-1/2">
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}" data-price="{{ $produit->prix_unitaire }}">
                            {{ $produit->lib_produit }} ({{ $produit->prix_unitaire }} FCFA)
                        </option>
                    @endforeach
                </select>
                <input type="number" name="produits[0][quantite]" class="border p-2 rounded w-1/2" placeholder="Quantité">
            </div>
        </div>
        <div class="mb-4">
            <label for="date_vente" class="block mb-1">Date de la vente</label>
            <input type="date" name="date_vente" class="w-full border rounded p-2" required>
        </div>

        <button type="button" onclick="ajouterProduit()" class="bg-blue-500 text-white px-3 py-1 rounded">+ Ajouter un produit</button>

        <div class="mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Enregistrer</button>
        </div>
    </form>
</div>

<script>
    let index = 1;
    function ajouterProduit() {
        const container = document.getElementById('produits-container');
        const row = document.createElement('div');
        row.classList.add('produit-row', 'mb-4', 'flex', 'gap-4');
        row.innerHTML = `
            <select name="produits[${index}][id_produit]" class="border p-2 rounded w-1/2">
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->lib_produit }} ({{ $produit->prix_unitaire }})</option>
                @endforeach
            </select>
            <input type="number" name="produits[${index}][quantite]" class="border p-2 rounded w-1/2" placeholder="Quantité">
        `;
        container.appendChild(row);
        index++;
    }
</script>
@endsection