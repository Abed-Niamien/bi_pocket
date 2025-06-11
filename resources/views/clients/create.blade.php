@extends('layouts.sidebar')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Ajouter un client</h2>

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Ajouter un nouveau client</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Nom du client</label>
            <input type="text" name="nom_client" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Téléphone</label>
            <input type="text" name="telephone_client" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Sexe</label>
            <select name="sexe_client" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Choisir --</option>
                <option value="m">Masculin</option>
                <option value="f">Féminin</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Email</label>
            <input type="email" name="email_client" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Commune</label>
            <select name="id_commune" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Choisir une commune --</option>
                @foreach($communes as $commune)
                    <option value="{{ $commune->id }}">{{ $commune->lib_commune }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-300">
                Enregistrer le client
            </button>
        </div>
    </form>
</div>

@endsection
