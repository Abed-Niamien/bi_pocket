<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
     protected $fillable = ['nom_pays', 'longitude_pays', 'lattitude_pays'];

    public function villes()
    {
        return $this->hasMany(Ville::class, 'id_pays');
    }
}
