@extends('layouts.sidebar')

@section('content')

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des villes') }}
        </h2>
    </x-slot>

     <!-- Liste des Villes -->
    <div class="mb-8 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Liste des Villes</h2>
        @if($villes->isEmpty())
            <p>Aucune ville enregistrée.</p>
        @else
        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nom de la ville</th>
                    <th class="px-4 py-2 border">Pays</th>
                </tr>
            </thead>
            <tbody>
                @foreach($villes as $ville)
                <tr>
                    <td class="px-4 py-2 border">{{ $ville->lib_ville }}</td>
                    <td class="px-4 py-2 border">{{ $ville->pays->nom_pays ?? 'Sans pays' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

@endsection
