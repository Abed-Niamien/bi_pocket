<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ventes par Ville</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 5px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Ventes par Ville</h2>
    <table>
        <thead>
            <tr>
                <th>Ville</th>
                <th>Quantité Totale</th>
                <th>Montant Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $vente)
                <tr>
                    <td>{{ $vente->lib_ville }}</td>
                    <td>{{ $vente->total_qte }}</td>
                    <td>{{ number_format($vente->total_montant, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
