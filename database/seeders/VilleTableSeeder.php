<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use DB;

class VilleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // On récupère les pays avec leurs IDs

$pays = DB::table('pays')->pluck('id', 'nom_pays');

$now = Carbon::now();

$villes = [
    ['lib_ville' => 'Abidjan', 'id_pays' => $pays["Côte d'Ivoire"], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Yamoussoukro', 'id_pays' => $pays["Côte d'Ivoire"], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Dakar', 'id_pays' => $pays['Sénégal'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Thiès', 'id_pays' => $pays['Sénégal'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Bamako', 'id_pays' => $pays['Mali'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Accra', 'id_pays' => $pays['Ghana'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Lagos', 'id_pays' => $pays['Nigeria'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Nairobi', 'id_pays' => $pays['Kenya'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Johannesburg', 'id_pays' => $pays['Afrique du Sud'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Casablanca', 'id_pays' => $pays['Maroc'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Alger', 'id_pays' => $pays['Algérie'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Tunis', 'id_pays' => $pays['Tunisie'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Le Caire', 'id_pays' => $pays['Égypte'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Douala', 'id_pays' => $pays['Cameroon'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Ouagadougou', 'id_pays' => $pays['Burkina Faso'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Lomé', 'id_pays' => $pays['Togo'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Kigali', 'id_pays' => $pays['Rwanda'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Kampala', 'id_pays' => $pays['Uganda'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Maputo', 'id_pays' => $pays['Mozambique'], 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Antananarivo', 'id_pays' => $pays['Madagascar'], 'created_at' => $now, 'updated_at' => $now],
];

DB::table('villes')->insert($villes);

    }
}
