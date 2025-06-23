<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\ClientsSegmentesExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ClientSegmentationController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();

    // Liste des entreprises liées à cet utilisateur
    $entreprises = DB::table('user_entreprise')
        ->join('entreprises', 'entreprises.id', '=', 'user_entreprise.id_entreprise')
        ->where('user_entreprise.id_user', $user->id)
        ->select('entreprises.id', 'entreprises.nom_entreprise')
        ->get();

    $selectedEntrepriseId = $request->query('entreprise');

    // Récupérer les users liés à l'entreprise sélectionnée, ou toutes les entreprises de l'utilisateur
    if ($selectedEntrepriseId) {
        $idsUsers = DB::table('user_entreprise')
            ->where('id_entreprise', $selectedEntrepriseId)
            ->pluck('id_user');
    } else {
        $entrepriseIds = $entreprises->pluck('id');
        $idsUsers = DB::table('user_entreprise')
            ->whereIn('id_entreprise', $entrepriseIds)
            ->pluck('id_user');
    }

    $today = Carbon::today();

    $clients = DB::table('clients as c')
        ->leftJoin('ventes as v', 'c.id', '=', 'v.id_client')
        ->leftJoin('produit_vente as pv', 'v.id', '=', 'pv.id_vente')
        ->whereIn('c.id_user', $idsUsers)
        ->select(
            'c.id',
            'c.nom_client',
            DB::raw('MAX(v.date_vente) as last_purchase_date'),
            DB::raw('COUNT(v.id) as frequency'),
            DB::raw('SUM(pv.montant_total) as monetary')
        )
        ->groupBy('c.id', 'c.nom_client')
        ->get();

    // Segmentation RFM
    $clients = $clients->map(function ($client) use ($today) {
        $lastDate = $client->last_purchase_date ? Carbon::parse($client->last_purchase_date) : null;
        $client->recence = $lastDate ? $lastDate->diffInDays($today) : null;

        $client->segment_r = match (true) {
            $client->recence === null     => 3,
            $client->recence <= 30        => 1,
            $client->recence <= 90        => 2,
            default                       => 3,
        };

        $client->segment_f = match (true) {
            $client->frequency >= 10 => 1,
            $client->frequency >= 5  => 2,
            default                  => 3,
        };

        $client->segment_m = match (true) {
            $client->monetary >= 1000000 => 1,
            $client->monetary >= 500000  => 2,
            default                      => 3,
        };

        $client->segment = $client->segment_r . $client->segment_f . $client->segment_m;

        return $client;
    });

    return view('admin.clients.index', compact('clients', 'entreprises', 'selectedEntrepriseId'));
}
    public function exportCSV()
    {
        return Excel::download(new ClientsSegmentesExport, 'clients_segmentes.csv');
    }

    public function exportPDF()
{
    $user = auth()->user();

    $idEntreprises = DB::table('user_entreprise')
        ->where('id_user', $user->id)
        ->pluck('id_entreprise');

    $idsUsers = DB::table('user_entreprise')
        ->whereIn('id_entreprise', $idEntreprises)
        ->pluck('id_user');

    $today = Carbon::today();

    $clients = DB::table('clients as c')
        ->leftJoin('ventes as v', 'c.id', '=', 'v.id_client')
        ->leftJoin('produit_vente as pv', 'v.id', '=', 'pv.id_vente')
        ->whereIn('c.id_user', $idsUsers)
        ->select(
            'c.nom_client',
            DB::raw('MAX(v.date_vente) as last_purchase_date'),
            DB::raw('COUNT(v.id) as frequency'),
            DB::raw('COALESCE(SUM(pv.montant_total), 0) as monetary')
        )
        ->groupBy('c.id', 'c.nom_client')
        ->get();

    $clients = $clients->map(function ($client) use ($today) {
        $lastDate = $client->last_purchase_date ? Carbon::parse($client->last_purchase_date) : null;
        $client->recence = $lastDate ? $lastDate->diffInDays($today) : null;

        $client->segment_r = $client->recence === null ? 3 : ($client->recence <= 30 ? 1 : ($client->recence <= 90 ? 2 : 3));
        $client->segment_f = $client->frequency >= 10 ? 1 : ($client->frequency >= 5 ? 2 : 3);
        $client->segment_m = $client->monetary >= 1000000 ? 1 : ($client->monetary >= 500000 ? 2 : 3);
        $client->segment = $client->segment_r . $client->segment_f . $client->segment_m;

        return $client;
    });

    $pdf = Pdf::loadView('exports.ventes.clientspdf', compact('clients'));

    return $pdf->download('clients_segmentes.pdf');
}

public function listeClients()
{
    $user = auth()->user();

    // Récupérer les entreprises liées à l'utilisateur
    $idEntreprises = DB::table('user_entreprise')
        ->where('id_user', $user->id)
        ->pluck('id_entreprise');

    // Récupérer tous les utilisateurs liés à ces entreprises
    $idsUsers = DB::table('user_entreprise')
        ->whereIn('id_entreprise', $idEntreprises)
        ->pluck('id_user');

    // Récupérer les clients liés à ces utilisateurs
    $clients = DB::table('clients')
        ->whereIn('id_user', $idsUsers)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.clients.liste', compact('clients'));
}

public function show($id)
{
    $user = auth()->user();

    // Vérifier que ce client appartient à une entreprise liée à l'utilisateur
    $idEntreprises = DB::table('user_entreprise')->where('id_user', $user->id)->pluck('id_entreprise');
    $idsUsers = DB::table('user_entreprise')->whereIn('id_entreprise', $idEntreprises)->pluck('id_user');

    $client = DB::table('clients')
        ->where('id', $id)
        ->whereIn('id_user', $idsUsers)
        ->first();

    if (!$client) {
        abort(403, "Accès refusé ou client inexistant");
    }

    // Détails des ventes
    $ventes = DB::table('ventes as v')
        ->join('produit_vente as pv', 'v.id', '=', 'pv.id_vente')
        ->join('produits as p', 'pv.id_produit', '=', 'p.id')
        ->select(
            'v.id',
            'v.date_vente',
            'v.canal_vente',
            DB::raw('SUM(pv.quantite_vente) as total_qte'),
            DB::raw('SUM(pv.montant_total) as total_montant'),
            DB::raw('GROUP_CONCAT(p.lib_produit) as produits')
        )
        ->where('v.id_client', $client->id)
        ->groupBy('v.id', 'v.date_vente', 'v.canal_vente')
        ->orderByDesc('v.date_vente')
        ->get();

    return view('admin.clients.show', compact('client', 'ventes'));
}

    
}
