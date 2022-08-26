<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventiController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LocandinaController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('can:nonHaUnaBand')->group(function () {
    Route::view('/band/crea', 'band.create');
    Route::post('/band/salva', [BandController::class, 'store'])->name('band.salva');
});

// Band
Route::middleware('can:haUnaBand')->group(function () {
    Route::get('/lista-band', [BandController::class, 'index'])->name('band.index');
    Route::post('/band/aggiorna', [BandController::class, 'aggiornaBand'])->name('band.aggiorna');
});

// Locali
Route::middleware('can:haUnaBand')->group(function () {
    Route::get('/locale', [LocaleController::class, 'index'])->name('locale.index');
    Route::post('/locale/salva', [LocaleController::class, 'creaLocale'])->name('locale.crea');
});

// Eventi
Route::middleware('can:haUnaBand')->group(function () {
    Route::get('/eventi', [EventiController::class, 'mostraEventi'])->name('evento.mostra');
    Route::post('/evento/salva', [EventiController::class, 'creaEvento'])->name('evento.crea');
    Route::delete('/evento/elimina', [EventiController::class, 'eliminaEvento'])->name('evento.elimina');
});

// Locandina
Route::middleware('can:haUnaBand')->group(function () {
    Route::get('locandina/mostra', [LocandinaController::class, 'index'])->name('mostra.locandina');
    Route::post('locandina/filtro', [LocandinaController::class, 'filtroLocandina'])->name('filtro.locandina');
});

// Rotte vue
Route::middleware('can:haUnaBand')->group(function () {
    // Metterlo sempre alla fine di tutte le rotte cosi se l'url non è quello delle altre rotte allora entra in questa
    Route::get('/{any?}', [HomeController::class, 'index'])->where('any', '.*');
});

