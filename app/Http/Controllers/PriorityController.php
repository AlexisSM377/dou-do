<?php

namespace App\Http\Controllers;

use App\Http\Resources\PriorityResource;
use App\Models\Priority;

/**
 * Controller class to Priorities
 */
class PriorityController extends Controller
{
    /**
     * Returns a general list from priorities
     *
     * @return JsonResponse<Priorities>
     */
    public function index()
    {
        // TODO: Not used
    }
}
