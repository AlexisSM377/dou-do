<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class VerifyEmailController extends Controller
{
    public function getVerifyRequest(Request $request, $token)
    {
        if ($request->hasValidSignature()) {
            $url = config('app.base_url') . "/api/verify-email";
            $token = Crypt::decryptString($token);
            $response = Http::withToken($token)->post($url);
            if ($response->ok()) {
                
            }
        } else {
            dd("Esta petición ha vencido");
        }
    }
}
