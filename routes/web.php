<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClearCart;
use App\Http\Controllers\SupplierInfoController;
use App\Http\Controllers\SupplierProductController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\UserVendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('cities', CityController::class);
Route::resource('vendors',VendorController::class);
Route::resource('categories',CategoryController::class);

Route::group([
    'prefix' => 'supplier'
], function ($router) {
    
    Route::get('',[SupplierInfoController::class,'index']);
    Route::put('',[SupplierInfoController::class,'update']);
    Route::resource('products', SupplierProductController::class);
});

Route::group([
    'prefix' => 'app'
], function ($router) {
    
    Route::get('',[UserVendorController::class,'index']);
    Route::get('product/{id}',[UserProductController::class,'show']);
    Route::get('cart/confirm', [CartController::class,'confirm']);
    Route::resource('cart',CartController::class);
    Route::resource('order', UserOrderController::class);
    Route::post('order/{id}/cancel',[UserOrderController::class,'cancel']);
    Route::get('info', [UserInfoController::class,'index']);
    Route::put('info', [UserInfoController::class,'update']);
    Route::delete('clearcart', ClearCart::class);
    Route::get('supplier/{id}',[UserVendorController::class,'show']);
    Route::resource('address', UserAddressController::class);
});
