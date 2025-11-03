<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Inscription extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'firstname',
        'email',
        'password',
        'role',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

}
