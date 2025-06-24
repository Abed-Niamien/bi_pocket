@extends('layouts.sidebar')

@section('content')

    <!-- Conteneur principal -->
    <div class="max-w-3xl mx-auto p-4 sm:p-6 bg-white rounded shadow mt-6 w-full">

        <!-- Ligne du haut : bouton + titre -->
        <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
            <!-- Bouton à gauche -->
            <div class="w-full sm:w-auto mb-2 sm:mb-0">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    ← Retour au tableau de bord
                </a>
            </div>

            <!-- Titre centré -->
            <h2 class="text-lg sm:text-xl font-semibold text-gray-800 text-center w-full sm:w-auto">
                Ajouter un produit
            </h2>
        </div>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="mb-6 text-red-600">
                <ul class="list-disc list-inside text-sm sm:text-base">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nom du produit -->
            <div class="mb-4">
                <label for="lib_produit" class="block text-gray-700 font-medium mb-2">Nom du produit</label>
                <input type="text" id="lib_produit" name="lib_produit" value="{{ old('lib_produit') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Prix unitaire -->
            <div class="mb-4">
                <label for="prix_unitaire" class="block text-gray-700 font-medium mb-2">Prix unitaire (FCFA)</label>
                <input type="number" step="0.01" min="0" id="prix_unitaire" name="prix_unitaire" value="{{ old('prix_unitaire') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Couleur / Motif -->
            <div class="mb-4">
                <label for="couleur_motif" class="block text-gray-700 font-medium mb-2">Couleur / Motif</label>
                <input type="text" id="couleur_motif" name="couleur_motif" value="{{ old('couleur_motif') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Photo -->
            <div class="mb-4">
                <label for="photo_produit" class="block text-gray-700 font-medium mb-2">Photo du produit</label>
                <input type="file" id="photo_produit" name="photo_produit"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" accept="image/*">
            </div>

            <!-- Catégorie -->
            <div class="mb-6">
                <label for="id_cat_produit" class="block text-gray-700 font-medium mb-2">Catégorie du produit</label>
                <select id="id_cat_produit" name="id_cat_produit" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Choisir une catégorie --</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ old('id_cat_produit') == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->lib_cat_produit }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Bouton d’envoi -->
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition text-sm sm:text-base">
                    Ajouter le produit
                </button>
            </div>
        </form>
    </div>

@endsection
