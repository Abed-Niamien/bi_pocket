@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Segmentation des Clients</h1>


    <a href="{{ route('admin.clients.liste') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm mb-4 inline-block">
         Voir la liste des clients
    </a>


    {{-- Boutons d'export --}}
    <div class="flex flex-wrap justify-end mb-4 space-x-2">
        <a href="{{ route('exports.clientscsv.csv') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">
            Exporter en CSV
        </a>
        <a href="{{ route('exports.clientspdf.pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
            Exporter en PDF
        </a>
    </div>

    {{-- Tableau des clients segmentés --}}
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 font-semibold text-gray-700">Nom</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Fréquence</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Montant Total</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Récence (jours)</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Segment RFM</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($clients as $client)
                    <tr>
                        <td class="px-4 py-2">{{ $client->nom_client }}</td>
                        <td class="px-4 py-2">{{ $client->frequency }}</td>
                        <td class="px-4 py-2">{{ number_format($client->monetary, 0, ',', ' ') }} FCFA</td>
                        <td class="px-4 py-2">{{ $client->recence }}</td>
                        <td class="px-4 py-2 font-mono font-bold">{{ $client->segment }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">Aucun client trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
