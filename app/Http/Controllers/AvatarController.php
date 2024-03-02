<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\Requests\Api\SetAvatarRequest;
use App\Http\Resources\Collections\AvatarCollection;
use App\Models\Avatar;
use App\Models\User;
use App\Models\UserAvatar;
use Error;

/**
 * Controller class to Avatar actions
 */
class AvatarController extends Controller
{
    /**
     * Index function - Returns all avatars in database
     *
     * @return Collection
     */
    public function index()
    {
        $avatars = Avatar::paginate(10);
        return new AvatarCollection($avatars);
    }

    /**
     * Set Avatar function - Set the user avatar
     *
     * @param SetAvatarRequest $request
     * @return JsonResponse<200>
     */
    public function setAvatar(SetAvatarRequest $request)
    {
        try {
            $user = User::where('external_identifier', $request->user_id)->first();
            if (!empty($user)) {
                UserAvatar::where('user_id', $user->id)->delete();
                $user->avatars()->attach($request->avatar_id);
            } else {
                throw new Error('No se encontro al usuario indicado');
            }
            return response()->json(['status' => 'ok']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
        }
    }
}
