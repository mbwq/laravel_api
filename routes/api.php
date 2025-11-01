<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProduitController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/liste_user', [InscriptionController::class, 'inscription_index']);
Route::get('/listeUser/info', [InscriptionController::class, 'liste'])->middleware('auth:sanctum');

//les routes inscription, connexion et admin connexion
Route::post('/inscription', [InscriptionController::class, 'inscription_new']);
Route::post('/connexion', [InscriptionController::class, 'connexion_auth']);
Route::post('/admin/connexion', [AdminController::class, 'connexion_admin']);

//route produits, categories
Route::get('/produits', [ProduitController::class, 'produit_index']);
Route::get('/produits/{id}', [ProduitController::class, 'produit']);
Route::get('/categorie/{id}', [ProduitController::class, 'viewCategorie']);
    // autres routes...

//les routes proteger utilisateur
Route::get('/profile', [InscriptionController::class, 'profile'])->middleware('auth:sanctum');
Route::get('/logout', [InscriptionController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/setting/update', [InscriptionController::class, 'updateUser'])->middleware('auth:sanctum');
Route::get('/order/allOrder', [OrderController::class, 'index_order'])->middleware('auth:sanctum');//<- pas encore fait

//les routes admin proteger
Route::get('/admin/logout', [AdminController::class, 'logout'])->middleware('auth::sanctum');
Route::post('/admin/createProduit', [ProduitController::class, 'storeProduit'])->middleware('auth:sanctum');
Route::post('/admin/updateProduit/{id}', [ProduitController::class, 'updateProduit'])->middleware('auth:sanctum');
Route::post('/admin/destroyProduit/{id}', [ProduitController::class, 'destroyProduit'])->middleware('auth:sanctum');
Route::get('/order/createOrder', [OrderController::class, 'storeOrder'])->middleware('auth:sanctum');//<- pas encore
Route::get('/order/updateOrder', [OrderController::class, 'updateOrder'])->middleware('auth:sanctum');//<- pas encore
Route::get('/order/destroyOrder', [OrderController::class, 'destroyOrder'])->middleware('auth:sanctum');//<- pas encore
