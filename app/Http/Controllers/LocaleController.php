<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Band;
use App\Models\Locale;

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

    public function salva(Request $request)
    {
        $locale = new Locale();

        $this->validaESalva($locale, $request);
    }

    private function validaESalva(Locale $locale, Request $request)
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

        // Se hai già un'istanza del modello, puoi utilizzare il metodo fill
        // per popolarla con una matrice di attributi
        $locale->fill([
			'nome'      => $request->nome,
            'indirizzo' => $request->indirizzo,
            'provincia' => $request->provincia,
            'cap'       => $request->cap,
            'regione'   => $request->regione,
            'telefono'  => $request->telefono,
            'tipo'      => $request->tipo,
            'band_id'   => $request->band_id,
		]);

		return $locale->save();
    }
}
