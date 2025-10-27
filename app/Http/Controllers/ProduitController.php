<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Exception;

class ProduitController extends Controller
{
    //
    public function produit_index() {
        // SELECT = FROM produit
        $produits = Produit::all();
        return response()->json($produits);
        /*try{
            $produits = Produit::all();
            return response()->json($produits);
        }catch(Exception $e){
            return response()->json($e);
        }*/
    }

    public function produit($id) {
        //echo "page produit";
        $produit = Produit::findOrFail($id);
        return response()->json($produit);
    }
}
