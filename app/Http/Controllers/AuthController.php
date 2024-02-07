<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->all())) {
            $user = Auth()->User();
            return $user->createToken('user-token')->plainTextToken;
        } else {
            return response()->json(['message' => 'Incorrect credentials']);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Closed session'], 200);
    }
}
