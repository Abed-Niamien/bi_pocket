@extends('layouts.sidebar')

@section('content')

<!-- Conteneur principal -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">

    <!-- Bouton retour et titre -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            ← Retour au tableau de bord
        </a>
        <h2 class="text-xl font-bold text-gray-800 text-center sm:text-right">Ajouter un client</h2>
    </div>

    <!-- Carte formulaire -->
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">

        <!-- Message d'erreurs -->
        @if($errors->any())
            <div class="mb-6 bg-red-100 text-red-700 p-4 rounded">
                <ul class="list-disc pl-5 text-sm sm:text-base">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form action="{{ route('clients.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Nom du client</label>
                <input type="text" name="nom_client"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Téléphone</label>
                <input type="text" name="telephone_client"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Sexe</label>
                <select name="sexe_client"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Choisir --</option>
                    <option value="m">Masculin</option>
                    <option value="f">Féminin</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Email</label>
                <input type="email" name="email_client"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">Commune</label>
                <select name="id_commune"
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Choisir une commune --</option>
                    @foreach($communes as $commune)
                        <option value="{{ $commune->id }}">{{ $commune->lib_commune }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                    Enregistrer le client
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
