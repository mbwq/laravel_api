<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class connexionController extends Controller
{
    //afficher la page de connexion
    public function connexion_index() {
        return view('connexion');
    }

    //authentifier l'utilisateur
    public function connexion_auth(Request $request) {
        
        // Validation du formulaire
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:191|unique:inscriptions',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->error()]);
        }

        // Rechercher l'utilisateur par email
        $user = Inscription::where('email', $request->email)->first();

        if ($user || Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email ou mot de passe est incorrecte']);
        }

        // Génerer un token
        $token = $user->createToken('authToken')->plaintTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    //afficher la page de bienvenue après connexion
    /*public function welcome() {
        if (!Session::has('user')) {
            return redirect()->route('connexion.index')->withErrors(['access' => 'Vous devez être connecté pour accéder à cette page.']);
        }

        return view('welcome', ['user' => Session::get('user')]);
    }


    //déconnexion de l'utilisateur
    public function logout(Request $request) {
        Session::forget('user');
        return redirect()->route('connexion.index')->with('message', 'Vous avez été déconnecté avec succès.');
    }*/
}

