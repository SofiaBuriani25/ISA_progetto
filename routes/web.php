<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DipendenteHomeController;

use App\Http\Controllers\DaOrdinareController;
use App\Http\Controllers\VisiteController;
use App\Http\Controllers\ProdottoController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth:dipendenti'])->group(function () {
    // Rotte protette per i dipendenti
    Route::get('/dipendente_home', [DipendenteHomeController::class, 'index'])->name('dipendente_home');
    Route::get('/daOrdinare', [ProdottoController::class, 'mostraDaOrdinare'])->name('daOrdinare');
    Route::get('/dipendente_home', [ProdottoController::class, 'listaProdotti'])->name('dipendente_home');
    Route::post('/aggiungiProdotto', [ProdottoController::class, 'aggiungiProdotto'])->name('aggiungiProdotto');
    Route::post('/dipendente_home', [ProdottoController::class, 'aggiungiProdotto'])->name('dipendente_home');
    // ...
});

Route::get('/dashboard', [ProdottoController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/aggiungi_al_carrello', [ProdottoController::class, 'aggiungiAlCarrello'])->name('aggiungi_al_carrello');
Route::get('/mostra-prenotazioni', [ProdottoController::class, 'mostraPrenotazioni'])->name('mostra-prenotazioni');

Route::get('/visite', [VisiteController::class, 'index'])->middleware(['auth', 'verified'])->name('visite');
Route::post('/prenota_visita', [VisiteController::class, 'aggiungiPrenotazione'])->name('prenota_visita');

require __DIR__.'/auth.php';



