<?php

namespace App\Http\GlobalClases\Api;

use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\UserToken;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VerificationActions
{
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

    private static function generateBody($user, $token)
    {
        $body = [
            'token' => $token,
            'request_code' => $user->external_identifier,
        ];

        return Crypt::encryptString(json_encode($body));
    }
}