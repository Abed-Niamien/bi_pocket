@extends('layouts.sidebar')

@section('content')
<div class="max-w-7xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Tableaux d'analyse des ventes</h1>

    @php
        $sections = [
            [
                'title' => 'Ventes par Mois',
                'exportCsv' => 'exports.ventes.date.csv',
                'exportPdf' => 'exports.ventes.date.pdf',
                'headers' => ['Mois', 'Quantité Totale', 'Montant Total'],
                'data' => $ventesParMois ?? [],
                'rows' => fn($item) => [
                    \Carbon\Carbon::createFromFormat('Y-m', $item->mois)->translatedFormat('F Y'),
                    $item->total_qte,
                    number_format($item->total_montant, 0, ',', ' ') . ' FCFA'
                ]
            ],
            [
                'title' => 'Ventes par Produit',
                'exportCsv' => 'exports.ventes.produit.csv',
                'exportPdf' => 'exports.ventes.produit.pdf',
                'headers' => ['Produit', 'Quantité Totale', 'Montant Total'],
                'data' => $ventesParProduit ?? [],
                'rows' => fn($item) => [
                    $item->lib_produit,
                    $item->total_qte,
                    number_format($item->total_montant, 0, ',', ' ') . ' FCFA'
                ]
            ],
            [
                'title' => 'Ventes par Canal',
                'exportCsv' => 'exports.ventes.canal.csv',
                'exportPdf' => 'exports.ventes.canal.pdf',
                'headers' => ['Canal', 'Quantité Totale', 'Montant Total'],
                'data' => $ventesParCanal ?? [],
                'rows' => fn($item) => [
                    ucfirst($item->canal_vente),
                    $item->total_qte,
                    number_format($item->total_montant, 0, ',', ' ') . ' FCFA'
                ]
            ],
            [
                'title' => 'Ventes par Ville',
                'exportCsv' => 'exports.ventes.ville.csv',
                'exportPdf' => 'exports.ventes.ville.pdf',
                'headers' => ['Ville', 'Quantité Totale', 'Montant Total'],
                'data' => $ventesParVille ?? [],
                'rows' => fn($item) => [
                    $item->lib_ville,
                    $item->total_qte,
                    number_format($item->total_montant, 0, ',', ' ') . ' FCFA'
                ]
            ],
        ];
    @endphp
{{-- Formulaire de filtrage par entreprise --}}
<form method="GET" class="mb-6 flex items-center gap-4">
    <label for="entreprise" class="text-sm font-semibold">Filtrer par entreprise :</label>
    <select name="entreprise" id="entreprise" onchange="this.form.submit()" class="border rounded px-3 py-2 text-sm">
        <option value="">-- Toutes les entreprises --</option>
        @foreach($entreprises as $e)
            <option value="{{ $e->id }}" {{ request('entreprise') == $e->id ? 'selected' : '' }}>
                {{ $e->nom_entreprise }}
            </option>
        @endforeach
    </select>
</form>
    @foreach ($sections as $section)
        <div class="bg-white shadow rounded-lg p-6 mb-10">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-5 space-y-3 sm:space-y-0">
                <h2 class="text-xl font-semibold text-gray-800">{{ $section['title'] }}</h2>
                <div class="flex gap-2">
                    <a href="{{ route($section['exportCsv']) }}" class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded transition">CSV</a>
                    <a href="{{ route($section['exportPdf']) }}" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded transition">PDF</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 uppercase text-gray-600 text-xs">
                        <tr>
                            @foreach ($section['headers'] as $header)
                                <th class="px-4 py-2">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($section['data'] as $item)
                            <tr>
                                @foreach ($section['rows']($item) as $cell)
                                    <td class="px-4 py-2">{{ $cell }}</td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($section['headers']) }}" class="text-center text-gray-500 px-4 py-2">Aucune donnée trouvée</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection
