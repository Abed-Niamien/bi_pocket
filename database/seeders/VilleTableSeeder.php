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
    ['lib_ville' => 'Abidjan',       'id_pays' => $pays["Côte d'Ivoire"], 'longitude_ville' => -4.0083,  'lattitude_ville' => 5.3097, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Yamoussoukro',  'id_pays' => $pays["Côte d'Ivoire"], 'longitude_ville' => -5.2736,  'lattitude_ville' => 6.8276, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Dakar',         'id_pays' => $pays['Sénégal'],       'longitude_ville' => -17.4677, 'lattitude_ville' => 14.7167, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Thiès',         'id_pays' => $pays['Sénégal'],       'longitude_ville' => -16.9333, 'lattitude_ville' => 14.7833, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Bamako',        'id_pays' => $pays['Mali'],          'longitude_ville' => -7.9922,  'lattitude_ville' => 12.6392, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Accra',         'id_pays' => $pays['Ghana'],         'longitude_ville' => -0.186964, 'lattitude_ville' => 5.614818, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Lagos',         'id_pays' => $pays['Nigeria'],       'longitude_ville' => 3.3792,   'lattitude_ville' => 6.5244, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Nairobi',       'id_pays' => $pays['Kenya'],         'longitude_ville' => 36.8219,  'lattitude_ville' => -1.2921, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Johannesburg',  'id_pays' => $pays['Afrique du Sud'],'longitude_ville' => 28.0473,  'lattitude_ville' => -26.2041, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Casablanca',    'id_pays' => $pays['Maroc'],         'longitude_ville' => -7.5898,  'lattitude_ville' => 33.5731, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Alger',         'id_pays' => $pays['Algérie'],       'longitude_ville' => 3.0588,   'lattitude_ville' => 36.7538, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Tunis',         'id_pays' => $pays['Tunisie'],       'longitude_ville' => 10.1815,  'lattitude_ville' => 36.8065, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Le Caire',      'id_pays' => $pays['Égypte'],        'longitude_ville' => 31.2357,  'lattitude_ville' => 30.0444, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Douala',        'id_pays' => $pays['Cameroon'],      'longitude_ville' => 9.7085,   'lattitude_ville' => 4.0511, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Ouagadougou',   'id_pays' => $pays['Burkina Faso'],  'longitude_ville' => -1.5167,  'lattitude_ville' => 12.3703, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Lomé',          'id_pays' => $pays['Togo'],          'longitude_ville' => 1.2255,   'lattitude_ville' => 6.1319, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Kigali',        'id_pays' => $pays['Rwanda'],        'longitude_ville' => 30.0588,  'lattitude_ville' => -1.9441, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Kampala',       'id_pays' => $pays['Uganda'],        'longitude_ville' => 32.5825,  'lattitude_ville' => 0.3476, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Maputo',        'id_pays' => $pays['Mozambique'],    'longitude_ville' => 32.5732,  'lattitude_ville' => -25.9692, 'created_at' => $now, 'updated_at' => $now],
    ['lib_ville' => 'Antananarivo',  'id_pays' => $pays['Madagascar'],    'longitude_ville' => 47.5162,  'lattitude_ville' => -18.8792, 'created_at' => $now, 'updated_at' => $now],
];

DB::table('villes')->insert($villes);

    }
}
