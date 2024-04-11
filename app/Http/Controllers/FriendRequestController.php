<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\GlobalClases\Notifications\NotificationPush;
use App\Http\Requests\Store\FriendRequestStoreRequest;
use App\Models\FriendRequest;
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
            $origin_user = $this->searchUser($request->origin_user_id);
            $target_user = $this->searchUser($request->target_user_id);
            if ($origin_user != false && $target_user != false) {
                $request_last = FriendRequest::where('origin_user_id', $origin_user->id)->where('target_user_id', $target_user->id)->where('status', null)->latest()->first();
                $currentDate = Carbon::now('America/Mexico_city');
                if (!empty($request_last->created_at)) {
                    $due_date = $request_last->created_at->addHours(6)->format('Y-m-d H:i:s');
                    if ($currentDate->greaterThan($due_date)) {
                        return $this->friendRequestGenerate($origin_user, $request, $currentDate);
                    } else {
                        return response()->json(['message' => 'Ya has enviado una solicitud a este usuario, vuélvelo a intentar más tarde.', 'status' => 'rejected']);
                    }
                } else {
                    return $this->friendRequestGenerate($origin_user, $target_user, $currentDate);
                }
            } else {
                return response()->json(['message' => 'Código de usuario no válido.'], 404);
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
        }
    }

    public function friendRequestGenerate($origin_user, $target_user, $currentDate)
    {
        $origin_user->friendRequests()->attach($target_user->id, ['created_at' => $currentDate->format('Y-m-d H:i:s')]);
        $this->sendNotification($origin_user, $target_user);
        return response()->json(['message' => 'Solicitud enviada']);
    }

    public function sendNotification($origin_user, $target_user)
    {
        $expo = Expo::normalSetup();
        $expo->subscribe('solicitud', $target_user->expo_push_token);
        $data = [
            'type' => 'friend-request',
            'body' => [
                'user_name' => $origin_user->name . " " . $origin_user->last_name,
            ]
        ];
        NotificationPush::build($data);
    }

    public function searchUser($external_identifier)
    {
        $user = User::where('external_identifier', $external_identifier)->first();
        return !empty($user->id) ? $user : false;
    }
}
