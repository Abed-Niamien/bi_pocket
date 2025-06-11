<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Produit;
use App\Models\Client;
use App\Models\Ville;
use App\Models\Vente;
use App\Models\User;
use Faker\Factory as Faker;
use DB;

class VenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $client = Client::first();
        //$ville = Ville::first();
        $employes = User::where('id_role_user', 2)->get();

        if (!$client || $employes->isEmpty()) {
            $this->command->warn("Données manquantes : client ou employés");
            return;
        }

        // Créer 30 ventes réparties sur différents jours
        for ($i = 0; $i < 30; $i++) {
            $employe = $employes->random();
            $canal = collect(['physique', 'en ligne'])->random();

            Vente::create([
                'date_vente' => Carbon::now()->subDays(rand(0, 60)),
                'canal_vente' => $canal,
                'id_client' => $client->id,
                'id_user' => $employe->id,
            ]);
        }
    }
}
