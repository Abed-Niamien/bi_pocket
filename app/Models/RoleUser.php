<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = ['lib_role_user'];

    public function personnels()
    {
        return $this->hasMany(Personnel::class, 'id_role_user');
    }
}
