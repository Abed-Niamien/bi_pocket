<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieProduit extends Model
{
    protected $table = 'categorie_produit';
    protected $fillable = ['lib_cat_produit'];

    public function produits()
    {
        return $this->hasMany(Produit::class, 'id_cat_produit');
    }
}
