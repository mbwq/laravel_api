<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProduitController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/liste_user', [InscriptionController::class, 'inscription_index']);
Route::get('/liste_user/{id}', [InscriptionController::class, 'liste']);
Route::post('/connexion', [InscriptionController::class, 'connexion_auth']);
Route::post('/inscription', [InscriptionController::class, 'inscription_new']);
Route::get('/produits', [ProduitController::class, 'produit_index']);
Route::get('/produits/{id}', [ProduitController::class, 'produit']);
Route::get('/categorie/{id}', [ProduitController::class, 'viewCategorie']);
    // autres routes...



