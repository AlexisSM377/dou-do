<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\Resources\Collections\UserCollection;
use App\Models\Workspace;
use Illuminate\Http\Request;

class UserWorkspaceController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!empty($request->workspace_id)) {
                $workspace = Workspace::where('id', $request->workspace_id)->first();
                return new UserCollection( $workspace->users->loadMissing('avatars') );
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }
}
