<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * [LH REVIEW] Использовать ресурсы оверхед. Достаточно одной страницы для добавления просмотров. Можно было вынести в api.
 *  Файл routes/api.php . Например Route::post('add-view/{uuid}', PageController@addView);
 */
Route::resource('pages', PageController::class);
