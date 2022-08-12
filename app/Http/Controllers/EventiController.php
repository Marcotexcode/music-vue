<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Band;
use DateTime;
use Illuminate\Support\Facades\Auth;

class EventiController extends Controller
{
    public function mostraEventi(Request $request)
    {
        $band = Band::where('user_id', Auth::user()->id)->value('id');

        $mostraEventi = Evento::where('band_id', $band)->whereBetween('data_evento', [$request->dataInizio, $request->dataFine])->get();

        $arrayEventi = [];
        foreach ($mostraEventi as $mostraEvento) {
            // https://www.php.net/manual/en/class.datetime.php
            $date = new DateTime($mostraEvento->ora);

            $aggiuntaArrayEventi = [];
            $aggiuntaArrayEventi['title'] = /* $date->format('H:i') . ' ' . */ $mostraEvento->nome_evento;
            $aggiuntaArrayEventi['idEvento'] = $mostraEvento->id;
            $aggiuntaArrayEventi['oraEvento'] = $mostraEvento->ora;
            $aggiuntaArrayEventi['compenso'] = $mostraEvento->compenso;
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
            'oraEvento' => 'required',
            'compenso' => 'required',
        ]);

        $evento = Evento::updateOrCreate(
            [
                'id' => $request->input('idEvento'),
                'data_evento' => $request->input('dataEvento'),
            ],
            [
                'nome_evento' => $request->input('nomeEvento'),
                'data_evento' => $request->input('dataEvento'),
                'band_id' => $request->input('idBand'),
                'ora' => $request->input('oraEvento'),
                'compenso' => $request->input('compenso'),
            ]
        );

    }

    public function eliminaEvento(Request $request)
    {
        $prova = Evento::whereIn('id', $request)->delete();
    }
}