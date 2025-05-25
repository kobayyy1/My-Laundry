<?php

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;
use App\Http\Middleware\adminAuthenticate;
use App\Http\Controllers\pages\CartController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\orderController;
use App\Http\Controllers\auth\userAuthController;
use App\Http\Controllers\pages\productController;
use App\Http\Controllers\auth\adminAuthController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\productAdminController;
use App\Http\Controllers\admin\profileAdminController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\forgotpasswordcontroller;
use App\Http\Controllers\admin\transactionAdminController;

// ROUTING USERS
Route::get('/', [indexController::class, 'index'])->name('index');
Route::get('/home', [indexController::class, 'index'])->name('index');
Route::get('/about', [indexController::class, 'about'])->name('about');
Route::get('/product', [indexController::class, 'product'])->name('product');

// PRODUCT_ORDER
Route::get('/product/order/{id}/{slug}', [productController::class, 'order'])->name('product.order');
Route::get('/product/order/delete/{id}/{slug}', [productController::class, 'orderDelete'])->name('product.order.delete');

//CART
Route::get('/cart', [CartController::class, 'cart'])->name('cart');


// AUTHENTICATE
Route::get('/login', [userAuthController::class, 'login'])->name('login');
Route::get('/signup', [userAuthController::class, 'signup'])->name('signup');
Route::post('/signup/post', [userAuthController::class, 'signuppost'])->name('signup.post');
// FORGOT AND RESET
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [forgotpasswordcontroller::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// ROUTING ADMIN
Route::get('/admin/login', [adminAuthController::class, 'login'])->name('admin.login');

Route::prefix('admin')->middleware([adminAuthenticate::class])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [profileAdminController::class, 'index'])->name('admin.profile');
    Route::post('/logout', [adminController::class, 'logout'])->name('admin.logout');

    // ACCOUNT ROUTING
    Route::get('/account', [adminController::class, 'index'])->name('admin.account');
    Route::get('/account/create', [adminController::class, 'create'])->name('admin.account.create');
    Route::post('/account/create/post', [adminController::class, 'createPost'])->name('admin.account.create.post');
    Route::get('/account/update/{id}', [adminController::class, 'update'])->name('admin.account.update');
    Route::put('/account/update/{id}/post', [adminController::class, 'updatePost'])->name('admin.account.update.post');

    // PRODUCT ROUTING
    Route::get('/product', [productAdminController::class, 'data'])->name('admin.product');
    Route::get('/product/create', [productAdminController::class, 'create'])->name('admin.product.create');
    Route::post('/product/create/post', [productAdminController::class, 'createPost'])->name('admin.product.create.post');
    Route::get('/product/update/{id}', [productAdminController::class, 'update'])->name('admin.product.update');
    Route::put('/product/update/post/{id}', [productAdminController::class, 'updatePost'])->name('admin.product.update.post');

    // TRANSACTION ROUTING
    Route::get('transaction', [transactionAdminController::class, 'index'])->name('admin.transaction');


    Route::get('/order', [orderController::class, 'index'])->name('admin.orders');
    Route::post('/order/upload', [orderController::class, 'uploadFile'])->name('admin.orders.upload');
});
Route::post('/logout', [userAuthController::class, 'logout'])->name('logout');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/send-test-email', function () {
    Mail::to('bilnet18@gmail.com')->send(new App\Mail\TestDoang());
    return 'Email sent!';
});
