<?php

namespace App\Http\GlobalClases\Api;

use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\UserToken;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Class to VerificationActions actions
 */
class VerificationActions
{
    /**
     * Gets user and token type, and create a UserToken record
     *
     * @param object $user
     * @param integer $tokenType
     * @return token
     */
    public static function setUserToken($user, $tokenType)
    {
        $token = Str::random(15) . Str::replace(' ', '/', now('America/Mexico_City'));
        UserToken::create([
            'user_id' => $user->id,
            'token' => Crypt::encryptString($token),
            'token_type_id' => $tokenType,
            'valid_until' => now('America/Mexico_City')->addHours(12),
        ]);
        return $token;
    }

    /**
     * Gets the user, token and the email type, build the email and sends it
     *
     * @param object $user
     * @param string $token
     * @param integer $type
     * @return void
     */
    public static function buildEmail($user, $token, $type)
    {
        $body = VerificationActions::generateBody($user, $token);
        switch ($type) {
            case 1:
                $emailVerify = new VerifyAccount($user, $body);
            break;
            case 2:
                $emailVerify = new ForgotPassword($user, $body);
            break;
            default:
            break;
        }
        Mail::to($user->email)->send($emailVerify);
    }

    /**
     * Builds the email body with the token and request_code (user external identifier)
     *
     * @param object $user
     * @param string $token
     * @return body<encrypted>
     */
    private static function generateBody($user, $token)
    {
        $body = [
            'token' => $token,
            'request_code' => $user->external_identifier,
        ];

        return Crypt::encryptString(json_encode($body));
    }
}