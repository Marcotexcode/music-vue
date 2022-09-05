<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Band;
use App\Models\Locale;

class LocaleController extends Controller
{
    public function index()
    {
        $bands = Band::where('user_id', Auth::user()->id)->get();

        foreach ($bands as $band) {
            $locali = Locale::where('band_id', $band->id)->get();
        }

        return response()->json($locali);
    }

    public function creaLocale(Request $request)
    {
        $band = Locale::create($request->all());
    }
}
