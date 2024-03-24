<?php

namespace App\Http\Controllers;

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
        $user = User::where('external_identifier', $request->origin_user_id)->first();
        if ($request->origin_user_id != $request->target_user_id) {
            $target_user = User::where('external_identifier', $request->target_user_id)->first();
            $user->friendRequests()->attach($target_user->id, ['created_at' => Carbon::now('America/Mexico_city')->format('Y-m-d H:i:s')]);
            return response()->json(['message' => 'Solicitud enviada']);
        }
    }
}
