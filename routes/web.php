<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Entreprises
    Route::get('/entreprises/create', [EntrepriseController::class, 'create'])->name('entreprises.create');
    Route::post('/entreprises', [EntrepriseController::class, 'store'])->name('entreprises.store');

    // Employés liés à une entreprise
    Route::get('/entreprises/{entreprise}/employes/create', [EmployeController::class, 'create'])->name('employes.create');
    Route::post('/entreprises/{entreprise}/employes', [EmployeController::class, 'store'])->name('employes.store');

    //Produits 
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');

    //Ventes
    Route::get('ventes/create', [VenteController::class, 'create'])->name('ventes.create');
    Route::post('ventes', [VenteController::class, 'store'])->name('ventes.store');
    Route::get('/ventes/index', [VenteController::class, 'index'])->name('ventes.index');

    //Clients
    Route::get('clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/index', [ClientController::class, 'index'])->name('clients.index');

    Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
    Route::get('/stocks/index', [StockController::class, 'index'])->name('stocks.index');

    });




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
