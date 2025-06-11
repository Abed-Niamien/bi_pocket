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

public function index() {
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
