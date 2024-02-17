<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


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

Route::get('/get-verify-request/{token}', [
    VerifyEmailController::class, 
    'getVerifyRequest']
)->name('verify-request');

Route::get('welcome', function(){
    return view('welcome');
})->name('welcome');

Route::post('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify-email');

Route::get('nose', function(){
    $body = [
        'token' => 'nose1234nose1234nose1234',
        'request_code' => 'A1-B1-C1'
    ];
    $newBody = json_encode($body);
    dd(Crypt::encryptString($newBody));
});