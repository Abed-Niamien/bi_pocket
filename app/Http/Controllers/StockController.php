<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Stock;
use App\Models\MouvementStock;
use App\Models\StockProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class StockController extends Controller
{
    public function create()
{
    $produits = Produit::all();
    return view('stocks.create', compact('produits'));
}

public function index()
{
    $user = auth()->user();

    // 1. Récupérer les entreprises du user
    $entreprises = DB::table('user_entreprise')
        ->join('entreprises', 'user_entreprise.id_entreprise', '=', 'entreprises.id')
        ->where('user_entreprise.id_user', $user->id)
        ->select('entreprises.id', 'entreprises.nom_entreprise')
        ->get();

    $stocksParEntreprise = [];

    foreach ($entreprises as $entreprise) {
        // 2. Récupérer les utilisateurs de cette entreprise
        $idsUsers = DB::table('user_entreprise')
            ->where('id_entreprise', $entreprise->id)
            ->pluck('id_user');

        // 3. Récupérer les produits et la quantité actuelle
        $stocks = DB::table('stock_produit as sp')
            ->join('stocks as s', 'sp.id_stock', '=', 's.id')
            ->join('produits as p', 'sp.id_produit', '=', 'p.id')
            ->whereIn('s.id_user', $idsUsers)
            ->select(
                'p.lib_produit',
                'sp.quantite_stock',
                'sp.updated_at as date_mise_a_jour'
            )
            ->groupBy('p.id', 'p.lib_produit', 'sp.quantite_stock', 'sp.updated_at')
            ->orderBy('p.lib_produit')
            ->get();

        $stocksParEntreprise[] = [
            'id' => $entreprise->id,
            'entreprise' => $entreprise->nom_entreprise,
            'stocks' => $stocks
        ];
    }

    return view('admin.stocks.index', compact('stocksParEntreprise'));
}


public function index_() {
    $stocks = Stock::with('produits')
        ->where('id_user', Auth::id())
        ->get();

    return view('stocks.index', compact('stocks'));
}

public function store(Request $request)
{
    // 🔹 Étape 1 : Validation des données envoyées depuis le formulaire
    $request->validate([
        'date_entree' => 'required|date',
        'produits' => 'required|array|min:1',
        'produits.*.id_produit' => 'required|exists:produits,id',
        'produits.*.quantite_stock' => 'required|integer|min:1',
    ]);

    $idUser = auth()->id();
    $dateEntree = $request->date_entree;

    // 🔹 Étape 2 : Créer un enregistrement dans la table stocks (si nécessaire)
    $stock = \App\Models\Stock::firstOrCreate(
        ['id_user' => $idUser],
        ['date_entree' => $dateEntree]
    );

    // 🔹 Étape 3 : Traiter chaque ligne de produit
    foreach ($request->produits as $item) {
        // On filtre les lignes invalides (par sécurité supplémentaire)
        if (empty($item['id_produit']) || empty($item['quantite_stock'])) {
            continue;
        }

        $idProduit = $item['id_produit'];
        $quantite = $item['quantite_stock'];

        // 🔸 Enregistrer le mouvement dans mouvements_stock
        \App\Models\MouvementStock::create([
            'id_produit'     => $idProduit,
            'quantite'       => $quantite,
            'type_mouvement' => 'entree',
            'date_mouvement' => $dateEntree,
            'id_user'        => $idUser,
        ]);

        // 🔸 Vérifier si le produit existe déjà dans le stock_produit
        $stockProduit = \App\Models\StockProduit::where('id_stock', $stock->id)
            ->where('id_produit', $idProduit)
            ->first();

        if ($stockProduit) {
            // Mise à jour de la quantité existante
            $stockProduit->update([
                'quantite_stock' => $stockProduit->quantite_stock + $quantite
            ]);
        } else {
            // Création d’une nouvelle ligne
            \App\Models\StockProduit::create([
                'id_stock'       => $stock->id,
                'id_produit'     => $idProduit,
                'quantite_stock' => $quantite,
            ]);
        }
    }

    // 🔹 Étape finale : redirection avec message de succès
    return redirect()->route('dashboard')->with('success', 'Stock ajouté avec succès.');
}

}
