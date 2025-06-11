<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CategorieProduit; // la table catégorie_produit

class ProductController extends Controller
{

    public function index()
{
    $produits = Produit::with('categorie')->where('id_user', auth()->id())->get();
    return view('products.index', compact('produits'));
}

    public function create()
    {
        $categories = CategorieProduit::all();
        return view('products.create', compact('categories'));
    }


public function store(Request $request)
{
    $validated = $request->validate([
        'lib_produit' => 'required|string|max:255',
        'prix_unitaire' => 'required|numeric|min:0',
        'couleur_motif' => 'nullable|string|max:255',
        'photo_produit' => 'nullable|image|max:2048',
        'id_cat_produit' => 'required|exists:categorie_produit,id',
    ]);

    $photoPath = null;

if ($request->hasFile('photo_produit')) {
    $file = $request->file('photo_produit');
    $filename = time() . '_' . Str::slug($file->getClientOriginalName());
    $file->storeAs('public/produit', $filename); // ✅ Enregistrement dans storage/app/public/produit
    $photoPath = 'produit/' . $filename; // ✅ On sauvegarde ce chemin dans la BDD
}


    DB::table('produits')->insert([
        'lib_produit' => $validated['lib_produit'],
        'prix_unitaire' => $validated['prix_unitaire'],
        'couleur_motif' => $validated['couleur_motif'] ?? null,
        'photo_produit' => $photoPath,
        'id_cat_produit' => $validated['id_cat_produit'],
        'id_user' => auth()->id(), // ✅ Lier le produit à l'utilisateur connecté
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('dashboard')->with('success', 'Produit ajouté avec succès.');
}


}

