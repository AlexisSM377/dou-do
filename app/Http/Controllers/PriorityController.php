<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\PriorityCollection;
use App\Http\Resources\PriorityResource;
use App\Models\Priority;

/**
 * Controller class to Priorities actions
 */
class PriorityController extends Controller
{
    /**
     * Returns a general list from priorities
     *
     * @return JSON
     */
    public function index()
    {
        $priorities = Priority::all();
        return new PriorityCollection($priorities);
    }
}
