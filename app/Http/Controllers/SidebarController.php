<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SidebarController extends Controller
{
    // Aggiungere i dati della sidebar dall immagine del profilo
    // all elenco dei link delle pagine per inserirci il filtro.

    public function lista()
    {
        $utente = User::where('id', Auth::user()->id)->get();

        return response()->json($utente);
    }




}
