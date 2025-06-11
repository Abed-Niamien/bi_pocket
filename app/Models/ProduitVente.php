<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitVente extends Model
{
    protected $table = 'produit_vente';

    protected $fillable = [
        'id_vente',
        'id_produit',
        'quantite_vente',
        'montant_total'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }

}
