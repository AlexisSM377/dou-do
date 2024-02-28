<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\Requests\Api\SetAvatarRequest;
use App\Http\Resources\Collections\AvatarCollection;
use App\Models\Avatar;
use App\Models\UserAvatar;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function index()
    {
        $avatars = Avatar::paginate(10);
        return new AvatarCollection($avatars);
    }

    public function setAvatar(SetAvatarRequest $request)
    {
        try {
            UserAvatar::create($request->all());
            return response()->json(['status' => 'ok']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
        }
    }
}
