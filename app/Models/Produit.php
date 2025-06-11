<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = 'produits';
    protected $fillable = ['lib_produit', 'prix_unitaire', 'couleur_motif', 'photo_produit', 'id_cat_produit', 'id_user'];

    public function categorie()
    {
        return $this->belongsTo(CategorieProduit::class, 'id_cat_produit');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');

        // App\Models\Produit.php

    }
    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'stock_produit', 'id_produit', 'id_stock')
                    ->withPivot('quantite_stock')
                    ->withTimestamps();
    }

}
