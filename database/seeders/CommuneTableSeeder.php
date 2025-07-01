<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class CommuneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

$villes = DB::table('villes')->pluck('id', 'lib_ville'); // ['Abidjan' => 1, ...]

$communes = [
    ['lib_commune' => 'Cocody',     'id_ville' => $villes['Abidjan'], 'longitude_commune' => -3.9788, 'lattitude_commune' => 5.3614, 'created_at' => $now, 'updated_at' => $now],
    ['lib_commune' => 'Yopougon',   'id_ville' => $villes['Abidjan'], 'longitude_commune' => -4.0836, 'lattitude_commune' => 5.3490, 'created_at' => $now, 'updated_at' => $now],
    ['lib_commune' => 'Plateau',    'id_ville' => $villes['Abidjan'], 'longitude_commune' => -4.0282, 'lattitude_commune' => 5.3204, 'created_at' => $now, 'updated_at' => $now],
    ['lib_commune' => 'Medina',     'id_ville' => $villes['Dakar'],   'longitude_commune' => -17.4410, 'lattitude_commune' => 14.6810, 'created_at' => $now, 'updated_at' => $now],
    ['lib_commune' => 'Hamdallaye', 'id_ville' => $villes['Bamako'],  'longitude_commune' => -7.9901, 'lattitude_commune' => 12.6393, 'created_at' => $now, 'updated_at' => $now],
    ['lib_commune' => 'Riviera',    'id_ville' => $villes['Abidjan'], 'longitude_commune' => -3.9812, 'lattitude_commune' => 5.3702, 'created_at' => $now, 'updated_at' => $now],
];

        DB::table('communes')->insert($communes);
    }
}
