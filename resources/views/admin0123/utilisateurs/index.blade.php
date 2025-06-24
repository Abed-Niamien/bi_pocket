@extends('layouts.sidebar')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <!-- 🔹 Bouton de retour en haut à gauche -->
    <div class="mb-6">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-100 text-gray-800 text-sm font-medium rounded hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            ← Retour au tableau de bord
        </a>
    </div>

    <!-- 🔹 Titre -->
    <h1 class="text-2xl font-bold mb-6">Liste des Utilisateurs</h1>

    <!-- 🔹 Filtres -->
    <form method="GET" class="mb-4 flex items-center space-x-3">
        <label for="filtre" class="text-sm">Filtrer par rôle :</label>
        <select name="filtre" id="filtre" onchange="this.form.submit()" class="px-3 py-1 border rounded text-sm">
            <option value="" {{ $filtre === null ? 'selected' : '' }}>Tous</option>
            <option value="proprietaires" {{ $filtre === 'proprietaires' ? 'selected' : '' }}>Créateur d'entreprise</option>
            <option value="employes" {{ $filtre === 'employes' ? 'selected' : '' }}>Employés</option>
        </select>
    </form>

    <!-- 🔹 Résumé -->
    <div class="mb-4 text-sm text-gray-600">
        @if ($filtre === 'proprietaires')
            Nombre de propriétaires : <strong>{{ $nbProprietaires }}</strong>
        @elseif ($filtre === 'employes')
            Nombre d'employés : <strong>{{ $nbEmployes }}</strong>
        @else
            Nombre total d'utilisateurs : <strong>{{ $total }}</strong>
        @endif
    </div>

    <!-- 🔹 Tableau -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Entreprise</th>
                    <th class="px-4 py-2">Rôle</th>
                    <th class="px-4 py-2">Date d’inscription</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($utilisateurs as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->nom_entreprise }}</td>
                        <td class="px-4 py-2">
                            {{ strtolower($user->lib_role_user) === 'membre' ? 'Employé' : $user->lib_role_user }}
                        </td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">Aucun utilisateur trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
