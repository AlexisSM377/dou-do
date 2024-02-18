<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerifyEmailController extends Controller
{
    public function getVerifyRequest(Request $request, $body)
    {
        if ($request->hasValidSignature()) {
            $rescuedBody = json_decode(Crypt::decryptString($body));
            if ($rescuedBody->token && $rescuedBody->request_code) {
                $user = User::where('external_identifier', $rescuedBody->request_code)->first();
                $token = UserToken::where('user_id', $user->id)->where('token', $rescuedBody->token)->latest()->first();
                dump($user);
                dd($token);
            }
        } else {
            //TODO: LINK YA NO ES VALIDO
        }
    }
}
