@extends('layouts.sidebar')

@section('content')

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
                    <input type="text" name="nom_pays" placeholder="Nom du pays" required class="w-full border rounded px-4 py-2">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Créer</button>
                </form>
            </div>
    </div>
@endsection