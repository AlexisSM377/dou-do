<?php

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
    Route::get('/attend/{body}', [ VerifyEmailController::class, 'getVerifyRequest' ])->name('verification.attend');
    Route::get('/verify/{user}', [ VerifyEmailController::class, 'verified' ])->name('verification.verify');
    Route::get('/expired', [ VerifyEmailController::class, 'verificationExpired' ])->name('verification.expired');
    Route::post('/resend', [ VerifyEmailController::class, 'recendRequest' ])->name('verification.resend');
    Route::get('/forwarded-message', [ VerifyEmailController::class, 'resend' ])->name('verification.fm');
});

