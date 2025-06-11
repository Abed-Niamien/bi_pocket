<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable = ['nom_entreprise', 'logo_entreprise'];

    
    public function admin()
{
    return $this->belongsTo(User::class, 'id_user');
}

public function users()
{
    return $this->belongsToMany(User::class, 'user_entreprise', 'id_entreprise', 'id_user')
                ->withPivot('is_creator')
                ->withTimestamps();
}



}
