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
            $collaboration_request = CollaborationRequest::create(
                array_merge(
                    ['user_id' => $user->id],
                    ['collaborator_id' => $collaborator->id],
                    $request->all()
                )
            );
            $this->sendNotification($user, $workspace, $collaborator, $collaboration_request);
            return response()->json(['message' => 'Solicitud de colaboración enviada exitosamente.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }

    public function sendNotification($origin_user, $workspace, $target_user, $collaboration_request)
    {
        $data = [
            'type' => 'workspace-invite',
            'body' => [
                'user_name' => $origin_user->name . " " . $origin_user->last_name,
                'workspace_name' => $workspace->name
            ],
            'target_user' => $target_user,
            'workspace' => $collaboration_request->id
        ];
        NotificationPush::build($data);
    }

    public function update(Request $request, $collaboratorRequest)
    {
        try {
            $col_re = CollaborationRequest::find($collaboratorRequest);
            $col_re->update([
                'status' => 1
            ]);
            $collaborator = User::where('id', $col_re->collaborator_id)->first();
            $workspace = Workspace::where('id', $col_re->workspace_id)->first();
            $collaborator->workspaces()->attach($workspace->id, ['rol_id' => 2]);
            return response()->json(['message' => 'Solicitud de colaboración aceptada.']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }
}
