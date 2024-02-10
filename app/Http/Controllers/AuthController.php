<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller class to User-Auth actions
 */
class AuthController extends Controller
{
    /**
     * Login function - Gets user credentials and returns an auth token or error message
     *
     * @param AuthRequest $request
     * @return JsonResponse<200|403>
     */
    public function login(AuthRequest $request)
    {
        if (Auth::attempt($request->all())) {
            $user = Auth()->User();
            return response()->json(['token' => $user->createToken('user-token')->plainTextToken], 200);
        } else {
            return response()->json(['message' => 'Incorrect credentials'], 403);
        }
    }

    /**
     * Logout function - Gets a user authenticated and returns an informatical message
     *
     * @param Request $request
     * @return JsonResponse<200>
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Closed session'], 200);
    }
}
