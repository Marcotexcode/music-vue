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

        // cambiare il return che porta al componente band.vue tramite json
        return response()->json($bands);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameBand' => 'required',
            'phoneBand' => 'required',
        ]);

        $band = Band::create([
            'name_band' => $request->input('nameBand'),
            'phone_band' => $request->input('phoneBand'),
            'user_id' => Auth::user()->id,
        ]);

        // Se la band ha come user_id l'utente allora modifica hasBand a 1
        $user = User::where('id', $band->user_id)->update(['hasBand' => User::HA_UNA_BAND]);
        return redirect('band');
    }
}
