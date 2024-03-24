<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\Requests\Store\FriendRequestStoreRequest;
use App\Models\User;
use Carbon\Carbon;

/**
 * Controller class to friend requests actions
 */
class FriendRequestController extends Controller
{
    /**
     * Returns a general list from friend requests
     *
     * @return JsonResponse<FriendRequests>
     */
    public function index()
    {
        // TODO: Not used
    }

    public function store(FriendRequestStoreRequest $request)
    {
        try {
            $user = User::where('external_identifier', $request->origin_user_id)->first();
            if ($request->origin_user_id != $request->target_user_id) {
                $request_last = $user->getLastFriendRequestSent();
                $due_date = $request_last->created_at->addHours(6)->format('Y-m-d H:i:s');
                $currentDate = Carbon::now('America/Mexico_city');
                if ($currentDate->greaterThan($due_date)) {
                    $target_user = User::where('external_identifier', $request->target_user_id)->first();
                    $user->friendRequests()->attach($target_user->id, ['created_at' => $currentDate->format('Y-m-d H:i:s')]);
                    return response()->json(['message' => 'Solicitud enviada']);
                } else {
                    return response()->json(['message' => 'Ya has enviado una solicitud a este usuario, necesitas esperar algunas horas para volver a enviar otra.']);
                }
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
        }
    }
}
