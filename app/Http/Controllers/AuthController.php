<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Store\UserStoreRequest;
use App\Http\Resources\Resources\UserResource;
use App\Mail\VerifyAccount;
use App\Models\User;
use App\Models\VerificationTraking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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
        $user = User::create($request->all());
        VerificationTraking::create(['user_id' => $user->id, 'valid_until' => now('America/Mexico_City')->addHours(8) ]);
        $token = $user->createToken('email-token', [], now('America/Mexico_City')->addHours(8))->plainTextToken;
        $emailVerify = new VerifyAccount($user, $token);
        Mail::to($user->email)->send($emailVerify);
        return new UserResource($user);
    }

    public function verifyEmail(Request $request)
    {
        if (now('America/Mexico_City')->lessThan($request->user()->verificationTraking->valid_until)) {
            dump("Aun tienes tiempo");
            if ($request->user()->verificationTraking->count <= 2) {
                $request->user()->update(['verified' => true]);
                return redirect()->route('welcome');
            } else {
                dd("Exception");
            }
        } else {
            dd("El tiempo expiro");
        }
    }

}
