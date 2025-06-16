<?php

namespace App\Http\Controllers;

use App\Models\CategorieProduit;
use Illuminate\Http\Request;

class CategorieProduitController extends Controller
{
    public function index()
    {
        $categories = CategorieProduit::all();
        return view('categorie_produits.index', compact('categories'));
    }

    public function create()
    {
        return view('categorie_produits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lib_cat_produit' => 'required|string|max:255',
        ]);

        CategorieProduit::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function show(CategorieProduit $category)
    {
        return view('categorie_produits.show', compact('category'));
    }

    public function edit(CategorieProduit $category)
    {
        return view('categorie_produits.edit', compact('category'));
    }

    public function update(Request $request, CategorieProduit $category)
    {
        $request->validate([
            'lib_cat_produit' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(CategorieProduit $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
