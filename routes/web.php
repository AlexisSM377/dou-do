<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InternalManagement;
use App\Http\Controllers\VerifyEmailController;
use App\Http\GlobalClases\Notifications\NotificationPush;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('welcome', function(){
    return view('welcome');
})->name('welcome');

Route::get('/internal-error', [ InternalManagement::class, 'handleInternalError' ])->name('internal.error');

Route::group(['prefix' => 'verification'], function(){
    Route::get('/verify-user/{user}', [ VerifyEmailController::class, 'verifyUser' ])->name('verification.verify');
    Route::get('/attend/{body}', [ VerifyEmailController::class, 'attendVerification' ])->name('verification.attend');
    Route::get('/expired', [ VerifyEmailController::class, 'attendExpiredRequest' ])->name('verification.expired');
    Route::post('/resend', [ VerifyEmailController::class, 'attendRequestForwarded' ])->name('verification.forwarded');
});

Route::group(['prefix' => 'forgot-password'], function(){
    Route::post('/restore/{user}', [ForgotPasswordController::class, 'restorePassword'])->name('forgot-password.restore');
    Route::get('/attend/{body}', [ ForgotPasswordController::class, 'attendRequest' ])->name('forgot-password.attend');
    Route::get('/expired', [ForgotPasswordController::class, 'attendExpiredRequest'])->name('forgot-password.expired');
    Route::post('/resend', [ForgotPasswordController::class, 'attendRequestForwarded'])->name('forgot-password.forwarded');
});

/*
Route::get('/nose', function(){
    $expo = \ExponentPhpSDK\Expo::normalSetup();
    $expo->subscribe('general', 'ExponentPushToken[xruFMYA9YWofjVf3GQnkGK]');
    $data = [
        'type' => 'partner-left-team',
        'body' => [
            'user_name' => 'Rafael',
            'workspace_name' => 'Integrador IDGS-83',
            'task' => 'Generar índice de la documentación'
        ]
    ];
    NotificationPush::build($data);
});
*/