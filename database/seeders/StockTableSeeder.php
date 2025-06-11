<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\StockProduit;
use App\Models\User;
use DB;

class StockTableSeeder extends Seeder
{
    public function run()
    {
        // Récupérer tous les vendeurs (utilisateurs avec id_role_user = 2)
        $vendeurs = User::where('id_role_user', 2)->get();

        // Récupérer tous les produits existants
        $produits = Produit::all();

        foreach ($vendeurs as $vendeur) {
            // Créer un stock pour chaque vendeur
            $stock = Stock::create([
                'date_entree' => now(),
                'id_user' => $vendeur->id,
            ]);

            // Lier quelques produits au stock avec des quantités aléatoires
            $produitsAleatoires = $produits->random(min(10, $produits->count())); // max 10 produits par stock

            foreach ($produitsAleatoires as $produit) {
                StockProduit::create([
                    'id_stock' => $stock->id,
                    'id_produit' => $produit->id,
                    'quantite_stock' => rand(5, 20),
                ]);
            }
        }
    }
}
