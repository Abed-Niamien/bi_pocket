<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use DB;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('role_user')->insert([
    [
        'lib_role_user' => 'Createur',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'lib_role_user' => 'Membre',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);
}
}
