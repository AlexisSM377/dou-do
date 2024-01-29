<?php

use App\Models\Notification;
use App\Models\Priority;
use App\Models\Profession;
use App\Models\Summary;
use App\Models\Task;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function(){
    Route::resource('users', User::class);
    Route::resource('workspaces', Workspace::class);
    Route::resource('tasks', Task::class);
    Route::resource('notifications', Notification::class);
    Route::resource('professions', Profession::class);
    Route::resource('priorities', Priority::class);
    Route::resource('summaries', Summary::class);
});
