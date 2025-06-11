<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RoleUserTableSeeder::class,
            UserTableSeeder::class,
            PaysTableSeeder::class,
            VilleTableSeeder::class,
            CommuneTableSeeder::class,
            CategorieProduitTableSeeder::class,
            ProduitTableSeeder::class,
            StockTableSeeder::class,
            EntrepriseTableSeeder::class,
            ClientTableSeeder::class,
            VenteTableSeeder::class,
            HistoriqueTableSeeder::class,
            UserEntrepriseSeeder::class,
        ]);
    }
}
