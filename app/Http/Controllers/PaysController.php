<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Http\Controllers\PaysController;
use Illuminate\Http\Request;

class PaysController extends Controller
{
    public function index()
    {
        $pays = Pays::all();
        return view('pays.index', compact('pays'));
    }

    public function create()
    {
        return view('pays.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_pays' => 'required|string|max:255',
        ]);
        Pays::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Pays ajouté avec succès.');
    }

    public function show(Pays $pay)
    {
        return view('pays.show', compact('pay'));
    }

    public function edit(Pays $pay)
    {
        return view('pays.edit', compact('pay'));
    }

    public function update(Request $request, Pays $pay)
    {
        $request->validate([
            'nom_pays' => 'required|string|max:255',
        ]);
        $pay->update($request->all());
        return redirect()->route('pays.index')->with('success', 'Pays mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $p = Pays::findOrFail($id);
        $p->delete();
        return redirect()->route('dashboard')->with('success', 'Pays supprimé avec succès.');
    }
}
