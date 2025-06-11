<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserEntrepriseSeeder extends Seeder
{
    public function run()
    {
        $abed = User::where('email', 'abed@example.com')->first();
    $company1 = Entreprise::where('nom_entreprise', 'BI Pocket SA')->first();

    DB::table('user_entreprise')->insert([
        'is_creator' => true,
        'created_at' => now(),
        'updated_at' => now(),
        'id_user' => $abed->id,
        'id_entreprise' => $company1->id,
]);

    }
}
