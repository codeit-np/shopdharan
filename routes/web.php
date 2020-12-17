<?php

use App\Http\Controllers\AdminChangePasswordController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\AdminResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClearCart;
use App\Http\Controllers\CreateAdminController;
use App\Http\Controllers\CustomerForgotPasswordController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\CustomerResetPasswordController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeLoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierChangePasswordController;
use App\Http\Controllers\SupplierForgotPasswordController;
use App\Http\Controllers\SupplierInfoController;
use App\Http\Controllers\SupplierLoginController;
use App\Http\Controllers\SupplierProductController;
use App\Http\Controllers\SupplierResetPasswordController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::group([
    'prefix' => 'admin'
], function ($router) {
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
Route::get('/create', CreateAdminController::class)->name('admin.create');
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
Route::get('forgotpassword',[AdminForgotPasswordController::class,'show'])->name('admin.forgotpassword');
Route::post('forgotpassword',[AdminForgotPasswordController::class,'send'])->name('admin.forgotpassword');
Route::get('resetpassword',[AdminResetPasswordController::class,'show'])->name('admin.reset');
Route::post('resetpassword',[AdminResetPasswordController::class,'send'])->name('admin.reset');
});


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
    Route::get('forgotpassword',[SupplierForgotPasswordController::class,'show'])->name('supplier.forgotpassword');
    Route::post('forgotpassword',[SupplierForgotPasswordController::class,'send'])->name('supplier.forgotpassword');
    Route::get('resetpassword',[SupplierResetPasswordController::class,'show'])->name('supplier.reset');
    Route::post('resetpassword',[SupplierResetPasswordController::class,'send'])->name('supplier.reset');
    
});

// Route::group([
//     'prefix' => 'app'
// ], function ($router) {
     
    Route::get('',[UserVendorController::class,'index'])->name('customer.home');
    Route::get('product/{id}',[UserProductController::class,'show'])->name('customer.product');
    Route::get('cart/confirm', [CartController::class,'confirm'])->name('cart.confirm');
    Route::resource('cart',CartController::class);
    Route::resource('order', UserOrderController::class,
    ["as"=>'customer']);
    Route::post('order/{id}/cancel',[UserOrderController::class,'cancel'])->name('order.cancel');
    Route::get('info', [UserInfoController::class,'index'])->name('customer.info');
    Route::put('info', [UserInfoController::class,'update'])->name('customer.info');
    Route::delete('clearcart', ClearCart::class)->name('cart.clear');
    Route::get('vendor/{id}',[UserVendorController::class,'show'])->name('customer.supplier');
    Route::resource('address', UserAddressController::class);
    Route::get('login', [CustomerLoginController::class,'showlogin'])->name('customer.login');
    Route::post('login',[CustomerLoginController::class,'login'])->name('customer.login');
    Route::get('register',[CustomerRegisterController::class,'showregister'])->name('customer.register');
    Route::post('register',[CustomerRegisterController::class,'register'])->name('customer.register');
    Route::delete('logout',[CustomerLoginController::class,'logout'])->name('customer.logout');
    Route::get('changepassword',[UserChangePasswordController::class,'show'])->name('customer.changepassword');
    Route::put('changepassword',[UserChangePasswordController::class,'change'])->name('customer.changepassword');
    Route::get('forgotpassword',[CustomerForgotPasswordController::class,'show'])->name('customer.forgotpassword');
    Route::post('forgotpassword',[CustomerForgotPasswordController::class,'send'])->name('customer.forgotpassword');
    Route::get('resetpassword',[CustomerResetPasswordController::class,'show'])->name('customer.reset');
    Route::post('resetpassword',[CustomerResetPasswordController::class,'send'])->name('customer.reset');
    
    // });
