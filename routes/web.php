<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CategoriesOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\Homecontroller;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\SinglePageController;
use App\Http\Controllers\ThankYouController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', Homecontroller::class)->name('home');

Auth::routes(['verify' => true]);

//'verified';

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => ['auth', 'IsNotUser']], function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('users', UsersController::class);
        Route::resource('categories', CategoriesController::class);
        Route::resource('products', ProductsController::class);
        Route::resource('orders', OrdersController::class)->except('create');
        Route::resource('coupons', App\Http\Controllers\Admin\CouponController::class);
        Route::post('/orders/changeStatus', [OrdersController::class, 'changeStatus']);
        Route::get('menu', [CategoriesOrderController::class, 'index'])->name('menu');
        Route::post('/update/menu', [CategoriesOrderController::class, 'updateOrder'])->name('update.position');
    });
});


Route::group(['middleware' => ['auth', 'CanBuyProduct', 'verified']], function () {
    Route::get('/user/profile', [\App\Http\Controllers\Frontend\UserProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/change/name', [\App\Http\Controllers\Frontend\UserProfileController::class, 'changeName'])->name('user.change.name');
    Route::post('/user/change/password', [\App\Http\Controllers\Frontend\UserProfileController::class, 'updatePassword'])->name('user.change.password');

});
Route::group(['middleware' => ['CanBuyProduct', 'verified']], function () {
    Route::get('/thankyou', ThankYouController::class)->name('thankyou');
    Route::get('/carts/view', [CartController::class, 'index'])->name('cart.view');
    Route::post('/addTo/cart', [CartController::class, 'addToCart'])->name('cart');
    Route::get('/checkout', [OrderController::class, 'index'])->name('checkout');
    Route::post('/increase/cartItem', [CartController::class, 'increaseCartQuantity'])->name('increase.cart.quantity');
    Route::post('/decrease/cartItem', [CartController::class, 'decreaseCartQuantity'])->name('decrease.cart.quantity');
    Route::delete('/delete/cartItem/{id}', [CartController::class, 'destroyCart'])->name('remove.cart.item');
    Route::post('/coupon/add', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('/coupon/delete', [CouponController::class, 'destroy'])->name('coupon.delete');
    Route::post('/order/create', [OrderController::class, 'store'])->name('order');
    Route::get('/{category:slug}/{product:slug}', SinglePageController::class)->name('single');
});





