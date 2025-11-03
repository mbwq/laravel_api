<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'inscription_id',
        'montant_total',
        'statut',
    ];

    public function user()
    {
        return $this->belongsTo(Inscription::class);
    }

    public function commandeProduit()
    {
        return $this->hasMany(CommandeProduit::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produits')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }


}
