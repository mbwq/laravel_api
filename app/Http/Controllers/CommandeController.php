<?php

namespace App\Http\Controllers;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    //
    public function store(Request $request) {
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'produits' => 'required|array|min:1',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);

        //si le formulaire n'est pas valide
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Calcul du total
        $total = 0;
        $validated = $validator->validated();

        $productIds = array_column($validated['produits'], 'id');
        $produitsDb = Produit::where('id', $productIds)->get()->keyBy('id');

        foreach ($validated['produits'] as $item) {
            $produit = $produitsDb->get($item['id']);
            // Au cas où (même si 'exists' devrait le couvrir)
            if ($produit) {
                $total += $produit->prix * $item['quantite'];
            }
        }

        $commande = Commande::create([
            'inscription_id' => $userId, // Utiliser l'ID vérifié
            'montant_total' => $total,
            'statut' => 'en_attente',
        ]);

        // Préparer les données pour la table pivot
        $produitsAPivoter = [];
        foreach ($validated['produits'] as $item) {
            $produit = $produitsDb->get($item['id']);
            if ($produit) {
                $produitsAPivoter[$produit->id] = [
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $produit->prix,
                ];
            }
        }
        // Attacher tous les produits en une seule fois
        $commande->produits()->attach($produitsAPivoter);

        return response()->json([
            'message' => 'Commande crée avec succès',
            'commande' => $commande->load('produits'),
        ], 201);
    }

    public function userCommande() {
        $userId = auth()->id();
        $commande = Commande::with('produits')->where('inscription_id', $userId)->get();
        return response()->json($commande);
    }

    public function allCommande() {
        $commande = Commande::with('user', 'produits')->get();
        return response()->json($commande);
    }

    public function updateCommande(Request $request, $id) {
        $commande = Commande::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'statut' => 'required|string|in:en_attente,payée,livrée,annulée',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $commande->update($validated);

        return response()->json([
            'message' => 'Commande mise à jour',
            'commande' => $commande,
        ]);
    }

    //crée une commande manuellement
    public function createByAdmin(Request $request) {
        $validator = Validator::make($request->all(), [
            'inscription_id' => 'required|exists:inscriptions,id',
            'montant_total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $commande = Commande::create([
            'inscription_id' => $validated['inscription_id'],
            'montant_total' => $validated['montant_total'],
            'statut' => 'en_attente',
        ]);

        return response()->json([
            'message' => 'Commande créée par admin',
            'commande' => $commande,
        ]);
    }

    //supprimer une commande
    public function destroyAdmin($id) {

        $commande = Commande::findOrFail($id);
        $commande->produits()->detach();
        $commande->delete();

        return response()->json(['message' => 'Commande supprimée']);
    }
}
