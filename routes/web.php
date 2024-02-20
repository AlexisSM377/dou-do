<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InternalManagement;
use App\Http\Controllers\VerifyEmailController;
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
    Route::post('/forwarded', [ VerifyEmailController::class, 'attendRequestForwarded' ])->name('verification.forwarded');
    Route::get('/forwarded-message', [ VerifyEmailController::class, 'showForwardMessage' ])->name('verification.fm');
});

Route::group(['prefix' => 'forgot-password'], function(){
    Route::get('/attend/{body}', [ ForgotPasswordController::class, 'attendRequest' ])->name('forgot-password.attend');
});


Route::get('nose', function(){
    return view('mails.forms.forgot-password');
});