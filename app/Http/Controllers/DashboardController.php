<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Produit;
use App\Models\CategorieProduit;
use App\Models\Client;
use App\Models\Commune;
use App\Models\User;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // ✅ CAS 1 : Super Admin spécifique
    if ($user->id_role_user == 1 && $user->name == 'admin0123') {
        return view('dashboard', [
            'user' => $user, // ← Important
            'nbPays' => \App\Models\Pays::count(),
            'nbProduits' => \App\Models\Produit::count(),
            'nbVilles' => \App\Models\Ville::count(),
            'nbCommunes' => \App\Models\Commune::count(),
            'nbCategories' => \App\Models\CategorieProduit::count(),
        ]);
    }

    // ✅ CAS 2 : Admin classique
    elseif ($user->id_role_user == 1) {
        $entreprises = $user->entreprises;
        $statistiquesParEntreprise = [];

        foreach ($entreprises as $entreprise) {
            // 1. Récupération des IDs utilisateurs liés à l'entreprise
            $usersIds = $entreprise->users->pluck('id');

            // 2. Jointure entre ventes et produit_vente pour récupérer les montants
            $ventesParPeriode = DB::table('ventes as v')
                ->join('produit_vente as pv', 'v.id', '=', 'pv.id_vente')
                ->whereIn('v.id_user', $usersIds)
                ->select(
                    DB::raw('DATE(v.created_at) as periode'),
                    DB::raw('SUM(pv.montant_total) as total')
                )
                ->groupBy('periode')
                ->orderBy('periode')
                ->get();

            $ventesParCategorie = DB::table('ventes')
                ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
                ->join('produits', 'produit_vente.id_produit', '=', 'produits.id')
                ->join('categorie_produit', 'produits.id_cat_produit', '=', 'categorie_produit.id')
                ->select('categorie_produit.lib_cat_produit as categorie', DB::raw('SUM(produit_vente.montant_total) as total'))
                ->whereIn('ventes.id_user', $usersIds)
                ->groupBy('categorie_produit.lib_cat_produit')
                ->get();

            $produitsPlusVendus = DB::table('ventes')
                ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
                ->join('produits', 'produit_vente.id_produit', '=', 'produits.id')
                ->select('produits.lib_produit as produit', DB::raw('SUM(produit_vente.quantite_vente) as quantite_totale'))
                ->whereIn('ventes.id_user', $usersIds)
                ->groupBy('produits.lib_produit')
                ->orderByDesc('quantite_totale')
                ->limit(5)
                ->get();

            $ventesAvecCoordonnees[$entreprise->id] = DB::table('ventes')
    ->join('clients', 'ventes.id_client', '=', 'clients.id')
    ->join('communes', 'clients.id_commune', '=', 'communes.id')
    ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
    ->join('produits', 'produit_vente.id_produit', '=', 'produits.id')  // <-- jointure produits
    ->whereIn('ventes.id_user', $usersIds)
    ->whereNotNull('communes.lattitude_commune')
    ->whereNotNull('communes.longitude_commune')
    ->select(
        'clients.nom_client',
        DB::raw('SUM(produit_vente.montant_total) as montant_total'),
        'communes.lib_commune',
        'communes.lattitude_commune',
        'communes.longitude_commune',
        'ventes.date_vente',
        'ventes.canal_vente',
        'produits.lib_produit',   // <-- ici nom produit depuis la table produits
        'produit_vente.quantite_vente'
    )
    ->groupBy(
        'clients.nom_client',
        'communes.lib_commune',
        'communes.lattitude_commune',
        'communes.longitude_commune',
        'ventes.date_vente',
        'ventes.canal_vente',
        'produits.lib_produit', 
        'produit_vente.quantite_vente'  // <-- aussi group by nom produit
    )
    ->get();


            $statistiquesParEntreprise[$entreprise->id] = [
                'ventesParPeriode' => $ventesParPeriode,
                'ventesParCategorie' => $ventesParCategorie,
                'produitsPlusVendus' => $produitsPlusVendus,
            ];
        }

        $produits = collect();
        $stocks = collect();
        $clients = collect();
        $ventes = collect();

        return view('dashboard', [
            'user' => $user,
            'entreprises' => $entreprises,
            'produits' => $produits,
            'stocks' => $stocks,
            'clients' => $clients,
            'ventes' => $ventes,
            'statistiquesParEntreprise' => $statistiquesParEntreprise,
            'ventesAvecCoordonnees' => $ventesAvecCoordonnees,
        ]);
    }

    // ✅ CAS 3 : Employé
    elseif ($user->id_role_user == 2) {
        $entreprise = $user->entreprises()->first();
        $entreprises = $entreprise ? collect([$entreprise]) : collect();

        $produits = \App\Models\Produit::where('id_user', $user->id)->get();
        $stocks = \App\Models\Stock::where('id_user', $user->id)->get();
        $clients = \App\Models\Client::where('id_user', $user->id)->get();
        $ventes = \App\Models\Vente::where('id_user', $user->id)->get();
    }

    // ✅ CAS 4 : Autres cas
    else {
        $entreprises = collect();
        $produits = collect();
        $stocks = collect();
        $clients = collect();
        $ventes = collect();
    }

    return view('dashboard', [
        'user' => $user,
        'entreprises' => $entreprises,
        'produits' => $produits,
        'stocks' => $stocks,
        'clients' => $clients,
        'ventes' => $ventes,
    ]);
}

}
