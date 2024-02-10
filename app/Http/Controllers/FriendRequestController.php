<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;

/**
 * Controller class to friend requests
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
        $friendRequests = FriendRequest::paginate(10);
        // return new FriendRequestResource($friendRequests);
    }
}
