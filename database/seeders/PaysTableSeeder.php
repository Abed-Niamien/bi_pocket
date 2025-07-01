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
            ['nom_pays' => 'Côte d\'Ivoire', 'longitude_pays' => -5.5471, 'lattitude_pays' => 7.5400, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Sénégal',        'longitude_pays' => -14.4524, 'lattitude_pays' => 14.4974, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Mali',           'longitude_pays' => -3.9962, 'lattitude_pays' => 17.5707, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Ghana',          'longitude_pays' => -1.0232, 'lattitude_pays' => 7.9465, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Nigeria',        'longitude_pays' => 8.6753, 'lattitude_pays' => 9.0820, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Kenya',          'longitude_pays' => 37.9062, 'lattitude_pays' => -0.0236, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Afrique du Sud', 'longitude_pays' => 22.9375, 'lattitude_pays' => -30.5595, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Maroc',          'longitude_pays' => -7.0926, 'lattitude_pays' => 31.7917, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Algérie',        'longitude_pays' => 1.6596, 'lattitude_pays' => 28.0339, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Tunisie',        'longitude_pays' => 9.5375, 'lattitude_pays' => 33.8869, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Égypte',         'longitude_pays' => 30.8025, 'lattitude_pays' => 26.8206, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Cameroon',       'longitude_pays' => 12.3547, 'lattitude_pays' => 7.3697, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Burkina Faso',   'longitude_pays' => -1.5616, 'lattitude_pays' => 12.2383, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Togo',           'longitude_pays' => 1.5197, 'lattitude_pays' => 8.6195, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Rwanda',         'longitude_pays' => 29.8739, 'lattitude_pays' => -1.9403, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Uganda',         'longitude_pays' => 32.2903, 'lattitude_pays' => 1.3733, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Mozambique',     'longitude_pays' => 35.5296, 'lattitude_pays' => -18.6657, 'created_at' => $now, 'updated_at' => $now],
            ['nom_pays' => 'Madagascar',     'longitude_pays' => 46.8691, 'lattitude_pays' => -18.7669, 'created_at' => $now, 'updated_at' => $now],
        ];


        DB::table('pays')->insert($pays);
    }
}
