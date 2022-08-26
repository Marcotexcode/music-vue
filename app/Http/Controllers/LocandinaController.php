<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;
use App\Models\Band;


class LocandinaController extends Controller
{
    public function index()
    {
        $filtriLocandina = session()->get('filtriLocadina');

        $evento = Evento::where('user_id', Auth::user()->id)
        ->join('band', 'eventi.band_id', '=', 'band.id')
        ->join('locale', 'eventi.locale_id', '=', 'locale.id');

        if($filtriLocandina['data']) {
            $evento = $evento->where('data_evento', $filtriLocandina['data']);
        }

        if($filtriLocandina['ora']) {
            $evento = $evento->where('ora', $filtriLocandina['ora']);
        }

        $evento = $evento->get();

        return response()->json($evento);
    }

    public function filtroLocandina(Request $request)
    {
        $filtri = [
            'data' => $request->dataEvento,
            'ora' => $request->oraEvento,
        ];

        session()->put('filtriLocadina', $filtri);
    }
}
