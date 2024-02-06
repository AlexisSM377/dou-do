<?php

namespace App\Http\Controllers;

use App\Filters\Api\UserFilter;
use App\Http\Requests\Store\UserStoreRequest;
use App\Http\Requests\update\UserUpdateRequest;
use App\Http\Resources\Collections\UserCollection;
use App\Http\Resources\resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new UserFilter();
        $users = User::where($filter->build($request));
        $users = ($request->includeNotifications) ? $users->with('notifications') : $users;
        return new UserCollection($users->paginate(10)->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (request()->includeNotifications) {
            return new UserResource($user->loadMissing('notifications'));
        } else {
            return new UserResource($user);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
