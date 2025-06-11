<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class CategorieProduitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['lib_cat_produit' => 'Tissus Wax'],
            ['lib_cat_produit' => 'Tissus Bazin'],
            ['lib_cat_produit' => 'Tissus Chigan'],
            ['lib_cat_produit' => 'Chemises Hommes'],
            ['lib_cat_produit' => 'Robes Femmes'],
            ['lib_cat_produit' => 'Costumes'],
            ['lib_cat_produit' => 'Pantalons'],
            ['lib_cat_produit' => 'Jupes'],
            ['lib_cat_produit' => 'Chaussures Hommes'],
            ['lib_cat_produit' => 'Chaussures Femmes'],
            ['lib_cat_produit' => 'Sandales'],
            ['lib_cat_produit' => 'Baskets'],
            ['lib_cat_produit' => 'Accessoires (ceintures, chapeaux)'],
        ];

        $now = now();
        foreach ($categories as &$cat) {
            $cat['created_at'] = $now;
            $cat['updated_at'] = $now;
        }

        DB::table('categorie_produit')->insert($categories);
    }
}
