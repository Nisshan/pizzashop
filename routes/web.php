<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CategoriesOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProductVariantsController;
use App\Http\Controllers\Admin\UsersController;
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

Route::get('/', \App\Http\Controllers\Frontend\Homecontroller::class)->name('home');


Auth::routes();


//        , 'verified';

Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => ['auth','IsNotUser']], function () {

        Route::get('/dashboard',DashboardController::class)->name('dashboard');

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


