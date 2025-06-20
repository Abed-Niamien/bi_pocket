<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = [ 'id_pays', 'lib_ville', 'longitude_ville', 'lattitude_ville'];

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'id_pays');
    }

    public function communes()
    {
        return $this->hasMany(Commune::class, 'id_ville');
    }
}
