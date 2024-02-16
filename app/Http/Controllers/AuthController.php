<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Store\UserStoreRequest;
use App\Http\Resources\Resources\UserResource;
use App\Mail\VerifyAccount;
use App\Models\ErrorLog;
use App\Models\User;
use App\Models\UserToken;
use App\Models\VerificationTraking;
use Error;
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
        try {
            $user = User::create($request->all());
            $token = $this->setUserToken($user, 1);
            $this->buildEmail($user, $token);
            
            return new UserResource($user);
        } catch (\Throwable $th) {
            $this->setError($th, 1);
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function verifyEmail(Request $request)
    {
        
    }

    public function setError($th, $typeError)
    {
        ErrorLog::create([
            'message' => Str::limit($th->getMessage(), 250),
            'error_type_id' => $typeError,
            'class' => $th->getTrace()[0]['class'],
            'function' => $th->getTrace()[0]['function'],
        ]);
    }

    public function setUserToken($user, $tokenType) 
    {
        $token = Str::random(15) . Str::replace(' ', '/', now('America/Mexico_City'));
        UserToken::create([
            'user_id' => $user->id,
            'token' => bcrypt($token),
            'token_type_id' => $tokenType,
            'valid_until' => now('America/Mexico_City')->addHours(12),
        ]);
        return $token;
    }

    public function buildEmail($user, $token)
    {
        $encryptedToken = Crypt::encryptString($token);
        $emailVerify = new VerifyAccount($user, $encryptedToken);
        Mail::to($user->email)->send($emailVerify);
    }
}
