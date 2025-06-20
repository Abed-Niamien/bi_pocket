<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Stock;
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

            // 3. Récupérer les stocks faits par les utilisateurs de cette entreprise
            $stocks = DB::table('stocks as s')
                ->join('stock_produit as sp', 's.id', '=', 'sp.id_stock')
                ->join('produits as p', 'sp.id_produit', '=', 'p.id')
                ->whereIn('s.id_user', $idsUsers)
                ->select(
                    'p.lib_produit',
                    'sp.quantite_stock',
                    's.date_entree',
                    's.id_user'
                )
                ->orderBy('s.date_entree', 'desc')
                ->get();

            $stocksParEntreprise[] = [
                'id'         => $entreprise->id,
                'entreprise' => $entreprise->nom_entreprise,
                'stocks'     => $stocks
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
    $request->validate([
        'date_entree' => 'required|date',
        'produits.*.id_produit' => 'required|exists:produits,id',
        'produits.*.quantite_stock' => 'required|integer|min:1',
    ]);

    $stock = Stock::create([
        'date_entree' => $request->date_entree,
        'id_user' => Auth::id(),
    ]);

    foreach ($request->produits as $produitData) {
        $pivot = StockProduit::where('id_produit', $produitData['id_produit'])->first();

        if ($pivot) {
            $pivot->quantite_stock += $produitData['quantite_stock'];
            $pivot->save();
        } else {
            StockProduit::create([
                'id_stock' => $stock->id,
                'id_produit' => $produitData['id_produit'],
                'quantite_stock' => $produitData['quantite_stock'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return redirect()->route('dashboard')->with('success', 'Stock mis à jour avec succès.');
}

}
