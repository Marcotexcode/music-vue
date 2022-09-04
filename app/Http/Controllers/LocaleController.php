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
        $bands = Band::where('user_id', Auth::id())->get();

        foreach ($bands as $band) {
            $locali = $band->locali;
        }

        return response()->json($locali);
    }

    public function creaLocale(Locale $locale, Request $request)
    {
        $locale->create($request->all());
    }
}
