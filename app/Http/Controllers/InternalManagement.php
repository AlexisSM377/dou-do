<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller class to Internal Management actions
 */
class InternalManagement extends Controller
{
    /**
     * Redirect internal error function - Redirects to view with a internal error message
     *
     * @return void
     */
    public function redirectInternalError()
    {
        return view('internalManage.internal-error');
    }
}
