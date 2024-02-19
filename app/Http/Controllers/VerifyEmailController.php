<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\Api\BuildError;
use App\Http\GlobalClases\Api\RegistrationActions;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerifyEmailController extends Controller
{
    public function getVerifyRequest(Request $request, $body)
    {
        try {
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
                                return redirect()->route('email.verified', $user->id);
                            }
                        }
                    }
                }
                return redirect()->route('verification.expired');
            } else {
                return redirect()->route('verification.expired');
            }
        } catch (\Throwable $th) {
            BuildError::setError($th, 5);
            return redirect()->route('internal.error');
        }
    }

    public function verificationExpired()
    {
        return view('mails.resend-verification');
    }

    public function verified(User $user)
    {
        if ($user->verified) {
            return view('mails.verified');
        } else {
            abort(403);
        }
    }

    public function recendRequest(Request $request)
    {
        $email = $request->email;
        if (!empty($email)) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $token = RegistrationActions::setUserToken($user, 1);
                RegistrationActions::buildEmail($user, $token);
            }
        }
        return redirect()->route('email.recend');

    }

    public function resend()
    {
        return view('mails.resend');
    }
}
