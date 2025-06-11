<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockProduit extends Model
{
    protected $table = 'stock_produit';

    protected $fillable = [
        'id_stock',
        'id_produit',
        'quantite_stock'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function vente()
    {
        return $this->belongsTo(Stock::class);
    }

}
