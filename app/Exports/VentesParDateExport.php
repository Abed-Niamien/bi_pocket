<?php

namespace App\Exports;

use App\Models\Vente;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class VentesParDateExport implements FromCollection
{
    public function collection()
    {
        return DB::table('ventes')
            ->select(DB::raw('DATE(ventes.created_at) as date'), DB::raw('SUM(quantite_vente) as total_qte'), DB::raw('SUM(montant_total) as total_montant'))
            ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
            ->groupBy(DB::raw('DATE(ventes.created_at)'))
            ->get();
    }
}
