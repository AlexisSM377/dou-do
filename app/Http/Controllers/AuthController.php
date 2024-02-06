<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->all())) {
            # code...
        }
        return json_encode($request->all());
    }
}
