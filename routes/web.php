<?php

use App\Http\Controllers\AdminChangePasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClearCart;
use App\Http\Controllers\CreateAdminController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeLoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierChangePasswordController;
use App\Http\Controllers\SupplierInfoController;
use App\Http\Controllers\SupplierLoginController;
use App\Http\Controllers\SupplierProductController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserChangePasswordController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\UserVendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorOrderController;
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

// Auth::routes();
Route::get('/create', CreateAdminController::class)->name('admin.create');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
Route::resource('cities', CityController::class);
Route::put('/vendors/{vendor}/updatepassword',[VendorController::class,'updatepassword'])->name('vendors.update.password');
Route::resource('vendors',VendorController::class);
Route::resource('categories',CategoryController::class);
Route::resource('orders',OrderController::class,[
    'as'=>'admin'
]);
Route::resource('employees', EmployeeController::class);
Route::get('login',[EmployeeLoginController::class,'show'])->name('admin.login');
Route::post('login',[EmployeeLoginController::class,'process'])->name('admin.login');
Route::delete('logout',[EmployeeLoginController::class,'logout'])->name('admin.logout');
Route::get('changepassword',[AdminChangePasswordController::class, 'show'])->name('admin.changepassword');
Route::put('changepassword',[AdminChangePasswordController::class, 'change'])->name('admin.changepassword');

Route::group([
    'prefix' => 'supplier'
], function ($router) {
    
    Route::get('',[SupplierInfoController::class,'index'])->name('supplier.home');
    Route::put('',[SupplierInfoController::class,'update'])->name('supplier.update');
    Route::resource('products', SupplierProductController::class);
    Route::resource('orders',VendorOrderController::class,[
        'as'=>"supplier",
    ]);
    Route::get('login',[SupplierLoginController::class,'show'])->name('supplier.login');
    Route::post('login',[SupplierLoginController::class,'process'])->name('supplier.login');
    Route::delete('logout',[SupplierLoginController::class, 'logout'])->name('supplier.logout');
    Route::get('changepassword',[SupplierChangePasswordController::class,'show'])->name('supplier.changepassword');
    Route::put('changepassword',[SupplierChangePasswordController::class,'change'])->name('supplier.changepassword');
});

Route::group([
    'prefix' => 'app'
], function ($router) {
     
    Route::get('',[UserVendorController::class,'index'])->name('customer.home');
    Route::get('product/{id}',[UserProductController::class,'show'])->name('customer.product');
    Route::get('cart/confirm', [CartController::class,'confirm'])->name('cart.confirm');
    Route::resource('cart',CartController::class);
    Route::resource('order', UserOrderController::class);
    Route::post('order/{id}/cancel',[UserOrderController::class,'cancel'])->name('order.cancel');
    Route::get('info', [UserInfoController::class,'index'])->name('customer.info');
    Route::put('info', [UserInfoController::class,'update'])->name('customer.info');
    Route::delete('clearcart', ClearCart::class)->name('cart.cancel');
    Route::get('supplier/{id}',[UserVendorController::class,'show'])->name('customer.supplier');
    Route::resource('address', UserAddressController::class);
    Route::get('login', [CustomerLoginController::class,'showlogin'])->name('customerlogin');
    Route::post('login',[CustomerLoginController::class,'login'])->name('customerlogin');
    Route::get('register',[CustomerRegisterController::class,'showregister'])->name('customerregister');
    Route::post('register',[CustomerRegisterController::class,'register'])->name('customerregister');
    Route::delete('logout',[CustomerLoginController::class,'logout']);
    Route::get('changepassword',[UserChangePasswordController::class,'show'])->name('customerchangepassword');
    Route::put('changepassword',[UserChangePasswordController::class,'change'])->name('customerchangepassword');
});
