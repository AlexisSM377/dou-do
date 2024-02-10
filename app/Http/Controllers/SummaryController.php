<?php

namespace App\Http\Controllers;

use App\Http\Resources\SummaryResource;
use App\Models\Summary;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index()
    {
        //* Not used
        // $summaries = Summary::paginate(10);
        // return new SummaryResource($summaries);
    }
}
