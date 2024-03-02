<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller class to Internal Management actions
 */
class InternalManagement extends Controller
{
    /**
     * Redirects to view with a internal error message
     *
     * @return void
     */
    public function redirectInternalError()
    {
        return view('internalManage.internal-error');
    }
}
