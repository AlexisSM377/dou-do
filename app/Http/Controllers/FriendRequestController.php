<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendRequestResource;
use App\Models\FriendRequest;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    public function index()
    {
        $friendRequests = FriendRequest::paginate(10);
        return new FriendRequestResource($friendRequests);
    }
}
