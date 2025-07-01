<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use App\Models\Pays;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function index()
    {
        $villes = Ville::with('pays')->get();
        return view('villes.index', compact('villes'));
    }

    public function create()
{
    $pays = Pays::all();
    return view('villes.create', compact('pays'));
}

public function store(Request $request)
{
    $request->validate([
        'lib_ville' => 'required|string|max:255',
        'id_pays' => 'required|exists:pays,id',
        'longitude_ville' => 'nullable|numeric|between:-180,180',
        'lattitude_ville' => 'nullable|numeric|between:-90,90',
    ]);

    Ville::create($request->only([
        'lib_ville',
        'id_pays',
        'longitude_ville',
        'lattitude_ville',
    ]));

    return redirect()->route('dashboard')->with('success', 'Ville ajoutée avec succès.');
}


    public function show(Ville $ville)
    {
        $ville->load('pays');
        return view('villes.show', compact('ville'));
    }

    public function edit(Ville $ville)
    {
        $pays = Pays::all();
        return view('villes.edit', compact('ville', 'pays'));
    }

    public function update(Request $request, Ville $ville)
    {
        $request->validate([
            'lib_ville' => 'required|string|max:255',
            'id_pays' => 'required|exists:pays,id',
        ]);

        $ville->update($request->all());

        return redirect()->route('villes.index')->with('success', 'Ville mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $ville = Ville::findOrFail($id);
        $ville->delete();
        return redirect()->route('dashboard')->with('success', 'Ville supprimée avec succès.');
    }
}
