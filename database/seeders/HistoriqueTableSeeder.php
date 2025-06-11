<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Historique;
use App\Models\Vente;
use Carbon\Carbon;
use DB;

class HistoriqueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = User::where('id_role_user', 1)->first();
        $employe = User::where('id_role_user', 2)->first();
        $ventesCount = DB::table('ventes')->count();

        if (!$admin || !$employe || !$ventesCount) {
            $this->command->warn("Données manquantes pour remplir l'historique.");
            return;
        }

        // Actions par l'admin
        Historique::create([
            'type_action' => 'Création de l’entreprise BI Pocket SARL',
            'id_user' => $admin->id,
            'date_action' => Carbon::now()->subDays(10),
            'id_vente' => rand(1, $ventesCount),
        ]);

        Historique::create([
            'type_action' => 'Ajout d’un employé à l’entreprise',
            'id_user' => $admin->id,
            'date_action' => Carbon::now()->subDays(9),
            'id_vente' => rand(1, $ventesCount),
        ]);

        // Actions par l’employé
        Historique::create([
            'type_action' => 'Ajout d’un produit au catalogue',
            'id_user' => $employe->id,
            'date_action' => Carbon::now()->subDays(3),
            'id_vente' => rand(1, $ventesCount),
        ]);

        Historique::create([
            'type_action' => 'Enregistrement d’une vente',
            'id_user' => $employe->id,
            'date_action' => Carbon::now()->subDay(),
            'id_vente' => rand(1, $ventesCount),
        ]);
    }
}
