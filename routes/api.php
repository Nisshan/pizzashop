<?php

use App\Http\Controllers\Api\Admin\UsersController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\VerificationController;
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


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/cart/checkout', [OrderController::class, 'index']);
    Route::get('/orders/all',[OrderController::class,'viewAllOrderByStaff']);
    Route::get('/orders/{order}',[OrderController::class,'viewSingleOrderByStaff']);
    Route::get('/cart/items', [OrderController::class, 'getCartItems']);
    Route::resource('users', UsersController::class)->except('create');
    Route::post('/cart', [CartController::class, 'addToCart']);
    Route::post('/increase/cartItem', [CartController::class, 'increaseCartQuantity']);
    Route::post('/decrease/cartItem', [CartController::class, 'decreaseCartQuantity']);
    Route::post('/delete/cartItem', [CartController::class, 'destroyCart']);
    Route::post('/apply/coupon', [CouponController::class, 'apply']);
    Route::post('/remove/coupon', [CouponController::class, 'remove']);
    Route::post('/order/create', [OrderController::class, 'store']);
    Route::post('/order/changeStatus', [OrderController::class, 'changeStatus']);


});

Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::get('/{product}', [HomeController::class, 'single']);
