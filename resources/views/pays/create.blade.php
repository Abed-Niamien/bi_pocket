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

    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Formulaire de création pour Pays -->
        <div class="mb-8 bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-semibold mb-4">Créer un Pays</h2>
            <form action="{{ route('pays.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="nom_pays" placeholder="Nom du pays" required
                       value="{{ old('nom_pays') }}"
                       class="w-full border rounded px-4 py-2">

                <input type="number" step="0.000001" name="longitude_pays" placeholder="Longitude (ex: -4.0083)"
                       value="{{ old('longitude_pays') }}"
                       class="w-full border rounded px-4 py-2">

                <input type="number" step="0.000001" name="lattitude_pays" placeholder="Latitude (ex: 5.3097)"
                       value="{{ old('lattitude_pays') }}"
                       class="w-full border rounded px-4 py-2">

                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Créer
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
