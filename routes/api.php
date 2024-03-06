<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\WorkspaceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * Route group for V1 APIs
 * -> Prefix: V1
 * -> Middleware: auth.api
 */
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers', 'middleware' => 'auth.api' ], function(){
    Route::resource('users', UserController::class);
    Route::resource('workspaces', WorkspaceController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('professions', ProfessionController::class);
    Route::resource('priorities', PriorityController::class);
    Route::resource('summaries', SummaryController::class);
    Route::resource('friends', FriendController::class);
    Route::resource('friend-request', FriendRequestController::class);
    Route::resource('avatars', AvatarController::class);
});

/**
 * Routes for:
 ** login
 ** register
 ** forgot-password
 ** set-avatar
 */
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('set-avatar', [AvatarController::class, 'setAvatar']);

/**
 * Route group for:
 ** logout
 ** who-i-am
 ** refresh-user
 * -> Middleware: sanctum
 */
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/who-i-am', [AuthController::class, 'whoIAm']);
    Route::get('/refresh-user', [AuthController::class, 'refreshUser']);
});