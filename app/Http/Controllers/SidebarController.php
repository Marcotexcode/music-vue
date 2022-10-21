<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function listaUtente()
    {
        $utente = User::where('id', Auth::user()->id)->get();

        return response()->json($utente);
    }

    public function listaPagine()
    {
        $filtroPagine = session()->get('filtroPagine');


        $elencoPagine = [
            [
                'link' => 'home',
                'font' => 'fa-solid fa-house',
                'name' => 'Home',
                'toll' => 'Home'
            ],
            [
                'link' => 'calendario',
                'font' => 'fa-solid fa-calendar',
                'name' => 'Calendario',
                'toll' => 'Calendario'
            ],
            [
                'link' => 'band',
                'font' => 'fa-solid fa-music',
                'name' => 'Band',
                'toll' => 'Band'
            ],
            [
                'link' => 'locandina',
                'font' => 'fa-solid fa-eye',
                'name' => 'Locandina',
                'toll' => 'Locandina'
            ],
            [
                'link' => 'utente',
                'font' => 'fa-solid fa-user',
                'name' => 'Utente',
                'toll' => 'Utente'
            ],
        ];

        // Dato che LIKE non si può usare per una raccolta ho trovato questo metodo
        // Prende la collezione e la filtra
        // $elencoPagine sarebbe l' elenco degli elementi
        // $item sarebbero gli elementi del primo array.
        // $filtroPagine la parola da filtrare.
        // Ho dovuto usare un foreach esaminare ogni singolo elemento del secondo array.


        $listaPagine = collect($elencoPagine)->filter(function ($item) use ($filtroPagine) {
            foreach ($item as $elementi) {
                return false !== stripos($elementi, $filtroPagine);
            }
        });

        return response()->json($listaPagine);
    }

    public function filtro(Request $request)
    {
        session()->put('filtroPagine', $request->filtroPagine);
    }
    
}
