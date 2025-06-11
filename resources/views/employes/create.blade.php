@extends('layouts.sidebar')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Ajouter un employé pour l'entreprise "{{ $entreprise->nom_entreprise }}"</h2>

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employes.store', $entreprise) }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nom complet</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-semibold mb-2">Adresse email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
            <label for="password" class="block text-gray-700 font-semibold mb-2">Mot de passe</label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded transition-colors duration-200">
            Ajouter l'employé
        </button>
    </form>
</div>
@endsection
