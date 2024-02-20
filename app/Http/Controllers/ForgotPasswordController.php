<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\Requests\Update\PasswordUpdateRequest;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ForgotPasswordController extends Controller
{
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
                return redirect()->route('verification.expired');
            } else {
                return redirect()->route('verification.expired');
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 5);
            return redirect()->route('internal.error');
        }
    }

    public function attendExpiredRequest()
    {
        return view('mails.forms.resend-password-reset');
    }

    public function attendRequestForwarded()
    {
        // TODO: Logica para reenvio de solicitud
    }

    public function showForwardMessage()
    {
        // TODO: Motsrar vista de que se ha reenviado la solicitud de restablecimiento de contraseña
    }

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
