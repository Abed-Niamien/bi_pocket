<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'telephone_client',
        'sexe_client',
        'nom_client',
        'email_client',
        'id_commune',
        'id_user',
    ];

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'id_commune');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
}

