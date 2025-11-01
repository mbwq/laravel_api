<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    //trouver le produit
    public function produit(Resquest $request, $id) {
        $produit = Produit::findOrFail($id);
        return response()->json($produit);
    }

    public function viewCategorie(Request $request) {
        //SELECT * FROM produits = category_id = $request->id
        $produits = Produit::where('category_id', $request->id)->get();
        return response()->json($produits);
    }

    //crée un produit pas touche
    public function storeProduit(Request $request) {
        // Validation du formulaire
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'photo_principale' => 'required|string|regex:/\.(jpg|jpeg|png|gif)$/i',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Création du produit dans la base
        $produits = Produit::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'description' => $request->description,
            'photo_principale' => $request->photo_principale,
            'category_id' => $request->category_id,
        ]);

        // Message de succès
        return response()->json([
            'status_code' => 201,
            'status_message' => 'Produit créé avec succès',
            'data' => $produits
        ]);
    }

    //updapte des produit pas touche
    public function updateProduit(Request $request, $id) {
        $produit = Produit::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|required|string|max:191',
            'prix' => 'sometimes|required|numeric|min:0',
            'description' => 'sometimes|required|string',
            'photo_principale' => 'sometimes|required|string',
            'category_id' => 'sometimes|required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $produit->update($validator->validated());

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Produit mis à jour avec succès',
            'data' => $produit->fresh()//permet de recharge les donnée
        ]);
    }


    //supprimer les produit pas touche
    public function destroyProduit(Request $request, $id) {
        $produit = Produit::findOrFail($id);

        $produit->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Produit supprimé avec succès',
            'produit' => $produit
        ]);
    }

    

}
