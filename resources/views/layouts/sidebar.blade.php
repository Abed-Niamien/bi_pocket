@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">Mon Espace</h2>
        </div>
        <nav class="mt-6">
            <ul>
                <li>
                    <a href="{{ route('entreprises.create') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-100">
                        ➕ Créer une entreprise
                    </a>
                </li>

            </ul>
        </nav>
    </aside>

    {{-- Contenu principal --}}
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Bienvenue sur votre tableau de bord</h1>

        {{-- Tu peux ajouter ici des statistiques, graphiques, etc. --}}
        <div class="bg-white shadow rounded p-6">
            <p class="text-gray-600">Ici s'affichera votre contenu principal.</p>
        </div>
    </main>

</div>
@endsection
