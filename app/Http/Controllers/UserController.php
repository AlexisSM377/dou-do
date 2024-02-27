<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Store\UserStoreRequest;
use App\Http\Requests\Update\UserUpdateRequest;
use App\Http\Resources\Collections\UserCollection;
use App\Http\Resources\Resources\UserResource;
use App\Filters\Api\UserFilter;
use App\Models\User;

/**
 * Controller class to users
 */
class UserController extends Controller
{
    /**
     * Returns a general list from users
     *
     * @param Request $request
     * @return JsonResponse<Users>
     */
    public function index(Request $request)
    {
        $filter = new UserFilter();
        $users = User::where($filter->build($request));
        $users = ($request->includeNotifications) ? $users->with('notifications') : $users;
        return new UserCollection($users->paginate(10)->appends($request->query()));
    }

    /**
     * Save in database a new User and returns it
     *
     * @param UserStoreRequest $request
     * @return JsonResponse<User>
     */
    public function store(UserStoreRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }

    /**
     * Gets from database a user and returns it
     *
     * @param User $user
     * @return JsonResponse<User>
     */
    public function show(User $user)
    {
        $includ = [];
        (request()->includeNotifications) ? array_push($includ, 'notifications') : null;
        (request()->includeAvatar) ? array_push($includ, 'avatars') : null;
        return new UserResource($user->loadMissing($includ));
    }

    /**
     * Updates a user and returns it
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return JsonResponse<User>
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove a user and returns a informatical message
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => "El usuario con el correo electronico: $user->email ha sido eliminado",
        ], 200);
    }
}
