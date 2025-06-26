<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MouvementStock extends Model
{
    use HasFactory;

    protected $table = 'mouvements_stock';

    protected $fillable = [
        'id_produit',
        'quantite',
        'type_mouvement',
        'date_mouvement',
        'id_user',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'id_produit');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
