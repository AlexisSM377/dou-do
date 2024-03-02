<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\Api\BuildForgotPasswordEmail;
use App\Http\GlobalClases\BuildError;
use App\Http\Requests\Update\OnlyEmailRequest;
use App\Http\Requests\Update\PasswordUpdateRequest;
use App\Models\User;
use App\Models\UserToken;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

/**
 * Controller class to ForgotPassword actions
 */
class ForgotPasswordController extends Controller
{
    /**
     * Attend Request function - Validates the request and redirect to reset password form, with a user variable
     *
     * @param Request $request
     * @param string<encoded> $body
     * @return void
     */
    public function attendRequest(Request $request, $body)
    {
        try {
            if ($request->hasValidSignature()) {
                $rescuedBody = json_decode(Crypt::decryptString($body));
                if ($rescuedBody->token && $rescuedBody->request_code) {
                    $user = User::where('external_identifier', $rescuedBody->request_code)->first();
                    if (!empty($user)) {
                        $userToken = UserToken::where('user_id', $user->id)->where('token_type_id', 2)->latest()->first();
                        if (!empty($userToken->id)) {
                            $currentToken = Crypt::decryptString($userToken->token);
                            if (strcasecmp($currentToken, $rescuedBody->token) == 0) {
                                return view('mails.forms.restore-password', compact('user'));
                            }
                        }
                    }
                }
                return redirect()->route('forgot-password.expired');
            } else {
                return redirect()->route('forgot-password.expired');
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 5);
            return redirect()->route('internal.error');
        }
    }

    /**
     * Attend Expired Request function - Redirects to the resend request form
     *
     * @return void
     */
    public function attendExpiredRequest()
    {
        return view('mails.forms.resend-password-reset');
    }

    /**
     * Attend Request Forwarded function - Gets the email and resend a new forgot password request
     *
     * @param OnlyEmailRequest $request
     * @return void
     */
    public function attendRequestForwarded(OnlyEmailRequest $request)
    {
        try {
            if ($request->email) {
                BuildForgotPasswordEmail::build($request->email);
                return view('mails.informativeMessages.resend-password-reset');
            } else {
                throw new Error('La petición no contiene un correo.');
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 6);
        }
    }

    /**
     * Restore Password function - Gets the password, validates it, and save the new password in the user record
     *
     * @param PasswordUpdateRequest $request
     * @param User $user
     * @return void
     */
    public function restorePassword(PasswordUpdateRequest $request, User $user)
    {
        try {
            if ($request->password == $request->password_confirmation) {
                $user->update([
                    'password' => $request->password
                ]);
                return view('mails.informativeMessages.password-reset');
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 6);
        }
    }
}
