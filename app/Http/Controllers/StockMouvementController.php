<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StockMouvementController extends Controller
{
    public function index($entreprise)
{
    // Récupérer les utilisateurs liés à l'entreprise
    $users = DB::table('user_entreprise')
        ->where('id_entreprise', $entreprise)
        ->pluck('id_user');

    // Entrées (depuis mouvements_stock)
    $entrees = DB::table('mouvements_stock as ms')
        ->join('produits as p', 'ms.id_produit', '=', 'p.id')
        ->whereIn('ms.id_user', $users)
        ->where('ms.type_mouvement', 'entree')
        ->select(
            DB::raw("'Entrée' as type"),
            'p.lib_produit',
            'ms.quantite as quantite',
            'ms.created_at as date',
            'ms.id_user as utilisateur'
        )
        ->get();

    // Sorties (depuis ventes)
    $sorties = DB::table('produit_vente as pv')
        ->join('produits as p', 'pv.id_produit', '=', 'p.id')
        ->join('ventes as v', 'pv.id_vente', '=', 'v.id')
        ->whereIn('v.id_user', $users)
        ->select(
            DB::raw("'Sortie' as type"),
            'p.lib_produit',
            'pv.quantite_vente as quantite',
            'v.created_at as date',
            'v.id_user as utilisateur'
        )
        ->get();

    // Fusionner les deux
    $mouvements = $entrees->merge($sorties);

    // Trier par produit A-Z, puis type (Entrée avant Sortie), puis date décroissante
    $mouvements = $mouvements->sort(function ($a, $b) {
        $produitCompare = strcmp($a->lib_produit, $b->lib_produit);
        if ($produitCompare !== 0) return $produitCompare;

        // Entrée avant Sortie
        if ($a->type !== $b->type) {
            return $a->type === 'Entrée' ? -1 : 1;
        }

        // Date décroissante
        return strtotime($b->date) <=> strtotime($a->date);
    });

    return view('admin.stocks.mouvements', ['mouvements' => $mouvements]);
}

}
