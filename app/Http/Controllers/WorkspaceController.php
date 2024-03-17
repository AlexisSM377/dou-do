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

    /**
     * Gets from database a workspace and returns it
     *
     * @param User $user
     * @return JSON
     */
    public function show(Workspace $workspace)
    {
        return new WorkspaceResoruce($workspace);
    }

    /**
     * Save in database a new workspace and returns it
     *
     * @return JSON
     */
    public function store(WorkspaceStoreRequest $request)
    {
        Workspace::create($request->all());
        return response()->json(['message' => 'Espacio de trabajo creado.']);
    }

    /**
     * Updates a worskpace and returns it
     *
     * @return JSON
     */
    public function update(WorkspaceUpdateRequest $request, Workspace $workspace)
    {
        $workspace->update($request->all());
        return response()->json(['message' => 'Espacio de trabajo actualizado.']);
    }

    /**
     * Remove a worskpace and returns a informatical message
     *
     * @param User $user
     * @return JsonResponse<200>
     */
    public function destroy(Workspace $workspace)
    {
        $workspace->delete();
        return response()->json(['message' => 'Espacio de trabajo eliminado']);
    }

}
