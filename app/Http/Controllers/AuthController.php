<?php

namespace App\Http\Controllers;

use App\Http\GlobalClases\Api\BuildForgotPasswordEmail;
use App\Http\GlobalClases\Api\BuildVerificationEmail;
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
     * Gets user credentials and returns an auth token or error message
     *
     * @param AuthRequest $request
     * @return JsonResponse<200|403>
     */
    public function login(AuthRequest $request)
    {
        try {
            if (Auth::attempt($request->all())) {
                $user = User::where('id', Auth()->User()->id)->first();
                if ($user->verified == 1) {
                    return response()->json([
                        'token' => $user->createToken('user-token')->plainTextToken,
                        'user' => new UserResource($user->loadMissing('avatars')),
                    ], 200);
                } else {
                    return response()->json(['message' => 'Por favor, verifica tu cuenta por correo electrónico.' ], 403);
                }
            } else {
                return response()->json(['message' => 'Credenciales incorrectas.'], 401);
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 2);
            return response()->json(['message' => 'Error en el servidor, inténtalo más tarde.'], 500);
        }
    }

    /**
     * Gets a user authenticated and returns an informatical message
     *
     * @param Request $request
     * @return JsonResponse<200>
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json(['status' => 'ok'], 200);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 2);
        }
    }


    /**
     * Save user in database and returns it
     *
     * @param UserStoreRequest $request
     * @return JsonResponse<200>
     */
    public function register(UserStoreRequest $request)
    {
        try {
            $user = User::create($request->all());
            BuildVerificationEmail::build($user, 1);
            return new UserResource($user);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
            return response()->json(['message' => 'Error en el servidor, inténtalo más tarde.'], 500);
        }
    }

    /**
     * Gets the email and send a mail for reset the password
     *
     * @param Request $request
     * @return JsonResponse<200>
     */
    public function forgotPassword(Request $request)
    {
        try {
            if (!empty($request->email)) {
                BuildForgotPasswordEmail::build($request->email);
                return response()->json(['status' => 'ok']);
            } else {
                throw new Error('La petición no contiene un correo.');
            }
        } catch (\Throwable $th) {
            BuildError::saveError($th, 6);
            return response()->json(['message' => $th->getMessage()]);
        }
    }

    /**
     * Checks if the user token is still available
     *
     * @return JsonResponse<200>
     */
    public function whoIAm()
    {
        try {
            return response()->json(['status' => 'ok']);
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
        }
    }

    /**
     * Checks if the user is auth and returns it
     *
     * @param Request $request
     * @return JsonResponse<200>
     */
    public function refreshUser(Request $request)
    {
        try {
            $user = User::where('id', $request->user()->id)->first();
            return new UserResource($user->loadMissing('avatars'));
        } catch (\Throwable $th) {
            BuildError::saveError($th, 1);
        }
    }
}
