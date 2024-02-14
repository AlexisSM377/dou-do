<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerifyEmailController extends Controller
{
    public function getVerifyRequest(Request $request, $token)
    {
        if ($request->hasValidSignature()) {
            dd(Crypt::decryptString($token));
        } else {
            dd("Esta petición ha vencido");
        }
    }
}
