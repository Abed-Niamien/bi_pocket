<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    protected $fillable = ['date_action', 'type_action', 'id_personnel', 'id_vente'];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }

    public function vente()
    {
        return $this->belongsTo(Vente::class, 'id_vente');
    }
}
