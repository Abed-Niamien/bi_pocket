<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategorieProduitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\StockMouvementController;
use App\Http\Controllers\ClientSegmentationController;
use App\Http\Middleware\NoCacheMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', \App\Http\Middleware\NoCacheMiddleware::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Entreprises
    Route::get('/entreprises/create', [EntrepriseController::class, 'create'])->name('entreprises.create');
    Route::post('/entreprises', [EntrepriseController::class, 'store'])->name('entreprises.store');
    Route::get('/entreprises/{id}', [EntrepriseController::class, 'show'])->name('entreprises.show');
    Route::get('admin/entreprises', [EntrepriseController::class, 'index'])->name('admin.entreprises.index');

    // Export CSV pour les ventes par date
    Route::get('/export-ventes/date/csv', [App\Http\Controllers\ExportController::class, 'exportVentesParDateCSV'])->name('exports.ventes.date.csv');

    // Export CSV pour les ventes par produit
    Route::get('/export-ventes/produit/csv', [App\Http\Controllers\ExportController::class, 'exportVentesParProduitCSV'])->name('exports.ventes.produit.csv');

    // Export CSV pour les ventes par canal
    Route::get('/export-ventes/canal/csv', [App\Http\Controllers\ExportController::class, 'exportVentesParCanalCSV'])->name('exports.ventes.canal.csv');

    // Export CSV pour les ventes par ville
    Route::get('/export-ventes/ville/csv', [App\Http\Controllers\ExportController::class, 'exportVentesParVilleCSV'])->name('exports.ventes.ville.csv');


    // Export PDF pour les ventes par date
    Route::get('/export-ventes/date/pdf', [App\Http\Controllers\ExportController::class, 'exportVentesParDatePDF'])->name('exports.ventes.date.pdf');

    // Export PDF pour les ventes par produit
    Route::get('/export-ventes/produit/pdf', [App\Http\Controllers\ExportController::class, 'exportVentesParProduitPDF'])->name('exports.ventes.produit.pdf');

    // Export PDF pour les ventes par canal
    Route::get('/export-ventes/canal/pdf', [App\Http\Controllers\ExportController::class, 'exportVentesParCanalPDF'])->name('exports.ventes.canal.pdf');

    // Export PDF pour les ventes par ville
    Route::get('/export-ventes/ville/pdf', [App\Http\Controllers\ExportController::class, 'exportVentesParVillePDF'])->name('exports.ventes.ville.pdf');

    // Segmentation des clients
    Route::get('admin/clients/index', [ClientSegmentationController::class, 'index'])
    ->name('admin.clients.index');
    Route::get('admin/clients/liste', [\App\Http\Controllers\ClientSegmentationController::class, 'listeClients'])->name('admin.clients.liste');
    Route::get('admin/clients/{id}', [\App\Http\Controllers\ClientSegmentationController::class, 'show'])->name('admin.clients.show');


    // Employés liés à une entreprise
    Route::get('/entreprises/{entreprise}/employes/create', [EmployeController::class, 'create'])->name('employes.create');
    Route::post('/entreprises/{entreprise}/employes', [EmployeController::class, 'store'])->name('employes.store');
    Route::get('/admin/entreprises/{id}/employes', [App\Http\Controllers\EntrepriseController::class, 'show_'])
    ->name('admin.entreprises.show');
    Route::get('/adminconnectiix/utilisateurs/index', [App\Http\Controllers\UserController::class, 'index'])
    ->name('admin0123.utilisateurs.index');

    //Produits 
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/index', [ProductController::class, 'index_'])->name('products.index1');

    //Ventes
    Route::get('ventes/create', [VenteController::class, 'create'])->name('ventes.create');
    Route::post('ventes', [VenteController::class, 'store'])->name('ventes.store');
    Route::get('ventes/index', [VenteController::class, 'index'])->name('ventes.index');
    Route::get('admin/ventes/index', [VenteController::class, 'statistiques'])->name('admin.ventes.index');

    //Clients
    Route::get('clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/index', [ClientController::class, 'index'])->name('clients.index');

    Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/stocks/index', [StockController::class, 'index_'])->name('stocks.index');

    //Exporter les donnees cients en csv et pdf
    Route::get('/clients/segmentes/export/csv', [ClientSegmentationController::class, 'exportCSV'])->name('exports.clientscsv.csv');
    Route::get('/clients/segmentes/export/pdf', [ClientSegmentationController::class, 'exportPDF'])->name('exports.clientspdf.pdf');

    });




Route::middleware('auth', \App\Http\Middleware\NoCacheMiddleware::class)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', \App\Http\Middleware\NoCacheMiddleware::class])->group(function () {
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('categorie_produit', App\Http\Controllers\CategorieProduitController::class);
    Route::resource('pays', App\Http\Controllers\PaysController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('villes', App\Http\Controllers\VilleController::class);
    Route::resource('communes', App\Http\Controllers\CommuneController::class);
});

Route::prefix('admin/stocks')->name('admin.')->middleware(['auth', \App\Http\Middleware\NoCacheMiddleware::class])->group(function () {
    Route::get('index', [StockController::class, 'index'])->name('stocks.index');
    Route::get('/edit/{id}', [StockController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [StockController::class, 'update'])->name('update');
});

Route::get('stock/mouvements/{entreprise}', [StockMouvementController::class, 'index'])->name('admin.stocks.mouvements')->middleware(NoCacheMiddleware::class);

require __DIR__.'/auth.php';
