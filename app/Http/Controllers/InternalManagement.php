<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InternalManagement extends Controller
{
    public function handleInternalError()
    {
        return view('internalManage.internal-error');
    }
}
