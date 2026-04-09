<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\BilletController;

Route::get('/', [VoyageController::class, 'accueil'])->name('home');

Route::get('/rechercher', [VoyageController::class, 'formRecherche'])->name('voyage.form');
Route::get('/rechercher/resultats', [VoyageController::class, 'resultatRecherche'])->name('voyage.search');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/voyageurs', [PaiementController::class, 'formVoyageurs'])->name('voyageurs.form');
Route::post('/voyageurs', [PaiementController::class, 'storeVoyageurs'])->name('voyageurs.store');
Route::get('/paiement/process', [PaiementController::class, 'processPaiement'])->name('paiement.process');

Route::get('/billets', [BilletController::class, 'show'])->name('billets.show');

use App\Http\Controllers\Api\VoyageApiController;

Route::get('/voyages/search-json', [VoyageApiController::class, 'search'])
    ->name('voyages.search.json');