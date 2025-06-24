@extends('layouts.sidebar')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <!-- Bouton de retour en haut à gauche -->
    <div class="mb-6">
        <a href="{{ route('admin.entreprises.index') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            ← Retour à la liste des entreprises
        </a>
    </div>

    {{-- Carte de l'entreprise --}}
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h1 class="text-2xl font-bold mb-4">Détails de l’entreprise</h1>
        <ul class="text-sm text-gray-700 space-y-1">
            <li><strong>Nom :</strong> {{ $entreprise->nom_entreprise }}</li>
            <li><strong>Créée le :</strong> {{ \Carbon\Carbon::parse($entreprise->created_at)->format('d/m/Y') }}</li>
        </ul>
    </div>

    {{-- Liste des employés --}}
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Employés rattachés</h2>

        @if ($employes->isEmpty())
            <p class="text-gray-500 text-sm">Aucun employé rattaché à cette entreprise.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Rôle</th>
                            <th class="px-4 py-2">Création du compte</th>
                            <th class="px-4 py-2">Date d’affectation</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($employes as $employe)
                            <tr>
                                <td class="px-4 py-2">{{ $employe->name }}</td>
                                <td class="px-4 py-2">{{ $employe->email }}</td>
                                <td class="px-4 py-2">
                                    {{ $employe->lib_role_user === 'Membre' ? 'Employé' : $employe->lib_role_user }}
                                </td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($employe->created_at)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($employe->date_affectation)->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
