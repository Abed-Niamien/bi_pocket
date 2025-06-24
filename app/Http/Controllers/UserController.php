<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use DB;

class UserController extends Controller
{
    public function index(Request $request)
{
    $filtre = $request->input('filtre');

    $query = DB::table('users')
        ->join('user_entreprise', 'users.id', '=', 'user_entreprise.id_user')
        ->join('entreprises', 'user_entreprise.id_entreprise', '=', 'entreprises.id')
        ->join('role_user', 'users.id_role_user', '=', 'role_user.id')
        ->select(
            'users.*',
            'entreprises.nom_entreprise',
            'entreprises.id as entreprise_id',
            'role_user.lib_role_user'
        );

    // Filtrage
    if ($filtre === 'proprietaires') {
        $query->where('lib_role_user', 'Créateur');
    } elseif ($filtre === 'employes') {
        $query->where('lib_role_user', 'Membre'); // aliasé en "Employé" dans la vue
    }

    $utilisateurs = $query->distinct()->get();;

    // Comptages
    $total = DB::table('users')->count();

    $nbProprietaires = DB::table('users')
        ->join('role_user', 'users.id_role_user', '=', 'role_user.id')
        ->where('role_user.lib_role_user', 'Créateur')
        ->count();

    $nbEmployes = DB::table('users')
        ->join('role_user', 'users.id_role_user', '=', 'role_user.id')
        ->where('role_user.lib_role_user', 'Membre')
        ->count();

    return view('admin0123.utilisateurs.index', compact(
        'utilisateurs',
        'filtre',
        'total',
        'nbProprietaires',
        'nbEmployes'
    ));
}

}
