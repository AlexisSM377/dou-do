<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\Requests\Api\SetAvatarRequest;
use App\Http\Resources\Collections\AvatarCollection;
use App\Models\Avatar;
use App\Models\User;
use App\Models\UserAvatar;
use Error;
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
            $user = User::where('external_identifier', $request->user_id)->first();
            if (!empty($user)) {
                UserAvatar::create([
                    'user_id' => $user->id,
                    'avatar_id' => $request->avatar_id,
                ]);
            } else {
                throw new Error('No se encontro al usuario indicado');
            }
            return response()->json(['status' => 'ok']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
        }
    }
}
