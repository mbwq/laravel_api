<?php

use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\connexionController;

Route::get('/', [WelcomeController::class, 'welcome_index'])->name('welcome.index');

Route::get('/produit',[WelcomeController::class, 'welcome_produit']);

// Routes pour l'inscription
Route::get('/inscription', [InscriptionController::class, 'inscription_index'])->name('inscription.index');
Route::post('/inscription', [InscriptionController::class, 'inscription_new'])->name('inscription.new');

//Routes pour la connexion
Route::get('/connexion', [connexionController::class, 'connexion_index'])->name('connexion.index');
Route::post('/connexion', [connexionController::class, 'connexion_auth'])->name('connexion.auth');

// Routes protégées par authentification
Route::get('/welcome', [connexionController::class, 'welcome'])->name('welcome')->middleware('');//proteger ma route
// Route deconnexion
Route::post('logout', [connexionController::class, 'logout'])->name('logout')->middleware('auth');


/*Route::middleware('auth')->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});*/