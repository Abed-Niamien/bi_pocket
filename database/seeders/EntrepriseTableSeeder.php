<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entreprise;
use DB;

class EntrepriseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Créer une vraie entreprise appartenant à cet admin
        $entreprise = Entreprise::create([
            'nom_entreprise' => 'BI Pocket SARL',
            'logo_entreprise' => 'logo.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer une vraie entreprise appartenant à cet admin
        $entreprise = Entreprise::create([
            'nom_entreprise' => 'BI Pocket SA',
            'logo_entreprise' => 'logo2.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
