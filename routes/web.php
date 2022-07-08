<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
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


// In questa rotta gli ho passato un parametro opzionale {{nome parametro tpo any e ?}}
// Inserendo il metodo where l'url va solamente nelle parti che ho elencato e se scrivo un url a caso mi da errore
// Il controller di questa rotta è ad azione singola quindi non ha nessun metodo da passare
Route::get('/{any?}', PagesController::class)->where('any', 'band|home|calendario');
