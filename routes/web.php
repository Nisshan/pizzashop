<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CategoriesOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProductVariantsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\Homecontroller;
use App\Http\Controllers\Frontend\OrderController;
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

Route::post('/cart', [CartController::class, 'addToCart'])->name('cart');

Route::get('/checkout', [OrderController::class, 'index'])->name('checkout');
Route::post('/increase/cartItem', [CartController::class, 'increaseCartQuantity'])->name('increase.cart.quantity');
Route::post('/decrease/cartItem', [CartController::class, 'decreaseCartQuantity'])->name('decrease.cart.quantity');
Route::delete('/delete/cartItem/{id}', [CartController::class, 'destroyCart'])->name('remove.cart.item');

Auth::routes();


//        , 'verified';

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => ['auth', 'IsNotUser']], function () {

        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::resource('users', UsersController::class);
        Route::resource('categories', CategoriesController::class);
        Route::resource('products', ProductsController::class);
        Route::resource('orders', OrdersController::class)->except('create');
        Route::post('/orders/changeStatus', [OrdersController::class, 'changeStatus']);

        Route::delete('/products/variant/delete', ProductVariantsController::class)->name('product.variant.destroy');
        Route::get('menu', [CategoriesOrderController::class, 'index'])->name('menu');
        Route::post('/update/menu', [CategoriesOrderController::class, 'updateOrder'])->name('update.position');
    });
});

Route::get('/{category:slug}/{product:slug}', \App\Http\Controllers\Frontend\SinglePageController::class)->name('single');


