<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DipendenteHomeController;

use App\Http\Controllers\DaOrdinareController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\ProdottoController;
use App\Http\Controllers\OrdiniDipController;


use App\Http\Controllers\PrenotazioneController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/








Route::middleware(['auth:web'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [ProdottoController::class, 'index'])->name('dashboard');
});


/*
Route::middleware(['auth:web'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
});
*/


Route::middleware(['auth:dipendenti'])->group(function () {
    // Rotte protette per i dipendenti
    Route::get('/profile_dip', [DipendenteHomeController::class, 'edit'])->name('profile_dip.edit');
    

    Route::get('/dipendente_home', [DipendenteHomeController::class, 'index'])->name('dipendente_home');
    Route::get('/daOrdinare', [ProdottoController::class, 'mostraDaOrdinare'])->name('daOrdinare');
    Route::get('/dipendente_home', [ProdottoController::class, 'listaProdotti'])->name('dipendente_home');
    Route::post('/aggiungiProdotto', [ProdottoController::class, 'aggiungiProdotto'])->name('aggiungiProdotto');
    Route::post('/dipendente_home', [ProdottoController::class, 'aggiungiProdotto'])->name('dipendente_home');
    Route::post('/ordina_prodotto', [ProdottoController::class, 'ordinaProdotto'])->name('ordina_prodotto');
    Route::post('/gestionePrenotazioni', [ProdottoController::class, 'aggiungiProdotto'])->name('gestionePrenotazioni');
    Route::get('/storico_dipendenti', [OrdiniDipController::class, 'mostraTabella'])->name('storico_dipendenti');
    Route::post('/aggiungi_al_carrello_dip', [ProdottoController::class, 'aggiungiAlCarrello'])->name('aggiungi_al_carrello_dip');
    Route::get('/gestionePrenotazioni',  [PrenotazioneController::class, 'index'])->name('gestionePrenotazioni');
    // Rotta per confermare il pagamento
    Route::post('/conferma-pagamento/{id}', [PrenotazioneController::class, 'confermaPagamento'])->name('conferma_pagamento');

    // Rotta per eliminare la prenotazione
    Route::post('/elimina-prenotazione/{id}', [PrenotazioneController::class, 'eliminaPrenotazione'])->name('elimina_prenotazione');



    // ...
});

Route::get('/', function () {return view('welcome');})->name('home'); //  QUESTA E' LA ROUTE CHE PORTA AL SITO IN MANUTENZIONE

Route::post('/aggiungi_al_carrello', [ProdottoController::class, 'aggiungiAlCarrello'])->name('aggiungi_al_carrello');
Route::get('/mostra-prenotazioni', [ProdottoController::class, 'mostraPrenotazioni'])->name('mostra-prenotazioni');

Route::get('/visite', [VisiteController::class, 'index'])->middleware(['auth', 'verified'])->name('visite');
Route::post('/prenota_visita', [VisiteController::class, 'aggiungiPrenotazione'])->name('prenota_visita');
Route::delete('/visite/cancel/{id}', [VisiteController::class, 'cancellaPrenotazione'])->name('visite.cancel');




require __DIR__.'/auth.php';


