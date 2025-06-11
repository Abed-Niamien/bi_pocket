<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProduitTableSeeder extends Seeder
{
    public function run()
    {
        $users = DB::table('users')->where('id_role_user', 2)->get();
        $categoriesCount = DB::table('categorie_produit')->count();

        $couleurs = ['Rouge', 'Bleu', 'Vert', 'Noir', 'Blanc'];
        $now = now();

        $libelles = [
            // Textile
            'Tissu pagne wax 6 yards',
            'Tissu bazin riche 5 mètres',
            'Tissu dentelle guipure 3 mètres',
            'Tissu kente traditionnel',
            'Tissu coton imprimé africain',
            'Voile léger pour couture',
            'Tissu lin uni 4 mètres',

            // Vêtements
            'Chemise homme manches longues',
            'T-shirt coton col rond',
            'Jean slim homme',
            'Robe femme élégante',
            'Tailleur jupe pour femme',
            'Veste costume homme',
            'Débardeur femme coton',
            'Pantalon chino homme',
            'Jupe midi plissée',

            // Chaussures
            'Basket Nike Air Max',
            'Chaussure en cuir homme',
            'Sandales plates femme',
            'Escarpins talon 8 cm',
            'Mocassins homme en daim',
            'Babouches traditionnelles',
            'Tennis en toile femme',
            'Bottes en cuir synthétique',
        ];

        $produits = [];

        foreach ($users as $user) {
            // Produits à partir des libellés définis
            foreach ($libelles as $index => $libelle) {
                $produits[] = [
                    'lib_produit' => $libelle,
                    'prix_unitaire' => rand(5000, 100000),
                    'couleur_motif' => $couleurs[array_rand($couleurs)],
                    'photo_produit' => "produit_" . ($index + 1) . ".png",
                    'id_cat_produit' => rand(1, $categoriesCount),
                    'created_at' => $now,
                    'updated_at' => $now,
                    'id_user' => $user->id,
                ];
            }

            // Produits supplémentaires jusqu'à 200 (répartis par utilisateur)
            for ($i = 0; $i < 10; $i++) {
                $produits[] = [
                    'lib_produit' => "Produit " . Str::random(5),
                    'prix_unitaire' => rand(5000, 100000),
                    'couleur_motif' => $couleurs[array_rand($couleurs)],
                    'photo_produit' => "produit_random_$i.png",
                    'id_cat_produit' => rand(1, $categoriesCount),
                    'created_at' => $now,
                    'updated_at' => $now,
                    'id_user' => $user->id,
                ];
            }
        }

        DB::table('produits')->insert($produits);
    }
}
