<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['date_entree', 'id_user'];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function produits() {
    return $this->belongsToMany(Produit::class, 'stock_produit', 'id_stock', 'id_produit')
                ->withPivot('quantite_stock')
                ->withTimestamps();
    }

}
