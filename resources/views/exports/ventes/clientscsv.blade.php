<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Clients Segmentés</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Clients Segmentés (RFM)</h2>
    <table>
        <thead>
            <tr>
                <th>ID Client</th>
                <th>Nom Client</th>
                <th>Récence (jours)</th>
                <th>Fréquence</th>
                <th>Montant Total</th>
                <th>Segment RFM</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->nom_client }}</td>
                    <td>{{ $client->recence ?? 'N/A' }}</td>
                    <td>{{ $client->frequency }}</td>
                    <td>{{ number_format($client->monetary, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $client->segment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
