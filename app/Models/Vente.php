<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = ['date_vente', 'canal_vente', 'id_user', 'id_client'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function historiques()
    {
        return $this->hasMany(Historique::class, 'id_vente');
    }

    public function produits() {
    return $this->belongsToMany(Produit::class, 'produit_vente', 'id_vente', 'id_produit')
                ->withPivot('quantite_vente', 'montant_total')
                ->withTimestamps();
    }
}
