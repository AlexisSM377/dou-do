<?php

namespace App\Http\GlobalClases\Api;

/**
 * Class to BuildVerificationEmail actions
 */
class BuildVerificationEmail
{
    /**
     * Gets the user and the token type, and build the verification email
     *
     * @param string $user
     * @param integer $tokenType
     * @return void
     */
    public static function build($user, $tokenType)
    {
        $token = VerificationActions::setUserToken($user, $tokenType);
        VerificationActions::buildEmail($user, $token, $tokenType);
    }
}