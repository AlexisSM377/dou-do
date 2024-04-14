<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InternalManagement;
use App\Http\Controllers\VerifyEmailController;
use App\Http\GlobalClases\Notifications\NotificationPush;
use App\Http\Resources\Collections\UserCollection;
use App\Http\Resources\Resources\UserResource;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\Notification;
use YieldStudio\LaravelExpoNotifier\ExpoNotificationsChannel;
use YieldStudio\LaravelExpoNotifier\Dto\ExpoMessage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//* Route for dashboard
Route::get('/', function () {
    return view('dashboard');
});

//* Route for welcome to the app
Route::get('welcome', function(){
    return view('welcome');
})->name('welcome');

//* Route for manage internal errors
Route::get('/internal-error', [ InternalManagement::class, 'redirectInternalError' ])->name('internal.error');

/**
 * Route group for Email verification
 ** verify-user
 ** attend
 ** expired
 ** resend
 * -> Prefix: verification
 */
Route::group(['prefix' => 'verification'], function(){
    Route::get('/verify-user/{user}', [ VerifyEmailController::class, 'verifyUser' ])->name('verification.verify');
    Route::get('/attend/{body}', [ VerifyEmailController::class, 'attendVerification' ])->name('verification.attend');
    Route::get('/expired', [ VerifyEmailController::class, 'attendExpiredRequest' ])->name('verification.expired');
    Route::post('/resend', [ VerifyEmailController::class, 'attendRequestForwarded' ])->name('verification.forwarded');
});

/**
 * Route group for Restore password
 ** restore
 ** attend
 ** expired
 ** resend
 * -> Prefix: forgot-password
 */
Route::group(['prefix' => 'forgot-password'], function(){
    Route::post('/restore/{user}', [ForgotPasswordController::class, 'restorePassword'])->name('forgot-password.restore');
    Route::get('/attend/{body}', [ ForgotPasswordController::class, 'attendRequest' ])->name('forgot-password.attend');
    Route::get('/expired', [ForgotPasswordController::class, 'attendExpiredRequest'])->name('forgot-password.expired');
    Route::post('/resend', [ForgotPasswordController::class, 'attendRequestForwarded'])->name('forgot-password.forwarded');
});

// Route::get('/nose', function(){
//     $expo = \ExponentPhpSDK\Expo::normalSetup();
//     $expo->subscribe('user_rafa', 'ExponentPushToken[NX-kLmDQZkZbrmlsqpMKjS]');
//     $notification = [
//         'title' => 'Solicitud de amistad.',
//         'body' => 'Rafa te ha enviado una solicitud de amistad. 🤝'
//     ];
//     $expo->notify(['user_rafa'], $notification);
// });

Route::get('/nose', function(){
    $external_identifier = "83d89b8f-83f0-4905-aefd-ff8aadb9a1d9";
    $user = User::where('external_identifier', $external_identifier)->first();
    dd( new UserCollection($user->friends->loadMissing('avatars')) );
});