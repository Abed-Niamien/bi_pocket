<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleUser;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roleCreateur = RoleUser::where('lib_role_user', 'Créateur')->first();
        $roleMembre = RoleUser::where('lib_role_user', 'Membre')->first();

        User::firstOrcreate([
            'name' => 'Abed',
            'email' => 'abed@example.com',
            'password' => Hash::make('password'),
            'id_role_user' => $roleCreateur->id,
        ]);

        User::firstOrcreate([
            'name' => 'Keren',
            'email' => 'keren@example.com',
            'password' => Hash::make('password'),
            'id_role_user' => $roleMembre->id,
        ]);
    }
}
