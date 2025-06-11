<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Vente;
use App\Models\ProduitVente;
use App\Models\Client;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class VenteController extends Controller
{


public function create()
{
    $clients = Client::where('id_user', auth()->id())->get();
    $produits = Produit::with('stocks')->where('id_user', auth()->id())->get();

    return view('ventes.create', compact('clients', 'produits'));
}

public function index(){
$ventes = Vente::with(['produits'])
        ->where('id_user', Auth::id())
        ->get();

    return view('ventes.index', compact('ventes'));
}

public function store(Request $request)
{
    $request->validate([
    'date_vente' => 'required|date',
    'canal_vente' => 'required|string',
    'id_client' => 'required|exists:clients,id',
    'produits' => 'required|array',
    'produits.*.id_produit' => 'required|exists:produits,id',
    'produits.*.quantite' => 'required|integer|min:1',
]);


    // Création de la vente
    $vente = Vente::create([
    'date_vente' => $request->date_vente,
    'canal_vente' => $request->canal_vente,
    'id_client' => $request->id_client,
    'id_user' => auth()->id(), // ✅ Automatique
]);


    foreach ($request->produits as $item) {
        $produit = Produit::with('stocks')->findOrFail($item['id_produit']);

        // Récupérer le stock lié au produit (via la relation many-to-many)
        $stock = $produit->stocks->first(); // à adapter si plusieurs stocks

        if (!$stock || $stock->pivot->quantite_stock < $item['quantite']) {
            return back()->withErrors("Stock insuffisant pour le produit : " . $produit->lib_produit);
        }

        // Insertion dans la table produit_vente
        ProduitVente::create([
            'id_produit' => $produit->id,
            'id_vente' => $vente->id,
            'quantite_vente' => $item['quantite'],
            'montant_total' => $item['quantite'] * $produit->prix_unitaire,
        ]);

        // Mise à jour de la quantité dans la table pivot stock_produit
        $newQuantite = $stock->pivot->quantite_stock - $item['quantite'];

        DB::table('stock_produit')
            ->where('id_stock', $stock->id)
            ->where('id_produit', $produit->id)
            ->update(['quantite_stock' => $newQuantite]);
    }

    return redirect()->route('dashboard')->with('success', 'Vente enregistrée et stock mis à jour.');
}

}

