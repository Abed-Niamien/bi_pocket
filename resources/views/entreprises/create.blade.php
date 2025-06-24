@extends('layouts.sidebar')

@section('content')

<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Bouton retour aligné à gauche -->
        <div class="flex justify-start mb-4">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 whitespace-nowrap">
                ← Retour au tableau de bord
            </a>
        </div>

        <!-- Carte de formulaire -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Créer une nouvelle entreprise</h2>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('entreprises.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="nom_entreprise" class="block text-gray-700 font-semibold mb-2">
                        Nom de l'entreprise <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nom_entreprise" name="nom_entreprise" value="{{ old('nom_entreprise') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <div>
                    <label for="logo_entreprise" class="block text-gray-700 font-semibold mb-2">
                        Logo (optionnel)
                    </label>
                    <input type="file" id="logo_entreprise" name="logo_entreprise" accept="image/*"
                           class="w-full text-gray-600" />
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition duration-200">
                    Créer l'entreprise
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
