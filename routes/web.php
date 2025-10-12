<?php

use App\Http\Controllers\InscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/connexion', function () {
    return view('connexion');
})->name('connexion');

// Routes pour l'inscription
Route::get('/inscription', [InscriptionController::class, 'inscription_index'])->name('inscription.index');
Route::post('/inscription', [InscriptionController::class, 'inscription_new'])->name('inscription.new');



/*Route::middleware('auth')->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});*/