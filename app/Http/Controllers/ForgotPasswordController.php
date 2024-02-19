<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function receiveRequest(Request $request, $body)
    {
        dd($body);
    }
}
