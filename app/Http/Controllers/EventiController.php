<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Band;
use Carbon\Carbon;
//use DateTime;
use Illuminate\Support\Facades\Auth;

class EventiController extends Controller
{
    public function lista(Request $request)
    {
        $band = Band::where('user_id', Auth::user()->id)->value('id');

        $mostraEventi = Evento::where('band_id', $band)->whereBetween('data_evento', [$request->dataInizio, $request->dataFine])->get();

        $arrayEventi = [];
        foreach ($mostraEventi as $mostraEvento) {
            // https://www.php.net/manual/en/class.datetime.php
            //$date = new DateTime($request->dataFine);

            $aggiuntaArrayEventi = [];
            $aggiuntaArrayEventi['title']           = $mostraEvento->nome_evento;
            $aggiuntaArrayEventi['idEvento']        = $mostraEvento->id;
            $aggiuntaArrayEventi['oraEvento']       = $mostraEvento->ora;
            $aggiuntaArrayEventi['compenso']        = $mostraEvento->compenso;
            $aggiuntaArrayEventi['start']           = $mostraEvento->data_evento;
            $aggiuntaArrayEventi['locale']          = $mostraEvento->locale_id;
            $aggiuntaArrayEventi['backgroundColor'] = '#343a40';
            $aggiuntaArrayEventi['borderColor']     = '#343a40';

            // $mostra = Evento::where('data_evento', '<', Carbon::now()->format('Y-m-d'))->get();
            // if ($mostra->isNotEmpty()) {
            //     $aggiuntaArrayEventi['backgroundColor'] = '#343a40';
            //     $aggiuntaArrayEventi['borderColor'] = '#343a40';
            // } else {
            //    $aggiuntaArrayEventi['backgroundColor'] = 'red';
            //    $aggiuntaArrayEventi['borderColor'] = 'red';
            // }

            array_push($arrayEventi, $aggiuntaArrayEventi);
        }

        return response()->json($arrayEventi);
    }

    public function salva(Request $request)
    {
        $request->validate([
            'nomeEvento'    => 'required',
            'idBand'        => 'required',
            'dataEvento'    => 'required',
            'oraEvento'     => 'required',
            'compenso'      => 'required|numeric',
            'locale'        => 'required',
        ]);

        $evento = Evento::updateOrCreate(
            [
                'id'            => $request->input('idEvento'),
                'data_evento'   => $request->input('dataEvento'),
            ],
            [
                'nome_evento'   => $request->input('nomeEvento'),
                'data_evento'   => $request->input('dataEvento'),
                'band_id'       => $request->input('idBand'),
                'ora'           => $request->input('oraEvento'),
                'compenso'      => $request->input('compenso'),
                'locale_id'     => $request->input('locale'),
            ]
        );
    }

    public function elimina(Request $request)
    {
        Evento::whereIn('id', $request)->delete();
    }

    public function filtroEvento(Request $request)
    {
        Evento::whereBetween('data_evento', [$request->da, $request->a])->delete();
    }
}
