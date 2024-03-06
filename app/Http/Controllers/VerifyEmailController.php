<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\Api\BuildVerificationEmail;
use App\Http\GlobalClases\BuildError;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

/**
 * Controller class to Verify email actions
 */
class VerifyEmailController extends Controller
{
    /**
     * Validates the request, verify user and redirects to a confirm view
     *
     * @param Request $request
     * @param string<encrypted> $body
     * @return void
     */
    public function attendVerification(Request $request, $body)
    {
        try {
            if ($request->hasValidSignature()) {
                $rescuedBody = json_decode(Crypt::decryptString($body));
                if ($rescuedBody->token && $rescuedBody->request_code) {
                    $user = User::where('external_identifier', $rescuedBody->request_code)->first();
                    if (!empty($user) && $user->verified == false) {
                        $userToken = UserToken::where('user_id', $user->id)->latest()->first();
                        if (!empty($userToken->id)) {
                            $currentToken = Crypt::decryptString($userToken->token);
                            if (strcasecmp($currentToken, $rescuedBody->token) == 0) {
                                $user->update([
                                    'verified' => true
                                ]);
                                return redirect()->route('verification.verify', $user->id);
                            }
                        }
                    }
                }
                return redirect()->route('verification.expired');
            } else {
                return redirect()->route('verification.expired');
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 5);
            return redirect()->route('internal.error');
        }
    }

    /**
     * Redirects to the request forwarding form
     *
     * @return void
     */
    public function attendExpiredRequest()
    {
        return view('mails.forms.resend-verification');
    }

    /**
     * Validates the user's verification status and redirects to a confirmation view or an error view
     *
     * @param User $user
     * @return void
     */
    public function verifyUser(User $user)
    {
        if ($user->verified) {
            return view('mails.informativeMessages.verified');
        } else {
            abort(403);
        }
    }

    /**
     * Gets the email, resend the verification request and returns to a confirmation view
     *
     * @param Request $request
     * @return void
     */
    public function attendRequestForwarded(Request $request)
    {
        $email = $request->email;
        if (!empty($email)) {
            $user = User::where('email', $email)->first();
            if ($user) {
                BuildVerificationEmail::build($user, 1);
            }
        }
        return view('mails.informativeMessages.resend');
    }
}
