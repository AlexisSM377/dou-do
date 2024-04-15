<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Models\CollaborationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CollaborationRequestController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = User::where('external_identifier', $request->user)->first();
            $collaborator = User::where('external_identifier', $request->collaborator)->first();
            CollaborationRequest::create(
                array_merge(
                    ['user_id' => $user->id],
                    ['collaborator_id' => $collaborator->id],
                    $request->all()
                )
            );
            return response()->json(['message' => 'Solicitud de colaboración enviada exitosamente.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    /*
    public function store(Request $request)
    {
        try {
            $collaborator = User::where('external_identifier', $request->member)->first();
            $workspace = Workspace::where('id', $request->workspace)->first();
            $collaborator->workspaces()->attach($workspace->id, ['rol_id' => 2]);
            return response()->json(['message' => 'Solicitud de colaboración enviada exitosamente.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }
    */
}
