<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Analyse des Ventes par Mois</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            color: #444;
        }
        tr:nth-child(even) {
            background-color: #fdfdfd;
        }
        tr:nth-child(odd) {
            background-color: #f7f7f7;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>Analyse des Ventes par Mois</h2>

    <table>
        <thead>
            <tr>
                <th>Mois</th>
                <th>Quantité Totale</th>
                <th>Montant Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $vente)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::createFromFormat('Y-m-d', $vente->date)->translatedFormat('F Y') }}
                    </td>
                    <td>{{ $vente->total_qte }}</td>
                    <td class="text-right">{{ number_format($vente->total_montant, 0, ',', ' ') }} FCFA</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: #888;">Aucune donnée disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
