<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\Api\BuildError;
use App\Http\GlobalClases\Api\RegistrationActions;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Store\UserStoreRequest;
use App\Http\Resources\Resources\UserResource;
use App\Models\User;
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
            if ($user->verified == 1) {
                return response()->json(['token' => $user->createToken('user-token')->plainTextToken], 200);
            } else {
                return response()->json(['message' => 'Please verify your account via email' ], 401);
            }
        } else {
            return response()->json(['error' => 'Incorrect credentials'], 403);
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

    public function register(UserStoreRequest $request)
    {
        try {
            $user = User::create($request->all());
            $this->buildVerificationToken($user, 'verification');

            return new UserResource($user);
        } catch (\Throwable $th) {
            BuildError::setError($th, 1);
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function forgotPassword(Request $request)
    {
        if (!empty($request->email)) {
            $user = User::where('email', $request->email)->first();
            if (!empty($user)) {
                $this->buildVerificationToken($user, 'forgot-password');
            }
        }

    }

    public function buildVerificationToken($user, $type)
    {
        $token = RegistrationActions::setUserToken($user, 1);
        RegistrationActions::buildEmail($user, $token, $type);
    }
}
