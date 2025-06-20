@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Détail du client : {{ $client->nom_client }}</h1>

    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <h2 class="text-lg font-semibold mb-2">Informations générales</h2>
        <ul class="text-sm text-gray-700 space-y-1">
            <li><strong>ID :</strong> {{ $client->id }}</li>
            <li><strong>Nom :</strong> {{ $client->nom_client }}</li>
            <li><strong>Email :</strong> {{ $client->email_client }}</li>
            <li><strong>Téléphone :</strong> {{ $client->telephone_client }}</li>
        </ul>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-lg font-semibold mb-4">Historique des Ventes</h2>
        @if($ventes->isEmpty())
            <p class="text-gray-500 text-sm">Aucune vente enregistrée pour ce client.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2">ID Vente</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Canal</th>
                        <th class="px-4 py-2">Produits</th>
                        <th class="px-4 py-2">Quantité</th>
                        <th class="px-4 py-2">Montant</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($ventes as $vente)
                        <tr>
                            <td class="px-4 py-2">{{ $vente->id }}</td>
                            <td class="px-4 py-2">{{ $vente->date_vente }}</td>
                            <td class="px-4 py-2">{{ ucfirst($vente->canal_vente) }}</td>
                            <td class="px-4 py-2">{{ $vente->produits }}</td>
                            <td class="px-4 py-2">{{ $vente->total_qte }}</td>
                            <td class="px-4 py-2">{{ number_format($vente->total_montant, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
