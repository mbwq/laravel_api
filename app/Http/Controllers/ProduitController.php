<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
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
        $produit = Produit::findOrFail($id);
        return response()->json($produit);
    }

    public function viewCategorie(Request $request) {
        //en va recupere tous les categories >> is_online
        //$categories = Category::where('is_online', 1)->get();
        //dd($categories);
        //SELECT * FROM produits = category_id = $request->id
        $produits = Produit::where('category_id', $request->id)->get();
        return response()->json($produits);
    }
}
