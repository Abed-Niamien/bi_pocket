<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function create(Entreprise $entreprise)
{
    return view('employes.create', compact('entreprise'));
}

 

public function store(Request $request, $id_entreprise)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Création du user (employé)
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'id_role_user' => 2,
    ]);

    // Récupérer les ids
    $entreprise = Entreprise::findOrFail($id_entreprise);  // adapte selon ta clé primaire
    $id_user = $user->id;
    // Insertion manuelle dans la table pivot user_entreprise
    DB::table('user_entreprise')->insert([
        'id_entreprise' => $id_entreprise,
        'id_user' => $id_user,
        'is_creator' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('dashboard')->with('success', 'Employé ajouté avec succès.');
}


}
