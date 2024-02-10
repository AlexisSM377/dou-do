<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkspaceResource;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index()
    {
        //* Not used
        // $workspaces = Workspace::paginate(10);
        // return new WorkspaceResource($workspaces);
    }
}
