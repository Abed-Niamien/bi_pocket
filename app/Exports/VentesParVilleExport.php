<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentesParVilleExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $user = Auth::user();

        $userIds = DB::table('user_entreprise')
            ->where('id_entreprise', function ($query) use ($user) {
                $query->select('id_entreprise')
                    ->from('user_entreprise')
                    ->where('id_user', $user->id)
                    ->limit(1);
            })
            ->pluck('id_user');

        return DB::table('ventes')
            ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
            ->join('clients', 'ventes.id_client', '=', 'clients.id')
            ->join('communes', 'clients.id_commune', '=', 'communes.id')
            ->join('villes', 'communes.id_ville', '=', 'villes.id')
            ->whereIn('ventes.id_user', $userIds)
            ->select('villes.lib_ville',
                     DB::raw('SUM(produit_vente.quantite_vente) as total_qte'),
                     DB::raw('SUM(produit_vente.montant_total) as total_montant'))
            ->groupBy('villes.lib_ville')
            ->get();
    }

    public function headings(): array
    {
        return ['Ville', 'Quantité Totale', 'Montant Total'];
    }
}
