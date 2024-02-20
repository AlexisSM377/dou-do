<?php

namespace App\Http\GlobalClases\Api;

class BuildVerificationEmail
{
    public static function build($user, $tokenType)
    {
        $token = VerificationActions::setUserToken($user, $tokenType);
        VerificationActions::buildEmail($user, $token, $tokenType);
    }
}