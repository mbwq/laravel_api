<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Produit;

class CategoryController extends Controller
{
    //les categorie affiche
    public function index() {
        $categories = Category::all();
        return response()->json($categories);
    }

    /*public function show(Request $request, $id) {
        $categories = Category::with('produits')->findOrFail($id);
        
        return response()->json($categories);
    }*/

    public function storeCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191|unique:categories,nom',
            'is_online' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $categories = Category::create($validator->validated());

        return response()->json([
            'status' => 201,
            'message' => 'Categorie crée',
            'data' => $categories
        ]);
    }

    public function updateCategory(Request $request, $id){
        $categories = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nom' => 'sometimes|required|string|max:191|unique:categories,nom',
            'is_online' => 'sometimes|required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $categories->update($validator->validated());

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Catégorie mise à jour avec succès',
            'data' => $categories
        ]);
    }

    public function deleteCategory(Request $request, $id) {
        $categories = Category::findOrFail($id);

        // $category->produits()->delete();

        $categories->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Catégorie et produits liés (si configuré) supprimés avec succès',
        ]);
    }
}
