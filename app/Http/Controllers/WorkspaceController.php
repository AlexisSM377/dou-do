<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\WorkspaceStoreRequest;
use App\Http\Requests\Update\WorkspaceUpdateRequest;
use App\Http\Resources\Collections\WorkspaceCollection;
use App\Http\Resources\Resources\WorkspaceResoruce;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;

/**
 * Controller class to Workspaces actions
 */
class WorkspaceController extends Controller
{
    /**
     * Returns a user workspaces list
     *
     * @return JSON
     */
    public function index(Request $request)
    {
        if (!empty($request->user)) {
            $user = User::where('external_identifier', $request->user)->first();
            return new WorkspaceCollection($user->workspaces);
        }
    }

    public function show(Workspace $workspace)
    {
        return new WorkspaceResoruce($workspace);
    }

    public function store(WorkspaceStoreRequest $request)
    {
        Workspace::create($request->all());
        return response()->json(['message' => 'Espacio de trabajo creado.']);
    }

    public function update(WorkspaceUpdateRequest $request, Workspace $workspace)
    {
        $workspace->update($request->all());
        return response()->json(['message' => 'Espacio de trabajo actualizado.']);
    }

    public function destroy(Workspace $workspace)
    {
        $workspace->delete();
        return response()->json(['message' => 'Espacio de trabajo eliminado']);
    }

}
