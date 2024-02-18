<?php

use App\Http\Controllers\AuthController;
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

Route::group(['prefix' => 'verification'], function(){
    Route::get('/receive-request/{body}', [ VerifyEmailController::class, 'getVerifyRequest' ])->name('receive-request');
    Route::get('/expired', [ VerifyEmailController::class, 'verificationExpired' ])->name('expired');
});
