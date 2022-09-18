<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Band;
use App\Models\Locale;
use App\Models\Evento;


class LocaleController extends Controller
{
    public function lista()
    {
        $bands = Band::where('user_id', Auth::user()->id)->get();

        foreach ($bands as $band) {
            $locali = Locale::where('band_id', $band->id)->get();
        }

        return response()->json($locali);
    }

    public function salvaModifica(Request $request)
    {
        $locale = new Locale();

        $this->validaSalvaModifica($locale, $request);
    }

    public function modifica(Request $request)
    {
        $locale = Locale::find($request->idLocale);

        return response()->json($locale);
    }

    public function elimina(Request $request)
    {
        // Aggiungere validazione
        $eventi = Evento::where('locale_id', $request->idLocale)->get();

        $elencoEventi = [];

        foreach ($eventi as $evento) {
            array_push($elencoEventi, $evento->nome_evento);
        }

        if ($eventi->isEmpty()) {
            $locale = Locale::where('id', $request->idLocale)->delete();

            return response()->json([
                'status' => 'Successo!',
                'msg' => 'Il locale è stato eliminato',
                'cod' => 201
            ]);
        } else {

            return response()->json([
                'status' => 'Errore!',
                'msg' => 'Il locale non può essere eliminato perchè fa parte dell\' evento: ' . implode(", ", $elencoEventi) . '.',
                'cod' => 400
            ], 400);
        }
    }

    private function validaSalvaModifica(Locale $locale, Request $request)
	{
        $rules = [
            'nome'      => 'required',
            'indirizzo' => 'required',
            'provincia' => 'required',
            'cap'       => 'required',
            'regione'   => 'required',
            'telefono'  => 'required',
            'tipo'      => 'required',
            'band_id'   => 'required',
		];

        $request->validate($rules);

        $locale->updateOrCreate(
            [
                'id' => $request->idLocale,
            ],
            [
                'nome'      => $request->nome,
                'indirizzo' => $request->indirizzo,
                'provincia' => $request->provincia,
                'cap'       => $request->cap,
                'regione'   => $request->regione,
                'telefono'  => $request->telefono,
                'tipo'      => $request->tipo,
                'band_id'   => $request->band_id,
            ]
        );

		return $locale;
    }
}
