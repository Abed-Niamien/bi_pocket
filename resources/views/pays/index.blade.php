@extends('layouts.sidebar')

@section('content')

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des pays') }}
        </h2>
    </x-slot>

    <!-- Liste des Pays -->
    <div class="mb-8 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Liste des Pays</h2>
        @if($pays->isEmpty())
            <p>Aucun pays enregistré.</p>
        @else
        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nom du pays</th>
                    <th class="px-4 py-2 border">Date de création</th>
                    <th class="px-4 py-2 border text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pays as $p)
                <tr>
                    <td class="px-4 py-2 border">{{ $p->nom_pays }}</td>
                    <td class="px-4 py-2 border">{{ $p->created_at }}</td>
                    <td class="px-4 py-2 border">
                        <form action="{{ route('pays.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Supprimer ce pays ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection
