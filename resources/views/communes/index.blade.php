@extends('layouts.sidebar')

@section('content')

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des communes') }}
        </h2>
    </x-slot>

    <!-- Liste des Communes -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Liste des Communes</h2>
        @if($communes->isEmpty())
            <p>Aucune commune enregistrée.</p>
        @else
        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nom de la commune</th>
                    <th class="px-4 py-2 border">Ville</th>
                </tr>
            </thead>
            <tbody>
                @foreach($communes as $commune)
                <tr>
                    <td class="px-4 py-2 border">{{ $commune->lib_commune }}</td>
                    <td class="px-4 py-2 border">{{ $commune->ville->lib_ville ?? 'Sans ville' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
