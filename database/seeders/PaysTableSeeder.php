<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class PaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        $pays = [
            ['nom_pays' => 'Côte d\'Ivoire', 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Sénégal',        'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Mali',           'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Ghana',          'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Nigeria',        'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Kenya',          'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Afrique du Sud', 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Maroc',          'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Algérie',        'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Tunisie',        'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Égypte',         'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Cameroon',       'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Burkina Faso',   'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Togo',           'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Rwanda',         'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Uganda',         'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Mozambique',     'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Madagascar',     'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('pays')->insert($pays);
    }
}
