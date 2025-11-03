<?php

use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'welcome_index'])->name('welcome.index');