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
                if (!empty($user) && $user->verified == false) {
                    $userToken = UserToken::where('user_id', $user->id)->first();
                    if (!empty($userToken->id)) {
                        $currentToken = Crypt::decryptString($userToken->token);
                        if (strcasecmp($currentToken, $rescuedBody->token) == 0) {
                            $user->update([
                                'verified' => true
                            ]);
                        }
                    }
                }
            }
        } else {
            //TODO: LINK YA NO ES VALIDO
        }
    }

    public function verificationExpired()
    {
        return view('mails.resend-verification');
    }
}
