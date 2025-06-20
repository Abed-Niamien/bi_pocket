<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = ['id_ville', 'lib_commune', 'longitude_commune', 'lattitude_commune'];

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'id_ville');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'id_commune');
    }
}
