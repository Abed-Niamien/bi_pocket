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

if ($user->id_role_user == 1) {
    // Récupérer les entreprises du propriétaire
    $entreprises = $user->entreprises;
    $statistiquesParEntreprise = [];

    foreach ($entreprises as $entreprise) {
        // Utilisateurs liés à l'entreprise (via la table pivot user_entreprise)
        $usersIds = $entreprise->users->pluck('id');

        // Ventes de ces utilisateurs
        $ventesEntreprise = Vente::whereIn('id_user', $usersIds)->get();

        // 🔹 Ventes par période (mois/année)
        $ventesParPeriode = $ventesEntreprise->groupBy(function ($vente) {
            return \Carbon\Carbon::parse($vente->created_at)->format('Y-m');
        })->map(function ($group, $key) {
            return [
                'periode' => $key,
                'total' => $group->sum('montant_total'),
            ];
        })->values();

        // 🔹 Ventes par catégorie
        $ventesParCategorie = DB::table('ventes')
            ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
            ->join('produits', 'produit_vente.id_produit', '=', 'produits.id')
            ->join('categorie_produit', 'produits.id_cat_produit', '=', 'categorie_produit.id')
            ->select('categorie_produit.lib_cat_produit as categorie', DB::raw('SUM(produit_vente.montant_total) as total'))
            ->whereIn('ventes.id_user', $usersIds)
            ->groupBy('categorie_produit.lib_cat_produit')
            ->get();

        // 🔹 Produits les plus vendus
        $produitsPlusVendus = DB::table('ventes')
            ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
            ->join('produits', 'produit_vente.id_produit', '=', 'produits.id')
            ->select('produits.lib_produit as produit', DB::raw('SUM(produit_vente.quantite_vente) as quantite_totale'))
            ->whereIn('ventes.id_user', $usersIds)
            ->groupBy('produits.lib_produit')
            ->orderByDesc('quantite_totale')
            ->limit(5)
            ->get();

        // On regroupe tout par entreprise
        $statistiquesParEntreprise[$entreprise->id] = [
            'ventesParPeriode' => $ventesParPeriode,
            'ventesParCategorie' => $ventesParCategorie,
            'produitsPlusVendus' => $produitsPlusVendus,
        ];
    }

    // Autres données (comme dans ton code initial)
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
    ]);
}


 elseif ($user->id_role_user == 2) {
    // Employé : une seule entreprise
    $entreprise = $user->entreprises()->first();
    $entreprises = $entreprise ? collect([$entreprise]) : collect();

    // Récupération des données liées uniquement à l'utilisateur connecté
    $produits = \App\Models\Produit::where('id_user', $user->id)->get();
    $stocks = \App\Models\Stock::where('id_user', $user->id)->get();
    $clients = \App\Models\Client::where('id_user', $user->id)->get();
    $ventes = \App\Models\Vente::where('id_user', $user->id)->get();

} else {
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
