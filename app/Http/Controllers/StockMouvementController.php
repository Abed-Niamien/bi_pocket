<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StockMouvementController extends Controller
{
    public function index($entreprise)
    {
        // Récupérer tous les users liés à cette entreprise
        $users = DB::table('user_entreprise')
            ->where('id_entreprise', $entreprise)
            ->pluck('id_user');

        // Entrées (ajout dans stock)
        $entrees = DB::table('stock_produit as sp')
            ->join('produits as p', 'sp.id_produit', '=', 'p.id')
            ->join('stocks as s', 'sp.id_stock', '=', 's.id')
            ->whereIn('s.id_user', $users)
            ->select(
                DB::raw("'Entrée' as type"),
                'p.lib_produit',
                'sp.quantite_stock as quantite',
                's.date_entree as date',
                's.id_user as utilisateur'
            );

        // Sorties (ventes)
        $sorties = DB::table('produit_vente as pv')
            ->join('produits as p', 'pv.id_produit', '=', 'p.id')
            ->join('ventes as v', 'pv.id_vente', '=', 'v.id')
            ->whereIn('v.id_user', $users)
            ->select(
                DB::raw("'Sortie' as type"),
                'p.lib_produit',
                'pv.quantite_vente as quantite',
                'v.date_vente as date',
                'v.id_user as utilisateur'
            );

        // Union + tri
        $mouvements = $entrees->unionAll($sorties)->orderBy('date', 'desc')->get();

        return view('admin.stocks.mouvements', compact('mouvements'));
    }
}
