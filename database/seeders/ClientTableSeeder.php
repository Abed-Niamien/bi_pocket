<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $communes = DB::table('communes')->pluck('id')->toArray();
        $users = DB::table('users')->pluck('id')->toArray();

        $clients = [];

        for ($i = 0; $i < 100; $i++) {
            $sexe = $faker->randomElement(['M', 'F']); // H = Homme, F = Femme
            $nom = $faker->lastName;
            $prenom = $faker->firstName($sexe == 'H' ? 'male' : 'female');
            $email = strtolower($prenom . '.' . $nom . '@example.com');

            $clients[] = [
                'telephone_client' => '07' . rand(00000000, 99999999),
                'sexe_client'      => $sexe,
                'nom_client'       => $prenom . ' ' . $nom,
                'email_client'     => $email,
                'id_commune'       => $faker->randomElement($communes),
                'id_user'       => $faker->randomElement($users),
                'created_at'       => now(),
                'updated_at'       => now(),
            ];
        }

        DB::table('clients')->insert($clients);
    }
}
