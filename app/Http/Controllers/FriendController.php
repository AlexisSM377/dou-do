<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\BuildError;
use App\Http\Resources\Collections\FriendCollection;
use App\Http\Resources\Collections\UserCollection;
use App\Http\Resources\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Controller class to Friends actios
 */
class FriendController extends Controller
{
    /**
     * Returns the general friend list
     *
     * @return JsonResponse<Friends>
     */
    public function index(Request $request)
    {
        try {
            if (!empty($request->user)) {
                $user = User::where('external_identifier', $request->user)->first();
                return (new UserCollection($user->friends->loadMissing('avatars')));
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message', 'Se ha generado un error interno, por favor, comunícate con el soporte.'], 500);
        }
    }
}
