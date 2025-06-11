<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_role_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roleUser()
{
    return $this->belongsTo(RoleUser::class, 'role_user_id');
}

public function entreprises()
{
    return $this->belongsToMany(Entreprise::class, 'user_entreprise', 'id_user', 'id_entreprise')
                ->withPivot('is_creator')
                ->withTimestamps();
}


public function produits()
    {
        return $this->hasMany(Produit::class, 'id_user');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'id_user');
    }

public function ventes()
    {
        return $this->hasMany(Vente::class, 'id_user');
    }

    public function historiques()
    {
        return $this->hasMany(Historique::class, 'id_user');
    }

    public function clients()
    {
        return $this->hasMany(client::class, 'id_user');
    }
}
