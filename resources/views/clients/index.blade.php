@extends('layouts.sidebar')

@section('content')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Liste des Clients') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-bold text-indigo-700 mb-4">Clients enregistrés</h3>

            @if($clients->isEmpty())
                <p class="text-gray-500 italic">Aucun client enregistré.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nom</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Téléphone</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Commune</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Créé le</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($clients as $client)
                            <tr>
                                <td class="px-4 py-2">{{ $client->id }}</td>
                                <td class="px-4 py-2">{{ $client->nom_client }}</td>
                                <td class="px-4 py-2">{{ $client->telephone_client }}</td>
                                <td class="px-4 py-2">{{ $client->email_client }}</td>
                                <td class="px-4 py-2">{{ $client->commune->lib_commune }}</td>
                                <td class="px-4 py-2">{{ $client->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
