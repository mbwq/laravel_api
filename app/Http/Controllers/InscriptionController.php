<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class InscriptionController extends Controller
{
    public function inscription_index()
    {
        return response()->json(Inscription::all());
    }

    public function inscription_new(Request $request)
    {
        // Validation du formulaire
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'firstname' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:inscriptions',
            'password' => 'required|string|min:6|confirmed',
        ]);
        //si le formulaire n'est pas valide
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Création dans la base
        $inscription = Inscription::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Message de succès
        return response()->json([
            'status_code' => 200,
            'status_message' => 'inscription réussi',
            'data' => $inscription
        ]);
    }

    public function liste(Request $request) {
        //echo "page produit";
        $user = $request->user();
        return response()->json([
            'status' => 200,
            'user' => $user->only(['id', 'name', 'firstname','email'])
        ]);
    }

    public function connexion_auth(Request $request) {
        // Validation du formulaire
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:191|exists:inscriptions,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Rechercher l'utilisateur par email
        $user = Inscription::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Email ou mot de passe incorrect'
            ], 401);
        }

        $token = $user->createToken('ma_cle_secret_token')->plainTextToken;

        
        return response()->json([
            'status' => 200,
            'message' => 'Connexion réussie',
            'user' => $user->only(['id', 'name', 'email']),
            'token' => $token
        ]);

    }

    //deconnexion
    public function logout(Request $request) {
        request()->user()->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'utilisateur deconnecter',
        ]);
    }

    public function updateUsers(Request $request, $id) {
        $inscription = inscription::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:191',
            'firstname' => 'sometimes|required|string|max:191',
            'email' => 'sometimes|required|string|email|max:191|unique:inscriptions,email,' . $id,
            'password' => 'sometimes|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $inscription->update($validator->validated());

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Produit mis à jour avec succès',
            'data' => $inscription->fresh()//permet de recharge les donnée
        ]);
    }

    public function destroyUtilisateur(Request $request, $id) {
        $inscription = Inscription::findOrFail($id);

        $inscription->delete();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Utilisateur supprimé avec succès',
            'produit' => $inscription
        ]);
    }

}
