@extends('layouts.sidebar')

@section('content')

<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Categories de produits') }}
        </h2>
    </x-slot>

    <!-- Liste des Catégories de Produits -->
<div class="mb-8 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Liste des Catégories de Produits</h2>
    @if($categories->isEmpty())
        <p>Aucune catégorie enregistrée.</p>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Libellé</th>
                    <th class="px-4 py-2 border">Date de création</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td class="px-4 py-2 border">{{ $cat->lib_cat_produit }}</td>
                    <td class="px-4 py-2 border">{{ $cat->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection
