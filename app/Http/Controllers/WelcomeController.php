<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class WelcomeController extends Controller
{
    //
    public function welcome_index() {
        // SELECT = FROM produit
        $produits = Produit::all();
        return view('welcome', compact('produits'));
    }

    public function welcome_produit() {
        echo "page produit";
    }
}
