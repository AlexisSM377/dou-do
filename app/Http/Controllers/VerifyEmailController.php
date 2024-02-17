<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerifyEmailController extends Controller
{
    public function getVerifyRequest(Request $request, $body)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
        if ($request->hasValidSignature()) {
            $rescuedBody = json_decode(Crypt::decryptString($body));
            if ($rescuedBody->token && $rescuedBody->request_code) {
                
            }
        } else {

        }
    }
}
