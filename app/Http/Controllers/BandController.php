<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Band;

class BandController extends Controller
{
    public function index()
    {
        $bands = Band::where('user_id', Auth::user()->id)->get();

        return response()->json($bands);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameBand' => 'required',
            'phoneBand' => 'required',
        ]);

        $imageName = time() . '-' . $request->nameBand . '.' .

        $request->image->extension();

        $request->image->move(public_path('image'), $imageName);

        $band = Band::create([
            'name_band' => $request->input('nameBand'),
            'phone_band' => $request->input('phoneBand'),
            'image_path' => $imageName,
            'user_id' => Auth::user()->id,
        ]);

        // Se la band ha come user_id l'utente allora modifica hasBand a 1
        $user = User::where('id', $band->user_id)->update(['hasBand' => User::HA_UNA_BAND]);
        return redirect('band');
    }

    public function aggiornaBand(Request $request) 
    {
        $request->validate([
            'name_band' => 'required',
            'phone_band' => 'required',
        ]);

        $imageName = time() . '-' . $request->name_band . '.';
        
        // extension() : La funzione extension() determina l'estensione del file in base al tipo MIME del file...
        $request->image_path->extension();

        // move : il metodo move può essere utilizzato per rinominare o spostare un file esistente in una nuova posizione
        // public_path() : La funzione public_path restituisce il percorso completo della publicdirectory dell'applicazione esempio: "C:\laragon\www\music-vue\public\image"
        $request->image_path->move(public_path('image'), $imageName);


        $band = Band::where('id', $request->idBand)->update([
            'name_band' => $request->name_band,
            'phone_band' => $request->phone_band,
            'image_path' => $imageName,
        ]);
    }
}
