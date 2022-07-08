<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // In questo controller ho definito il medoto invocke
    // In questo modo l'intera classe del controller esegue una singola azione
    public function __invoke()
    {
        return view('home');
    }
}
