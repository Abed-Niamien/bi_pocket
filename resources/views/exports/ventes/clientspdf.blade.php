<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Clients Segmentés</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background-color: #f3f3f3; }
        h2 { margin-bottom: 12px; }
    </style>
</head>
<body>
    <h2>Segmentation des Clients</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Récence (jours)</th>
                <th>Fréquence</th>
                <th>Montant</th>
                <th>Segment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->nom_client }}</td>
                    <td>{{ $client->recence ?? 'N/A' }}</td>
                    <td>{{ $client->frequency }}</td>
                    <td>{{ number_format($client->monetary ?? 0, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $client->segment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
