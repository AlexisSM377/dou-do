<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\Api\BuildForgotPasswordEmail;
use App\Http\GlobalClases\Api\BuildVerificationEmail;
use App\Http\GlobalClases\Api\VerificationActions;
use App\Http\GlobalClases\BuildError;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Store\UserStoreRequest;
use App\Http\Resources\Resources\UserResource;
use App\Models\User;
use Error;
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
                return response()->json([
                    'token' => $user->createToken('user-token')->plainTextToken,
                    'user' => $user,
                ], 200);
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
        return response()->json(['status' => 'ok'], 200);
    }

    public function register(UserStoreRequest $request)
    {
        try {
            $user = User::create($request->all());
            BuildVerificationEmail::build($user, 1);

            return new UserResource($user);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            if (!empty($request->email)) {
                BuildForgotPasswordEmail::build($request->email);
            } else {
                throw new Error('La petición no contiene un correo.');
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 6);
        }
    }

    public function whoIAm()
    {
        return response()->json(['status' => 'ok']);
    }
}
