@extends('layouts.sidebar')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Liste des Clients</h1>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Téléphone</th>
                    <th class="px-4 py-2">Sexe</th>
                    <th class="px-4 py-2">Date d’enregistrement</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($clients as $client)
                    <tr>
                        <td class="px-4 py-2">{{ $client->nom_client }}</td>
                        <td class="px-4 py-2">{{ $client->email_client ?? 'Non renseigné' }}</td>
                        <td class="px-4 py-2">{{ $client->telephone_client ?? 'Non renseigné' }}</td>
                        <td class="px-4 py-2">{{ ucfirst($client->sexe_client) ?? '-' }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($client->created_at)->translatedFormat('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.clients.show', $client->id) }}" class="text-indigo-600 hover:underline text-sm">Voir les détails</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center text-gray-500">Aucun client trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
