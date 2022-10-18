<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected function logout(Request $request)
    {

        if ($request->wantsJson()) {
            Auth::logout();
            return response()->json([], 204);
        }
    }
}
