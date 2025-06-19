<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Vente;
use App\Models\ProduitVente;
use App\Models\Client;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
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

public function statistiques()
{
    $entrepriseId = DB::table('user_entreprise')
        ->where('id_user', Auth::id())
        ->value('id_entreprise');

    $idsUsersEntreprise = DB::table('user_entreprise')
        ->where('id_entreprise', $entrepriseId)
        ->pluck('id_user');

    //Ventes par mois
    $ventesParMois = DB::table('ventes')
    ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
    ->selectRaw("DATE_FORMAT(ventes.created_at, '%Y-%m') as mois, 
                 SUM(produit_vente.quantite_vente) as total_qte, 
                 SUM(produit_vente.montant_total) as total_montant")
    ->groupBy(DB::raw("DATE_FORMAT(ventes.created_at, '%Y-%m')"))
    ->orderBy(DB::raw("DATE_FORMAT(ventes.created_at, '%Y-%m')"), 'desc')
    ->get();

    // Ventes par produit
    $ventesParProduit = DB::table('produit_vente')
        ->join('produits', 'produit_vente.id_produit', '=', 'produits.id')
        ->select('produits.lib_produit', DB::raw('SUM(produit_vente.quantite_vente) as total_qte'), DB::raw('SUM(produit_vente.montant_total) as total_montant'))
        ->whereIn('produits.id_user', $idsUsersEntreprise)
        ->groupBy('produits.lib_produit')
        ->get();

    // Ventes par canal
    $ventesParCanal = DB::table('ventes')
        ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
        ->select('ventes.canal_vente', DB::raw('SUM(produit_vente.quantite_vente) as total_qte'), DB::raw('SUM(produit_vente.montant_total) as total_montant'))
        ->whereIn('ventes.id_user', $idsUsersEntreprise)
        ->groupBy('ventes.canal_vente')
        ->get();

    // Ventes par ville
    $ventesParVille = DB::table('ventes')
    ->join('produit_vente', 'ventes.id', '=', 'produit_vente.id_vente')
    ->join('clients', 'ventes.id_client', '=', 'clients.id')
    ->join('communes', 'clients.id_commune', '=', 'communes.id')
    ->join('villes', 'communes.id_ville', '=', 'villes.id')
    ->select(
        'villes.lib_ville',
        DB::raw('SUM(produit_vente.quantite_vente) as total_qte'),
        DB::raw('SUM(produit_vente.montant_total) as total_montant')
    )
    ->whereIn('ventes.id_user', $idsUsersEntreprise)
    ->groupBy('villes.lib_ville')
    ->get();

    return view('admin.ventes.index', compact(
        'ventesParMois',
        'ventesParProduit',
        'ventesParCanal',
        'ventesParVille'
    ));
}

public function exportParDatePDF()
{
    $data = $this->getParDateData();
    $pdf = Pdf::loadView('exports.ventes.par_date', compact('data'));
    return $pdf->download('ventes_par_date.pdf');
}

public function exportParProduitPDF()
{
    $data = $this->getParProduitData();
    $pdf = Pdf::loadView('exports.ventes.par_produit', compact('data'));
    return $pdf->download('ventes_par_produit.pdf');
}

public function exportParCanalPDF()
{
    $data = $this->getParCanalData();
    $pdf = Pdf::loadView('exports.ventes.par_canal', compact('data'));
    return $pdf->download('ventes_par_canal.pdf');
}

public function exportParVillePDF()
{
    $data = $this->getParVilleData();
    $pdf = Pdf::loadView('exports.ventes.par_ville', compact('data'));
    return $pdf->download('ventes_par_ville.pdf');
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

