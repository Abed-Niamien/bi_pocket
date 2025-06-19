<?php

namespace App\Http\Controllers;

use App\Exports\VentesParDateExport;
use App\Exports\VentesParProduitExport;
use App\Exports\VentesParCanalExport;
use App\Exports\VentesParVilleExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PDF;

class ExportController extends Controller
{
    public function exportVentesParDateCSV()
    {
        return Excel::download(new VentesParDateExport, 'ventes_par_date.csv');
    }

    public function exportVentesParProduitCSV()
    {
        return Excel::download(new VentesParProduitExport, 'ventes_par_produit.csv');
    }

    public function exportVentesParCanalCSV()
    {
        return Excel::download(new VentesParCanalExport, 'ventes_par_canal.csv');
    }

    public function exportVentesParVilleCSV()
    {
        return Excel::download(new VentesParVilleExport, 'ventes_par_ville.csv');
    }

    public function exportVentesParDatePDF()
    {
        $data = (new VentesParDateExport)->collection();
        $pdf = PDF::loadView('exports.ventes.par_date', ['data' => $data]);
        return $pdf->download('ventes_par_date.pdf');
    }

    public function exportVentesParProduitPDF()
    {
        $data = (new VentesParProduitExport)->collection();
        $pdf = PDF::loadView('exports.ventes.par_produit', ['data' => $data]);
        return $pdf->download('ventes_par_produit.pdf');
    }

    public function exportVentesParCanalPDF()
    {
        $data = (new VentesParCanalExport)->collection();
        $pdf = PDF::loadView('exports.ventes.par_canal', ['data' => $data]);
        return $pdf->download('ventes_par_canal.pdf');
    }

    public function exportVentesParVillePDF()
    {
        $data = (new VentesParVilleExport)->collection();
        $pdf = PDF::loadView('exports.ventes.par_ville', ['data' => $data]);
        return $pdf->download('ventes_par_ville.pdf');
    }
}

