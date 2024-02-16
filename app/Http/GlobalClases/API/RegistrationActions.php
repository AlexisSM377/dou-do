<?php

use App\Mail\VerifyAccount;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationActions 
{
    public static function verifyEmail(Request $request)
    {
        
    }

    public static function setUserToken($user, $tokenType) 
    {
        $token = Str::random(15) . Str::replace(' ', '/', now('America/Mexico_City'));
        UserToken::create([
            'user_id' => $user->id,
            'token' => bcrypt($token),
            'token_type_id' => $tokenType,
            'valid_until' => now('America/Mexico_City')->addHours(12),
        ]);
        return $token;
    }

    public static function buildEmail($user, $token)
    {
        $encryptedToken = Crypt::encryptString($token);
        $emailVerify = new VerifyAccount($user, $encryptedToken);
        Mail::to($user->email)->send($emailVerify);
    }
}