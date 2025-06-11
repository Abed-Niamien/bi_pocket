<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commune;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
    $clients = Client::with('commune')->where('id_user', Auth::id())
        ->get();
    return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $communes = Commune::all();
        return view('clients.create', compact('communes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone_client' => 'nullable|string',
            'sexe_client' => 'nullable|in:m,f',
            'email_client' => 'nullable|email',
            'id_commune' => 'nullable|exists:communes,id'
        ]);

        Client::create([
            'nom_client' => $request->nom_client,
            'telephone_client' => $request->telephone_client,
            'sexe_client' => $request->sexe_client,
            'email_client' => $request->email_client,
            'id_commune' => $request->id_commune,
            'id_user' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Client ajouté avec succès.');
    }
}
