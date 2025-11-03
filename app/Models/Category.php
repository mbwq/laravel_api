<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'nom',
        'is_online'
    ];

    public function produit() {

        return $this->hasMany(Produit::class);
    }
}
