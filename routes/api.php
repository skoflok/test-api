<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/pages/{uuid}/stats', [PageController::class, 'showStats']);
    Route::get('/pages/stats', [StatController::class, 'index']);
    Route::get('/pages/stats/top', [StatController::class, 'top']);
});

Route::post('/sanctum/token', [UserController::class, 'getToken']);

//Route::post('/register', [UserController::class, 'register']);
