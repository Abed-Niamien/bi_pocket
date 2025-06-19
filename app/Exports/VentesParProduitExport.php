<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentesParProduitExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $user = Auth::user();

        // Récupérer les IDs de tous les utilisateurs de l'entreprise
        $userIds = DB::table('user_entreprise')
            ->where('id_entreprise', function ($query) use ($user) {
                $query->select('id_entreprise')
                    ->from('user_entreprise')
                    ->where('id_user', $user->id)
                    ->limit(1);
            })
            ->pluck('id_user');

        return DB::table('produit_vente')
            ->join('ventes', 'ventes.id', '=', 'produit_vente.id_vente')
            ->join('produits', 'produits.id', '=', 'produit_vente.id_produit')
            ->whereIn('ventes.id_user', $userIds)
            ->select('produits.lib_produit',
                     DB::raw('SUM(produit_vente.quantite_vente) as total_qte'),
                     DB::raw('SUM(produit_vente.montant_total) as total_montant'))
            ->groupBy('produits.lib_produit')
            ->get();
    }

    public function headings(): array
    {
        return ['Produit', 'Quantité Totale', 'Montant Total'];
    }
}
