<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BandController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::middleware('can:haUnaBand')->group(function () {
    Route::get('/lista-band', [BandController::class, 'index'])->name('band.index');

    // In questa rotta gli ho passato un parametro opzionale {{nome parametro tpo any e ?}}
    // Inserendo il metodo where l'url va solamente nelle parti che ho elencato e se scrivo un url a caso mi da errore
    // Il controller di questa rotta è ad azione singola quindi non ha nessun metodo da passare
    Route::get('/{any?}', PagesController::class)->where('any', 'band|home|calendario');
});

Route::middleware('can:nonHaUnaBand')->group(function () {
    Route::view('/createBand', 'band.create');
    Route::post('/bande', [BandController::class, 'store'])->name('createBand');
});
