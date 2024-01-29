<?php

namespace App\Http\Controllers;

use App\Http\Resources\FriendResource;
use App\Models\Friend;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Friend::paginate(20);
        return new FriendResource($friends);
    }
}
