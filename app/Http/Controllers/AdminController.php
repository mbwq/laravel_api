<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function inscription_index(Request $request) {
        //return response()->json(Inscription::all());
        //$inscriptions = Inscription::where('role', $request->string)->get();
        //return response()->json($inscriptions);
        return view('/admin/connexion');
    }

    public function connexion_admin(Request $request) {
        // Validation du formulaire
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:191',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        //recherche de l'admin par le mail
        $user = Inscription::where('email', $request->email)->where('role', 'admin')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Email ou mot de passe incorrect'
            ], 401);
        }

        $token = $user->createToken('ma_cle_secret_admin', ['admin'])->plainTextToken;

        return response()->json([
            'status' => 200,
            'message' => 'Connexion admin reussi !',
            'admin' => $user->only(['id', 'name', 'email']),
            'token' => $token
        ]);
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'admin deconnecter'
        ]);
    }
}
