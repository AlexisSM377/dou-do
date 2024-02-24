<?php

namespace App\Http\GlobalClases\Api;

use App\Http\GlobalClases\BuildError;
use App\Models\User;

class BuildForgotPasswordEmail
{
    public static function build($email)
    {
        try {
            $user = User::where('email', $email)->first();
            if (!empty($user)) {
                BuildVerificationEmail::build($user, 2);
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 6);
        }
    }
}