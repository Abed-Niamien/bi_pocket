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

        $villes = DB::table('villes')->pluck('id', 'lib_ville');

        $communes = [
            ['lib_commune' => 'Cocody',     'id_ville' => $villes['Abidjan'],        'created_at' => $now, 'updated_at' => $now],
            ['lib_commune' => 'Yopougon',   'id_ville' => $villes['Abidjan'],        'created_at' => $now, 'updated_at' => $now],
            ['lib_commune' => 'Plateau',    'id_ville' => $villes['Abidjan'],        'created_at' => $now, 'updated_at' => $now],
            ['lib_commune' => 'Medina',     'id_ville' => $villes['Dakar'],          'created_at' => $now, 'updated_at' => $now],
            ['lib_commune' => 'Hamdallaye', 'id_ville' => $villes['Bamako'],         'created_at' => $now, 'updated_at' => $now],
            ['lib_commune' => 'Riviera',    'id_ville' => $villes['Abidjan'],        'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('communes')->insert($communes);
    }
}
