<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentesParCanalExport implements FromCollection, WithHeadings
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
            ->whereIn('ventes.id_user', $userIds)
            ->select('ventes.canal_vente',
                     DB::raw('SUM(produit_vente.quantite_vente) as total_qte'),
                     DB::raw('SUM(produit_vente.montant_total) as total_montant'))
            ->groupBy('ventes.canal_vente')
            ->get();
    }

    public function headings(): array
    {
        return ['Canal', 'Quantité Totale', 'Montant Total'];
    }
}
