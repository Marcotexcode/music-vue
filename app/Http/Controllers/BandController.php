<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Band;

class BandController extends Controller
{
    public function lista()
    {
        $bands = Band::where('user_id', Auth::user()->id)->get();

        return response()->json($bands);
    }

    public function aggiungi()
    {
        return view('Band.create');
    }

    public function salva(Request $request)
    {
        $request->validate([
            'nameBand' => 'required',
            'phoneBand' => 'required',
            'image' => 'required',
        ]);

        // Salvo l'immagine
        $img = Storage::put('immagine_band', $request->image);

        $band = Band::create([
            'name_band' => $request->input('nameBand'),
            'phone_band' => $request->input('phoneBand'),
            'image_path' => $img,
            'user_id' => Auth::user()->id,
        ]);

        // Se la band ha come user_id l'utente allora modifica hasBand a 1
        $user = User::where('id', $band->user_id)->update(['hasBand' => User::HA_UNA_BAND]);
        return redirect('band');
    }

    public function aggiorna(Request $request)
    {
        $val = $request->validate([
            'name_band' => 'required',
            'phone_band' => 'required',
            'image_path' => 'required',
        ]);

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
}
