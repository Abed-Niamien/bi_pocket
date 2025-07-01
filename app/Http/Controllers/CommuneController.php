<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Ville;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    public function index()
    {
        $communes = Commune::with('ville')->get();
        return view('communes.index', compact('communes'));
    }

    public function create()
{
    $villes = Ville::all();
    return view('communes.create', compact('villes'));
}

public function store(Request $request)
{
    $request->validate([
        'lib_commune' => 'required|string|max:255',
        'id_ville' => 'required|exists:villes,id',
        'longitude_commune' => 'nullable|numeric|between:-180,180',
        'lattitude_commune' => 'nullable|numeric|between:-90,90',
    ]);

    Commune::create($request->only([
        'lib_commune',
        'id_ville',
        'longitude_commune',
        'lattitude_commune',
    ]));

    return redirect()->route('dashboard')->with('success', 'Commune ajoutée avec succès.');
}


    public function show(Commune $commune)
    {
        $commune->load('ville');
        return view('communes.show', compact('commune'));
    }

    public function edit(Commune $commune)
    {
        $villes = Ville::all();
        return view('communes.edit', compact('commune', 'villes'));
    }

    public function update(Request $request, Commune $commune)
    {
        $request->validate([
            'lib_commune' => 'required|string|max:255',
            'id_ville' => 'required|exists:villes,id',
        ]);

        $commune->update($request->all());

        return redirect()->route('communes.index')->with('success', 'Commune mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $commune = Commune::findOrFail($id);
        $commune->delete();
        return redirect()->route('dashboard')->with('success', 'Commune supprimée avec succès.');
    }
}
