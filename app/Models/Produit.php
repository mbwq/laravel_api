<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
//use Illuminate\Support\Facades\Storage;

class Produit extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'nom',
        'prix',
        'description',
        'photo_principale',
        'category_id',
    ];

    //
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function articles()
    {
        return $this->hasMany(CommandeProduit::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produits')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

}
