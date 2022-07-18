<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;

class EventiController extends Controller
{
    public function mostraEventi(Request $request)
    {
        $mostraEventi = Evento::whereBetween('data_evento', [$request->dataInizio, $request->dataFine])->get();

        $arrayEventi = [];

        foreach ($mostraEventi as $mostraEvento) {

            $aggiuntaArrayEventi = [];
            $aggiuntaArrayEventi['title'] = $mostraEvento->nome_evento;
            // $aggiuntaArrayEventi['idPresenza'] = $presenza->id;
            // $aggiuntaArrayEventi['id'] = $presenza->collaboratori->id;
            $aggiuntaArrayEventi['start'] = $mostraEvento->data_evento;
            $aggiuntaArrayEventi['backgroundColor'] = '#343a40';
            $aggiuntaArrayEventi['borderColor'] = '#343a40';

             array_push($arrayEventi, $aggiuntaArrayEventi);
        }

        return response()->json($arrayEventi);
    }

    public function creaEvento(Request $request) {
        $request->validate([
            'nomeEvento' => 'required',
            'idBand' => 'required',
            'dataEvento' => 'required',
        ]);
        $event = Evento::create([
            'nome_evento' => $request->input('nomeEvento'),
            'data_evento' => $request->input('dataEvento'),
            'band_id' => $request->input('idBand'),
        ]);
    }
}
