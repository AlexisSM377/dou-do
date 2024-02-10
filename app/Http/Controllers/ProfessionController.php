<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfessionResource;
use App\Models\Profession;

/**
 * Controller class to Professions
 */
class ProfessionController extends Controller
{
    /**
     * Returns a general list from Professions
     *
     * @return JsonResponse<Professions>
     */
    public function index()
    {
        // TODO: Not used
    }
}
