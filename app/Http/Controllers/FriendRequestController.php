<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\GlobalClases\Notifications\NotificationPush;
use App\Http\Requests\Store\FriendRequestStoreRequest;
use App\Models\User;
use Carbon\Carbon;
use ExponentPhpSDK\Expo;

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
                $currentDate = Carbon::now('America/Mexico_city');
                if (!empty($request_last->created_at)) {
                    $due_date = $request_last->created_at->addHours(6)->format('Y-m-d H:i:s');
                    if ($currentDate->greaterThan($due_date)) {
                        return $this->friendRequestGenerate($user, $request, $currentDate);
                    } else {
                        return response()->json(['message' => 'Ya has enviado una solicitud a este usuario, necesitas esperar algunas horas para volver a enviar otra.']);
                    }
                } else {
                    return $this->friendRequestGenerate($user, $request, $currentDate);
                }
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
        }
    }

    public function friendRequestGenerate($user, $request, $currentDate)
    {
        $target_user = User::where('external_identifier', $request->target_user_id)->first();
        $user->friendRequests()->attach($target_user->id, ['created_at' => $currentDate->format('Y-m-d H:i:s')]);
        $this->sendNotification($user, $target_user);
        return response()->json(['message' => 'Solicitud enviada']);
    }

    public function sendNotification($origin_user, $target_user)
    {
        $expo = Expo::normalSetup();
        $expo->subscribe('general', $target_user->expo_push_token);
        $data = [
            'type' => 'friend-request',
            'body' => [
                'user_name' => $origin_user->name . " " . $origin_user->last_name,
            ]
        ];
        NotificationPush::build($data);
    }
}
