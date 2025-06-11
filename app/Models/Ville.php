<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $fillable = ['lib_ville', 'id_pays'];

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'id_pays');
    }

    public function communes()
    {
        return $this->hasMany(Commune::class, 'id_ville');
    }
}
