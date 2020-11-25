<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\SupplierInfoController;
use App\Http\Controllers\SupplierProductController;
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

