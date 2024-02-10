<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;

/**
 * Controller class to Friends
 */
class FriendController extends Controller
{
    /**
     * Returns the general friend list 
     *
     * @return JsonResponse
     */
    public function index()
    {
        $friends = Friend::paginate(20);
        // return new FriendResource($friends);
    }
}
