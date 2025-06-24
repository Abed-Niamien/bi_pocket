@extends('layouts.sidebar')

@section('content')

<!-- Bouton de retour -->
        <div class="max-w-3xl mx-auto mt-6">
            <a href="{{ route('dashboard') }}"
            class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ← Retour au tableau de bord
            </a>
        </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un produit') }}
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

        <!-- Formulaire de création pour Villes -->
    <div class="mb-8 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Créer une Ville</h2>
        <form action="{{ route('villes.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="text" name="lib_ville" placeholder="Nom de la ville" required class="w-full border rounded px-4 py-2">
            <select name="id_pays" class="w-full border rounded px-4 py-2">
                @foreach($pays as $p)
                    <option value="{{ $p->id }}">{{ $p->nom_pays }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Créer</button>
        </form>
    </div>
    </div>
@endsection