<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\GlobalClases\Notifications\NotificationPush;
use App\Models\CollaborationRequest;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;

class CollaborationRequestController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = User::where('external_identifier', $request->user)->first();
            $collaborator = User::where('external_identifier', $request->collaborator)->first();
            $workspace = Workspace::where('id', $request->workspace_id)->first();
            CollaborationRequest::create(
                array_merge(
                    ['user_id' => $user->id],
                    ['collaborator_id' => $collaborator->id],
                    $request->all()
                )
            );
            $this->sendNotification($user, $workspace, $collaborator);
            return response()->json(['message' => 'Solicitud de colaboración enviada exitosamente.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    public function sendNotification($origin_user, $workspace, $target_user)
    {
        $data = [
            'type' => 'workspace-invite',
            'body' => [
                'user_name' => $origin_user->name . " " . $origin_user->last_name,
                'workspace_name' => $workspace->name
            ],
            'target_user' => $target_user
        ];
        NotificationPush::build($data);
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
