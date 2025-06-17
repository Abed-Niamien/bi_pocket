<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CategorieProduit; // la table catégorie_produit

class ProductController extends Controller
{

    public function index_()
{
    $produits = Produit::with('categorie')->where('id_user', auth()->id())->get();
    return view('products.index', compact('produits'));
}

public function index()
{
    $produits = Produit::all();
    return view('products.index1', compact('produits'));
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

 // Méthode d'édition (affiche le formulaire)
    public function edit(Produit $produit)
    {
        $categories = CategorieProduit::all();
        return view('products.edit', compact('produit', 'categories'));
    }

    // Méthode de mise à jour (traitement du formulaire)
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'lib_produit' => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric|min:0',
            'couleur_motif' => 'nullable|string|max:100',
            'photo_produit' => 'nullable|image|max:2048',
            'id_cat_produit' => 'required|exists:categorie_produit,id',
            'id_user' => 'required|exists:users,id',
        ]);

        $data = $request->all();

        // Gérer l'upload d'image
        if ($request->hasFile('photo_produit')) {
            // Supprimer l'ancienne photo s'il y en a une
            if ($produit->photo_produit) {
                Storage::disk('public')->delete($produit->photo_produit);
            }

            $path = $request->file('photo_produit')->store('produits_photos', 'public');
            $data['photo_produit'] = $path;
        }

        $produit->update($data);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }



    public function destroy($id)
{
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('dashboard')->with('success', 'Produit supprimé avec succès.');
    }

}

