<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEntreprise extends Model
{
    use HasFactory;

    protected $table = 'user_entreprise'; // nom de ta table pivot

    protected $primaryKey = null; // pas de clé primaire auto-incrémentée

    public $incrementing = false; // car table pivot, sans id auto

    public $timestamps = true; // created_at & updated_at activés

    protected $fillable = [
        'id_user',
        'id_entreprise',
        'is_creator',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'id_entreprise');
    }
}
