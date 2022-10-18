<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventiController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LocandinaController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('can:nonHaUnaBand')->group(function () {
    Route::get('/band/aggiungi',    [BandController::class, 'aggiungi'])->name('band.aggiungi');
    Route::post('/band/salva',      [BandController::class, 'salva'])   ->name('band.salva');
});


Route::middleware('can:haUnaBand')->group(function () {

    Route::post('/logout', [UserController::class, 'logout']);


    // Band
    Route::get('/band/lista',       [BandController::class, 'lista'])   ->name('band.lista');
    Route::post('/band/aggiorna',   [BandController::class, 'aggiorna'])->name('band.aggiorna');

    // Locali
    Route::get('/locale/lista',             [LocaleController::class, 'lista'])         ->name('locale.lista');
    Route::post('/locale/salva-modifica',   [LocaleController::class, 'salvaModifica']) ->name('locale.salva-modifica');
    Route::get('/locale/modifica',          [LocaleController::class, 'modifica'])      ->name('locale.modifica');
    Route::delete('/locale/elimina',        [LocaleController::class, 'elimina'])       ->name('locale.elimina');


    // Eventi
    Route::get('/evento/lista',         [EventiController::class, 'lista'])   ->name('evento.lista');
    Route::post('/evento/salva',        [EventiController::class, 'salva'])   ->name('evento.salva');
    Route::delete('/evento/elimina',    [EventiController::class, 'elimina']) ->name('evento.elimina');
    Route::post('/evento/filtro',    [EventiController::class, 'filtroEvento']) ->name('evento.filtro');

    // Locandina
    Route::get('/locandina/lista',      [LocandinaController::class, 'lista'])  ->name('locandina.lista');
    Route::post('/locandina/filtro',    [LocandinaController::class, 'filtro']) ->name('locandina.filtro');

    // Rotte vue
    // Metterlo sempre alla fine di tutte le rotte cosi se l'url non è quello delle altre rotte allora entra in questa
    Route::get('/{any?}', [HomeController::class, 'index'])->where('any', '.*');
});


