<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsSegmentesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $user = auth()->user();

        $idEntreprises = DB::table('user_entreprise')
            ->where('id_user', $user->id)
            ->pluck('id_entreprise');

        $idsUsers = DB::table('user_entreprise')
            ->whereIn('id_entreprise', $idEntreprises)
            ->pluck('id_user');

        $today = Carbon::today();

        $clients = DB::table('clients as c')
            ->leftJoin('ventes as v', 'c.id', '=', 'v.id_client')
            ->leftJoin('produit_vente as pv', 'v.id', '=', 'pv.id_vente')
            ->whereIn('c.id_user', $idsUsers)
            ->select(
                'c.nom_client',
                DB::raw('MAX(v.date_vente) as last_purchase_date'),
                DB::raw('COUNT(v.id) as frequency'),
                DB::raw('COALESCE(SUM(pv.montant_total), 0) as monetary')
            )
            ->groupBy('c.id', 'c.nom_client')
            ->get();

        $formatted = $clients->map(function ($client) use ($today) {
            $lastDate = $client->last_purchase_date ? Carbon::parse($client->last_purchase_date) : null;
            $recence = $lastDate ? $lastDate->diffInDays($today) : null;

            $segment_r = $recence === null ? 3 : ($recence <= 30 ? 1 : ($recence <= 90 ? 2 : 3));
            $segment_f = $client->frequency >= 10 ? 1 : ($client->frequency >= 5 ? 2 : 3);
            $segment_m = $client->monetary >= 1000000 ? 1 : ($client->monetary >= 500000 ? 2 : 3);

            return [
                'Nom'        => $client->nom_client,
                'Récence'    => $recence,
                'Fréquence'  => $client->frequency,
                'Montant'    => number_format($client->monetary, 0, ',', ' '),
                'Segment'    => $segment_r . $segment_f . $segment_m,
            ];
        });

        return new Collection($formatted);
    }

    public function headings(): array
    {
        return ['Nom', 'Récence (jours)', 'Fréquence', 'Montant', 'Segment'];
    }
}
