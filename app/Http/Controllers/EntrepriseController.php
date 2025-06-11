<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEntreprise;

class EntrepriseController extends Controller
{
    public function index()
{
    $entreprises = Entreprise::with('employes')->get();
    return view('dashboard', compact('entreprises'));
}

public function create()
{
    return view('entreprises.create');
}

public function store(Request $request)
{
    $request->validate([
        'nom_entreprise' => 'required|string|max:255',
        'logo_entreprise' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
    ]);

    $logoPath = null;

    if ($request->hasFile('logo_entreprise')) {
        $logoPath = $request->file('logo_entreprise')->store('logos', 'public');
        // stocke le logo dans storage/app/public/logos
    }

    $entreprise = Entreprise::create([
        'nom_entreprise' => $request->nom_entreprise,
        'logo_entreprise' => $logoPath,
    ]);

    // Récupérer l'entreprise créée via where (id_proprietaire + nom)
    $entreprise = Entreprise::where('nom_entreprise', $request->nom_entreprise)
        ->latest('created_at')
        ->first();

    if ($entreprise) {
        // Insérer dans user_entreprise avec is_creator = 1
        UserEntreprise::create([
            'id_user' => Auth::id(),
            'id_entreprise' => $entreprise->id,
            'is_creator' => 1,
        ]);

        return redirect()->route('dashboard')->with('success', 'Entreprise créée avec succès.');
    }

    return back()->with('error', 'Erreur lors de la création de l’entreprise.');
}

}
