<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfessionResource;
use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::all();
        return new ProfessionResource($professions);
    }
}
