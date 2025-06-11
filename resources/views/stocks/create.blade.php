@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Ajouter des Produits au Stock</h2>

    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="date_entree" class="block mb-1">Date d'entrée</label>
            <input type="date" name="date_entree" class="w-full border rounded p-2" required>
        </div>

        <div id="produit-list">
            <div class="flex gap-4 mb-2">
                <select name="produits[0][id_produit]" class="border p-2 rounded w-1/2" required>
                    <option value="">Choisir un produit</option>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}">{{ $produit->lib_produit }}</option>
                    @endforeach
                </select>
                <input type="number" name="produits[0][quantite_stock]" class="border p-2 rounded w-1/2" placeholder="Quantité" min="1" required>
            </div>
        </div>

        <button type="button" onclick="addProduit()" class="bg-blue-500 text-white px-3 py-1 rounded">+ Ajouter un produit</button>

        <div class="mt-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Ajouter au stock</button>
        </div>
    </form>
</div>

<script>
    let index = 1;
    function addProduit() {
        const container = document.getElementById('produit-list');
        const html = `
        <div class="flex gap-4 mb-2">
            <select name="produits[${index}][id_produit]" class="border p-2 rounded w-1/2" required>
                <option value="">Choisir un produit</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->lib_produit }}</option>
                @endforeach
            </select>
            <input type="number" name="produits[${index}][quantite_stock]" class="border p-2 rounded w-1/2" placeholder="Quantité" min="1" required>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        index++;
    }
</script>
@endsection
