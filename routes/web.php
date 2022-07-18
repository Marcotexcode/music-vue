<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventiController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('can:nonHaUnaBand')->group(function () {
    Route::view('/createBand', 'band.create');
    Route::post('/bande', [BandController::class, 'store'])->name('createBand');
});

Route::middleware('can:haUnaBand')->group(function () {
    Route::get('/lista-band', [BandController::class, 'index'])->name('band.index');
    Route::post('/aggiorna-band', [BandController::class, 'aggiornaBand'])->name('band.aggiorna');
    Route::post('/crea-evento', [EventiController::class, 'creaEvento'])->name('evento.crea');
    Route::get('/mostra-eventi', [EventiController::class, 'mostraEventi'])->name('evento.mostra');

    // Metterlo sempre alla fine di tutte le rotte cosi se l'url non è quello delle atre rotte allora entra in questa
    Route::get('/{any?}', [HomeController::class, 'index'])->where('any', '.*');
});


