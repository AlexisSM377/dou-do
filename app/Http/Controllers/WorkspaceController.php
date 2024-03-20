<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
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
        try {
            if (!empty($request->user)) {
                $user = User::where('external_identifier', $request->user)->first();
                return new WorkspaceCollection($user->workspaces);
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
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
        try {
            return new WorkspaceResoruce($workspace);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    /**
     * Save in database a new workspace and returns it
     *
     * @return JSON
     */
    public function store(WorkspaceStoreRequest $request)
    {
        try {
            $workspace = Workspace::create($request->all());
            $user = User::where('external_identifier', $request->user_id)->first();
            $user->workspaces()->attach($workspace->id);
            return response()->json(['message' => 'Espacio de trabajo creado.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    /**
     * Updates a worskpace and returns it
     *
     * @return JSON
     */
    public function update(WorkspaceUpdateRequest $request, Workspace $workspace)
    {
        try {
            $workspace->update($request->all());
            return response()->json(['message' => 'Espacio de trabajo actualizado.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    /**
     * Remove a worskpace and returns a informatical message
     *
     * @param User $user
     * @return JsonResponse<200>
     */
    public function destroy(Workspace $workspace)
    {
        try {
            $workspace->delete();
            return response()->json(['message' => 'Espacio de trabajo eliminado']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

}
