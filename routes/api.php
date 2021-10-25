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
    /**
     * [LH REVIEW]
     * метода PageController->showStats не существует
     */
    Route::get('/pages/{uuid}/stats', [PageController::class, 'showStats']);
    Route::get('/pages/stats', [StatController::class, 'index']);
    /**
     * [LH REVIEW]
     * Для клиентов, в частности для веб-приложений, не очень удобно делать запросы в виде /pages/stats/top?day={кол-во дней}
     * Лучше сделать Route::get('/pages/stats/top/{period}', [StatController::class, 'top'])->where(['period' => ('day'|'week'|'month'|'year')]);
     */
    Route::get('/pages/stats/top', [StatController::class, 'top']);
});

Route::post('/sanctum/token', [UserController::class, 'getToken']);

//Route::post('/register', [UserController::class, 'register']);
