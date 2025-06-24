<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;
use App\Models\Vente;
use App\Models\User;
use App\Models\CategorieProduit;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEntreprise;
use DB;

class EntrepriseController extends Controller
{


    public function index()
{
    $userId = Auth::id();

    $entreprises = DB::table('entreprises')
        ->join('user_entreprise', 'entreprises.id', '=', 'user_entreprise.id_entreprise')
        ->where('user_entreprise.id_user', $userId)
        ->select(
            'entreprises.id',
            'entreprises.nom_entreprise',
            'entreprises.created_at',
            // ✅ Sous-requête modifiée pour exclure le créateur (user connecté)
            DB::raw("(
                SELECT COUNT(*) 
                FROM user_entreprise 
                WHERE id_entreprise = entreprises.id AND id_user != $userId
            ) as nb_employes")
        )
        ->distinct()
        ->get();

    return view('admin.entreprises.index', compact('entreprises'));
}


    public function show($id, Request $request)
{
    $entreprise = Entreprise::findOrFail($id);


    
    // 🔸 Récupérer uniquement les employés de cette entreprise
    $usersIds = DB::table('user_entreprise')
        ->where('id_entreprise', $id)
        ->pluck('id_user');

    // 🔸 Récupérer les utilisateurs (employés) liés à l’entreprise
    $employes = DB::table('users')
        ->whereIn('id', $usersIds)
        ->get();

    // 🔸 Base des ventes
    $ventesQuery = DB::table('ventes')
        ->whereIn('id_user', $usersIds);

    // 🔸 Appliquer les filtres dynamiques
    if ($request->filled('id_user')) {
        $ventesQuery->where('id_user', $request->id_user);
    }

    if ($request->filled('periode')) {
        $ventesQuery->whereMonth('created_at', substr($request->periode, 5, 2))
                    ->whereYear('created_at', substr($request->periode, 0, 4));
    }

    $ventesIds = $ventesQuery->pluck('id');

    // 🔸 Produits filtrés (dans les ventes trouvées)
    $produitVenteQuery = DB::table('produit_vente')
        ->join('produits', 'produit_vente.id_produit', '=', 'produits.id')
        ->whereIn('produit_vente.id_vente', $ventesIds);

    if ($request->filled('id_produit')) {
        $produitVenteQuery->where('produits.id', $request->id_produit);
    }

    if ($request->filled('id_categorie')) {
        $produitVenteQuery->where('produits.id_cat_produit', $request->id_categorie);
    }

    // 🔹 Ventes par période
    $ventesParPeriode = $ventesQuery->get()->groupBy(function ($vente) {
        return \Carbon\Carbon::parse($vente->created_at)->format('Y-m');
    })->map(function ($group, $key) {
        return [
            'periode' => $key,
            'total' => $group->sum('montant_total'),
        ];
    })->values();

    // 🔹 Ventes par catégorie
    $ventesParCategorie = $produitVenteQuery
        ->join('categorie_produit', 'produits.id_cat_produit', '=', 'categorie_produit.id')
        ->select('categorie_produit.lib_cat_produit as categorie', DB::raw('SUM(produit_vente.montant_total) as total'))
        ->groupBy('categorie_produit.lib_cat_produit')
        ->get();

    // 🔹 Produits les plus vendus
    $produitsPlusVendus = $produitVenteQuery
        ->select('produits.lib_produit as produit', DB::raw('SUM(produit_vente.quantite_vente) as quantite_totale'))
        ->groupBy('produits.lib_produit')
        ->orderByDesc('quantite_totale')
        ->limit(5)
        ->get();

    // 🔸 Pour les champs de sélection dans le formulaire
    $produits = DB::table('produits')
        ->whereIn('id_user', $usersIds)
        ->get();

    $categories = DB::table('categorie_produit')->get();

    // 🔹 On regroupe les stats à envoyer à la vue
    $stats = [
        'ventesParPeriode' => $ventesParPeriode,
        'ventesParCategorie' => $ventesParCategorie,
        'produitsPlusVendus' => $produitsPlusVendus
    ];

    // Obtenir les employés de l'entreprise
    $usersIds = DB::table('user_entreprise')
        ->where('id_entreprise', $id)
        ->pluck('id_user');

    // 🔹 Ventes globales
   $ventesParPeriode = DB::table('ventes')
    ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
    ->select(DB::raw("DATE_FORMAT(date_vente, '%Y-%m') as periode"), DB::raw('SUM(produit_vente.montant_total) as total'))
    ->whereIn('ventes.id_user', $usersIds)
    ->groupBy('periode')
    ->orderBy('periode')
    ->get()
    ->map(function ($item) {
        $date = \Carbon\Carbon::createFromFormat('Y-m', $item->periode);
        return [
            'periode' => $date->translatedFormat('F Y'),
            'total' => $item->total
        ];
    });

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

    // 🔹 On regroupe les stats à envoyer à la vue
    $stats = [
        'ventesParPeriode' => $ventesParPeriode,
        'ventesParCategorie' => $ventesParCategorie,
        'produitsPlusVendus' => $produitsPlusVendus
    ];

    return view('entreprises.show', compact('entreprise', 'stats'));
}

public function show_($id)
{
    // Détails de l’entreprise
    $entreprise = DB::table('entreprises')->where('id', $id)->first();

    // Récupérer tous les utilisateurs liés à cette entreprise (sauf le créateur)
    $employes = DB::table('user_entreprise as ue')
        ->join('users as u', 'ue.id_user', '=', 'u.id')
        ->leftJoin('role_user as r', 'u.id_role_user', '=', 'r.id') // jointure avec les rôles
        ->where('ue.id_entreprise', $id)
        ->where('u.id', '!=', auth()->id()) // ne pas afficher le créateur
        ->select(
            'u.id',
            'u.name',
            'u.email',
            'r.lib_role_user',
            'u.created_at',
            'ue.created_at as date_affectation'
        )
        ->get();

    return view('admin.entreprises.show', compact('entreprise', 'employes'));
}


public function create()
{
    return view('entreprises.create');
}

public function store(Request $request)
{
    $request->validate([
        'nom_entreprise' => 'required|string|max:255',
        'logo_entreprise' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
    ]);

    $logoPath = null;

    if ($request->hasFile('logo_entreprise')) {
        $logoPath = $request->file('logo_entreprise')->store('logos', 'public');
        // stocke le logo dans storage/app/public/logos
    }

    $entreprise = Entreprise::create([
        'nom_entreprise' => $request->nom_entreprise,
        'logo_entreprise' => $logoPath,
    ]);

    // Récupérer l'entreprise créée via where (id_proprietaire + nom)
    $entreprise = Entreprise::where('nom_entreprise', $request->nom_entreprise)
        ->latest('created_at')
        ->first();

    if ($entreprise) {
        // Insérer dans user_entreprise avec is_creator = 1
        UserEntreprise::create([
            'id_user' => Auth::id(),
            'id_entreprise' => $entreprise->id,
            'is_creator' => 1,
        ]);

        return redirect()->route('dashboard')->with('success', 'Entreprise créée avec succès.');
    }

    return back()->with('error', 'Erreur lors de la création de l’entreprise.');
}

}
