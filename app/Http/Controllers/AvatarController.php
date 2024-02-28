<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collections\AvatarCollection;
use App\Models\Avatar;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function index()
    {
        $avatars = Avatar::paginate(10);
        return new AvatarCollection($avatars);
    }
}
