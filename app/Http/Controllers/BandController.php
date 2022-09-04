<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Band;

class BandController extends Controller
{
    public function index()
    {
        $bands = Band::where('user_id', Auth::id())->get();

        return response()->json($bands);
    }

    public function store(Request $request)
    {
        $request->validate($this->validazione());

        // Salvo l'immagine
        $img = Storage::put('immagine_band', $request->image_path);

        $band = Band::create([
            'name_band' => $request->input('nameBand'),
            'phone_band' => $request->input('phoneBand'),
            'image_path' => $img,
            'user_id' => Auth::id(),
        ]);

        // Se la band ha come user_id l'utente allora modifica hasBand a 1
        $band->user->update(['hasBand' => User::HA_UNA_BAND]);

        return redirect('band');
    }

    public function aggiornaBand(Request $request)
    {
        $val = $request->validate($this->validazione());

        // Salvo la nuova immagine
        $nuovaImmagine = Storage::put('immagine_band', $request->image_path);

        // Elimino quella vecchia
        Storage::delete($request->img_vecchia);

        $band = Band::where('id', $request->idBand)->update([
            'name_band' => $request->name_band,
            'phone_band' => $request->phone_band,
            'image_path' => $nuovaImmagine,
        ]);

        return response()->json($val);
    }

    public function validazione()
    {
        $val = [
            'name_band' => 'required',
            'phone_band' => 'required',
            'image_path' => 'required',
        ];

        return $val;
    }
}
