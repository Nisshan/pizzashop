<?php

use App\Http\Controllers\Api\Admin\UsersController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [RegisterController::class, 'handle']);

Route::post('/login', [LoginController::class, 'handle']);

Route::get('/', [HomeController::class, 'home']);
Route::get('/{product}',[HomeController::class,'single']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('users', UsersController::class)->except('create');
});
