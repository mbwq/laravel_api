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
        return view('signin');
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

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Création dans la base
        Inscription::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Message de succès
        return redirect()->back()->with('message', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
    }
}
