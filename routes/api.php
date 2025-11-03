<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controller\CommandeController;

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
Route::get('/logout', [InscriptionController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/setting/update/{id}', [InscriptionController::class, 'updateUsers'])->middleware('auth:sanctum');
Route::post('/setting/delete/{id}', [InscriptionController::class, 'destroyUtilisateur'])->middleware('auth:sanctum');
Route::post('/commandes', [CommandeController::class, 'store'])->middleware('auth:sanctum');
Route::post('/setting/mes-commande', [CommandeController::class, 'userCommande'])->middleware('auth:sanctum');

//les routes admin proteger
Route::get('/admin/logout', [AdminController::class, 'logout'])->middleware('auth::sanctum');//deconnexion
Route::post('/admin/creerAdmin', [AdminController::class, 'storeAdmin'])->middleware('auth:sanctum');
Route::post('/admin/destroyAdmin/{id}', [AdminController::class, 'deleteAdmin'])->middleware('auth:sanctum');
//route crud produit
Route::post('/admin/createProduit', [ProduitController::class, 'storeProduit'])->middleware('auth:sanctum');
Route::post('/admin/updateProduit/{id}', [ProduitController::class, 'updateProduit'])->middleware('auth:sanctum');
Route::post('/admin/destroyProduit/{id}', [ProduitController::class, 'destroyProduit'])->middleware('auth:sanctum');
//route crud categorie
Route::post('/admin/createCategorie', [CategoryController::class, 'storeCategory'])->middleware('auth:sanctum');
Route::post('/admin/updateCategorie/{id}', [CategoryController::class, 'updateCategory'])->middleware('auth:sanctum');
Route::post('/admin/deleteCategorie/{id}', [CategoryController::class, 'deleteCategory'])->middleware('auth:sanctum');
//route crud commande
Route::get('/admin/allCommande', [CommandeController::class, 'allCommade'])->middleware('auth:sanctum');//<- pas encore fait
Route::post('/admin/updateCommande/{id}', [CommandeController::class, 'updateCommande'])->middleware('auth:sanctum');//<- pas encore
Route::post('/admin/createCommande', [CommandeController::class, 'createByAdmin'])->middleware('auth:sanctum');//<- pas encore
Route::post('/admin/deleteCommande/{id}', [CommandeController::class, 'destroyAdmin'])->middleware('auth:sanctum');//<- pas encore
